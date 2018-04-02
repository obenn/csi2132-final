﻿SET search_path = "Project"

CREATE TABLE RATER 
(
	UserID INTEGER PRIMARY KEY,
	Email VARCHAR,
	Name VARCHAR,
	JoinDate DATE,
	Type VARCHAR CHECK (type='blog' OR type='online' OR type='food critic'), 
	Reputation INTEGER CHECK (Reputation>=1 AND Reputation<=5) DEFAULT 1
);


CREATE TABLE RATING 
(
	UserID INTEGER,
	Date DATE,
	PRIMARY KEY (UserID, Date),
	Price INTEGER CHECK (Price>=1 AND Price<=5) DEFAULT 1,
	Food INTEGER CHECK (Food>=1 AND Food<=5) DEFAULT 1,
	Mood INTEGER CHECK (Mood>=1 AND Mood<=5) DEFAULT 1,
	Staff INTEGER CHECK (Staff>=1 AND Staff<=5) DEFAULT 1,
	Comments VARCHAR,
	RestaurantID INTEGER,
	FOREIGN KEY (UserID) REFERENCES RATER,
	FOREIGN KEY (RestaurantID) REFERENCES RESTAURANT
);

CREATE TABLE RESTAURANT
(
	RestaurantID INTEGER PRIMARY KEY,
	Name VARCHAR,
	Type VARCHAR,
	URL VARCHAR
);

CREATE TABLE LOCATION
(
	LocationID INTEGER PRIMARY KEY,
	FirstOpenDate DATE,
	ManagerName VARCHAR,
	PhoneNumber VARCHAR,
	StreetAddress VARCHAR,
	HourOpen VARCHAR,
	HourClose VARCHAR,
	RestaurantID INTEGER,
	FOREIGN KEY (RestaurantID) REFERENCES RESTAURANT
);

CREATE TABLE MENUITEM
(
	ItemID INTEGER PRIMARY KEY,
	Name VARCHAR,
	Type VARCHAR CHECK (Type='food' OR Type='beverage'),
	Category VARCHAR CHECK (Category='starter' OR Category='main' OR Category='dessert'),
	Description VARCHAR,
	Price MONEY,
	RestaurantID INTEGER,
	FOREIGN KEY (RestaurantID) REFERENCES RESTAURANT
);

CREATE TABLE RATINGITEM
(
	UserID INTEGER,
	Date DATE,
	ItemID INTEGER,
	PRIMARY KEY (UserID, Date, ItemID),
	Rating INTEGER CHECK (Rating>=1 AND Rating<=5) DEFAULT 1,
	Comment VARCHAR
);

INSERT INTO RATER
	VALUES (1,'big.joe@gmail.com','Big Joe','2017-01-01','online',3);
INSERT INTO RATER
	VALUES (2,'only.vegan@gmail.com','Only Vegan','2017-01-02','blog',2);
INSERT INTO RATER
	VALUES (3,'masterchef@gmail.com','Masterchef','2017-01-03','food critic',5);
INSERT INTO RATER
	VALUES (4,'meat.lover@gmail.com','Meat Lover','2017-01-04','blog',3);
INSERT INTO RATER
	VALUES (5,'apprentice.chef@gmail.com','Apprentice Chef','2017-01-05','food critic',4);
INSERT INTO RATER
	VALUES (6,'anything.goes@gmail.com','Anything Goes','2017-01-06','blog',1);
INSERT INTO RATER
	VALUES (7,'lowfat.water@gmail.com','Low Fat Water','2017-01-07','online',1);	
INSERT INTO RATER
	VALUES (8,'grease@gmail.com','Grease','2017-01-01','online',2);
INSERT INTO RATER
	VALUES (9,'chef.charlie@gmail.com','Chef Charlie','2017-01-02','food critic',5);
INSERT INTO RATER
	VALUES (10,'muffin.man@gmail.com','Muffin Man','2017-01-03','blog',5);
INSERT INTO RATER
	VALUES (11,'gingerbread.person@gmail.com','Gingerbread Person','2017-01-04','food critic',4);
INSERT INTO RATER
	VALUES (12,'food.addict@gmail.com','Food Addict','2017-01-05','food critic',5);
INSERT INTO RATER
	VALUES (13,'sugar@gmail.com','Sugar','2017-01-06','online',2);
INSERT INTO RATER
	VALUES (14,'protein.only@gmail.com','Protein Only','2017-01-07','blog',3);
INSERT INTO RATER
	VALUES (15,'head.cook@gmail.com','Head Cook','2017-01-08','food critic',5);


INSERT INTO RESTAURANT
	VALUES (1,'Ottawa Pizza House', 'italian', 'www.ottawapizzahouse.ca');
INSERT INTO RESTAURANT
	VALUES (2,'Tea House','japanese','www.teahouse.ca');
INSERT INTO RESTAURANT
	VALUES (3,'Old Scottish Pub','english','www.oldscottishpub.ca');
INSERT INTO RESTAURANT
	VALUES (4,'Deep Sea Market','english','www.deepseamarket.ca');
INSERT INTO RESTAURANT
	VALUES (5,'The Grill','canadian','www.thegrill.ca');
INSERT INTO RESTAURANT
	VALUES (6,'Johns Coffee and Doughnuts','american','www.johncoffeeanddoughnut.ca');
INSERT INTO RESTAURANT
	VALUES (7,'Desert Palace','italian','www.desertpalace.ca');
