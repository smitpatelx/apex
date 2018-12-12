DROP TABLE IF EXISTS offensives CASCADE;

CREATE TABLE offensives(
user_id VARCHAR(20) NOT NULL REFERENCES users(user_id),
listing_id INT NOT NULL REFERENCES listings(listing_id),
reported_on DATE NOT NULL,
status  VARCHAR(1) NOT NULL,
PRIMARY KEY (user_id, listing_id)
);