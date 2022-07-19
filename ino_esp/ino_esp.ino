//--- NodeMCU ESP8266
#include <WiFiClient.h>
#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>

//--- RFID
#include <SPI.h>
#include <MFRC522.h>

//--- Comunicarse por serial con Arduino
#include <Arduino.h>
#include <SoftwareSerial.h>

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//--- Pines RFID
#define SS_PIN D0
#define RST_PIN D1
#define ON_Board_LED 2
MFRC522 mfrc522(SS_PIN, RST_PIN);

//--- Pines de la conexión serial con arduino
SoftwareSerial esp_serial (D2, D3);

//---------------------------------------------------------------------------------------------DATOS CONEXIÓN-------------------------------------------------------------------------------//

ESP8266WebServer server(80);

const char *ssid = "arroz con atun";
const char *password = "gastonmourelle99";
const char *host = "http://192.168.0.105/dispensadorm2/";

/* const char *ssid = "iPhone de Gaston";
const char *password = "gastonmourelle";
const char *host = "http://172.20.10.7/dispensadorm2/"; */

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

uint8_t control = 0x00;
bool bandera = 0;
String perro_actual = "";

byte tag_leido[4];
char str[32] = "";
String uid_string;

String guardarSerial;

String peso;
String ultrasonido;
bool estado = 0;

//-----------------------------------------------------------------------------------------------SETUP--------------------------------------------------------------------------------------//

void setup()
{
    Serial.begin(115200);
    esp_serial.begin(115200);
    SPI.begin();
    mfrc522.PCD_Init();

    delay(500);

    WiFi.begin(ssid, password);
    Serial.println("");

    pinMode(ON_Board_LED, OUTPUT);
    digitalWrite(ON_Board_LED, HIGH);

    //--- Esperando conexión
    Serial.print("Conectando");
    while (WiFi.status() != WL_CONNECTED)
    {
        Serial.print(".");

        //--- Parpadeo del led del esp mientras se conecta a la red
        digitalWrite(ON_Board_LED, LOW);
        delay(250);
        digitalWrite(ON_Board_LED, HIGH);
        delay(250);
    }
    digitalWrite(ON_Board_LED, HIGH); // apaga el led cuando se conecta

    //--- Mostrar datos de conexión cuando se conecte correctamente a la red
    Serial.println("");
    Serial.print("Conectado con éxito a: ");
    Serial.println(ssid);
    Serial.print("Dirección IP: ");
    Serial.println(WiFi.localIP());
    Serial.println("Coloque el tag en el sensor para ver su UID");
    Serial.println("");
}

//-----------------------------------------------------------------------------------------------LOOP---------------------------------------------------------------------------------------//
uint8_t buf[10]= {};
MFRC522::Uid id;
MFRC522::Uid id2;
bool is_card_present = false;
void PrintHex(uint8_t *data, uint8_t length) // prints 8-bit data in hex with leading zeroes
{
char tmp[16];
for (int i=0; i<length; i++) {
tag_leido[i] = mfrc522.uid.uidByte[i]; // guardar UID en el array
array_to_string(tag_leido, 4, str);
uid_string = str;
}
}
//*****************************************************************************************//

void cpid(MFRC522::Uid *id){
memset(id, 0, sizeof(MFRC522::Uid));
memcpy(id->uidByte, mfrc522.uid.uidByte, mfrc522.uid.size);
id->size = mfrc522.uid.size;
id->sak = mfrc522.uid.sak;
}

void loop(){
MFRC522::MIFARE_Key key;
for (byte i = 0; i < 6; i++) key.keyByte[i] = 0xFF;
MFRC522::StatusCode status;

if ( !mfrc522.PICC_IsNewCardPresent()) {
return;
}
if ( !mfrc522.PICC_ReadCardSerial()) {
return;
}
uint8_t buf_len=4;
cpid(&id);
PrintHex(id.uidByte, id.size);
Serial.println(uid_string);

while(true)
{
control=0;
for(int i=0; i<3; i++)
{
if(!mfrc522.PICC_IsNewCardPresent())
{
if(mfrc522.PICC_ReadCardSerial())
{
//Serial.print('a');
control |= 0x16;
}
if(mfrc522.PICC_ReadCardSerial())
{
//Serial.print('b');
control |= 0x16;
}
//Serial.print('c');
control += 0x1;
}
//Serial.print('d');
control += 0x4;
}

//Serial.println(control);
if(control == 13 || control == 14)
{
  if(!estado)
  {
    Serial.println("Entro el perro");
    enviarEntroPerro("entrada");
    estado = 1;
  }
}
else
{
break;
}
}
Serial.println("Salio el perro");
enviarEntroPerro("salida");
estado = 0;
mfrc522.PICC_HaltA();
mfrc522.PCD_StopCrypto1();
}

