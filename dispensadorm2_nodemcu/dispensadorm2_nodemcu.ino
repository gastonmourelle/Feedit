
//--- NodeMCU ESP8266
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>

//--- RFID
#include <SPI.h>
#include <MFRC522.h>

//--- Recibir serial de Arduino
#include <SoftwareSerial.h>

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//--- Puertos RFID
#define SS_PIN D2
#define RST_PIN D1
#define ON_Board_LED 2
MFRC522 mfrc522(SS_PIN, RST_PIN);

//--- Puertos de la conexión serial con arduino
SoftwareSerial recibirSerial (D3);

//---------------------------------------------------------------------------------------------DATOS CONEXIÓN-------------------------------------------------------------------------------//

ESP8266WebServer server(80);

const char *ssid = "arroz con atun";
const char *password = "gastonmourelle99";
const char *host = "http://192.168.0.100/dispensadorm2/";

/*const char *ssid = "iPhone de Gaston";
const char *password = "gastonmourelle";
const char *host = "http://172.20.10.7/dispensadorm2/";*/

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

int readsuccess;
byte readcard[4];
char str[32] = "";
String StrUID;
String guardarSerial;

//-----------------------------------------------------------------------------------------------SETUP--------------------------------------------------------------------------------------//

void setup()
{
    Serial.begin(115200);
    recibirSerial.begin(9600);
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

void loop()
{
    enviarRfid();
}

//----------------------------------------Obtener UID del llavero o tarjeta-----------------------------------------------------------------------------------------------------------------//

int getid()
{
    if (!mfrc522.PICC_IsNewCardPresent())
    {
        return 0;
    }
    if (!mfrc522.PICC_ReadCardSerial())
    {
        return 0;
    }

    for (int i = 0; i < 4; i++)
    {
        readcard[i] = mfrc522.uid.uidByte[i]; // guardar UID en el array
        array_to_string(readcard, 4, str);
        StrUID = str;
    }
    mfrc522.PICC_HaltA();
    return 1;
}

//----------------------------------------Enviar RFID al servidor--------------------------------------------------------------------------------------------------------------------------//

void enviarRfid()
{
    readsuccess = getid();

    if (readsuccess)
    {
        digitalWrite(ON_Board_LED, LOW);
        HTTPClient http;

        String UIDresultSend, postData;
        UIDresultSend = StrUID;

        postData = "UIDresultado=" + UIDresultSend;

        String url, link;
        url = "datosESP_PHP.php";
        link = host + url;
        http.begin(link);
        http.addHeader("Content-Type", "application/x-www-form-urlencoded");

        int httpCode = http.POST(postData);
        String payload = http.getString();

        Serial.print("UID: ");
        Serial.println(UIDresultSend);

        //--- Recibir datos desde el servidor cuando se detecta el RFID
        if (UIDresultSend)
        {
            HTTPClient http;
            String url, link, data;
            int id = 0;
            url = "datosPHP_ESP.php";
            link = host + url;
            data = "ID=" + String(id);
            http.begin(link);
            http.addHeader("Content-Type", "application/x-www-form-urlencoded");
            int httpCodeGet = http.POST(data);
            String payloadGet = http.getString();
            Serial.println(payloadGet);
            Serial.println("");
            datosArduino();
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

//-------------------------------------Recibir datos de Arduino desde el serial-------------------------------------------------------------------------------------------------------------//

void datosArduino()
{
  guardarSerial = recibirSerial.readStringUntil('\r');
  int delimitador, delimitador1, delimitador2;
  delimitador = guardarSerial.indexOf("%");
  delimitador1 = guardarSerial.indexOf("%", delimitador + 1);
  delimitador2 = guardarSerial.indexOf("%", delimitador1 +1);

  String bal = guardarSerial.substring(delimitador + 1, delimitador1);
  String ultra = guardarSerial.substring(delimitador1 + 1, delimitador2);
  Serial.println("Ultrasonido: "+ultra);
}
