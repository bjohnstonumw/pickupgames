CREATE DATABASE IF NOT EXISTS pickupgames;



GRANT ALL PRIVILEGES ON pickupgames.* to 'pickupgameuser22'@'localhost' identified by 'pickup';
USE pickupgames;

/* Create Tables */

/*
*Import the US Zip Code Database into Table us_zips.
*WARNING: Drops the table if it already exists and loads the data from scratch
*
* Uses external database file zipcodes.csv
*/
DROP TABLE IF EXISTS us_zips;

CREATE TABLE us_zips (
	zip VARCHAR(5) NOT NULL,
	city VARCHAR(64) NOT NULL,
	statecode CHAR(2) NOT NULL,
	latitude FLOAT NOT NULL,
	longitude FLOAT NOT NULL,
	PRIMARY KEY (zip)
);
LOAD DATA LOCAL INFILE 'zipcodes.csv' INTO TABLE us_zips FIELDS TERMINATED BY ',';

CREATE TABLE IF NOT EXISTS basicusers (
	b_username VARCHAR(20) NOT NULL,
	password VARCHAR(40) NOT NULL,
	PRIMARY KEY (b_username)
);

CREATE TABLE IF NOT EXISTS users (
	username VARCHAR(12) NOT NULL,
	password VARCHAR(40) NOT NULL, 
	users_zip VARCHAR(5) NOT NULL,
	CONSTRAINT us_zips_zip_fk FOREIGN KEY (users_zip) REFERENCES us_zips(zip),
	PRIMARY KEY (username)
);

CREATE TABLE IF NOT EXISTS blog (
	blog_id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(12) NOT NULL,
	sdate TIMESTAMP NOT NULL DEFAULT NOW(),
	content BLOB NOT NULL,
	CONSTRAINT users_username_fk FOREIGN KEY (username) REFERENCES users(username),
	PRIMARY KEY (blog_id)
);

CREATE TABLE IF NOT EXISTS sports (
	sport_name VARCHAR(20),
	/*add other other sport related columns here*/
	PRIMARY KEY (sport_name)
);

/*  
* Facilities Tables - many-to-many relationship with supported sports
*/
CREATE TABLE IF NOT EXISTS facilities (
	fac_id INT(11) NOT NULL AUTO_INCREMENT,
	name VARCHAR(30) NOT NULL,
	street_address VARCHAR(45) NOT NULL,
	fac_zip VARCHAR(5) NOT NULL,
	CONSTRAINT us_zip_zip_fk FOREIGN KEY (fac_zip) REFERENCES us_zips(zip),
	PRIMARY KEY (fac_id)
);

/*Junction Table for supported sport types at a facility*/
CREATE TABLE IF NOT EXISTS facility_sports (
	fac_id INT(11) NOT NULL,
	sport_id VARCHAR(20) NOT NULL,
	CONSTRAINT pk_facility_sports PRIMARY KEY (fac_id, sport_id),
	FOREIGN KEY (fac_id) REFERENCES facilities(fac_id),
	FOREIGN KEY (sport_id) REFERENCES sports(sport_name)
	
);

CREATE TABLE IF NOT EXISTS events (
	event_id INT(11) NOT NULL AUTO_INCREMENT,
	name VARCHAR(30) NOT NULL,
	event_date DATE NOT NULL,
	event_time TIME NOT NULL,
	fac_id INT(11) NOT NULL,
	sport_type VARCHAR(20) DEFAULT NULL,
	ad BLOB,
	CONSTRAINT facilities_fac_id_fk FOREIGN KEY (fac_id) REFERENCES facilities(fac_id),
	CONSTRAINT sports_sport_name_fk FOREIGN KEY (sport_type) REFERENCES sports(sport_name),
	PRIMARY KEY (event_id)
);

/* Junction Table for users joined to an event */
CREATE TABLE IF NOT EXISTS jevents (
	username VARCHAR(12) NOT NULL,
	event_id INT(11) NOT NULL,
	CONSTRAINT pk_jevents_events PRIMARY KEY (username, event_id),
	FOREIGN KEY (username) REFERENCES users(username),
	FOREIGN KEY (event_id) REFERENCES events(event_id)
	
);

/* End Create Tables */

/*
*Fill tables with demo data
*/

/*
* The following insert trick using the dual table was modified from
* an insert statement found on techonthenet.com. The original can
* be found @: http://www.techonthenet.com/sql/insert.php
*
* This will only insert the user if the user doesn't already exists.
*/
INSERT INTO basicusers
(id, username, password)
SELECT 1, 'admin', sha('changeme')
FROM dual
WHERE not exists (select * from basicusers
                  where basicusers.id = 1);