-- FILE: 						persons.sql
-- TITLE:						Apex Listings - User Tables Creation Script
-- AUTHORS:						Smit Patel
-- LAST MODIFIED:		        October 4, 2018

DROP TABLE IF EXISTS persons;
CREATE TABLE persons (
    user_id VARCHAR(20) PRIMARY KEY REFERENCES users (user_id),
    salutation VARCHAR(10),
    first_name VARCHAR(128),
    last_name VARCHAR (128),
    street_address_1 VARCHAR(128),
    street_address_2 VARCHAR(128), 
    city VARCHAR(64), 
    province VARCHAR(2), 
    postal_code VARCHAR(6), 
    primary_phone_number VARCHAR(15), 
    secondry_phone_number VARCHAR(15), 
    fax_number VARCHAR(15),
    preferred_contact_method VARCHAR(1)
);