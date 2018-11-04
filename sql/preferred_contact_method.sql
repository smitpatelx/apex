-- FILE: 						preferred_contact_method.sql
-- TITLE:						Apex Listings - User Tables Creation Script
-- AUTHORS:						Smit Patel
-- LAST MODIFIED:		        October 4, 2018

DROP TABLE IF EXISTS preferred_contact_method;
CREATE TABLE preferred_contact_method (
    method_id INTEGER PRIMARY KEY,
    method VARCHAR(10),
    method_name VARCHAR(10)
);

INSERT INTO preferred_contact_method (method_id, method, method_name) VALUES ('1', 'email', 'E-mail');
INSERT INTO preferred_contact_method (method_id, method, method_name) VALUES ('2', 'phone', 'Phone');
INSERT INTO preferred_contact_method (method_id, method, method_name) VALUES ('3', 'letter', 'Letter');