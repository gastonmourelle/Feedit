/*---------------Comunicación serial-----------------*/
#include <SoftwareSerial.h>
SoftwareSerial esp(2, 3);
int dato_recibido = 0;

/*---------------Motor paso a paso-----------------*/
#include <Stepper.h>
#define motor_velocidad 10 //Velocidad a la cual se moverá el motor a pasos 0-3 rpm
#define gramos_vuelta 100 // Cambiar valor para ajustar giros
#define pasos_vuelta 2048
Stepper motor(2048, 8, 6, 9, 7);

/*---------------Celda de carga-----------------*/


/*---------------Ultrasonido-----------------*/
const int ultra_trigger = 4;   //Pin digital 4 para el Trigger del sensor
const int ultra_echo = 5;   //Pin digital 5 para el Echo del sensor
long ultra_tiempo; //timepo que demora en llegar el eco
long ultra_distancia; //distancia en centimetros

void setup() {
  //--- Serial
  Serial.begin(115200);
  esp.begin(115200);
  
  //--- Motor
  motor.setSpeed(motor_velocidad);
  
  //--- Ultrasonido
  pinMode(ultra_trigger, OUTPUT); //pin como salida
  pinMode(ultra_echo, INPUT);  //pin como entrada
  digitalWrite(ultra_trigger, LOW);//Inicializamos el pin con 0
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
      ultrasonido();
      Serial.println(ultra_distancia);
    }
  }
}

void vuelta(float vueltas)
{
  for(long i = 0; i < (pasos_vuelta*vueltas); i++)
    motor.step(1);
}

float calcularVueltas(float gramos)
{
  return gramos/gramos_vuelta;
}

void ultrasonido(){
  digitalWrite(ultra_trigger, HIGH);
  delayMicroseconds(10);          //Enviamos un pulso de 10us
  digitalWrite(ultra_trigger, LOW);
  
  ultra_tiempo = pulseIn(ultra_echo, HIGH); //obtenemos el ancho del pulso
  ultra_distancia = ultra_tiempo/59;             //escalamos el tiempo a una distancia en cm
  delay(1000);
}
