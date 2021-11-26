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

INSERT INTO `emp_managment_v2`.`addresses` (`id`, `city`, `street_address`, `state`, `postal_code`)
VALUES ('1', 'San Jone', '126', 'CA', '394432');
INSERT INTO `emp_managment_v2`.`addresses` (`id`, `city`, `street_address`, `state`, `postal_code`)
VALUES ('2', 'New York', '89', 'WA', '09889');
INSERT INTO `emp_managment_v2`.`addresses` (`id`, `city`, `street_address`, `state`, `postal_code`)
VALUES ('3', 'San Diego', '55', 'CA', '098765');
INSERT INTO `emp_managment_v2`.`addresses` (`id`, `city`, `street_address`, `state`, `postal_code`)
VALUES ('4', 'Salt Lake City', '90', 'UT', '978565');
INSERT INTO `emp_managment_v2`.`addresses` (`id`, `city`, `street_address`, `state`, `postal_code`)
VALUES ('5', 'Louisville', '43', 'KNT', '8989968');
INSERT INTO `emp_managment_v2`.`addresses` (`id`, `city`, `street_address`, `state`, `postal_code`)
VALUES ('6', 'Atlanta', '128', 'GEO', '398776');
INSERT INTO `emp_managment_v2`.`addresses` (`id`, `city`, `street_address`, `state`, `postal_code`)
VALUES ('7', 'Nashville', '1', 'TN', '76785');
INSERT INTO `emp_managment_v2`.`addresses` (`id`, `city`, `street_address`, `state`, `postal_code`)
VALUES ('8', 'New Orleans', '126', 'LU', '778594');
INSERT INTO `emp_managment_v2`.`addresses` (`id`, `city`, `street_address`, `state`, `postal_code`)
VALUES ('9', 'Albacete', '99', 'AL', '78600');
INSERT INTO `emp_managment_v2`.`addresses` (`id`, `city`, `street_address`, `state`, `postal_code`)
VALUES ('10', 'Barcelona', '10', 'BCN', '08018');
INSERT INTO `emp_managment_v2`.`addresses` (`id`, `city`, `street_address`, `state`, `postal_code`)
VALUES ('11', 'Lyon', '8', 'LY', '00012');
INSERT INTO `emp_managment_v2`.`addresses` (`id`, `city`, `street_address`, `state`, `postal_code`)
VALUES ('12', 'Moscú', '114', 'MO', '10101');

INSERT INTO `emp_managment_v2`.`alumni` (`name`, `last_name`, `email`, `gender_id`, `address_id`, `age`, `phone_number`) VALUES ('Rack', 'Lei', 'jackon@network.com', '1', '1', '24', '738362728');
INSERT INTO `emp_managment_v2`.`alumni` (`name`, `last_name`, `email`, `gender_id`, `address_id`, `age`, `phone_number`) VALUES ('Juan', 'Doe', 'johndoe@foo.com', '1', '2', '34', '364839274');
INSERT INTO `emp_managment_v2`.`alumni` (`name`, `last_name`, `email`, `gender_id`, `address_id`, `age`, `phone_number`) VALUES ('Leila', 'Mills', 'mills@leila.com', '2', '3', '55', '785675467');
INSERT INTO `emp_managment_v2`.`alumni` (`name`, `last_name`, `email`, `gender_id`, `address_id`, `age`, `phone_number`) VALUES ('Richard', 'Desmond', 'dismond@foo.com', '1', '4', '30', '789786989');
INSERT INTO `emp_managment_v2`.`alumni` (`name`, `last_name`, `email`, `gender_id`, `address_id`, `age`, `phone_number`) VALUES ('Susan ', 'Smith', 'susansmith@baz.com', '2', '5', '43', '65679564');
INSERT INTO `emp_managment_v2`.`alumni` (`name`, `last_name`, `email`, `gender_id`, `address_id`, `age`, `phone_number`) VALUES ('Brad', 'Simpson', 'brad@foo.com', '1', '6', '40', '767767580');
INSERT INTO `emp_managment_v2`.`alumni` (`name`, `last_name`, `email`, `gender_id`, `address_id`, `age`, `phone_number`) VALUES ('Neil', 'Walker', 'walkerneil@baz.com', '1', '7', '42', '998878678');
INSERT INTO `emp_managment_v2`.`alumni` (`name`, `last_name`, `email`, `gender_id`, `address_id`, `age`, `phone_number`) VALUES ('Robert', 'Thompson', 'jackon66@network.com', '1', '8', '24', '665677969');
INSERT INTO `emp_managment_v2`.`alumni` (`name`, `last_name`, `email`, `gender_id`, `address_id`, `age`, `phone_number`) VALUES ('Marc', 'Cansado', 'cansi@html.com', '1', '9', '46', '897896780');
INSERT INTO `emp_managment_v2`.`alumni` (`name`, `last_name`, `email`, `gender_id`, `address_id`, `age`, `phone_number`) VALUES ('Joel', 'Hoe', 'hoel@gmail.com', '3', '10', '34', '778558750');
INSERT INTO `emp_managment_v2`.`alumni` (`name`, `last_name`, `email`, `gender_id`, `address_id`, `age`, `phone_number`) VALUES ('Lala', 'Muñoz', 'lalala@gmail.com', '2', '11', '18', '786756785');
INSERT INTO `emp_managment_v2`.`alumni` (`name`, `last_name`, `email`, `gender_id`, `address_id`, `age`, `phone_number`) VALUES ('Pepa', 'Amigo', 'pepamigo@baz.com', '2', '12', '39', '656477842');


INSERT INTO genders (name)
VALUES ("Male"),("Female"),("Other");