INSERT INTO RESTAURANT
	VALUES (8,'One Stop Fast Food','american','www.onestopfastfood.ca');
INSERT INTO RESTAURANT
	VALUES (9,'Noodle House','asian','www.noodlehouse.ca');
INSERT INTO RESTAURANT
	VALUES (10,'Michelangelo','italian','www.michelangelo.ca');
INSERT INTO RESTAURANT
	VALUES (11,'Mediterranean Chicken','greek','www.mediterraneanchicken.ca');
INSERT INTO RESTAURANT
	VALUES (12,'Salad Bar','american','www.saladbar.ca');

INSERT INTO RATING
	VALUES (1,'2017-5-1',4,2,1,5,'X',1);
INSERT INTO RATING
	VALUES (2,'2017-5-2',3,4,3,2,'X',2);
INSERT INTO RATING
	VALUES (3,'2017-5-3',2,3,3,4,'X',3);
INSERT INTO RATING
	VALUES (4,'2017-5-4',4,3,2,4,'X',4);
INSERT INTO RATING
	VALUES (5,'2017-5-5',4,4,3,5,'X',5);
INSERT INTO RATING
	VALUES (6,'2017-5-6',2,1,3,1,'X',6);
INSERT INTO RATING
	VALUES (7,'2017-5-7',2,1,2,4,'X',7);
INSERT INTO RATING
	VALUES (8,'2017-5-8',3,1,2,5,'X',8);
INSERT INTO RATING
	VALUES (9,'2017-5-9',2,3,4,5,'X',9);
INSERT INTO RATING
	VALUES (10,'2017-5-10',1,5,4,1,'X',10);
INSERT INTO RATING
	VALUES (11,'2017-5-11',4,4,4,1,'X',11);
INSERT INTO RATING
	VALUES (12,'2017-5-12',2,2,2,2,'X',12);
INSERT INTO RATING
	VALUES (13,'2017-5-13',2,4,4,4,'X',1);
INSERT INTO RATING
	VALUES (14,'2017-5-14',5,3,4,5,'X',2);
INSERT INTO RATING
	VALUES (15,'2017-5-15',2,5,2,1,'X',3);
INSERT INTO RATING
	VALUES (1,'2017-5-16',4,5,5,1,'X',4);
INSERT INTO RATING
	VALUES (2,'2017-5-17',3,2,3,4,'X',5);
INSERT INTO RATING
	VALUES (3,'2017-5-18',3,4,1,4,'X',6);
INSERT INTO RATING
	VALUES (4,'2017-5-19',4,5,5,3,'X',7);
INSERT INTO RATING
	VALUES (5,'2017-5-20',3,5,2,5,'X',8);
INSERT INTO RATING
	VALUES (6,'2017-5-21',2,5,2,4,'X',9);
INSERT INTO RATING
	VALUES (7,'2017-5-22',5,3,1,2,'X',10);
INSERT INTO RATING
	VALUES (8,'2017-5-23',2,3,1,2,'X',11);
INSERT INTO RATING
	VALUES (9,'2017-5-24',2,1,4,4,'X',12);
INSERT INTO RATING
	VALUES (10,'2017-5-25',1,5,3,2,'X',1);
INSERT INTO RATING
	VALUES (11,'2017-5-26',5,3,4,4,'X',2);
INSERT INTO RATING
	VALUES (12,'2017-5-27',1,3,4,2,'X',3);
INSERT INTO RATING
	VALUES (13,'2017-5-28',2,4,3,4,'X',4);
INSERT INTO RATING
	VALUES (14,'2017-6-1',2,1,2,2,'X',5);
INSERT INTO RATING
	VALUES (15,'2017-6-2',5,3,3,3,'X',6);
INSERT INTO RATING
	VALUES (1,'2017-6-3',5,3,1,2,'X',7);
INSERT INTO RATING
	VALUES (2,'2017-6-4',3,1,3,2,'X',8);
INSERT INTO RATING
	VALUES (3,'2017-6-5',5,5,2,5,'X',9);
INSERT INTO RATING
	VALUES (4,'2017-6-6',4,3,2,4,'X',10);
INSERT INTO RATING
	VALUES (5,'2017-6-7',2,3,1,2,'X',11);
INSERT INTO RATING
	VALUES (6,'2017-6-8',1,3,5,1,'X',12);
INSERT INTO RATING
	VALUES (7,'2017-6-9',3,3,4,1,'X',1);
INSERT INTO RATING
	VALUES (8,'2017-6-10',3,4,3,1,'X',2);
INSERT INTO RATING
	VALUES (9,'2017-6-11',1,2,1,5,'X',3);
INSERT INTO RATING
	VALUES (10,'2017-6-12',4,2,1,1,'X',4);
INSERT INTO RATING
	VALUES (11,'2017-6-13',2,1,4,2,'X',5);
INSERT INTO RATING
	VALUES (12,'2017-6-14',4,4,3,3,'X',6);
INSERT INTO RATING
	VALUES (13,'2017-6-15',4,3,1,2,'X',7);
INSERT INTO RATING
	VALUES (14,'2017-6-16',1,1,4,5,'X',8);
INSERT INTO RATING
	VALUES (15,'2017-6-17',2,5,2,5,'X',9);
INSERT INTO RATING
	VALUES (1,'2017-6-18',4,5,2,5,'X',10);
INSERT INTO RATING
	VALUES (2,'2017-6-19',4,4,5,5,'X',11);
