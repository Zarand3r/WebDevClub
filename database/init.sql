USE heroku_28dbc20876ed2b4;

DROP TABLE users;

CREATE TABLE users (
	id INT PRIMARY KEY AUTO_INCREMENT,
    fname varchar(255),
    lname varchar(255),
    username varchar(255),
    pass CHAR(32),
    email varchar(255),
    accountType CHAR(1),
    score INT
);

-- CREATE TABLE active (
-- 	id INT PRIMARY KEY AUTO_INCREMENT,
--     username varchar(255),
--     timelog timestamp
-- );

DROP TABLE pagecodes;

CREATE TABLE pagecodes (
    typename varchar(255),
    sourcecode TEXT
);

INSERT INTO users (fname, lname, username, pass, email, accountType, score)
VALUES ('Richard', 'Bao', 'Akalem', 'fc5e038d38a57032085441e7fe7010b0', 'richardbao419@gmail.com', 'T', 100);

INSERT INTO pagecodes (typename, sourcecode)
VALUES ('news', 'This is a test news article post');
