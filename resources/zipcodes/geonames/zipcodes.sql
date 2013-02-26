CREATE DATABASE IF NOT EXISTS zipcodes;
GRANT ALL PRIVILEGES ON zipcodes.* to 'zipcodes22'@'localhost' identified by 'zipcodes';
USE zipcodes;

DROP TABLE IF EXISTS us_zips;

CREATE TABLE us_zips (
  countrycode char(2) DEFAULT NULL,
  zipcode varchar(20) DEFAULT NULL,
  city varchar(180) DEFAULT NULL,
  statename varchar(100) DEFAULT NULL,
  statecode varchar(20) DEFAULT NULL,
  junk1 varchar(100) DEFAULT NULL,
  junk2 varchar(20) DEFAULT NULL,
  junk3 varchar(100) DEFAULT NULL,
  junk4 varchar(20) DEFAULT NULL,
  latitude float DEFAULT NULL,
  longitude float DEFAULT NULL,
  junk5 float DEFAULT NULL
);

LOAD DATA LOCAL INFILE 'zipcodes.txt' INTO TABLE us_zips;

ALTER TABLE us_zips DROP COLUMN countrycode, drop junk1, drop junk2, drop junk3, drop junk4, drop junk5;