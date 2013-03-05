/*
*WARNING: Deletes the current database and starts from scratch
*/
DROP DATABASE IF EXISTS pickupgames;
CREATE DATABASE pickupgames;


GRANT ALL PRIVILEGES ON pickupgames.* to 'pickupgameuser22'@'localhost' identified by 'pickup';
USE pickupgames;

/* Create Tables */

CREATE TABLE IF NOT EXISTS basicusers (
  id int NOT NULL auto_increment,
  username VARCHAR(20) NOT NULL,
  password VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS users (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(12) NOT NULL,
  password varchar(100) NOT NULL,
  zipcode int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS blog (
  id int NOT NULL auto_increment,
  username VARCHAR(12),
  sdate TIMESTAMP NOT NULL DEFAULT NOW(),
  content BLOB,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS events (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(30) DEFAULT NULL,
  event_date date DEFAULT NULL,
  event_time time DEFAULT NULL,
  location varchar(30) DEFAULT NULL,
  zip varchar(5) DEFAULT NULL,
  sport_type varchar(15) DEFAULT NULL,
  ad blob,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS jevents (
	username varchar(12) NOT NULL,
	eventid int(11) NOT NULL
);

/*
*Import the US Zip Code Database into Table us_zips.
*WARNING: Drops the table if it already exists and loads the data from scratch
*
* Uses external database file zipcodes.csv
*/
DROP TABLE IF EXISTS us_zips;

CREATE TABLE us_zips (
  zip varchar(5) DEFAULT NULL,
  city varchar(64) DEFAULT NULL,
  statecode char(2) DEFAULT NULL,
  latitude float DEFAULT NULL,
  longitude float DEFAULT NULL
);
LOAD DATA LOCAL INFILE 'zipcodes.csv' INTO TABLE us_zips FIELDS TERMINATED BY ',';

CREATE TABLE IF NOT EXISTS facilities (
	id int(11) NOT NULL AUTO_INCREMENT,
	name vachar(30) NOT NULL,
		
	
);

/* End Create Tables */


/*
*Fill tables with demo data
*/

/*users, AKA Site Administrators*/
INSERT INTO basicusers VALUES (null, 'admin', sha('changeme'));


/*Client users, AKA regular site users*/ 
INSERT INTO users VALUES (null, 'josiah', sha('josiah'), 22485);
INSERT INTO users VALUES (null, 'maddie', sha('maddie'), 22401);
INSERT INTO users VALUES (null, 'wang', sha('wang'), 22402);
INSERT INTO users VALUES (null, 'brian', sha('brain'), 22404);
INSERT INTO users VALUES (null, 'jake', sha('jake'), 20601);
INSERT INTO users VALUES (null, 'smith', sha('smith'), 20646);

/*blog entries*/

INSERT INTO blog VALUES (null, 'josiah', null, 'I love soccer.');
INSERT INTO blog VALUES (null, 'maddie', null, 'I want to go to the sports event this weekend in Fredericksburg.');
INSERT INTO blog VALUES (null, 'brian', null, 'UMW is hosting a great pickup football rally event this Saturday.');
INSERT INTO blog VALUES (null, 'jake', null, 'Does anyone know of a good place to purchase good sporting equipment?');
INSERT INTO blog VALUES (null, 'wang', null, 'I cannot wait for this spring season.');

/*Sporting Events*/

INSERT INTO events VALUES (null, 'Soccer Youth Game', '20130603', '2:30pm', 'King George', '22485', 'soccer', 'Ages 9-15, Great Fun!');
INSERT INTO events VALUES (null, 'Touch Football Madness', '20130715', '2:30pm', 'Waldorf', '22601', 'football', 'Ages 18+, Bring your own drinks.');
INSERT INTO events VALUES (null, 'Baseball Diamond Bash', '20130812', '11:00am', 'La Plata', '20646', 'baseball', 'Ages 15 and up');
INSERT INTO events VALUES (null, 'Basketball Charity Event', '20130607', '7:30pm', 'Fredericksburg', '22401', 'basketball', 'Great Cause!');
INSERT INTO events VALUES (null, 'Soccer Game', '20130603', '4:30pm', 'Stafford', '22554', 'soccer', 'Ages 18+, Great Fun!');

/*Join a couple events*/

INSERT INTO jevents VALUES ('josiah', 1);
INSERT INTO jevents VALUES ('jake', 3);

				  




