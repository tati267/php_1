CREATE DATABASE yeticave;
USE yeticave;


CREATE TABLE Categories (
    CategoryID INT AUTO_INCREMENT PRIMARY KEY,
    CategoryName VARCHAR(255),
    CategoryClass VARCHAR(255)
);

CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    UserEmail VARCHAR(128),
    UserPassword VARCHAR(64),
    UserName VARCHAR(128),
    UserImgPath VARCHAR(128),
    UserComments VARCHAR(255)
);

CREATE TABLE Lots (
    LotID INT AUTO_INCREMENT,
    LotName VARCHAR(255),
    LotStepBid INT,
    LotPrice INT,
    LotImgUrl VARCHAR(128),
    LotDescription VARCHAR(255),
    LotDateTime DATETIME,
    CategoryID INT,
    PRIMARY KEY (LotID),
    FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID)
);

CREATE TABLE Bids (
    BidID INT AUTO_INCREMENT,
    BidPrice INT,
    BidDateTime DATETIME,
    UserID INT,
    LotID INT,
    PRIMARY KEY (BidID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (LotID) REFERENCES Lots(LotID)
);
