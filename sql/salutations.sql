-- FILE: 						salutations.sql
-- TITLE:						Apex Listings - User Tables Creation Script
-- AUTHORS:						Smit Patel
-- LAST MODIFIED:		        October 4, 2018

DROP TABLE IF EXISTS salutations;
CREATE TABLE salutations (
    salutations_id INTEGER PRIMARY KEY,
    salutation VARCHAR(7)
);

INSERT INTO salutations (salutations_id, salutation) VALUES ('1', 'Mr.');
INSERT INTO salutations (salutations_id, salutation) VALUES ('2', 'Master');
INSERT INTO salutations (salutations_id, salutation) VALUES ('3', 'Miss');
INSERT INTO salutations (salutations_id, salutation) VALUES ('4', 'Mrs.');
INSERT INTO salutations (salutations_id, salutation) VALUES ('5', 'Ms.');
