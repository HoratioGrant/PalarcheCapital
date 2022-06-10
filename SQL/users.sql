/*
Horatio Grant
Table for capturing users for Palarche Capital
2022-04-23
*/

CREATE TABLE users(
    email VARCHAR(100) PRIMARY KEY,
    userName VARCHAR(20), 
    passWord VARCHAR(20),
    createdON DATE
);

SELECT * FROM users;