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
    UserImgPath VARCHAR(128),
    UserName VARCHAR(128),
    UserComments VARCHAR(255),
);

CREATE TABLE Lots (
    LotID INT AUTO_INCREMENT,
    LotName VARCHAR(255),
    LotStartPrice INT,
    LotPrice INT,
    LotImgUrl VARCHAR(128),
    LotDescription VARCHAR(255),
    LotBidsQuantity INT,
    CategoryID INT,
    PRIMARY KEY (LotID),
    FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID)
);

CREATE TABLE Bids (
    BidID INT AUTO_INCREMENT,
    BidPrice INT,
    BidDate DATE,
    UserID INT,
    LotID INT,
    PRIMARY KEY (BidID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (LotID) REFERENCES Lots(LotID)
);

INSERT INTO Categories
SET CategoryName='Snowboard&Ski', CategoryClass = 'boards';
INSERT INTO Categories
SET CategoryName='Bindings', CategoryClass = 'bindings';
INSERT INTO Categories
SET CategoryName='Boots', CategoryClass = 'boots';
INSERT INTO Categories
SET CategoryName='Snowwear', CategoryClass = 'clothing';
INSERT INTO Categories
SET CategoryName='Accessories', CategoryClass = 'tools';
INSERT INTO Categories
SET CategoryName='Other', CategoryClass = 'other';


CREATE TABLE Lots (
    LotID INT AUTO_INCREMENT PRIMARY KEY,
    LotName VARCHAR(255) NOT NULL,
    LotCategory VARCHAR(50) NOT NULL,
    LotPrice INT NOT NULL,
    LotImgUrl VARCHAR(128),
    LotAbout VARCHAR(255),
);

INSERT INTO Lots
SET LotName ='2014 Rossignol District Snowboard',
    LotPrice ='350',
    LotImgUrl = 'img/lot-1.jpg',
    LotAbout = 'something about Snowboard',
    LotCategoryID = '1';
INSERT INTO Lots
SET LotName ='DC Ply Mens 2016/2017 Snowboard',
    LotPrice ='299',
    LotImgUrl = 'img/lot-2.jpg',
    LotAbout = 'something about Snowboard',
    LotCategoryID = '1';
INSERT INTO Lots
SET LotName ='Bindings Union Contact Pro 2015 size L/XL',
    LotPrice ='109',
    LotImgUrl = 'img/lot-3.jpg',
    LotAbout = 'something about Bindings',
    LotCategoryID = '2';
INSERT INTO Lots
SET LotName ='Boots for Snowboard DC Mutiny Charocal',
    LotPrice ='340',
    LotImgUrl = 'img/lot-4.jpg',
    LotAbout = 'something about boots',
    LotCategoryID = '3';
INSERT INTO Lots
SET LotName ='Jacket for Snowboard DC Mutiny Charocal',
    LotPrice ='169',
    LotImgUrl = 'img/lot-5.jpg',
    LotAbout = 'something about jacket',
    LotCategoryID = '4';
INSERT INTO Lots
SET LotName ='Face Mask DRAGON DX Goggle 2021',
    LotPrice ='270',
    LotImgUrl = 'img/lot-6.jpg',
    LotAbout = "The DX Goggle is a timeless Dragon shape that's been upgraded to meet the demands of today's consumers. The DX checks all the boxes: 100-percent UV protection, Super Anti Fog lens treatment, and a design that guarantees seamless goggle-to-helmet fit. Those looking for a no-fuss goggle should look no further than the DX.",
    LotCategoryID = '6';

CREATE TABLE Bets (
    BetID INT AUTO_INCREMENT PRIMARY KEY,
    BetPrice INT,
    BetDate DATE NOT NULL,
    BetNameID INT
);

INSERT INTO Bets
SET BetNameID ='2',
    BetPrice = '250',
    BetDate ="2021-08-13 00:15:00";
INSERT INTO Bets
SET BetNameID ='1',
    BetPrice = '280',
    BetDate ="2021-08-12 08:09:08";
INSERT INTO Bets
SET BetNameID ='3',
    BetPrice = '300',
    BetDate ="2021-08-11 12:17:40";
INSERT INTO Bets
SET BetNameID ='4',
    BetPrice = '280',
    BetDate ="2021-08-11 06:30:10";

CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    UserEmail CHAR(128),
    UserPassword CHAR(64),
    UserName CHAR(128);
);

INSERT INTO Users
SET UserEmail ='alex.v@gmail.com',
    UserPassword = '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka',
    UserName ='Alex';
INSERT INTO Users
SET UserEmail ='kitty_93@gmail.com',
    UserPassword = '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa',
    UserName ='Helen';
INSERT INTO Users
SET UserEmail ='warrior07@mail.ru',
    UserPassword = '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW',
    UserName ='Warrior';
INSERT INTO Users
SET UserEmail ='kitty_93@gmail.com',
    UserPassword = '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa',
    UserName ='Helen';