INSERT INTO RATING
	VALUES (3,'2017-6-20',2,5,5,5,'X',12);
INSERT INTO RATING
	VALUES (4,'2017-6-21',3,2,2,2,'X',1);
INSERT INTO RATING
	VALUES (5,'2017-6-22',3,2,3,2,'X',2);
INSERT INTO RATING
	VALUES (6,'2017-6-23',5,4,4,2,'X',3);
INSERT INTO RATING
	VALUES (7,'2017-6-24',5,3,3,5,'X',4);
INSERT INTO RATING
	VALUES (8,'2017-6-25',5,5,1,5,'X',5);
INSERT INTO RATING
	VALUES (9,'2017-6-26',2,4,4,5,'X',6);
INSERT INTO RATING
	VALUES (10,'2017-6-27',3,4,3,4,'X',7);
INSERT INTO RATING
	VALUES (11,'2017-6-28',3,3,5,4,'X',8);
INSERT INTO RATING
	VALUES (12,'2017-7-1',2,3,3,3,'X',9);
INSERT INTO RATING
	VALUES (13,'2017-7-2',5,1,1,4,'X',10);
INSERT INTO RATING
	VALUES (14,'2017-7-3',4,2,3,1,'X',11);
INSERT INTO RATING
	VALUES (15,'2017-7-4',3,4,4,1,'X',12);
INSERT INTO RATING
	VALUES (1,'2017-7-5',4,4,3,3,'X',1);
INSERT INTO RATING
	VALUES (2,'2017-7-6',4,3,1,4,'X',2);
INSERT INTO RATING
	VALUES (3,'2017-7-7',3,3,1,2,'X',3);
INSERT INTO RATING
	VALUES (4,'2017-7-8',1,4,5,4,'X',4);
INSERT INTO RATING
	VALUES (5,'2017-7-9',3,3,2,3,'X',5);
INSERT INTO RATING
	VALUES (6,'2017-7-10',2,4,1,4,'X',6);
INSERT INTO RATING
	VALUES (7,'2017-7-11',5,2,4,2,'X',7);
INSERT INTO RATING
	VALUES (8,'2017-7-12',4,2,5,1,'X',8);
INSERT INTO RATING
	VALUES (9,'2017-7-13',4,1,2,1,'X',9);
INSERT INTO RATING
	VALUES (10,'2017-7-14',4,3,4,1,'X',10);
INSERT INTO RATING
	VALUES (11,'2017-7-15',2,2,4,2,'X',11);
INSERT INTO RATING
	VALUES (12,'2017-7-16',5,4,3,3,'X',12);
INSERT INTO RATING
	VALUES (13,'2017-7-17',3,1,4,3,'X',1);
INSERT INTO RATING
	VALUES (14,'2017-7-18',4,3,3,3,'X',2);
INSERT INTO RATING
	VALUES (15,'2017-7-19',5,4,5,3,'X',3);
INSERT INTO RATING
	VALUES (1,'2017-7-20',4,3,3,4,'X',4);
INSERT INTO RATING
	VALUES (2,'2017-7-21',4,5,2,2,'X',5);
INSERT INTO RATING
	VALUES (3,'2017-7-22',4,5,1,3,'X',6);
INSERT INTO RATING
	VALUES (4,'2017-7-23',4,5,4,3,'X',7);
INSERT INTO RATING
	VALUES (5,'2017-7-24',2,1,1,1,'X',8);
INSERT INTO RATING
	VALUES (6,'2017-7-25',3,4,3,2,'X',9);
INSERT INTO RATING
	VALUES (7,'2017-7-26',5,5,3,2,'X',10);
INSERT INTO RATING
	VALUES (8,'2017-7-27',1,4,5,3,'X',11);
INSERT INTO RATING
	VALUES (9,'2017-7-28',2,3,5,3,'X',12);
INSERT INTO RATING
	VALUES (10,'2017-8-1',5,3,5,3,'X',1);
INSERT INTO RATING
	VALUES (11,'2017-8-2',5,3,4,2,'X',2);
INSERT INTO RATING
	VALUES (12,'2017-8-3',2,3,3,3,'X',3);
INSERT INTO RATING
	VALUES (13,'2017-8-4',5,4,5,4,'X',4);
INSERT INTO RATING
	VALUES (14,'2017-8-5',1,1,3,3,'X',5);
INSERT INTO RATING
	VALUES (15,'2017-8-6',1,2,1,4,'X',6);
INSERT INTO RATING
	VALUES (1,'2017-8-7',3,5,2,4,'X',7);
INSERT INTO RATING
	VALUES (2,'2017-8-8',2,2,2,1,'X',8);
INSERT INTO RATING
	VALUES (3,'2017-8-9',3,1,3,1,'X',9);
INSERT INTO RATING
	VALUES (4,'2017-8-10',1,2,2,2,'X',10);
INSERT INTO RATING
	VALUES (5,'2017-8-11',1,5,3,2,'X',11);
INSERT INTO RATING
	VALUES (6,'2017-8-12',2,4,1,4,'X',12);

INSERT INTO LOCATION
	VALUES (1,'01/01/2016','John','613-111-1111-','1 Main St','10:00am','12:00am',1);
INSERT INTO LOCATION
	VALUES (2,'02/01/2016','James','613-222-2222-','12 Main St','7:00am','9:00pm',2);
INSERT INTO LOCATION
	VALUES (3,'03/01/2016','Judith','613-333-3333','123 Main St','10:00am','3:00am',3);
