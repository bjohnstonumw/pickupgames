/*
*WARNING: Deletes the current database and starts from scratch
*/
DROP DATABASE IF EXISTS pickupgames;
CREATE DATABASE pickupgames;


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

/*users, AKA Site Administrators*/
INSERT INTO basicusers VALUES ('admin', sha('changeme'));


/*Client users, AKA regular site users*/ 
INSERT INTO users VALUES ('josiah', sha('josiah'), 22485);
INSERT INTO users VALUES ('maddie', sha('maddie'), 22401);
INSERT INTO users VALUES ('wang', sha('wang'), 22402);
INSERT INTO users VALUES ('brian', sha('brain'), 22404);
INSERT INTO users VALUES ('jake', sha('jake'), 20601);
INSERT INTO users VALUES ('smith', sha('smith'), 20603);

/*blog entries*/

INSERT INTO blog VALUES (null, 'josiah', null, 'I love soccer.');
INSERT INTO blog VALUES (null, 'maddie', null, 'I want to go to the sports event this weekend in Fredericksburg.');
INSERT INTO blog VALUES (null, 'brian', null, 'UMW is hosting a great pickup football rally event this Saturday.');
INSERT INTO blog VALUES (null, 'jake', null, 'Does anyone know of a good place to purchase good sporting equipment?');
INSERT INTO blog VALUES (null, 'wang', null, 'I cannot wait for this spring season.');

/*sports*/
INSERT INTO sports VALUES ('basketball');
INSERT INTO sports VALUES ('baseball');
INSERT INTO sports VALUES ('football');
INSERT INTO sports VALUES ('soccer');
INSERT INTO sports VALUES ('ice hockey');
INSERT INTO sports VALUES ('soccer indoor');
INSERT INTO sports VALUES ('golf');
INSERT INTO sports values ('volleyball');
INSERT INTO sports VALUES ('water polo');
INSERT INTO sports VALUES ('tennis');

/*Facilities*/
INSERT INTO facilities VALUES (1, 'Capital Club House', '3033 Waldorf Market Pl', '20603');
INSERT INTO facility_Sports VALUES (1, 'basketball'), (1, 'ice hockey'), (1, 'soccer indoor'), (1, 'volleyball');

INSERT INTO facilities VALUES (2, 'University of Mary Washington', '1301 College Avenue', '22401');
INSERT INTO facility_Sports VALUES (2, 'soccer'), (2, 'basketball'), (2, 'volleyball'), (2, 'baseball'), (2, 'football');

INSERT INTO facilities VALUES (3, 'Bryantown Sports Complex', '5665 Bryantown Road', '20601');
INSERT INTO facility_Sports VALUES (3, 'soccer');

INSERT INTO facilities VALUES (4, 'King George YMCA', '10545 Kings Highway', '22485');
INSERT INTO facility_Sports VALUES (4, 'basketball'), (4, 'water polo'), (4, 'tennis'), (4, 'volleyball');

INSERT INTO facilities VALUES (5, 'Barnsfield Park', '3360 Barnesfield Road', '22485');
INSERT INTO facility_Sports VALUES (5, 'baseball'), (5, 'soccer');

INSERT INTO facilities VALUES (6, 'Cameron Hills Golf Links', '14140 Salem Church Road', '22485');
INSERT INTO facility_Sports VALUES (6, 'golf');

INSERT INTO facilities VALUES (7, 'White Plains Regional Park and Golf Course', '1015 Saint Charles Parkway', '20695');
INSERT INTO facility_Sports VALUES (7, 'baseball'), (7, 'soccer'), (7, 'golf');



/*Sporting Events*/

INSERT INTO events VALUES (1, 'Soccer Youth Game', '20130603', '2:30pm', 1, 'soccer indoor', 'Ages 9-15, Great Fun!');
INSERT INTO events VALUES (2, 'Touch Football Madness', '20130715', '2:30pm ', 2, 'football', 'Ages 18+, Bring your own drinks.');
INSERT INTO events VALUES (3, 'Baseball Diamond Bash', '20130812', '11:00am', 5, 'baseball', 'Ages 15 and up');
INSERT INTO events VALUES (4, 'Basketball Charity Event', '20130607', '7:30pm', 4, 'basketball', 'Great Cause!');
INSERT INTO events VALUES (5, 'Golf Tournament', '20130603', '4:30pm', 7, 'golf', 'Ages 18+, Great Fun!');


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


/*Join a couple events*/

INSERT INTO jevents VALUES ('josiah', 1);
INSERT INTO jevents VALUES ('jake', 3);

				  




