/*************
Smit Patel
FILE: listing.sql
15 09 2018
WEBD - II
**************/

DROP TABLE IF EXISTS users;

CREATE TABLE users(
	id INT PRIMARY KEY,
	first_name VARCHAR(50) NOT NULL,
	last_name VARCHAR(50) NOT NULL,
	username VARCHAR(50) NOT NULL,
	email VARCHAR(50) NOT NULL,
	gender VARCHAR(50) NOT NULL,
	phone VARCHAR(50) NOT NULL
);

insert into users (id, first_name, last_name, username, email, phone, gender) values (1, 'Smit', 'Patel', 'smitpatel99', 'admin@netdevv.com', '999-999-0000', 'Male');