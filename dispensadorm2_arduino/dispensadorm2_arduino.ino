#include <SoftwareSerial.h>
#include <HX711_ADC.h>
#include <Wire.h>

HX711_ADC LoadCell(5, 4); // dt pin, sck pin
SoftwareSerial Arduino_SoftSerial(10,11); //RX | TX

const int Trigger = 2;
const int Echo = 3;

float i;

String balanza = "10";
String ultrasonido = "40";
char c;
String dataIn;
long t; //timepo que demora en llegar el eco
long d; //distancia en centimetros

void setup() {
  Serial.begin(57600);
  Arduino_SoftSerial.begin(9600);
  pinMode(Trigger, OUTPUT); //pin como salida
  pinMode(Echo, INPUT);  //pin como entrada
  digitalWrite(Trigger, LOW);//Inicializamos el pin con 0
  LoadCell.begin(); // start connection to HX711
  LoadCell.start(2000); // load cells gets 2000ms of time to stabilize
  LoadCell.setCalFactor(485.0); // calibration factor for load cell => strongly dependent on your individual setup
}

void loop() {
  ultra();
  celda();
  Arduino_SoftSerial.print("%"+balanza+"%"+i+"%\n");
  delay(1200);
  

  while(Arduino_SoftSerial.available() > 0){
    c = Arduino_SoftSerial.read();
    if (c == '\n'){
      break;
    }
    else{
      dataIn += c;
    }
  }
  if(c == '\n'){
    Serial.println(dataIn);
    c=0;
    dataIn="";
  }
}

void ultra(){

  digitalWrite(Trigger, HIGH);
  delayMicroseconds(10);          //Enviamos un pulso de 10us
  digitalWrite(Trigger, LOW);
  
  t = pulseIn(Echo, HIGH); //obtenemos el ancho del pulso
  d = t/59;             //escalamos el tiempo a una distancia en cm
}

void celda(){
  LoadCell.update(); // retrieves data from the load cell
  i = LoadCell.getData(); // get output value
  Serial.println(i);
}
