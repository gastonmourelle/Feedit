/*
  Creado: Luis del Valle (ldelvalleh@programarfacil.com
  Utilización librería Steper con motor 28BYJ-48
  https://programarfacil.com
*/

// Incluímos la librería para poder utilizarla
#include <Stepper.h>

// Esto es el número de pasos por revolución
#define STEPS 2048 
// Número de pasos que queremos que de
#define NUMSTEPS 1024

// Constructor, pasamos STEPS y los pines donde tengamos conectado el motor
Stepper stepper(STEPS, 8, 6, 9, 7);

void setup() {
  // Asignamos la velocidad en RPM (Revoluciones por Minuto)
  stepper.setSpeed(10);
}

void loop() {
  // Movemos el motor un número determinado de pasos
  stepper.step(NUMSTEPS);
  delay(2000);
}
