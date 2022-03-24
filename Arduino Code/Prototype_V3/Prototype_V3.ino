#include <LiquidCrystal.h>
#include <Ultrasonic.h>
#include <SoftwareSerial.h>
#include <Servo.h>

LiquidCrystal lcd(7, 8, 9, 10, 11, 12);
Ultrasonic us1(2,13);
/* 3, 4 */
/* 2, 13 */
Ultrasonic us2 (3, 4);
SoftwareSerial gsm(5, 6);
Servo myServo;

int full, threeQuater, half, quater, empty;

int distance = 0;
int d2 = 0;

bool flag = false;
bool isFull = false;

void PrintValues(const char* percentage, int distance)
{
  lcd.clear();
  lcd.print(percentage);
  delay(10);
  lcd.setCursor(0,1);
  lcd.print(distance);
  if (distance >= 10)
  {
    lcd.setCursor(3,1);
    lcd.print("cm");
  }else{
    lcd.setCursor(2,1);
    lcd.print("cm"); 
  }
  delay(10);
}

String ProcessResponse()
{
  String response = "";
  
  while(gsm.available())
  {
    char c = gsm.read();
    response += c;
  }

  return response;
}

void PassWeb()
{
  gsm.println("AT");
  delay(300);
  Serial.print(ProcessResponse());
  
  // Initilize GPRS Connection
  gsm.println("AT+SAPBR=3, 1, \"APN\", \"giffgaff.com\"");
  delay(300);
  Serial.print(ProcessResponse());

  gsm.println("AT+SAPBR=1,1");
  delay(1500);
  Serial.print(ProcessResponse());


  // Initilize and set up HTTP 
  gsm.println("AT+HTTPINIT");
  delay(300);
  Serial.println(ProcessResponse());

  gsm.println("AT+HTTPPARA=\"CID\", 1");
  delay(300);
  Serial.println(ProcessResponse());

  gsm.println("AT+HTTPPARA=\"URL\",\"http://wastedis.co.uk/API/insert.php?id=3&full=true\"");
  delay(300);
  Serial.println(ProcessResponse());

  // Perform HTTP GET Request
  gsm.println("AT+HTTPACTION=0");
  delay(1500);
  Serial.println(ProcessResponse());

  // Terminate HTTP request and close GRPS connection
  gsm.println("AT+HTTPTERM");
  delay(300);
  Serial.println(ProcessResponse());

  gsm.println("AT+SAPBR=0,1");
  delay(300);
  Serial.println(ProcessResponse());

  flag = true;
}

void SendSMS()
{
  gsm.println("AT");
  delay(300);
  Serial.print(ProcessResponse());

  gsm.println("AT+CMGF=1");
  delay(300);
  Serial.print(ProcessResponse());
  
  gsm.println("AT+CMGS=\"07801986058\"");
  delay(300);

  gsm.println("Hello! The Waste System is full!");
  delay(500);

  gsm.println("Go to www.wastedis.co.uk to find out the location and more information");
  delay(500);

  gsm.print((char)26);
  delay(500);
  gsm.println();
}


void setup() {
  full = 5;
  threeQuater = 7;
  half = 10;
  quater = 15;
  empty = 20;
  
  Serial.begin(9600);
  gsm.begin(9600);
  
  lcd.begin(16, 2);
  lcd.clear();
  lcd.print("Hello World");

  us1.init();
  us2.init();

  myServo.attach(14);
  myServo.write(90);

  delay(10000);
}

void loop() {
  us1.pulse();
  distance = us1.calculatedistance();

  us2.pulse();
  d2 = us2.calculatedistance();
  
    if (distance <= empty && distance > quater)
    {
      PrintValues("25%", distance);
      isFull = false;
      myServo.write(0);
    }
    else if (distance <= quater && distance > half)
    {
      PrintValues("50%", distance);
      isFull = false;
      myServo.write(0);
    }
    else if (distance <= half && distance > threeQuater)
    {
      PrintValues("75%", distance);
      isFull = false;
      myServo.write(0);
    }
    else if (distance < full && !isFull)
    {
      PrintValues("Full", distance);
      PassWeb();
      SendSMS();
      isFull = true;
      myServo.write(0);
    }
    else if(distance > empty)
    {
      PrintValues("Empty", distance);
      isFull = false;
      myServo.write(0);
    }

    if (d2 < 10)
    {
      myServo.write(90);
    }
  
  delay(1000);
}
