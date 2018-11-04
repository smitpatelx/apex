DROP TABLE IF EXISTS house_type;

CREATE TABLE house_type(
value VARCHAR(15) PRIMARY KEY
);

-- ALTER TABLE house_type OWNER TO groupXX_admin;

INSERT INTO house_type (value) VALUES ("mansion");
INSERT INTO house_type (value) VALUES ("semi detached");
INSERT INTO house_type (value) VALUES ("villa");
INSERT INTO house_type (value) VALUES ("detached");
INSERT INTO house_type (value) VALUES ("beach house");
INSERT INTO house_type (value) VALUES ("appartments");