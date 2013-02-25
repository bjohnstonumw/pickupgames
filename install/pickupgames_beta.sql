CREATE DATABASE IF NOT EXISTS pickupgames;
GRANT ALL PRIVILEGES ON pickupgames.* to 'pickupgameuser22'@'localhost' identified by 'pickup';
USE pickupgames;
CREATE TABLE IF NOT EXISTS basicusers (
  id int NOT NULL auto_increment,
  username VARCHAR(20) NOT NULL,
  password VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
);

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

CREATE TABLE IF NOT EXISTS blog (
  id int NOT NULL auto_increment,
  firstname VARCHAR(25),
  lastname VARCHAR(25),
  sdate TIMESTAMP NOT NULL DEFAULT NOW(),
  content BLOB,
  pic VARCHAR(50),
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS users (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(12) NOT NULL,
  password varchar(100) NOT NULL,
  zipcode int(11) NOT NULL,
  PRIMARY KEY (`id`)
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