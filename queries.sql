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


INSERT INTO Users
SET UserEmail ='dylan@gmail.com',
    UserPassword = '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka',
    UserName ='Dylan',
    UserComments='',
    UserImgPath = 'img/avatar.jpg';
INSERT INTO Users
SET UserEmail ='kitty_93@gmail.com',
    UserPassword = '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa',
    UserName ='Catherine',
    UserComments='',
    UserImgPath = 'img/avatar.jpg';
INSERT INTO Users
SET UserEmail ='warrior07@mail.ru',
    UserPassword = '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW',
    UserName ='Warrior',
    UserComments='',
    UserImgPath = 'img/avatar.jpg';
INSERT INTO Users
SET UserEmail ='kitty_93@gmail.com',
    UserPassword = '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa',
    UserName ='Skye',
    UserComments='',
    UserImgPath = 'img/avatar.jpg';

INSERT INTO Lots
SET LotName ='2014 Rossignol District Snowboard',
    LotPrice ='350',
    LotStartPrice ='380',
    LotImgUrl = 'img/lot-1.jpg',
    LotDescription = 'something about Snowboard',
    CategoryID = '1';
INSERT INTO Lots
SET LotName ='DC Ply Mens 2016/2017 Snowboard',
    LotPrice ='299',
    LotStartPrice ='300',
    LotImgUrl = 'img/lot-2.jpg',
    LotDescription = 'something about Snowboard',
    CategoryID = '1';
INSERT INTO Lots
SET LotName ='Bindings Union Contact Pro 2015 size L/XL',
    LotPrice ='109',
    LotStartPrice ='110',
    LotImgUrl = 'img/lot-3.jpg',
    LotDescription = 'something about Bindings',
    CategoryID = '2';
INSERT INTO Lots
SET LotName ='Boots for Snowboard DC Mutiny Charocal',
    LotPrice ='340',
    LotStartPrice ='350',
    LotImgUrl = 'img/lot-4.jpg',
    LotDescription = 'something about boots',
    CategoryID = '3';
INSERT INTO Lots
SET LotName ='Jacket for Snowboard DC Mutiny Charocal',
    LotPrice ='169',
    LotStartPrice ='170',
    LotImgUrl = 'img/lot-5.jpg',
    LotDescription = 'something about jacket',
    CategoryID = '4';
INSERT INTO Lots
SET LotName ='Face Mask DRAGON DX Goggle 2021',
    LotPrice ='270',
    LotStartPrice ='275',
    LotImgUrl = 'img/lot-6.jpg',
    LotDescription = "The DX Goggle is a timeless Dragon shape that's been upgraded to meet the demands of today's consumers. The DX checks all the boxes: 100-percent UV protection, Super Anti Fog lens treatment, and a design that guarantees seamless goggle-to-helmet fit. Those looking for a no-fuss goggle should look no further than the DX.",
    CategoryID = '6';


INSERT INTO Bids
SET BidPrice = '250',
    BidDate ="2021-08-13 00:15:00",
    LotID = '1',
    UserID ='2';
INSERT INTO Bids
SET BidPrice = '280',
    BidDate ="2021-08-12 08:09:08",
    LotID = '1',
    UserID ='1';
INSERT INTO Bids
SET BidPrice = '300',
    BidDate ="2021-08-11 12:17:40",
    LotID = '1',
    UserID ='3';
INSERT INTO Bids
SET BidPrice = '280',
    BidDate ="2021-08-11 06:30:10",
    LotID = '1',
    UserID ='4';

--Get all categories
SELECT CategoryName FROM Categories

--Get all new open lots

SELECT * FROM Lots

--Get combined table Lots+Categories about particular lot id
SELECT l.LotID,l.LotName, l.LotPrice, l.LotStartPrice, l.LotImgUrl, l.LotDescription, c.CategoryName
FROM Lots as l
JOIN Categories AS c ON l.CategoryID=c.CategoryID
WHERE LotID = 1;


--update lotName lot id
UPDATE `lots`
SET LotName = 'DC Ply Womans 2016/2017 Snowboard'
WHERE LotID = 2;

--Get list of Bids for lot id
SELECT b.BidID, b.BidPrice, b.BidDate, b.LotID, b.UserID
FROM Bids b
JOIN Lots l ON b.LotID= l.LotID
WHERE l.LotID = 1
ORDER BY BidPrice DESC;

