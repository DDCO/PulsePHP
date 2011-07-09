use pulsephp;
CREATE TABLE IF NOT EXISTS users ( 
    userid INT NOT NULL,
    username VARCHAR(45) NOT NULL,
    password VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL,
    usergroup VARCHAR(45) NOT NULL
);
CREATE TABLE IF NOT EXISTS log ( 
    logid INT NOT NULL,
    timestamp DATETIME NOT NULL,
    address VARCHAR(45) NOT NULL,
    description VARCHAR(45) NOT NULL
);