--CREATE DATABASE

DROP DATABASE  IF EXISTS emp_managment_v2;
CREATE DATABASE IF NOT EXISTS emp_managment_v2;

USE emp_managment_v2;

--CREATE TABLES

CREATE TABLE users(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
username VARCHAR(50) NOT NULL,
email VARCHAR(50) UNIQUE,
password VARCHAR(100) NOT NULL,
avatar VARCHAR(200)
);

CREATE TABLE alumni(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(50) NOT NULL,
last_name VARCHAR(50),
email VARCHAR(50) UNIQUE,
gender_id INT NOT NULL,
address_id INT NOT NULL,
age INT(2) NULL,
phone_number INT(9) NOT NULL,
FOREIGN KEY (gender_id) REFERENCES genders(id),
FOREIGN KEY (address_id) REFERENCES addresses(id)
);

CREATE TABLE addresses(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
city VARCHAR(50),
street_address VARCHAR (100),
state VARCHAR(50),
postal_code INT(5)
);

CREATE TABLE genders(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(25) NOT NULL
);

--INSERT DATA

INSERT INTO `emp_managment_v2`.`users` (`id`, `username`, `email`, `password`)
VALUES ('1', 'admin', 'admin@assemblerschool.com', '$2y$10$nuh1LEwFt7Q2/wz9/CmTJO91stTBS4cRjiJYBY3sVCARnllI.wzBC');

