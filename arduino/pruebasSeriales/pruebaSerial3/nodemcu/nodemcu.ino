#include <SoftwareSerial.h>

SoftwareSerial Node_SoftSerial(D3,D4); //RX | TX

String motor = "5 vueltas";
String bocina = "prender bocina";
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
    delimitarSerial();
    Node_SoftSerial.print("%"+motor+"%"+bocina+"%\n");
    c=0;
    dataIn="";
  }
}

void delimitarSerial(){
  /*guardarSerial = Node_SoftSerial.readStringUntil('\n');*/
  int delimitador, delimitador1, delimitador2;
  delimitador = dataIn.indexOf("%");
  delimitador1 = dataIn.indexOf("%", delimitador + 1);
  delimitador2 = dataIn.indexOf("%", delimitador1 +1);

  String first = dataIn.substring(delimitador + 1, delimitador1);
  String second = dataIn.substring(delimitador1 + 1, delimitador2);
  Serial.println(second);
  delay(4000);
}
