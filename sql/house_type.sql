DROP TABLE IF EXISTS house_type;

CREATE TABLE house_type(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

-- ALTER TABLE house_type OWNER TO groupXX_admin;

INSERT INTO house_type (value, property) VALUES (1 ,'mansion');
INSERT INTO house_type (value, property) VALUES (2 ,'semi detached');
INSERT INTO house_type (value, property) VALUES (4 ,'villa');
INSERT INTO house_type (value, property) VALUES (8 ,'detached');
INSERT INTO house_type (value, property) VALUES (16 ,'beach house');
INSERT INTO house_type (value, property) VALUES (32 ,'appartments');