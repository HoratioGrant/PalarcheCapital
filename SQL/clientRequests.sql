CREATE TABLE client_Requests(
    requestNumber INT AUTO_INCREMENT,
    clientId INT NOT NULL ,
    requestStatus VARCHAR(20),
    requestType VARCHAR(20),
    info VARCHAR(20),
   
    PRIMARY KEY (requestNumber)
);

SELECT * FROM client_Requests;