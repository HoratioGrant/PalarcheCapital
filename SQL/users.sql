/*
Horatio Grant
Table for capturing clients for Palarche Capital
2022-04-23
*/

CREATE TABLE client_list(
    clientId INT AUTO_INCREMENT ,
    email VARCHAR(100) ,
    userName VARCHAR(20) NOT NULL, 
    passWord VARCHAR(20) NOT NULL,
    createdON DATE,
    PRIMARY KEY (clientId)
);

SELECT * FROM client_list;