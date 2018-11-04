-- FILE: 						provinces.sql
-- TITLE:						Apex Listings - User Tables Creation Script
-- AUTHORS:						Smit Patel
-- LAST MODIFIED:		        October 4, 2018

DROP TABLE IF EXISTS provinces;
CREATE TABLE provinces (
    province_id INTEGER PRIMARY KEY,
    province VARCHAR(2),
    province_long VARCHAR(30)
);

INSERT INTO provinces (province_id, province, province_long) VALUES ('1', 'AB', 'Alberta');
INSERT INTO provinces (province_id, province, province_long) VALUES ('2', 'BC', 'British Columbia');
INSERT INTO provinces (province_id, province, province_long) VALUES ('3', 'MB', 'Manitoba');
INSERT INTO provinces (province_id, province, province_long) VALUES ('4', 'NB', 'New Brunswick');
INSERT INTO provinces (province_id, province, province_long) VALUES ('5', 'NL', 'Newfoundland and Labrador');
INSERT INTO provinces (province_id, province, province_long) VALUES ('6', 'NT', 'Northwest Territories');
INSERT INTO provinces (province_id, province, province_long) VALUES ('7', 'NS', 'Nova Scotia');
INSERT INTO provinces (province_id, province, province_long) VALUES ('8', 'NU', 'Nunavut');
INSERT INTO provinces (province_id, province, province_long) VALUES ('9', 'ON', 'Ontario');
INSERT INTO provinces (province_id, province, province_long) VALUES ('10', 'PE', 'Prince Edward Island');
INSERT INTO provinces (province_id, province, province_long) VALUES ('11', 'QC', 'Quebec');
INSERT INTO provinces (province_id, province, province_long) VALUES ('12', 'SK', 'Saskatchewan');
INSERT INTO provinces (province_id, province, province_long) VALUES ('13', 'YT', 'Yukon');
