﻿/*************
Smit Patel
FILE: listing.sql
15 09 2018
WEBD - II
**************/

DROP TABLE IF EXISTS listings CASCADE;

CREATE TABLE listings(
	listing_id int not null primary key default nextval('listing_id_seq'),
	user_id VARCHAR(20) NOT NULL REFERENCES users(user_id),
	status VARCHAR(1) NOT NULL,
	price NUMERIC NOT NULL,
	headline VARCHAR(100) NOT NULL,
	description VARCHAR(1000) NOT NULL,
	postal_code VARCHAR(6) NOT NULL,
	images SMALLINT NOT NULL,
	images_path JSON,
	main_image SMALLINT,
	city INTEGER NOT NULL,
	property_options INTEGER NOT NULL,
	bedrooms INTEGER NOT NULL,
	bathrooms INTEGER NOT NULL,
	address VARCHAR(40) NOT NULL,	
	area INTEGER NOT NULL,
	contact VARCHAR(15) NOT NULL,
	pets_friendly SMALLINT NOT NULL,
	created_on DATE NOT NULL
);