INSERT INTO LOCATION
	VALUES (4,'04/01/2016','Jeremy','613-444-4444','1234 Main St','10:00am','10:00pm',4);
INSERT INTO LOCATION
	VALUES (5,'05/01/2016','William','613-555-5555','1 Laurier St','10:00am','11:00pm',5);
INSERT INTO LOCATION
	VALUES (6,'06/01/2016','Cathy','613-667-6677','12 Laurier  St','6:00am','3:00pm',6);
INSERT INTO LOCATION
	VALUES (7,'07/01/2016','Janet','613-777-7777','123 Laurier St','3:00pm','9:00pm',7);
INSERT INTO LOCATION
	VALUES (8,'08/01/2016','Edward','613-888-8888','1234 Laurier St','10:00am','8:00pm',8);
INSERT INTO LOCATION
	VALUES (9,'09/01/2016','Colin','613-999-999','1 Lees St','10:00am','10:00pm',9);
INSERT INTO LOCATION
	VALUES (10,'10/01/2016','Robert','613-123-1234','12 Lees St','10:00am','10:00pm',10);
INSERT INTO LOCATION
	VALUES (11,'11/01/2016','Jasmine','613-234-5678-','123 Lees St','10:00am','8:00pm',11);
INSERT INTO LOCATION
	VALUES (12,'12/01/2016','Julia','613-345-6789','1234 Lees St','10:00am','10:00pm',12);

INSERT INTO MENUITEM
	VALUES (1,'Water','beverage','starter','Served ice cold',0.00,2);
INSERT INTO MENUITEM
	VALUES (2,'Coke','beverage','starter','Served ice cold',2.00,1);
INSERT INTO MENUITEM
	VALUES (3,'Pepsi','beverage','starter','Served ice cold',2.00,8);
INSERT INTO MENUITEM
	VALUES (4,'Beer','beverage','starter','Local craft pilsner',5.50,3);
INSERT INTO MENUITEM
	VALUES (5,'Wine','beverage','starter','2000 Vintage Pinot Noir',5.50,5);
INSERT INTO MENUITEM
	VALUES (6,'Caesar Salad','food','starter','Romaine lettuce, caesar dressing, croutons, bacon, grated cheese',5.00,12);
INSERT INTO MENUITEM
	VALUES (7,'Garden Salad','food','starter','Romaine lettuce, iceberg lettuce, house dressing, grape tomatoes, radishes, carrots, cucumbers',6.00,12);
INSERT INTO MENUITEM
	VALUES (8,'Onion rings','food','starter','Deep fried extra crispy jumbo rings',3.00,8);
INSERT INTO MENUITEM
	VALUES (9,'Bruschetta','food','starter','Baked baguette served with diced tomatoes, roasted garlic and olive oil',4.00,10);
INSERT INTO MENUITEM
	VALUES (10,'Cheese sticks','food','starter','Breaded mozzarella cheese',2.50,8);
INSERT INTO MENUITEM
	VALUES (11,'Nachos','food','starter','Served with peppers, olives, jalapenos, and monterey jack cheese',6.00,8);
INSERT INTO MENUITEM
	VALUES (12,'Seafood Chowder','food','starter','Shrimp, scallops, lobster, crab served in creamy white sauce',10.00,4);
INSERT INTO MENUITEM
	VALUES (13,'Lobster Roll','food','main','Peeled lobster claws served in warm bun',15.00,4);
INSERT INTO MENUITEM
	VALUES (14,'Ribs','food','main','Served with signature BBQ sauce',20.00,3);
INSERT INTO MENUITEM
	VALUES (15,'Wings','food','main','15 deep fried wings covered in honey garlic sauce',15.00,3);
INSERT INTO MENUITEM
	VALUES (16,'Chicken fingers','food','main','Crispy breaded chicken served with fries',17.38,8);
INSERT INTO MENUITEM
	VALUES (17,'Sauce and cheese pizza','food','main','Mozzarella and signature pizza sauce',8.50,1);
INSERT INTO MENUITEM
	VALUES (18,'Pepperoni pizza','food','main','Mozzarella, pepperoni, and signature pizza sauce ',9.50,1);
INSERT INTO MENUITEM
	VALUES (19,'Hawaiian pizza','food','main','Ham, pineapple, mozzarella, and signature pizza sauce',10.50,1);
INSERT INTO MENUITEM
	VALUES (20,'Canadian pizza','food','main','Bacon, mozzarella, mushrooms, pepperoni, and signature pizza sauce',11.50,1);
INSERT INTO MENUITEM
	VALUES (21,'Combination pizza','food','main','Green pepper, mozzarella, mushrooms, pepperoni, and signature pizza sauce',11.50,1);
INSERT INTO MENUITEM
	VALUES (22,'Filet mignon','food','main','Tender cut medium rare served with mashed potatoes and house salad',35.00,5);
INSERT INTO MENUITEM
	VALUES (23,'Rib steak','food','main','Bone in medium rare served with mashed potatoes and house salad',39.00,5);
INSERT INTO MENUITEM
	VALUES (24,'T-bone steak','food','main','Classic cut medium rare served with mashed potatoes and house salad',47.00,5);
INSERT INTO MENUITEM
	VALUES (25,'New York striploin','food','main','Thick cut served with mashed potatoes and house salad',37.00,5);
