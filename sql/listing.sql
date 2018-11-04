/*************
Smit Patel
FILE: listing.sql
15 09 2018
WEBD - II
**************/

DROP TABLE IF EXISTS listings;

CREATE TABLE listings(
	listing_id     int not null primary key default nextval('listing_id_seq'),
    user_id VARCHAR(20) NOT NULL REFERENCES users(id),
	list_heading VARCHAR(15) NOT NULL,
	img VARCHAR(50) NOT NULL,
	location VARCHAR(30) NOT NULL,
	price VARCHAR(20) NOT NULL,
	sqft VARCHAR(10) NOT NULL,
	phone VARCHAR(15) NOT NULL
);