-- FILE: 						listing.sql
-- TITLE:						Apex Listings - User Tables Creation Script
-- AUTHORS:					Blake Phillips, Clayton Galliah-Penhale, Dylan Lopez, Smit Patel
-- LAST MODIFIED BY: Dylan Lopez
-- LAST MODIFIED:		October 4, 2018
-- DESCRIPTION:			Creates users class for PostGreSQL database
ALTER TABLE IF EXISTS users;
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    user_id SERIAL PRIMARY KEY,
    user_name VARCHAR(20) NOT NULL,
    password VARCHAR(20) NOT NULL,
    user_type VARCHAR(2) NOT NULL,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR (30) NOT NULL,
    email_address VARCHAR(255) NOT NULL,
    enrol_date DATE NOT NULL,
    last_access DATE NOT NULL
);
-- 4	smitpatelx	1004c3d449a4002d2e167a7e0a3c063e	s	Smit	Patel	root@rootuser.com	2018-10-07	2018-10-07
-- 3	smitpatelc	1004c3d449a4002d2e167a7e0a3c063e	c	rocky	handsome	rocky@admin.com	2018-10-07	2018-10-07
-- 2	smitpatel2	1004c3d449a4002d2e167a7e0a3c063e	a	smit	patel	root@root.com	2018-10-07	2018-10-07
-- 1	smitpatel	1004c3d449a4002d2e167a7e0a3c063e	a	Smit	Patel	root@rootuser.com	2018-10-07	2018-10-07
INSERT INTO users (user_id, user_name, password, user_type, first_name, last_name, email_address, enrol_date, last_access) VALUES (1,    'usera',	'1004c3d449a4002d2e167a7e0a3c063e',	'a',	'Smit',	'Patel',	'root@rootuser.com',	'2018-10-07'::date,	'2018-10-07'::date);
INSERT INTO users (user_id, user_name, password, user_type, first_name, last_name, email_address, enrol_date, last_access) VALUES (2,    'userc',	'1004c3d449a4002d2e167a7e0a3c063e',	'c',	'Smit',	'Patel',	'root@rootuser.co',	'2018-10-07'::date,	'2018-10-07'::date);
INSERT INTO users (user_id, user_name, password, user_type, first_name, last_name, email_address, enrol_date, last_access) VALUES (3,    'users',	'1004c3d449a4002d2e167a7e0a3c063e',	's',	'Smit',	'Patel',	'root@rootuser.c',	'2018-10-07'::date,	'2018-10-07'::date);
INSERT INTO users (user_id, user_name, password, user_type, first_name, last_name, email_address, enrol_date, last_access) VALUES (4,    'userd',	'1004c3d449a4002d2e167a7e0a3c063e',	'd',	'Smit',	'Patel',	'root@rootuser.ca',	'2018-10-07'::date,	'2018-10-07'::date);