INSERT INTO MENUITEM
	VALUES (26,'Lobster','food','main','Full lobster served warm garlic butter and a side of coleslaw',30.00,4);
INSERT INTO MENUITEM
	VALUES (27,'Burger','food','main','Angus beef, tomato and lettuce',12.00,3);
INSERT INTO MENUITEM
	VALUES (28,'Pho','food','main','Rice noodle, fresh herbs, and chicken',8.75,9);
INSERT INTO MENUITEM
	VALUES (29,'Cruller','food','dessert','Light choux pastry covered with icing sugar',5.00,6);
INSERT INTO MENUITEM
	VALUES (30,'Jelly doughnut','food','dessert','Filled with strawberry jelly',2.50,6);
INSERT INTO MENUITEM
	VALUES (31,'Chocolate ice cream','food','dessert','Dark chocolate',4.00,7);
INSERT INTO MENUITEM
	VALUES (32,'Strawberry ice cream','food','dessert','Real strawberries',4.00,7);
INSERT INTO MENUITEM
	VALUES (33,'Chocolate cake','food','dessert','Layered chocolate cake and chocolate fudge',5.00,7);
INSERT INTO MENUITEM
	VALUES (34,'Carrot cake','food','dessert','Served with fresh whipped cream',5.00,7);
INSERT INTO MENUITEM
	VALUES (35,'Tiramisu','food','dessert','Rich coffee flavour',5.00,7);
INSERT INTO MENUITEM
	VALUES (36,'Boston cream doughnut','food','dessert','Chocolate covered with custard filling',5.00,6);
INSERT INTO MENUITEM
	VALUES (37,'Green tea','beverage','starter','Blended with lemongrass',2.00,2);
INSERT INTO MENUITEM
	VALUES (38,'Chai tea','beverage','starter','Blended with green tea',2.00,2);
INSERT INTO MENUITEM
	VALUES (39,'Watermelon bubble tea','beverage','starter','Pressed and served cold',4.00,2);
INSERT INTO MENUITEM
	VALUES (40,'Coffee','beverage','starter','Dark roast',3.00,6);
INSERT INTO MENUITEM
	VALUES (41,'Ramen','food','main','Wheat noodle, pork belly, seaweed, and green onions',10.50,9);
INSERT INTO MENUITEM
	VALUES (42,'Lasagna','food','main','7 layers topped with mozzarella cheese',15.25,10);
INSERT INTO MENUITEM
	VALUES (43,'Fettuccine Alfredo','food','main','Creamy alfredo sauce with choice of chicken or seafood',15.00,10);
INSERT INTO MENUITEM
	VALUES (44,'Chicken Kebab','food','main','Slow cooked authentic mediterranean kebab',7.00,11);
INSERT INTO MENUITEM
	VALUES (45,'Garlic Lemon Herb','food','main','Slow cooked chicken marinated in garlic, lemon, and fresh herbs served with baked potatoes',16.75,11);

INSERT INTO RATINGITEM
	VALUES (1,'2017-5-1',2,5,'X');
INSERT INTO RATINGITEM
	VALUES (2,'2017-5-2',1,4,'X');
INSERT INTO RATINGITEM
	VALUES (3,'2017-5-3',4,1,'X');
INSERT INTO RATINGITEM
	VALUES (4,'2017-5-4',12,2,'X');
INSERT INTO RATINGITEM
	VALUES (5,'2017-5-5',5,3,'X');
INSERT INTO RATINGITEM
	VALUES (6,'2017-5-6',29,2,'X');
INSERT INTO RATINGITEM
	VALUES (7,'2017-5-7',31,1,'X');
INSERT INTO RATINGITEM
	VALUES (8,'2017-5-8',3,2,'X');
INSERT INTO RATINGITEM
	VALUES (9,'2017-5-9',28,2,'X');
INSERT INTO RATINGITEM
	VALUES (10,'2017-5-10',9,1,'X');
INSERT INTO RATINGITEM
	VALUES (11,'2017-5-11',44,1,'X');
INSERT INTO RATINGITEM
	VALUES (12,'2017-5-12',6,5,'X');
INSERT INTO RATINGITEM
	VALUES (13,'2017-5-13',17,5,'X');
INSERT INTO RATINGITEM
	VALUES (14,'2017-5-14',37,1,'X');
INSERT INTO RATINGITEM
	VALUES (15,'2017-5-15',14,3,'X');
INSERT INTO RATINGITEM
	VALUES (1,'2017-5-16',13,1,'X');
INSERT INTO RATINGITEM
	VALUES (2,'2017-5-17',22,3,'X');
INSERT INTO RATINGITEM
	VALUES (3,'2017-5-18',30,3,'X');
INSERT INTO RATINGITEM
	VALUES (4,'2017-5-19',32,4,'X');
INSERT INTO RATINGITEM
	VALUES (5,'2017-5-20',8,3,'X');
INSERT INTO RATINGITEM
	VALUES (6,'2017-5-21',41,3,'X');
INSERT INTO RATINGITEM
	VALUES (7,'2017-5-22',42,4,'X');
INSERT INTO RATINGITEM
	VALUES (8,'2017-5-23',45,4,'X');
INSERT INTO RATINGITEM
	VALUES (9,'2017-5-24',7,5,'X');
INSERT INTO RATINGITEM
	VALUES (10,'2017-5-25',18,5,'X');
INSERT INTO RATINGITEM
	VALUES (11,'2017-5-26',38,5,'X');
