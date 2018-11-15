DROP TABLE IF EXISTS search_price;

CREATE TABLE search_price(
value INTEGER PRIMARY KEY,
property INT NOT NULL,
property_v VARCHAR(15) NOT NULL
);

--ALTER TABLE search_price OWNER TO groupXX_admin;
INSERT INTO search_price (value, property, property_v) VALUES (1,       100000, '$100000');
INSERT INTO search_price (value, property, property_v) VALUES (2,       200000, '$200000');
INSERT INTO search_price (value, property, property_v) VALUES (4,       300000, '$300000');
INSERT INTO search_price (value, property, property_v) VALUES (8,      400000, '$400000');
INSERT INTO search_price (value, property, property_v) VALUES (16,      500000, '$500000');
INSERT INTO search_price (value, property, property_v) VALUES (32,      600000, '$600000');
INSERT INTO search_price (value, property, property_v) VALUES (64,     700000, '$700000');
INSERT INTO search_price (value, property, property_v) VALUES (128,     800000, '$800000');
INSERT INTO search_price (value, property, property_v) VALUES (256,     900000, '$900000');
INSERT INTO search_price (value, property, property_v) VALUES (512,    1000000,'$1000000');
INSERT INTO search_price (value, property, property_v) VALUES (1024,    1100000,'$1100000');
INSERT INTO search_price (value, property, property_v) VALUES (2048,    1200000,'$1200000');
INSERT INTO search_price (value, property, property_v) VALUES (4096,    1300000,'$1300000');
INSERT INTO search_price (value, property, property_v) VALUES (8192,   1400000,'$1400000');
INSERT INTO search_price (value, property, property_v) VALUES (16384,   1500000,'$1500000');
INSERT INTO search_price (value, property, property_v) VALUES (32768,   1600000,'$1600000');