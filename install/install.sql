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

LOAD DATA INFILE '../../htdocs/pickupgames/install/zipcodes.csv' INTO TABLE us_zips FIELDS TERMINATED BY ',';

/* now contains atomic user information*/
CREATE TABLE IF NOT EXISTS users (
	username VARCHAR(12) NOT NULL,
	password VARCHAR(40) NOT NULL, 
	users_zip VARCHAR(5) NOT NULL,
	name varchar(50),
	age int(3),
	photo varchar(50),
	gender char(1) CHECK (gender IN ('M', 'F')),
	CONSTRAINT us_zips_zip_fk FOREIGN KEY (users_zip) REFERENCES us_zips(zip),
	PRIMARY KEY (username)
);

CREATE TABLE IF NOT EXISTS friends (
	username VARCHAR(12) NOT NULL,
	friend VARCHAR(12) NOT NULL,
	PRIMARY KEY (username, friend)
);

/*for finding a user's favorite sports*/
CREATE TABLE IF NOT EXISTS sportuser(
	username VARCHAR(12) NOT NULL,
	sport_name VARCHAR(2) NOT NULL,
	PRIMARY KEY (username, sport_name)
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
	min_players INT(2) NOT NULL,
	max_players INT(2) NOT NULL,
	
	PRIMARY KEY (sport_name)
);

CREATE TABLE IF NOT EXISTS equipment(
	equipment VARCHAR(50),
	PRIMARY KEY (equipment)
);

CREATE TABLE IF NOT EXISTS sports_equipment(
    sport_name VARCHAR(50) REFERENCES sports (sport_name),
    equipment VARCHAR(50) REFERENCES equipment (equipment),
    PRIMARY KEY (sport_name, equipment)
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
	sport_name VARCHAR(20) NOT NULL,
	CONSTRAINT pk_facility_sports PRIMARY KEY (fac_id, sport_name),
	FOREIGN KEY (fac_id) REFERENCES facilities(fac_id),
	FOREIGN KEY (sport_name) REFERENCES sports(sport_name)
	
);

