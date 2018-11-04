DROP TABLE IF EXISTS city;

CREATE TABLE city(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

-- ALTER TABLE city OWNER TO groupXX_admin;

INSERT INTO city (value, property) VALUES (1, 'ajax');
INSERT INTO city (value, property) VALUES (2, 'brooklin');
INSERT INTO city (value, property) VALUES (3, 'bowmanville');
INSERT INTO city (value, property) VALUES (4, 'oshawa');
INSERT INTO city (value, property) VALUES (5, 'pickering');
INSERT INTO city (value, property) VALUES (6, 'port perry');
INSERT INTO city (value, property) VALUES (7, 'whitby');
INSERT INTO city (value, property) VALUES (8, 'clarington');
INSERT INTO city (value, property) VALUES (9, 'scugog');
INSERT INTO city (value, property) VALUES (10, 'brampton');
INSERT INTO city (value, property) VALUES (11, 'toronto');
INSERT INTO city (value, property) VALUES (12, 'bowmanville');
INSERT INTO city (value, property) VALUES (13, 'courtice');