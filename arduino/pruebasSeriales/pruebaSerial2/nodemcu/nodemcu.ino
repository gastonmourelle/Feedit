#include <SoftwareSerial.h>

SoftwareSerial Node_SoftSerial(D3,D4); //RX | TX

char c;
String dataIn;
String guardarSerial;

void setup() {
  Serial.begin(57600);
  Node_SoftSerial.begin(9600);
}

void loop() {
  while(Node_SoftSerial.available() > 0){
    c = Node_SoftSerial.read();
    if(c=='\n') {
      break;
    }
    else{
      dataIn+=c;
    }
  }
  if(c=='\n'){
    Serial.println(dataIn);
    Node_SoftSerial.print("Node \n");
    c=0;
    dataIn="";
  }
  /*delimitarSerial();*/
}

void delimitarSerial(){
  guardarSerial = Node_SoftSerial.readStringUntil('\n');
  int delimitador, delimitador1, delimitador2;
  delimitador = guardarSerial.indexOf("%");
  delimitador1 = guardarSerial.indexOf("%", delimitador + 1);
  delimitador2 = guardarSerial.indexOf("%", delimitador1 +1);

  String first = guardarSerial.substring(delimitador + 1, delimitador1);
  String second = guardarSerial.substring(delimitador1 + 1, delimitador2);
  Serial.println(second);
  delay(4000);
}
