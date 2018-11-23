-- FILE: 						preferred_contact_method.sql
-- TITLE:						Apex Listings - User Tables Creation Script
-- AUTHORS:						Smit Patel
-- LAST MODIFIED:		        October 4, 2018

DROP TABLE IF EXISTS preferred_contact_method;
CREATE TABLE preferred_contact_method (
    value INTEGER PRIMARY KEY,
    method VARCHAR(10),
    method_name VARCHAR(10)
);

INSERT INTO preferred_contact_method (value, method, method_name) VALUES (1, 'e', 'E-mail');
INSERT INTO preferred_contact_method (value, method, method_name) VALUES (2, 'p', 'Phone');
INSERT INTO preferred_contact_method (value, method, method_name) VALUES (4, 'l', 'Letter');