INSERT INTO RATINGITEM
	VALUES (12,'2017-5-27',15,3,'X');
INSERT INTO RATINGITEM
	VALUES (13,'2017-5-28',26,4,'X');
INSERT INTO RATINGITEM
	VALUES (14,'2017-6-1',23,3,'X');
INSERT INTO RATINGITEM
	VALUES (15,'2017-6-2',36,1,'X');
INSERT INTO RATINGITEM
	VALUES (1,'2017-6-3',33,3,'X');
INSERT INTO RATINGITEM
	VALUES (2,'2017-6-4',10,1,'X');
INSERT INTO RATINGITEM
	VALUES (3,'2017-6-5',28,1,'X');
INSERT INTO RATINGITEM
	VALUES (4,'2017-6-6',43,5,'X');
INSERT INTO RATINGITEM
	VALUES (5,'2017-6-7',44,5,'X');
INSERT INTO RATINGITEM
	VALUES (6,'2017-6-8',6,3,'X');
INSERT INTO RATINGITEM
	VALUES (7,'2017-6-9',19,2,'X');
INSERT INTO RATINGITEM
	VALUES (8,'2017-6-10',39,3,'X');
INSERT INTO RATINGITEM
	VALUES (9,'2017-6-11',27,3,'X');
INSERT INTO RATINGITEM
	VALUES (10,'2017-6-12',12,4,'X');
INSERT INTO RATINGITEM
	VALUES (11,'2017-6-13',24,2,'X');
INSERT INTO RATINGITEM
	VALUES (12,'2017-6-14',40,3,'X');
INSERT INTO RATINGITEM
	VALUES (13,'2017-6-15',34,5,'X');
INSERT INTO RATINGITEM
	VALUES (14,'2017-6-16',11,5,'X');
INSERT INTO RATINGITEM
	VALUES (15,'2017-6-17',41,2,'X');
INSERT INTO RATINGITEM
	VALUES (1,'2017-6-18',9,3,'X');
INSERT INTO RATINGITEM
	VALUES (2,'2017-6-19',45,2,'X');
INSERT INTO RATINGITEM
	VALUES (3,'2017-6-20',7,4,'X');
INSERT INTO RATINGITEM
	VALUES (4,'2017-6-21',20,2,'X');
INSERT INTO RATINGITEM
	VALUES (5,'2017-6-22',1,3,'X');
INSERT INTO RATINGITEM
	VALUES (6,'2017-6-23',4,4,'X');
INSERT INTO RATINGITEM
	VALUES (7,'2017-6-24',13,2,'X');
INSERT INTO RATINGITEM
	VALUES (8,'2017-6-25',25,4,'X');
INSERT INTO RATINGITEM
	VALUES (9,'2017-6-26',29,4,'X');
INSERT INTO RATINGITEM
	VALUES (10,'2017-6-27',45,1,'X');
INSERT INTO RATINGITEM
	VALUES (11,'2017-6-28',16,3,'X');
INSERT INTO RATINGITEM
	VALUES (12,'2017-7-1',28,1,'X');
INSERT INTO RATINGITEM
	VALUES (13,'2017-7-2',42,3,'X');
INSERT INTO RATINGITEM
	VALUES (14,'2017-7-3',44,2,'X');
INSERT INTO RATINGITEM
	VALUES (15,'2017-7-4',6,1,'X');
INSERT INTO RATINGITEM
	VALUES (1,'2017-7-5',21,2,'X');
INSERT INTO RATINGITEM
	VALUES (2,'2017-7-6',37,4,'X');
INSERT INTO RATINGITEM
	VALUES (3,'2017-7-7',14,1,'X');
INSERT INTO RATINGITEM
	VALUES (4,'2017-7-8',26,3,'X');
INSERT INTO RATINGITEM
	VALUES (5,'2017-7-9',5,3,'X');
INSERT INTO RATINGITEM
	VALUES (6,'2017-7-10',30,5,'X');
INSERT INTO RATINGITEM
	VALUES (7,'2017-7-11',31,1,'X');
INSERT INTO RATINGITEM
	VALUES (8,'2017-7-12',3,2,'X');
INSERT INTO RATINGITEM
	VALUES (9,'2017-7-13',41,4,'X');
INSERT INTO RATINGITEM
	VALUES (10,'2017-7-14',43,5,'X');
INSERT INTO RATINGITEM
	VALUES (11,'2017-7-15',45,4,'X');
INSERT INTO RATINGITEM
	VALUES (12,'2017-7-16',7,2,'X');
INSERT INTO RATINGITEM
	VALUES (13,'2017-7-17',2,1,'X');
INSERT INTO RATINGITEM
	VALUES (14,'2017-7-18',38,2,'X');
INSERT INTO RATINGITEM
	VALUES (15,'2017-7-19',15,5,'X');
INSERT INTO RATINGITEM
	VALUES (1,'2017-7-20',12,5,'X');
INSERT INTO RATINGITEM
	VALUES (2,'2017-7-21',22,5,'X');
INSERT INTO RATINGITEM
	VALUES (3,'2017-7-22',36,2,'X');
INSERT INTO RATINGITEM
	VALUES (4,'2017-7-23',32,3,'X');
INSERT INTO RATINGITEM
	VALUES (5,'2017-7-24',8,2,'X');
INSERT INTO RATINGITEM
	VALUES (6,'2017-7-25',28,2,'X');
INSERT INTO RATINGITEM
	VALUES (7,'2017-7-26',9,2,'X');
