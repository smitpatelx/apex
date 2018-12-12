/*************
Smit Patel
FILE: listing.sql
15 09 2018
WEBD - II
**************/

<<<<<<< HEAD
DROP TABLE IF EXISTS listings CASCADE;
=======
DROP TABLE IF EXISTS listings;
>>>>>>> 5a03d788a70a72822cda86d705291dd82127a05a

CREATE TABLE listings(
	listing_id int not null primary key default nextval('listing_id_seq'),
	user_id VARCHAR(20) NOT NULL REFERENCES users(user_id),
	status VARCHAR(1) NOT NULL,
	price NUMERIC NOT NULL,
	headline VARCHAR(100) NOT NULL,
	description VARCHAR(1000) NOT NULL,
	postal_code VARCHAR(6) NOT NULL,
	images SMALLINT NOT NULL,
<<<<<<< HEAD
	images_path JSON,
	main_image SMALLINT,
=======
	images_path VARCHAR(200) NOT NULL,
>>>>>>> 5a03d788a70a72822cda86d705291dd82127a05a
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