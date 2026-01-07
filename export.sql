CREATE DATABASE takensysteem;

USE takensysteem;

CREATE TABLE `gebruikers` (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(128) NOT NULL,
    password VARCHAR(256) NOT NULL
    );

CREATE TABLE `taken` (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    gebruikerID int NOT NULL,
    task VARCHAR(255) NOT NULL,
    done ENUM('yes','no') NOT NULL DEFAULT 'no',
    deadline DATE
    );

INSERT INTO gebruikers (username, password)
VALUES('test', 'test');