INSERT INTO RATINGITEM
	VALUES (8,'2017-7-27',44,2,'X');
INSERT INTO RATINGITEM
	VALUES (9,'2017-7-28',6,5,'X');
INSERT INTO RATINGITEM
	VALUES (10,'2017-8-1',17,5,'X');
INSERT INTO RATINGITEM
	VALUES (11,'2017-8-2',39,5,'X');
INSERT INTO RATINGITEM
	VALUES (12,'2017-8-3',27,4,'X');
INSERT INTO RATINGITEM
	VALUES (13,'2017-8-4',13,5,'X');
INSERT INTO RATINGITEM
	VALUES (14,'2017-8-5',23,5,'X');
INSERT INTO RATINGITEM
	VALUES (15,'2017-8-6',40,4,'X');
INSERT INTO RATINGITEM
	VALUES (1,'2017-8-7',33,3,'X');
INSERT INTO RATINGITEM
	VALUES (2,'2017-8-8',10,2,'X');
INSERT INTO RATINGITEM
	VALUES (3,'2017-8-9',41,1,'X');
INSERT INTO RATINGITEM
	VALUES (4,'2017-8-10',42,5,'X');
INSERT INTO RATINGITEM
	VALUES (5,'2017-8-11',45,1,'X');
INSERT INTO RATINGITEM
	VALUES (6,'2017-8-12',7,1,'X');

/*
	Restaurents and menus
*/
/*
	a
	Display all the information about a user‐specified restaurant. That is, the user should select the
	name of the restaurant from a list, and the information as contained in the restaurant and
	location tables should then displayed on the screen.
*/
SELECT restaurant.name, restaurant.type, restaurant.url, location.firstopendate, location.managername, location.phonenumber, location.streetaddress, location.houropen, location.hourclose
FROM RESTAURANT
INNER JOIN LOCATION ON RESTAURANT.RestaurantID = LOCATION.RestaurantID;
/*
	b
	Display the full menu of a specific restaurant. That is, the user should select the name of the
	restaurant from a list, and all menu items, together with their prices, should be displayed on the
	screen. The menu should be displayed based on menu item categories.
	***** Note the restaurant.restaurantid must be able to change cause it is used as selection
	***** or can use restaurant.name = ' '
*/
SELECT menuitem.name, menuitem.type, menuitem.category, menuitem.description
FROM menuitem
INNER JOIN restaurant ON menuitem.restaurantid = restaurant.restaurantid
WHERE restaurant.name = 'Ottawa Pizza House'
ORDER BY menuitem.category DESC;
/*
	c
	For each user‐specified category of restaurant, list the manager names together with the date
	that the locations have opened. The user should be able to select the category (e.g. Italian or
	Thai) from a list.
	***** restaurant.type variable from webpage
*/
SELECT restaurant.name, location.managername, location.firstopendate
FROM location
INNER JOIN restaurant ON location.restaurantid = restaurant.restaurantid
WHERE restaurant.type = 'italian';
/*
	d
	Given a user‐specified restaurant, find the name of the most expensive menu item. List this
	information together with the name of manager, the opening hours, and the URL of the
	restaurant. The user should be able to select the restaurant name (e.g. El Camino) from a list.
	****could change the data so that there is only one most expensive item
*/
/*
SELECT MenuItem.*, Location.Managername, Location.Houropen, Location.Hourclose, Restaurant.URL
FROM Restaurant Restaurant 
	JOIN MenuItem MenuItem 
		ON Restaurant.RestaurantID = MenuItem.RestaurantID 
	JOIN Location Location 
		ON Restaurant.RestaurantID = Location.RestaurantID
GROUP BY(MenuItem.ItemID, Location.Managername,Location.Houropen, Location.Hourclose,Restaurant.URL,Restaurant.Name)
HAVING Restaurant.Name  = 'Name' 
	AND MenuItem.Price = MAX(MenuItem.price) 
;
*/
/*
SELECT MAX(menuitem.price),menuitem.name, MAX(location.managername), MAX(location.houropen), MAX(restaurant.url)
FROM menuitem
INNER JOIN restaurant ON menuitem.restaurantid = restaurant.restaurantid
INNER JOIN location ON location.restaurantid = restaurant.restaurantid
WHERE restaurant.name = 'Ottawa Pizza House'
GROUP BY
*/
/*
SELECT menuitem.name, pmax, location.managername, location.houropen, restaurant.url
FROM (	SELECT restaurant.name, MAX(menuitem.price) AS pmax
	FROM menuitem
	JOIN restaurant ON restaurant.restaurantid = menuitem.restaurantid
	WHERE restaurant.name = 'Ottawa Pizza House'
	GROUP BY 1
	) AS tpmax
JOIN menuitem ON menuitem.restaurantid = restaurant.restaurantid 
JOIN location ON restaurant.restaurantid = location.restaurantid
WHERE restaurant.name = 'Ottawa Pizza House';
*/
/*
SELECT menuitem.name, location.managername, location.houropen, restaurant.url
FROM menuitem
JOIN restaurant ON menuitem.restaurantid = restaurant.restaurantid
JOIN location ON restaurant.restaurantid = location.restaurantid
WHERE restaurant.name = 'Ottawa Pizza House' AND menuitem.price = (	SELECT MAX(menuitem.price)
								FROM menuitem
								GROUP BY menuitem.restaurantid);
*/
SELECT menuitem.name, location.managername, location.houropen, restaurant.url
FROM menuitem
JOIN restaurant ON menuitem.restaurantid = restaurant.restaurantid
JOIN location ON restaurant.restaurantid = location.restaurantid
WHERE menuitem.price IN (
	SELECT MAX(menuitem.price)
	FROM menuitem
	JOIN restaurant ON menuitem.restaurantid = restaurant.restaurantid
	WHERE restaurant.name = 'Ottawa Pizza House'
	GROUP BY menuitem.restaurantid);
