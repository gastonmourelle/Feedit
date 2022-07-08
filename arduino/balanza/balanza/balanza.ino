#include <HX711_ADC.h> // https://github.com/olkal/HX711_ADC
#include <Wire.h>

HX711_ADC LoadCell(5, 4); // dt pin, sck pin

void setup() {
  Serial.begin(9600);
  LoadCell.begin(); // start connection to HX711
  LoadCell.start(2000); // load cells gets 2000ms of time to stabilize
  LoadCell.setCalFactor(485.0); // calibration factor for load cell => strongly dependent on your individual setup
}

void loop() {
  LoadCell.update(); // retrieves data from the load cell
  float i = LoadCell.getData(); // get output value
  Serial.print("Peso[g]:"); // print out to LCD
  Serial.println(i); // print out the retrieved value to the second row
}
