INSERT INTO Categories (CategoryName, CategoryClass)
VALUES ('Snowboard&Ski', 'boards'),
       ('Bindings', 'bindings'),
       ('Boots', 'boots'),
       ('Snowwear', 'clothing'),
       ('Accessories', 'tools'),
       ('Other', 'other');

INSERT INTO Users (UserID, UserEmail, UserPassword, UserName, UserComments, UserImgPath )
VALUES ('1', 'dylan@gmail.com', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', 'Dylan', '','img/avatar.jpg'),
       ('2', 'kitty_93@gmail.com', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', 'Catherine', '','img/avatar.jpg'),
       ('3', 'warrior07@mail.ru', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', 'Warrior', '','img/avatar.jpg'),
       ('4', 'kitty_93@gmail.com', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', 'Skye', '','img/avatar.jpg');

INSERT INTO Lots (LotName, LotPrice, LotStepBid, LotImgUrl, LotDescription, CategoryID, LotDateTime)
VALUES ('2014 Rossignol District Snowboard','350','5','img/lot-1.jpg','something about Snowboard','1', '2021-08-22 00:00:00'),
       ('DC Ply Mens 2016/2017 Snowboard','299','5','img/lot-2.jpg','something about Snowboard','1', '2021-08-20 00:00:00'),
       ('Bindings Union Contact Pro 2015 size L/XL','109','5','img/lot-3.jpg','something about Bindings','2', '2021-08-10 05:00:00'),
       ('Boots for Snowboard DC Mutiny Charocal','340','5','img/lot-4.jpg','something about boots','3', '2021-08-02 07:07:11'),
       ('Jacket for Snowboard DC Mutiny Charocal','169','5','img/lot-5.jpg','something about jacket','4', '2021-08-01 14:17:00'),
       ('Face Mask DRAGON DX Goggle 2021','270','5','img/lot-6.jpg',"The DX Goggle is a timeless Dragon shape that's been upgraded to meet the demands of today's consumers. The DX checks all the boxes: 100-percent UV protection, Super Anti Fog lens treatment, and a design that guarantees seamless goggle-to-helmet fit. Those looking for a no-fuss goggle should look no further than the DX.",'6', '2021-08-01 04:19:00');

INSERT INTO Bids (BidID, BidPrice, BidDateTime, LotID, UserID)
VALUES ('1','250', '2021-08-13 00:15:00', '1', '2'),
       ('2','280', '2021-08-12 08:09:08', '1', '1'),
       ('3','300', '2021-08-11 12:17:40', '1', '3'),
       ('4','280', '2021-08-11 06:30:10', '1', '4');
