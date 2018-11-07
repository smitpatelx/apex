-- FILE: 						listing.sql
-- TITLE:						Apex Listings - User Tables Creation Script
-- AUTHORS:						Smit Patel
-- LAST MODIFIED:		        October 4, 2018
--ALTER TABLE IF EXISTS users;

DROP TABLE IF EXISTS users CASCADE;
CREATE TABLE users (
    user_id VARCHAR(20) NOT NULL PRIMARY KEY default nextval('user_id_seq'),
    user_name VARCHAR(16) NOT NULL,
    password VARCHAR(34) NOT NULL,
    user_type VARCHAR(2) NOT NULL,
    salutation VARCHAR(10) NOT NULL,
    first_name VARCHAR(128) NOT NULL,
    last_name VARCHAR (128) NOT NULL,
    email_address VARCHAR(40) NOT NULL,
    street_address_1 VARCHAR(128) NOT NULL,
    street_address_2 VARCHAR(128) NOT NULL, 
    city VARCHAR(64) NOT NULL, 
    province VARCHAR(2) NOT NULL, 
    postal_code VARCHAR(6) NOT NULL, 
    primary_phone_number VARCHAR(25) NOT NULL, 
    secondry_phone_number VARCHAR(25) NOT NULL, 
    fax_number VARCHAR(25) NOT NULL,
    preferred_contact_method VARCHAR(1) NOT NULL,
    enrol_date DATE NOT NULL,
    last_access DATE NOT NULL
);
-- 4	smitpatelx	1004c3d449a4002d2e167a7e0a3c063e	s	Smit	Patel	root@rootuser.com	2018-10-07	2018-10-07
-- 3	smitpatelc	1004c3d449a4002d2e167a7e0a3c063e	c	rocky	handsome	rocky@admin.com	2018-10-07	2018-10-07
-- 2	smitpatel2	1004c3d449a4002d2e167a7e0a3c063e	a	smit	patel	root@root.com	2018-10-07	2018-10-07
-- 1	smitpatel	1004c3d449a4002d2e167a7e0a3c063e	a	Smit	Patel	root@rootuser.com	2018-10-07	2018-10-07
INSERT INTO users (user_id, user_name, password, user_type, first_name, last_name, email_address, street_address_1, street_address_2, city, province, postal_code, primary_phone_number, secondry_phone_number, fax_number, salutation, preferred_contact_method, enrol_date, last_access) 
VALUES (10001,'usera','1004c3d449a4002d2e167a7e0a3c063e','a', 'Smit', 'Patel', 'root@rootuser.com', '38, greenhill ave','34, greenhill ave', 'oshawa', 'ON', 'l1ol1o', '9999869856', '9966869856', '9966869856', 'Mr.', 'e', '2018-10-07'::date,	'2018-10-07'::date);
INSERT INTO users (user_id, user_name, password, user_type, first_name, last_name, email_address, street_address_1, street_address_2, city, province, postal_code, primary_phone_number, secondry_phone_number, fax_number, salutation, preferred_contact_method, enrol_date, last_access) 
VALUES (10002,'userc','1004c3d449a4002d2e167a7e0a3c063e','c','Smit','Patel','root@rootuser.co', '38, greenhill ave','34, greenhill ave', 'oshawa', 'ON', 'l1ol1o', '9999869856', '9966869856', '9966869856', 'Mr.', 'e','2018-10-07'::date,	'2018-10-07'::date);
INSERT INTO users (user_id, user_name, password, user_type, first_name, last_name, email_address, street_address_1, street_address_2, city, province, postal_code, primary_phone_number, secondry_phone_number, fax_number, salutation, preferred_contact_method, enrol_date, last_access) 
VALUES (10003,'users','1004c3d449a4002d2e167a7e0a3c063e','s','Smit','Patel','root@rootuser.c', '38, greenhill ave','34, greenhill ave', 'oshawa', 'ON', 'l1ol1o', '9999869856', '9966869856', '9966869856', 'Mr.', 'e','2018-10-07'::date,	'2018-10-07'::date);
INSERT INTO users (user_id, user_name, password, user_type, first_name, last_name, email_address, street_address_1, street_address_2, city, province, postal_code, primary_phone_number, secondry_phone_number, fax_number, salutation, preferred_contact_method, enrol_date, last_access) 
VALUES (10004,'userd','1004c3d449a4002d2e167a7e0a3c063e','d','Smit','Patel','root@rootuser.ca', '38, greenhill ave','34, greenhill ave', 'oshawa', 'ON', 'l1ol1o', '9999869856', '9966869856', '9966869856', 'Mr.', 'e','2018-10-07'::date,	'2018-10-07'::date);

SELECT pg_catalog.setval('user_id_seq', 10004, true);