int enviarEntroPerro(String inout)
{
  //leido = leer_uid();

    if (true)
    {
        String resultado_uid, datos_post;
        resultado_uid = uid_string;
        digitalWrite(ON_Board_LED, LOW);
        HTTPClient http;

        datos_post = "UIDresultado=" + resultado_uid + "&situacion=" + inout;

        String url, link;
        url = "datosESP_PHP.php";
        link = host + url;
        http.begin(link);
        http.addHeader("Content-Type", "application/x-www-form-urlencoded");

        int codigo_http = http.POST(datos_post);
        String dato_recibido = http.getString();
        http.end();
        /*Serial.print("UID: ");
        Serial.println(resultado_uid);*/

        //--- Recibir datos desde el servidor cuando se detecta el RFID
        if (resultado_uid || inout == "salida")
        {
            HTTPClient http;
            String url, link, data;
            int id = 0;
            url = "datosPHP_ESP.php";
            link = host + url;
            data = "ID=" + String(id);
            http.begin(link);
            http.addHeader("Content-Type", "application/x-www-form-urlencoded");
            int codigo_httpGet = http.POST(data);
            String dato_recibidoGet = http.getString();
            Serial.println(dato_recibidoGet);

            // Separar datos en strings
            int delimitador, delimitador1, delimitador2;
            delimitador = dato_recibidoGet.indexOf("&");
            delimitador1 = dato_recibidoGet.indexOf("&", delimitador + 1);
            delimitador2 = dato_recibidoGet.indexOf("&", delimitador1 +1);

            String dato_gramos = dato_recibidoGet.substring(delimitador + 1, delimitador1);
            /*String dato2 = dato_recibidoGet.substring(delimitador1 + 1, delimitador2);*/
            
            enviarArduino(dato_gramos);
           
            if (dato_gramos.toInt() == 1){
              recibirArduino();
            }
        }

        http.end();
        delay(1000);
        digitalWrite(ON_Board_LED, HIGH);
    }
}

//----------------------------------------Cambiar el UID a string---------------------------------------------------------------------------------------------------------------------------//

void array_to_string(byte array[], unsigned int len, char buffer[])
{
    for (unsigned int i = 0; i < len; i++)
    {
        byte nib1 = (array[i] >> 4) & 0x0F;
        byte nib2 = (array[i] >> 0) & 0x0F;
        buffer[i * 2 + 0] = nib1 < 0xA ? '0' + nib1 : 'A' + nib1 - 0xA;
        buffer[i * 2 + 1] = nib2 < 0xA ? '0' + nib2 : 'A' + nib2 - 0xA;
    }
    buffer[len * 2] = '\0';
}

//----------------------------------------Enviar codigo UID al arduino---------------------------------------------------------------------------------------------------------------------------//

void enviarArduino(String mensaje)
{
  esp_serial.println(mensaje);
}

//-------------------------------------Recibir datos de Arduino desde el serial-------------------------------------------------------------------------------------------------------------//

void recibirArduino()
{
  guardarSerial = esp_serial.readStringUntil('\n');
  
  int delimitador, delimitador1, delimitador2;
  delimitador = guardarSerial.indexOf("&");
  delimitador1 = guardarSerial.indexOf("&", delimitador + 1);
  delimitador2 = guardarSerial.indexOf("&", delimitador1 +1);

  peso = guardarSerial.substring(delimitador + 1, delimitador1);
  ultrasonido = guardarSerial.substring(delimitador1 + 1, delimitador2);
  Serial.println("Peso: "+peso);
  Serial.println("Ultrasonido: "+ultrasonido);
  enviarDatos();
}

//----------------------------------------Enviar ultrasonido y peso al servidor--------------------------------------------------------------------------------------------------------------------------//

void enviarDatos(){
  WiFiClient wifi;
  HTTPClient http;
  String url, link;
  url = "peso_ultra.php";
  link = host + url;

  http.begin(wifi, link);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  String dato_enviado = "peso=" + peso + "&ultrasonido=" + ultrasonido;
  int codigo_enviado = http.POST(dato_enviado);
  http.end();
  
}
