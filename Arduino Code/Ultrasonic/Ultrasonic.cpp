#include "Ultrasonic.h"

Ultrasonic::Ultrasonic(int trig, int echo)
{
	_trig = trig;
	_echo = echo;
}

int Ultrasonic::calculatedistance()
{
	_distance = _duration * 0.034 / 2;
	return _distance;
}

void Ultrasonic::pulse()
{
	digitalWrite(_trig, LOW);
	delayMicroseconds(2);
	digitalWrite(_trig, HIGH);
	delayMicroseconds(10);
	digitalWrite(_trig, LOW);


	_duration = pulseIn(_echo, HIGH);
}

void Ultrasonic::init()
{
	pinMode(_trig, OUTPUT);
	pinMode(_echo, INPUT);
}
