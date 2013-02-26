CREATE DATABASE IF NOT EXISTS zipcodes_test2;
GRANT ALL PRIVILEGES ON zipcodes_test2.* to 'zipcodes22'@'localhost' identified by 'zipcodes';
USE zipcodes_test2;

DROP TABLE IF EXISTS us_zips;

CREATE TABLE us_zips (
  zip varchar(5) DEFAULT NULL,
  city varchar(64) DEFAULT NULL,
  statecode char(2) DEFAULT NULL,
  latitude float DEFAULT NULL,
  longitude float DEFAULT NULL
);

LOAD DATA LOCAL INFILE 'zipcodes.csv' INTO TABLE us_zips FIELDS TERMINATED BY ',';