/*
	e
	For each type of restaurant (e.g. Indian or Irish) and the category of menu item (appetiser, main
	or desert), list the average prices of menu items for each category.
*/
SELECT restaurant.type, menuitem.category, CAST(AVG(CAST(menuitem.price AS decimal)) AS money)
FROM menuitem
JOIN restaurant ON menuitem.restaurantid = restaurant.restaurantid
WHERE restaurant.type = 'italian' AND menuitem.category = 'dessert'
GROUP BY 1, 2;
/*
	Ratings of restaurants
*/
/*
	f
	Find the total number of rating for each restaurant, for each rater. That is, the data should be
	grouped by the restaurant, the specific raters and the numeric ratings they have received.
*/
/*
SELECT restaurant.name, rater.name, rating.price, rating.food, rating.mood, rating.staff
FROM rating
*/
/*
	g
	Display the details of the restaurants that have not been rated in January 2015. That is, you should display the name of the 
	restaurant together with the phone number and the type of food.
	*** does every rating that is not in 2015 so 88 occurences
*/
SELECT restaurant.name, location.phonenumber, restaurant.type
FROM restaurant
JOIN location ON location.restaurantid = restaurant.restaurantid
JOIN rating ON restaurant.restaurantid = rating.restaurantid
WHERE rating.date NOT BETWEEN '2015-01-01' AND '2015-12-31'
/*
	h
	Find the names and opening dates of the restaurants that obtained Staff rating that is lower
	than any rating given by rater X. Order your results by the dates of the ratings. (Here, X refers to
	any rater of your choice.)
*/
SELECT restaurant.name, location.firstopendate
FROM restaurant
JOIN location ON location.restaurantid = restaurant.restaurantid
JOIN rating ON rating.restaurantid = restaurant.restaurantid
WHERE rating.staff < (
			SELECT MIN(mintable.submin)
			FROM (
				SELECT rating.userid,
				       CASE WHEN rating.price < rating.food AND rating.price < rating.mood AND rating.price < rating.staff THEN rating.price
					    WHEN rating.food < rating.price AND rating.food < rating.mood AND rating.food < rating.staff THEN rating.food
					    WHEN rating.mood < rating.price AND rating.mood < rating.food AND rating.mood < rating.staff THEN rating.mood
					    ELSE rating.staff
				       END AS submin
				From rating
				JOIN rater ON rating.userid = rater.userid
				WHERE rater.name = 'Big Joe') AS mintable);
/*
	i
	List the details of the Type Y restaurants that obtained the highest Food rating. Display the
	restaurant name together with the name(s) of the rater(s) who gave these ratings. (Here, Type Y refers to any 
	restaurant type of your choice, e.g. Indian or Burger.)
*/
SELECT restaurant.name, rater.name
FROM (	SELECT restaurant.restaurantid, MAX(rating.food)
	FROM rating, restaurant
	GROUP BY restaurant.restaurantid) AS tmp, rating
JOIN restaurant ON restaurant.restaurantid = rating.restaurantid
JOIN rater ON rater.userid = rating.userid
WHERE restaurant.type = 'italian' AND tmp.restaurantid = restaurant.restaurantid;
/*
	j
	Provide a query to determine whether Type Y restaurants are “more popular” than other restaurants. 
	(Here, Type Y refers to any restaurant type of your choice, e.g. Indian or Burger.) Yes, this query 
	is open to your own interpretation!
	*****My interpretaion is the restaurants with the highest mood ratings
*/
SELECT restaurant.name, rater.name
FROM (	SELECT restaurant.restaurantid, MAX(rating.mood)
	FROM rating, restaurant
	GROUP BY restaurant.restaurantid) AS tmp, rating
JOIN restaurant ON restaurant.restaurantid = rating.restaurantid
JOIN rater ON rater.userid = rating.userid
WHERE restaurant.type = 'italian' AND tmp.restaurantid = restaurant.restaurantid;
/*
	Raters and their ratings
*/
/*
	k
	Find the names, join‐date and reputations of the raters that give the highest overall rating, in
	terms of the Food and the Mood of restaurants. Display this information together with the
	names of the restaurant and the dates the ratings were done.
	*****Im going to keep this easy by giving two tables, one giving the top food avg and the other the top mood avg
*/
SELECT rater.name, rater.joindate, rater.reputation, restaurant.name, rating.date
FROM rating
JOIN rater ON rating.userid = rater.userid
JOIN restaurant ON rating.userid = restaurant.restaurantid
WHERE 


SELECT 
SELECT MAX(tablefoodavg.foodavg)
FROM	(SELECT rating.userid, AVG(rating.food) AS foodavg
	FROM rating
	GROUP BY rating.userid
	ORDER BY foodavg DESC) AS tablefoodavg

SELECT `id` 
FROM `mytable` 
WHERE (`group_id`, `time`) IN (
  SELECT `group_id`, MAX(`time`) as `time` 
  FROM `mytable`
  GROUP BY `group_id`
)