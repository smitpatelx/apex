DROP TABLE IF EXISTS pet_friendly;

CREATE TABLE pet_friendly(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

--ALTER TABLE property_option OWNER TO groupXX_admin;

INSERT INTO pet_friendly (value, property) VALUES (1, 'yes');
INSERT INTO pet_friendly (value, property) VALUES (2, 'no');