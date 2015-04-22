CREATE DATABASE leedb;
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin';
GRANT ALL PRIVILEGES ON * . * TO 'admin'@'localhost';
FLUSH PRIVILEGES;

use leedb;

CREATE TABLE authorized_users(
	id INT NOT NULL AUTO_INCREMENT,
	firstName VARCHAR(50),
	lastName VARCHAR(50),
	username VARCHAR(50) NOT NULL UNIQUE,
	password VARCHAR(50) NOT NULL,
	primary key(id)
);
INSERT INTO authorized_users (firstName, lastName, username, password) VALUES ('Sangdon', 'Lee', 'admin', 'admin');

CREATE TABLE menu_items(
	id INT NOT NULL AUTO_INCREMENT,
	itemName VARCHAR(50) NOT NULL,
	itemDescription VARCHAR(255) NOT NULL,
	itemPrice DECIMAL(4,2) NOT NULL,
	itemImage VARCHAR(100) NOT NULL,	
	primary key(id)
);

CREATE TABLE mailingList(
	id int not null AUTO_INCREMENT,
	customerName VARCHAR(50) NOT NULL,
	phoneNumber VARCHAR(15) NOT NULL,
	emailAddress VARCHAR(100) NOT NULL,
	referrer VARCHAR(15) NOT NULL,
	PRIMARY KEY (id)
	);