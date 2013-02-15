CREATE DATABASE IF NOT EXISTS pickupgames;
GRANT ALL PRIVILEGES ON pickupgames.* to 'pickugameuser22'@'localhost' identified by 'pickupgames';
USE pickupgames;
CREATE TABLE IF NOT EXISTS basicusers (
  id int NOT NULL auto_increment,
  username VARCHAR(20) NOT NULL,
  password VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
);
INSERT INTO basicusers VALUES (null, 'admin','changeme');