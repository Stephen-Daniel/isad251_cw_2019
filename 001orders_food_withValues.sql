IF OBJECT_ID(N'dbo.Orders', N'U') IS NOT NULL 
BEGIN
	DROP TABLE dbo.Orders; 
END
CREATE TABLE dbo.Orders
(
    OrderId INT IDENTITY(0001,1) NOT NULL,
    /* time and date needed for the order*/
    OrderDate DATETIME NOT NULL,
    CustomerID NVARCHAR(20) NOT NULL,
    TableNumber SMALLINT NOT NULL,
    CONSTRAINT pk_Orders PRIMARY KEY (OrderID)
);

INSERT INTO dbo.Orders (OrderID, OrderDate, CustomerId, TableNumber)
VALUES (0001, '2019-10-19 10:05:23.187', 'stephen001', 12);
INSERT INTO dbo.Orders (OrderId, OrderDate, CustomerId, TableNumber)
VALUES (0002,'2019-10-19 12:10:30.100', 'Judy001', 1);
INSERT INTO dbo.Orders (OrderId, OrderDate, CustomerId, TableNumber)
VALUES (0003,'2019-10-19 14:21:49.020', 'Pam', 2);


IF OBJECT_ID(N'dbo.OrderLines', N'U') IS NOT NULL 
BEGIN
	DROP TABLE dbo.OrderLines; 
END

CREATE TABLE dbo.OrderLines 
( 
    OrderId INT NOT NULL, 
    FoodId INT NOT NULL,     
    Quantity INT NOT NULL 
        CHECK(Quantity >= 1), 
CONSTRAINT PK_OrderDetails PRIMARY KEY (OrderId, FoodId) 
); 


IF OBJECT_ID(N'dbo.Food', N'U') IS NOT NULL 
BEGIN
	DROP TABLE dbo.Food; 
END

CREATE TABLE dbo.Food
(
	FoodId NVARCHAR (30) NOT NULL,
    DrinkOrSnack BIT NOT NULL DEFAULT 1,/*drink = 1*/
    HotOrCold BIT NOT NULL DEFAULT 1,/*hot = 1*/
    Picture VARCHAR (Max) NOT NULL,
	FoodDescription VARCHAR (Max) NOT NULL,
	UnitPrice FLOAT NOT NULL,
	Quantity INT NOT NULL,
	CONSTRAINT pk_FoodId PRIMARY KEY (FoodId)
);

INSERT INTO dbo.Food(FoodId, DrinkOrSnack, HotOrCold, Picture, FoodDescription, UnitPrice, Quantity)
VALUES('TEA', 1, 1, '/image/drinkTea.jpg', 'Fresh hot brewed Tea from Tesco', 1.20, 300);
INSERT INTO dbo.Food(FoodId, DrinkOrSnack, HotOrCold, Picture, FoodDescription, UnitPrice, Quantity)
VALUES('CHOCOLATE', 1, 1, '/image/drinkChocolate.jpg', 'Melted milk choclate with cream', 1.90, 100);
INSERT INTO dbo.Food(FoodId, DrinkOrSnack, HotOrCold, Picture, FoodDescription, UnitPrice, Quantity)
VALUES('COFFEE', 1, 1, '/image/drinkCoffee.jpg', 'Espresso from Starcosta', 1.90, 300);
INSERT INTO dbo.Food(FoodId, DrinkOrSnack, HotOrCold, Picture, FoodDescription, UnitPrice, Quantity)
VALUES('COKE', 1, 0, '/image/drinkCoke.jpg', 'Cold, fizzy and in a bottle', 1.90, 300);
INSERT INTO dbo.Food(FoodId, DrinkOrSnack, HotOrCold, Picture, FoodDescription, UnitPrice, Quantity)
VALUES('FANTA', 1, 0, '/image/drinkFanta.jpg', 'Fizzy orange with a straw', 1.90, 300);
INSERT INTO dbo.Food(FoodId, DrinkOrSnack, HotOrCold, Picture, FoodDescription, UnitPrice, Quantity)
VALUES('SPRITE', 1, 0, '/image/drinkSprite.jpg', 'Lemon goodness in a cold bottle', 1.90, 300);
INSERT INTO dbo.Food(FoodId, DrinkOrSnack, HotOrCold, Picture, FoodDescription, UnitPrice, Quantity)
VALUES('TOAST', 0, 1, '/image/toast.jpg', 'Fresh cut toasted bread with butter', 2.00, 300);
INSERT INTO dbo.Food(FoodId, DrinkOrSnack, HotOrCold, Picture, FoodDescription, UnitPrice, Quantity)
VALUES('CHEESE ON TOAST', 0, 1, '/image/toastCheese.jpg', 'Melted chedder cheese on toast', 3.50, 300);
INSERT INTO dbo.Food(FoodId, DrinkOrSnack, HotOrCold, Picture, FoodDescription, UnitPrice, Quantity)
VALUES('TOASTED HAM & CHEESE', 0, 1, '/image/toastCheese&Ham.jpg', 'Best toasted sandwich EVER!', 4.50, 300);
INSERT INTO dbo.Food(FoodId, DrinkOrSnack, HotOrCold, Picture, FoodDescription, UnitPrice, Quantity)
VALUES('SALAD SANDWICH', 0, 0, '/image/sandwichSalad.jpg', 'Rabbit food between two slices', 2.00, 200);
INSERT INTO dbo.Food(FoodId, DrinkOrSnack, HotOrCold, Picture, FoodDescription, UnitPrice, Quantity)
VALUES('BEEF SANDWICH', 0, 0, '/image/sandwichBeef.jpg', 'Rabbit between two slices', 4.80, 100);
INSERT INTO dbo.Food(FoodId, DrinkOrSnack, HotOrCold, Picture, FoodDescription, UnitPrice, Quantity)
VALUES('CLUB SANDWICH', 0, 0, '/image/sandwichClub.jpg', 'The very best sandwich', 5.50, 100);

