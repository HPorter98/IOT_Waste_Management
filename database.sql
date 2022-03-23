/*
  The bin_data table retains basic information about
  a bin circut. This is the id and the gps location or
  waste system.
*/

CREATE TABLE bin_data (
  BinId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Latitude float,
  Longitude float
);

INSERT INTO bin_data (Latitude, Longitude) 
VALUES (52.9225301, -1.4746186);

INSERT INTO bin_data (Latitude, Longitude) 
VALUES (51.454513, -2.587910); 

INSERT INTO bin_data (Latitude, Longitude) 
VALUES (51.507351, -0.127758);

/*
  The waste_data table will retain information about
  whether a specific bin is full and the date it was
  added into the database. This will be the main table
  that will be appended too from the Arduino and in 
  which the data could possibly be used for analytics
*/

CREATE TABLE waste_data(
  WasteId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  BinId int NOT NULL ,
  isFull varchar(5),
  w_day int NOT NULL,
  w_month int NOT NULL,
  w_year int NOT NULL,
  FOREIGN KEY (BinId) REFERENCES bin_data(BinId)
);

INSERT INTO waste_data (BinId, isFull, w_day, w_month, w_year) 
VALUES (1, 'True', 11, 03, 2022); 

INSERT INTO waste_data (BinId, isFull, w_day, w_month, w_year) 
VALUES (1, 'True', 09, 03, 2022); 

INSERT INTO waste_data (BinId, isFull, w_day, w_month, w_year) 
VALUES (1, 'True', 05, 03, 2022); 

INSERT INTO waste_data (BinId, isFull, w_day, w_month, w_year) 
VALUES (1, 'True', 15, 03, 2022); 

INSERT INTO waste_data (BinId, isFull, w_day, w_month, w_year) 
VALUES (1, 'True', 20, 03, 2022); 

INSERT INTO waste_data (BinId, isFull, w_day, w_month, w_year) 
VALUES (1, 'True', 22, 03, 2022);

INSERT INTO waste_data (BinId, isFull, w_day, w_month, w_year) 
VALUES (1, 'True', 27, 03, 2022); 

INSERT INTO waste_data (BinId, isFull, w_day, w_month, w_year) 
VALUES (1, 'True', 30, 03, 2022); 

INSERT INTO waste_data (BinId, isFull, w_day, w_month, w_year) 
VALUES (1, 'True', 05, 04, 2022); 

INSERT INTO waste_data (BinId, isFull, w_day, w_month, w_year) 
VALUES (1, 'True', 10, 04, 2022);

INSERT INTO waste_data (BinId, isFull, w_day, w_month, w_year) 
VALUES (1, 'True', 12, 04, 2022);

INSERT INTO waste_data (BinId, isFull, w_day, w_month, w_year) 
VALUES (1, 'True', 16, 04, 2022);

INSERT INTO waste_data (BinId, isFull, w_day, w_month, w_year) 
VALUES (1, 'True', 22, 04, 2022); 

INSERT INTO waste_data (BinId, isFull, w_day, w_month, w_year) 
VALUES (2, 'True', 02, 02, 2022); 

INSERT INTO waste_data (BinId, isFull, w_day, w_month, w_year) 
VALUES (2, 'True', 05, 02, 2022);

INSERT INTO waste_data (BinId, isFull, w_day, w_month, w_year) 
VALUES (2, 'True', 11, 02, 2022);

/*
  The user table will contain log in information for
  the users of the web application

*/
CREATE TABLE users (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username varchar(25),
  passcode varchar(25)
);

INSERT INTO users (username, passcode)
VALUES ("admin", "password");

/* Query to select waste data based on id, month and year */
SELECT * from waste_data where BinID = 2 and MONTH(w_Date) = 2 and YEAR(w_Date) = 2022