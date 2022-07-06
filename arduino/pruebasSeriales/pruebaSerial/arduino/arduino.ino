#include <SoftwareSerial.h>

SoftwareSerial Arduino_SoftSerial(10,11); //RX | TX

String balanza = "10";
String ultrasonido = "40";
char c;
String dataIn;

void setup() {
  Serial.begin(57600);
  Arduino_SoftSerial.begin(9600);
}

void loop() {
  Arduino_SoftSerial.print("%"+balanza+"%"+ultrasonido+"%\n");
  delay(2000);
  /*Arduino_SoftSerial.print("ARduino \n");
  delay(1000);*/

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
