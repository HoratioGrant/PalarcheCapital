CREATE TABLE accounts_list(
    accountNumber INT AUTO_INCREMENT,
    clientId INT NOT NULL ,
    type VARCHAR(20),
    balance INT,
   
    PRIMARY KEY (accountNumber)
);

SELECT * FROM accounts_list;