CREATE TABLE IF NOT EXISTS events (
	event_id INT(11) NOT NULL AUTO_INCREMENT,
	name VARCHAR(30) NOT NULL,
	event_date DATE NOT NULL,
	event_time TIME NOT NULL,
	fac_id INT(11) NOT NULL,
	sport_name VARCHAR(20) NOT NULL,
	ad TEXT DEFAULT NULL,
	index (event_date),
	CONSTRAINT facilities_fac_id_fk FOREIGN KEY (fac_id) REFERENCES facilities(fac_id),
	CONSTRAINT sports_sport_name_fk FOREIGN KEY (sport_name) REFERENCES sports(sport_name),
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


/* Views */
CREATE VIEW view_friends AS SELECT u.username id, uf.* FROM friends f 
	INNER JOIN users u ON (f.username = u.username) INNER JOIN users uf
	ON (f.friend = uf.username);

/*
*Fill tables with demo data
*/

/*Client users, AKA regular site users*/ 
INSERT INTO users VALUES ('josiah', sha('josiah'), 22485, 'Josiah Neuberger', '30', 'profile_pics/josiah.', 'M');
INSERT INTO users VALUES ('maddie', sha('maddie'), 22401, 'Maddie Lord', '31', 'profile_pics/maddie', 'F');
INSERT INTO users VALUES ('wang', sha('wang'), 22402, 'Michael Wang', '32', 'profile_pics/wang', 'M');
INSERT INTO users VALUES ('brian', sha('brain'), 22404, 'Brian Johnston', '33', 'profile_pics/brian', 'M');
INSERT INTO users VALUES ('jake', sha('jake'), 20601, 'Jake Morgan', '22', 'profile_pics/jake', 'M');
INSERT INTO users VALUES ('smith', sha('smith'), 22485, 'Sarah Smith', '19', 'profile_pics/smith', 'F');

/*Add some friends*/
INSERT INTO friends VALUES ('josiah', 'jake');
INSERT INTO friends VALUES ('jake', 'smith');
INSERT INTO friends VALUES ('josiah', 'brian');
INSERT INTO friends VALUES ('jake', 'maddie');
INSERT INTO friends VALUES ('jake', 'wang');
INSERT INTO friends VALUES ('smith', 'brian');

/*blog entries*/

INSERT INTO blog VALUES (null, 'josiah', null, 'I love soccer.');
INSERT INTO blog VALUES (null, 'maddie', null, 'I want to go to the sports event this weekend in Fredericksburg.');
INSERT INTO blog VALUES (null, 'brian', null, 'UMW is hosting a great pickup football rally event this Saturday.');
INSERT INTO blog VALUES (null, 'jake', null, 'Does anyone know of a good place to purchase good sporting equipment?');
INSERT INTO blog VALUES (null, 'wang', null, 'I cannot wait for this spring season.');

/*sports*/
INSERT INTO sports VALUES ('basketball', 6, 12);
INSERT INTO sports VALUES ('baseball', 14, 28);
INSERT INTO sports VALUES ('football', 14, 28);
INSERT INTO sports VALUES ('soccer', 14, 28);
INSERT INTO sports VALUES ('ice hockey', 12, 24);
INSERT INTO sports VALUES ('soccer indoor', 14, 28);
INSERT INTO sports VALUES ('golf', 2, 8);
INSERT INTO sports values ('volleyball', 8, 16);
INSERT INTO sports VALUES ('water polo', 8, 16);
INSERT INTO sports VALUES ('tennis', 2, 4);

/*equipment*/
INSERT INTO equipment VALUES ('ball');
INSERT INTO equipment VALUES ('gloves');
INSERT INTO equipment VALUES ('bat');
INSERT INTO equipment VALUES ('cleats');
INSERT INTO equipment VALUES ('protective equipment');
INSERT INTO equipment VALUES ('flags');
INSERT INTO equipment VALUES ('puck');
INSERT INTO equipment VALUES ('stick');
INSERT INTO equipment VALUES ('skates');
INSERT INTO equipment VALUES ('clubs');
INSERT INTO equipment VALUES ('tennis racket');

/*sports_equipment*/
INSERT INTO sports_equipment VALUES ('basketball','ball');
INSERT INTO sports_equipment VALUES ('baseball','ball');
INSERT INTO sports_equipment VALUES ('baseball','bat');
INSERT INTO sports_equipment VALUES ('baseball','gloves');
INSERT INTO sports_equipment VALUES ('baseball','protective equipment');
INSERT INTO sports_equipment VALUES ('baseball','cleats');
INSERT INTO sports_equipment VALUES ('football','protective equipment');
INSERT INTO sports_equipment VALUES ('football','ball');
INSERT INTO sports_equipment VALUES ('football','cleats');
INSERT INTO sports_equipment VALUES ('football','flags');
INSERT INTO sports_equipment VALUES ('soccer','protective equipment');
INSERT INTO sports_equipment VALUES ('soccer','cleats');
INSERT INTO sports_equipment VALUES ('ice hockey','protective equipment');
INSERT INTO sports_equipment VALUES ('ice hockey','puck');
INSERT INTO sports_equipment VALUES ('ice hockey','stick');
INSERT INTO sports_equipment VALUES ('ice hockey','skatess');
INSERT INTO sports_equipment VALUES ('water polo','protective equipment');
INSERT INTO sports_equipment VALUES ('water polo','ball');
INSERT INTO sports_equipment VALUES ('tennis','ball');
INSERT INTO sports_equipment VALUES ('tennis','tennis racket');


/*Facilities*/
INSERT INTO facilities VALUES (null, 'Capital Club House', '3033 Waldorf Market Pl', '20603');
INSERT INTO facility_sports VALUES (1, 'basketball'), (1, 'ice hockey'), (1, 'soccer indoor'), (1, 'volleyball');

INSERT INTO facilities VALUES (null, 'University of Mary Washington', '1301 College Avenue', '22401');
INSERT INTO facility_sports VALUES (2, 'soccer'), (2, 'basketball'), (2, 'volleyball'), (2, 'baseball'), (2, 'football');

INSERT INTO facilities VALUES (3, 'Bryantown Sports Complex', '5665 Bryantown Road', '20601');
INSERT INTO facility_sports VALUES (3, 'soccer');

INSERT INTO facilities VALUES (4, 'King George YMCA', '10545 Kings Highway', '22485');
INSERT INTO facility_sports VALUES (4, 'basketball'), (4, 'water polo'), (4, 'tennis'), (4, 'volleyball');

INSERT INTO facilities VALUES (5, 'Barnsfield Park', '3360 Barnesfield Road', '22485');
INSERT INTO facility_sports VALUES (5, 'baseball'), (5, 'soccer');

INSERT INTO facilities VALUES (6, 'Cameron Hills Golf Links', '14140 Salem Church Road', '22485');
INSERT INTO facility_sports VALUES (6, 'golf');

INSERT INTO facilities VALUES (7, 'White Plains Regional Park and Golf Course', '1015 Saint Charles Parkway', '20695');
INSERT INTO facility_sports VALUES (7, 'baseball'), (7, 'soccer'), (7, 'golf');



/*Sporting Events*/

INSERT INTO events VALUES (1, 'Soccer Youth Game', '20130603', '2:30pm', 1, 'soccer indoor', 'Ages 9-15, Great Fun!');
INSERT INTO events VALUES (2, 'Touch Football Madness', '20130715', '2:30pm ', 2, 'football', 'Ages 18+, Bring your own drinks.');
INSERT INTO events VALUES (3, 'Baseball Diamond Bash', '20130812', '11:00am', 5, 'baseball', 'Ages 15 and up');
INSERT INTO events VALUES (4, 'Basketball Charity Event', '20130607', '7:30pm', 4, 'basketball', 'Great Cause!');
INSERT INTO events VALUES (5, 'Golf Tournament', '20130603', '4:30pm', 7, 'golf', 'Ages 18+, Great Fun!');


/*Join a couple events*/

INSERT INTO jevents VALUES ('josiah', 1);
INSERT INTO jevents VALUES ('jake', 3);

				  




