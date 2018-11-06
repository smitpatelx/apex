-- FILE: 						persons.sql
-- TITLE:						Apex Listings - User Tables Creation Script
-- AUTHORS:						Smit Patel
-- LAST MODIFIED:		        October 4, 2018

DROP TABLE IF EXISTS persons;
CREATE TABLE persons (
    user_id VARCHAR(20) PRIMARY KEY REFERENCES users (user_id),
    salutation VARCHAR(10) NOT NULL,
    first_name VARCHAR(128) NOT NULL,
    last_name VARCHAR (128) NOT NULL,
    street_address_1 VARCHAR(128) NOT NULL,
    street_address_2 VARCHAR(128) NOT NULL, 
    city VARCHAR(64) NOT NULL, 
    province VARCHAR(2) NOT NULL, 
    postal_code VARCHAR(6) NOT NULL, 
    primary_phone_number VARCHAR(15) NOT NULL, 
    secondry_phone_number VARCHAR(15) NOT NULL, 
    fax_number VARCHAR(15) NOT NULL,
    preferred_contact_method VARCHAR(1) NOT NULL
);