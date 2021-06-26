use db_netflix;

CREATE TABLE user (
    id INT NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(25) NOT NULL,
    lastname VARCHAR(25) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(60) NOT NULL,
    dh_insert DATETIME DEFAULT NOW(),
    is_subscribed TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY(id)
);






