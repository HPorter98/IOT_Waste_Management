#ifndef Ultrasonic_h
#define Ultrasonic_h

#include "Arduino.h"

class Ultrasonic
{
public:
	Ultrasonic(int trig, int echo);
	
	// Calculate distance from the duration of the pulse
	int calculatedistance();

	// Generate a pulse
	void pulse();

	// Initiate Ultrasonic sensor
	void init();

private:
	int _trig;
	int _echo;

	int _duration;
	int _distance;
	
};


#endif