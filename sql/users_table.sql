/*************
FILE: 						listing.sql
TITLE:						Apex Listings - User Tables Creation Script
AUTHORS:					Blake Phillips, Clayton Galliah-Penhale, Dylan Lopez, Smit Patel
LAST MODIFIED BY: Dylan Lopez
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Creates users class for PostGreSQL database
**************/

-- DROP TABLE IF EXISTS users;

-- CREATE TABLE users (
--     user_id VARCHAR(20) PRIMARY KEY,
--     password VARCHAR(32) NOT NULL,
--     user_type VARCHAR(2) NOT NULL,
--     email_address VARCHAR(255) NOT NULL,
--     enrol_date DATE NOT NULL,
--     last_access DATE NOT NULL
-- );


DROP TABLE IF EXISTS users;

CREATE TABLE users (
    user_id SERIAL PRIMARY KEY,
    user_name VARCHAR(20) NOT NULL,
    password VARCHAR(32) NOT NULL,
    user_type VARCHAR(2) NOT NULL,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR (45) NOT NULL,
    email_address VARCHAR(255) NOT NULL,
    enrol_date DATE NOT NULL,
    last_access DATE NOT NULL
);