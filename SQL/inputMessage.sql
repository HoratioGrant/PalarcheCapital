/*
Horatio Grant
Table for capturing contact messages for Palarche Capital
2022-04-23
*/

CREATE TABLE ContactUsMessages(
     id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    email VARCHAR(100),
    UserName VARCHAR(40), 
    UserMessage VARCHAR(400),
    createdON DATE
);

SELECT * FROM ContactUsMessages;