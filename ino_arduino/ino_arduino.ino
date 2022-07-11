#include <SoftwareSerial.h> //--- Comunicarse por serial con ESP
#include <Stepper.h> //--- Motor paso a paso

#define motor_velocidad 10 //Velocidad a la cual se moverá el motor a pasos 0-3 rpm
#define gramos_vuelta 50 // Cambiar valor para ajustar giros
#define pasos_vuelta 2048

SoftwareSerial esp(2, 3);
Stepper motor(2048, 8, 6, 9, 7);
int dato_recibido = 0;

void setup() {
  Serial.begin(115200);
  esp.begin(115200);
  motor.setSpeed(motor_velocidad);
}

void loop() 
{
  if(esp.available() > 0)
  {
    dato_recibido = esp.readStringUntil('\n').toInt();
    Serial.println(dato_recibido);
    
    /*-----------------------------------------------------------------------
    dato_recibido = 1 === (salida del perro - termino de comer)
    dato_recibido = 2 === (ya uso todos sus turnos, no dispensa)
    dato_recibido = 3 === (cooldown activo - tiempo de espera, no dispensa)
    dato_recibido > 3 === (gramos que tiene que dispensar)
    -----------------------------------------------------------------------*/
    
    if (dato_recibido > 3){
      vuelta(calcularVueltas(dato_recibido));
    }
    else if (dato_recibido == 1){
      // Enviar datos del ultrasonido y de la balanza
      
    }
  }
}

void vuelta(int vueltas)
{
  for(long i = 0; i < (pasos_vuelta*vueltas); i++)
    motor.step(1);
}

float calcularVueltas(int gramos)
{
  return gramos/gramos_vuelta;
}
