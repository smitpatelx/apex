DROP TABLE IF EXISTS city;

CREATE TABLE city(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

-- ALTER TABLE city OWNER TO groupXX_admin;

INSERT INTO city (value, property) VALUES (2, 'ajax');
INSERT INTO city (value, property) VALUES (4, 'brooklin');
INSERT INTO city (value, property) VALUES (8, 'bowmanville');
INSERT INTO city (value, property) VALUES (16, 'oshawa');
INSERT INTO city (value, property) VALUES (32, 'pickering');
INSERT INTO city (value, property) VALUES (64, 'port perry');
INSERT INTO city (value, property) VALUES (128, 'whitby');
INSERT INTO city (value, property) VALUES (256, 'clarington');
INSERT INTO city (value, property) VALUES (512, 'scugog');
INSERT INTO city (value, property) VALUES (1024, 'brampton');
INSERT INTO city (value, property) VALUES (2048, 'toronto');
INSERT INTO city (value, property) VALUES (4096, 'bowmanville');
INSERT INTO city (value, property) VALUES (8192, 'courtice');