DROP TABLE IF EXISTS listing_status;

CREATE TABLE listing_status(
value CHAR(1) PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

--ALTER TABLE listing_status OWNER TO groupXX_admin;

INSERT INTO listing_status(value, property) VALUES ('o', '0pen');

INSERT INTO listing_status(value, property) VALUES ('c', 'closed');

INSERT INTO listing_status(value, property) VALUES ('s', 'sold');

INSERT INTO listing_status(value, property) VALUES ('h', 'hidden');