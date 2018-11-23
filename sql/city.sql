﻿DROP TABLE IF EXISTS city;

CREATE TABLE city(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

-- ALTER TABLE city OWNER TO groupXX_admin;

INSERT INTO city (value, property) VALUES (1, 'ajax');
INSERT INTO city (value, property) VALUES (2, 'brooklin');
INSERT INTO city (value, property) VALUES (4, 'bowmanville');
INSERT INTO city (value, property) VALUES (8, 'oshawa');
INSERT INTO city (value, property) VALUES (16, 'pickering');
INSERT INTO city (value, property) VALUES (32, 'port perry');
INSERT INTO city (value, property) VALUES (64, 'whitby');
INSERT INTO city (value, property) VALUES (128, 'clarington');
INSERT INTO city (value, property) VALUES (256, 'courtice');