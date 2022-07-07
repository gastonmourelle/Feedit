#include <SoftwareSerial.h>

SoftwareSerial Arduino_SoftSerial(8,9); //RX | TX

String balanza = "10";
String ultrasonido = "40";
char c;
String dataIn;
String guardarSerial;

void setup() {
  Serial.begin(57600);
  Arduino_SoftSerial.begin(9600);
}

void loop() {
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
  delimitarSerial();
  Arduino_SoftSerial.print("%"+balanza+"%"+ultrasonido+"%\n");
  c=0;
  dataIn="";
  }
}

void delimitarSerial(){
  int delimitador, delimitador1, delimitador2;
  delimitador = dataIn.indexOf("%");
  delimitador1 = dataIn.indexOf("%", delimitador + 1);
  delimitador2 = dataIn.indexOf("%", delimitador1 +1);

  String first = dataIn.substring(delimitador + 1, delimitador1);
  String second = dataIn.substring(delimitador1 + 1, delimitador2);
  Serial.println(first);
}
