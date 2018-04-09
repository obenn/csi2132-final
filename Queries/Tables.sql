SET search_path = "restaurants";

CREATE TABLE RATER 
(
	UserID INTEGER PRIMARY KEY,
	Email VARCHAR,
	Name VARCHAR,
	JoinDate DATE,
	Type VARCHAR CHECK (type='blog' OR type='online' OR type='food critic'), 
	Reputation INTEGER CHECK (Reputation>=1 AND Reputation<=5) DEFAULT 1
);

CREATE TABLE RESTAURANT
(
	RestaurantID INTEGER PRIMARY KEY,
	Name VARCHAR,
	Type VARCHAR,
	URL VARCHAR
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
VALUES (1,'2017-5-1',3,4,1,2,'I got to meet the owner',1);
INSERT INTO RATING
VALUES (2,'2017-5-2',2,4,5,2,'Restaurant has no windows',2);
INSERT INTO RATING
VALUES (3,'2017-5-3',3,2,1,4,'They should add cheese even if cheese is not an ingredient',3);
INSERT INTO RATING
VALUES (4,'2017-5-4',5,3,1,5,'This place is da bomb',4);
INSERT INTO RATING
VALUES (5,'2017-5-5',1,4,5,2,'Such exotic flavours. Such wow.',5);
INSERT INTO RATING
VALUES (6,'2017-5-6',4,2,4,1,'I like food. They have it here.',6);
INSERT INTO RATING
VALUES (7,'2017-5-7',2,3,3,4,'This place is BAWLIN yo',7);
INSERT INTO RATING
VALUES (8,'2017-5-8',4,3,5,1,'There was chickens next to the patio',8);
INSERT INTO RATING
VALUES (9,'2017-5-9',1,1,3,5,'There werent enough ice cubes in my drink',9);
INSERT INTO RATING
VALUES (10,'2017-5-10',2,1,4,2,'They ran out of water',10);
INSERT INTO RATING
VALUES (11,'2017-5-11',5,5,1,4,'The cutlery was so amazing',11);
INSERT INTO RATING
VALUES (12,'2017-5-12',3,3,2,4,'More food please',12);
INSERT INTO RATING
VALUES (13,'2017-5-13',1,3,2,3,'Hint of smoke in the air',1);
INSERT INTO RATING
VALUES (14,'2017-5-14',2,3,2,5,'Fantastic!',2);
INSERT INTO RATING
VALUES (15,'2017-5-15',3,3,4,2,'Finger licking good',3);
INSERT INTO RATING
VALUES (1,'2017-5-16',1,5,2,2,'Great',4);
INSERT INTO RATING
VALUES (2,'2017-5-17',1,2,5,3,'Scrumptious',5);
INSERT INTO RATING
VALUES (3,'2017-5-18',1,5,3,2,'Limited parking',6);
INSERT INTO RATING
VALUES (4,'2017-5-19',2,3,1,2,'Everything is awesome',7);
INSERT INTO RATING
VALUES (5,'2017-5-20',3,5,5,1,'I got to meet the owner',8);
INSERT INTO RATING
VALUES (6,'2017-5-21',2,2,1,2,'Restaurant has no windows',9);
INSERT INTO RATING
VALUES (7,'2017-5-22',1,5,2,1,'They should add cheese even if cheese is not an ingredient',10);
INSERT INTO RATING
VALUES (8,'2017-5-23',4,3,4,4,'This place is da bomb',11);
INSERT INTO RATING
VALUES (9,'2017-5-24',2,1,1,1,'Such exotic flavours. Such wow.',12);
INSERT INTO RATING
VALUES (10,'2017-5-25',1,5,2,2,'I like food. They have it here.',1);
INSERT INTO RATING
VALUES (11,'2017-5-26',3,3,1,3,'This place is BAWLIN yo',2);
INSERT INTO RATING
VALUES (12,'2017-5-27',2,4,2,3,'There was chickens next to the patio',3);
INSERT INTO RATING
VALUES (13,'2017-5-28',5,4,1,3,'There werent enough ice cubes in my drink',4);
INSERT INTO RATING
VALUES (14,'2017-6-1',1,3,5,5,'They ran out of water',5);
INSERT INTO RATING
VALUES (15,'2017-6-2',3,2,4,2,'The cutlery was so amazing',6);
INSERT INTO RATING
VALUES (1,'2017-6-3',5,2,1,5,'More food please',7);
INSERT INTO RATING
VALUES (2,'2017-6-4',5,5,3,4,'Hint of smoke in the air',8);
INSERT INTO RATING
VALUES (3,'2017-6-5',3,1,1,4,'Fantastic!',9);
INSERT INTO RATING
VALUES (4,'2017-6-6',5,1,5,1,'Finger licking good',10);
INSERT INTO RATING
VALUES (5,'2017-6-7',4,1,4,2,'Great',11);
INSERT INTO RATING
VALUES (6,'2017-6-8',4,2,5,2,'Scrumptious',12);
INSERT INTO RATING
VALUES (7,'2017-6-9',5,1,3,1,'Limited parking',1);
INSERT INTO RATING
VALUES (8,'2017-6-10',1,3,1,5,'Everything is awesome',2);
INSERT INTO RATING
VALUES (9,'2017-6-11',4,1,3,4,'I got to meet the owner',3);
INSERT INTO RATING
VALUES (10,'2017-6-12',4,3,1,4,'Restaurant has no windows',4);
INSERT INTO RATING
VALUES (11,'2017-6-13',5,1,4,4,'They should add cheese even if cheese is not an ingredient',5);
INSERT INTO RATING
VALUES (12,'2017-6-14',3,4,1,2,'This place is da bomb',6);
INSERT INTO RATING
VALUES (13,'2017-6-15',2,5,3,2,'Such exotic flavours. Such wow.',7);
INSERT INTO RATING
VALUES (14,'2017-6-16',5,2,4,5,'I like food. They have it here.',8);
INSERT INTO RATING
VALUES (15,'2017-6-17',1,4,3,2,'This place is BAWLIN yo',9);
INSERT INTO RATING
VALUES (1,'2017-6-18',3,4,3,1,'There was chickens next to the patio',10);
INSERT INTO RATING
VALUES (2,'2017-6-19',3,1,4,2,'There werent enough ice cubes in my drink',11);
INSERT INTO RATING
VALUES (3,'2017-6-20',4,1,4,1,'They ran out of water',12);
INSERT INTO RATING
VALUES (4,'2017-6-21',1,5,4,3,'The cutlery was so amazing',1);
INSERT INTO RATING
VALUES (5,'2017-6-22',1,2,5,1,'More food please',2);
INSERT INTO RATING
VALUES (6,'2017-6-23',1,2,4,1,'Hint of smoke in the air',3);
INSERT INTO RATING
VALUES (7,'2017-6-24',1,3,3,2,'Fantastic!',4);
INSERT INTO RATING
VALUES (8,'2017-6-25',2,1,5,1,'Finger licking good',5);
INSERT INTO RATING
VALUES (9,'2017-6-26',4,2,4,3,'Great',6);
INSERT INTO RATING
VALUES (10,'2017-6-27',1,2,3,3,'Scrumptious',7);
INSERT INTO RATING
VALUES (11,'2017-6-28',2,4,2,1,'Limited parking',8);
INSERT INTO RATING
VALUES (12,'2017-7-1',3,1,1,4,'Everything is awesome',9);
INSERT INTO RATING
VALUES (13,'2017-7-2',5,4,3,2,'I got to meet the owner',10);
INSERT INTO RATING
VALUES (14,'2017-7-3',4,4,3,3,'Restaurant has no windows',11);
INSERT INTO RATING
VALUES (15,'2017-7-4',2,4,5,3,'They should add cheese even if cheese is not an ingredient',12);
INSERT INTO RATING
VALUES (1,'2017-7-5',5,2,1,5,'This place is da bomb',1);
INSERT INTO RATING
VALUES (2,'2017-7-6',2,2,2,4,'Such exotic flavours. Such wow.',2);
INSERT INTO RATING
VALUES (3,'2017-7-7',2,5,2,5,'I like food. They have it here.',3);
INSERT INTO RATING
VALUES (4,'2017-7-8',4,4,5,2,'This place is BAWLIN yo',4);
INSERT INTO RATING
VALUES (5,'2017-7-9',4,5,3,5,'There was chickens next to the patio',5);
INSERT INTO RATING
VALUES (6,'2017-7-10',2,1,5,2,'There werent enough ice cubes in my drink',6);
INSERT INTO RATING
VALUES (7,'2017-7-11',4,1,5,5,'They ran out of water',7);
INSERT INTO RATING
VALUES (8,'2017-7-12',1,3,1,2,'The cutlery was so amazing',8);
INSERT INTO RATING
VALUES (9,'2017-7-13',1,4,4,2,'More food please',9);
INSERT INTO RATING
VALUES (10,'2017-7-14',5,5,2,3,'Hint of smoke in the air',10);
INSERT INTO RATING
VALUES (11,'2017-7-15',1,5,4,4,'Fantastic!',11);
INSERT INTO RATING
VALUES (12,'2017-7-16',1,2,1,4,'Finger licking good',12);
INSERT INTO RATING
VALUES (13,'2017-7-17',2,5,1,2,'Great',1);
INSERT INTO RATING
VALUES (14,'2017-7-18',3,4,4,2,'Scrumptious',2);
INSERT INTO RATING
VALUES (15,'2017-7-19',5,4,2,5,'Limited parking',3);
INSERT INTO RATING
VALUES (1,'2017-7-20',4,1,2,4,'Everything is awesome',4);
INSERT INTO RATING
VALUES (2,'2017-7-21',3,1,2,2,'I got to meet the owner',5);
INSERT INTO RATING
VALUES (3,'2017-7-22',5,3,2,2,'Restaurant has no windows',6);
INSERT INTO RATING
VALUES (4,'2017-7-23',5,1,3,3,'They should add cheese even if cheese is not an ingredient',7);
INSERT INTO RATING
VALUES (5,'2017-7-24',4,5,4,3,'This place is da bomb',8);
INSERT INTO RATING
VALUES (6,'2017-7-25',3,3,1,1,'Such exotic flavours. Such wow.',9);
INSERT INTO RATING
VALUES (7,'2017-7-26',2,4,1,5,'I like food. They have it here.',10);
INSERT INTO RATING
VALUES (8,'2017-7-27',4,5,4,3,'This place is BAWLIN yo',11);
INSERT INTO RATING
VALUES (9,'2017-7-28',5,3,2,4,'There was chickens next to the patio',12);
INSERT INTO RATING
VALUES (10,'2017-8-1',5,3,1,5,'There werent enough ice cubes in my drink',1);
INSERT INTO RATING
VALUES (11,'2017-8-2',2,5,1,4,'They ran out of water',2);
INSERT INTO RATING
VALUES (12,'2017-8-3',5,3,5,5,'The cutlery was so amazing',3);
INSERT INTO RATING
VALUES (13,'2017-8-4',3,1,3,3,'More food please',4);
INSERT INTO RATING
VALUES (14,'2017-8-5',2,1,1,4,'Hint of smoke in the air',5);
INSERT INTO RATING
VALUES (15,'2017-8-6',2,5,2,3,'Fantastic!',6);
INSERT INTO RATING
VALUES (1,'2017-8-7',1,1,1,4,'Finger licking good',7);
INSERT INTO RATING
VALUES (2,'2017-8-8',5,5,2,5,'Great',8);
INSERT INTO RATING
VALUES (3,'2017-8-9',2,2,5,5,'Scrumptious',9);
INSERT INTO RATING
VALUES (4,'2017-8-10',5,1,2,2,'Limited parking',10);
INSERT INTO RATING
VALUES (5,'2017-8-11',5,3,1,3,'Everything is awesome',11);
INSERT INTO RATING
VALUES (6,'2017-8-12',5,2,3,3,'I got to meet the owner',12);

INSERT INTO LOCATION
	VALUES (1,'01/01/2016','John','613-111-1111','1 Main St','10:00am','12:00am',1);
INSERT INTO LOCATION
	VALUES (2,'02/01/2016','James','613-222-2222','12 Main St','7:00am','9:00pm',2);
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
	VALUES (9,'09/01/2016','Colin','613-999-9999','1 Lees St','10:00am','10:00pm',9);
INSERT INTO LOCATION
	VALUES (10,'10/01/2016','Robert','613-123-1234','12 Lees St','10:00am','10:00pm',10);
INSERT INTO LOCATION
	VALUES (11,'11/01/2016','Jasmine','613-234-5678','123 Lees St','10:00am','8:00pm',11);
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
VALUES (1,'2017-5-1',2,3,'I got to meet the owner');
INSERT INTO RATINGITEM
VALUES (2,'2017-5-2',1,2,'Restaurant has no windows');
INSERT INTO RATINGITEM
VALUES (3,'2017-5-3',4,3,'They should add cheese even if cheese is not an ingredient');
INSERT INTO RATINGITEM
VALUES (4,'2017-5-4',12,5,'This place is da bomb');
INSERT INTO RATINGITEM
VALUES (5,'2017-5-5',5,4,'Such exotic flavours. Such wow.');
INSERT INTO RATINGITEM
VALUES (6,'2017-5-6',29,4,'I like food. They have it here.');
INSERT INTO RATINGITEM
VALUES (7,'2017-5-7',31,4,'This place is BAWLIN yo');
INSERT INTO RATINGITEM
VALUES (8,'2017-5-8',3,5,'There was chickens next to the patio');
INSERT INTO RATINGITEM
VALUES (9,'2017-5-9',28,4,'There werent enough ice cubes in my drink');
INSERT INTO RATINGITEM
VALUES (10,'2017-5-10',9,2,'They ran out of water');
INSERT INTO RATINGITEM
VALUES (11,'2017-5-11',44,1,'The cutlery was so amazing');
INSERT INTO RATINGITEM
VALUES (12,'2017-5-12',6,2,'More food please');
INSERT INTO RATINGITEM
VALUES (13,'2017-5-13',17,3,'Hint of smoke in the air');
INSERT INTO RATINGITEM
VALUES (14,'2017-5-14',37,2,'Fantastic!');
INSERT INTO RATINGITEM
VALUES (15,'2017-5-15',14,4,'Finger licking good');
INSERT INTO RATINGITEM
VALUES (1,'2017-5-16',13,5,'Great');
INSERT INTO RATINGITEM
VALUES (2,'2017-5-17',22,4,'Scrumptious');
INSERT INTO RATINGITEM
VALUES (3,'2017-5-18',30,4,'Limited parking');
INSERT INTO RATINGITEM
VALUES (4,'2017-5-19',32,1,'Everything is awesome');
INSERT INTO RATINGITEM
VALUES (5,'2017-5-20',8,4,'I got to meet the owner');
INSERT INTO RATINGITEM
VALUES (6,'2017-5-21',41,4,'Restaurant has no windows');
INSERT INTO RATINGITEM
VALUES (7,'2017-5-22',42,4,'They should add cheese even if cheese is not an ingredient');
INSERT INTO RATINGITEM
VALUES (8,'2017-5-23',45,1,'This place is da bomb');
INSERT INTO RATINGITEM
VALUES (9,'2017-5-24',7,5,'Such exotic flavours. Such wow.');
INSERT INTO RATINGITEM
VALUES (10,'2017-5-25',18,3,'I like food. They have it here.');
INSERT INTO RATINGITEM
VALUES (11,'2017-5-26',38,4,'This place is BAWLIN yo');
INSERT INTO RATINGITEM
VALUES (12,'2017-5-27',15,5,'There was chickens next to the patio');
INSERT INTO RATINGITEM
VALUES (13,'2017-5-28',26,1,'There werent enough ice cubes in my drink');
INSERT INTO RATINGITEM
VALUES (14,'2017-6-1',23,2,'They ran out of water');
INSERT INTO RATINGITEM
VALUES (15,'2017-6-2',36,2,'The cutlery was so amazing');
INSERT INTO RATINGITEM
VALUES (1,'2017-6-3',33,3,'More food please');
INSERT INTO RATINGITEM
VALUES (2,'2017-6-4',10,5,'Hint of smoke in the air');
INSERT INTO RATINGITEM
VALUES (3,'2017-6-5',28,4,'Fantastic!');
INSERT INTO RATINGITEM
VALUES (4,'2017-6-6',43,3,'Finger licking good');
INSERT INTO RATINGITEM
VALUES (5,'2017-6-7',44,2,'Great');
INSERT INTO RATINGITEM
VALUES (6,'2017-6-8',6,1,'Scrumptious');
INSERT INTO RATINGITEM
VALUES (7,'2017-6-9',19,5,'Limited parking');
INSERT INTO RATINGITEM
VALUES (8,'2017-6-10',39,3,'Everything is awesome');
INSERT INTO RATINGITEM
VALUES (9,'2017-6-11',27,3,'I got to meet the owner');
INSERT INTO RATINGITEM
VALUES (10,'2017-6-12',12,2,'Restaurant has no windows');
INSERT INTO RATINGITEM
VALUES (11,'2017-6-13',24,5,'They should add cheese even if cheese is not an ingredient');
INSERT INTO RATINGITEM
VALUES (12,'2017-6-14',40,5,'This place is da bomb');
INSERT INTO RATINGITEM
VALUES (13,'2017-6-15',34,1,'Such exotic flavours. Such wow.');
INSERT INTO RATINGITEM
VALUES (14,'2017-6-16',11,2,'I like food. They have it here.');
INSERT INTO RATINGITEM
VALUES (15,'2017-6-17',41,5,'This place is BAWLIN yo');
INSERT INTO RATINGITEM
VALUES (1,'2017-6-18',9,5,'There was chickens next to the patio');
INSERT INTO RATINGITEM
VALUES (2,'2017-6-19',45,4,'There werent enough ice cubes in my drink');
INSERT INTO RATINGITEM
VALUES (3,'2017-6-20',7,4,'They ran out of water');
INSERT INTO RATINGITEM
VALUES (4,'2017-6-21',20,3,'The cutlery was so amazing');
INSERT INTO RATINGITEM
VALUES (5,'2017-6-22',1,3,'More food please');
INSERT INTO RATINGITEM
VALUES (6,'2017-6-23',4,5,'Hint of smoke in the air');
INSERT INTO RATINGITEM
VALUES (7,'2017-6-24',13,2,'Fantastic!');
INSERT INTO RATINGITEM
VALUES (8,'2017-6-25',25,2,'Finger licking good');
INSERT INTO RATINGITEM
VALUES (9,'2017-6-26',29,2,'Great');
INSERT INTO RATINGITEM
VALUES (10,'2017-6-27',45,2,'Scrumptious');
INSERT INTO RATINGITEM
VALUES (11,'2017-6-28',16,4,'Limited parking');
INSERT INTO RATINGITEM
VALUES (12,'2017-7-1',28,2,'Everything is awesome');
INSERT INTO RATINGITEM
VALUES (13,'2017-7-2',42,1,'I got to meet the owner');
INSERT INTO RATINGITEM
VALUES (14,'2017-7-3',44,5,'Restaurant has no windows');
INSERT INTO RATINGITEM
VALUES (15,'2017-7-4',6,2,'They should add cheese even if cheese is not an ingredient');
INSERT INTO RATINGITEM
VALUES (1,'2017-7-5',21,3,'This place is da bomb');
INSERT INTO RATINGITEM
VALUES (2,'2017-7-6',37,4,'Such exotic flavours. Such wow.');
INSERT INTO RATINGITEM
VALUES (3,'2017-7-7',14,5,'I like food. They have it here.');
INSERT INTO RATINGITEM
VALUES (4,'2017-7-8',26,5,'This place is BAWLIN yo');
INSERT INTO RATINGITEM
VALUES (5,'2017-7-9',5,2,'There was chickens next to the patio');
INSERT INTO RATINGITEM
VALUES (6,'2017-7-10',30,1,'There werent enough ice cubes in my drink');
INSERT INTO RATINGITEM
VALUES (7,'2017-7-11',31,2,'They ran out of water');
INSERT INTO RATINGITEM
VALUES (8,'2017-7-12',3,3,'The cutlery was so amazing');
INSERT INTO RATINGITEM
VALUES (9,'2017-7-13',41,1,'More food please');
INSERT INTO RATINGITEM
VALUES (10,'2017-7-14',43,1,'Hint of smoke in the air');
INSERT INTO RATINGITEM
VALUES (11,'2017-7-15',45,1,'Fantastic!');
INSERT INTO RATINGITEM
VALUES (12,'2017-7-16',7,3,'Finger licking good');
INSERT INTO RATINGITEM
VALUES (13,'2017-7-17',2,2,'Great');
INSERT INTO RATINGITEM
VALUES (14,'2017-7-18',38,5,'Scrumptious');
INSERT INTO RATINGITEM
VALUES (15,'2017-7-19',15,2,'Limited parking');
INSERT INTO RATINGITEM
VALUES (1,'2017-7-20',12,1,'Everything is awesome');
INSERT INTO RATINGITEM
VALUES (2,'2017-7-21',22,3,'I got to meet the owner');
INSERT INTO RATINGITEM
VALUES (3,'2017-7-22',36,4,'Restaurant has no windows');
INSERT INTO RATINGITEM
VALUES (4,'2017-7-23',32,5,'They should add cheese even if cheese is not an ingredient');
INSERT INTO RATINGITEM
VALUES (5,'2017-7-24',8,3,'This place is da bomb');
INSERT INTO RATINGITEM
VALUES (6,'2017-7-25',28,4,'Such exotic flavours. Such wow.');
INSERT INTO RATINGITEM
VALUES (7,'2017-7-26',9,4,'I like food. They have it here.');
INSERT INTO RATINGITEM
VALUES (8,'2017-7-27',44,2,'This place is BAWLIN yo');
INSERT INTO RATINGITEM
VALUES (9,'2017-7-28',6,5,'There was chickens next to the patio');
INSERT INTO RATINGITEM
VALUES (10,'2017-8-1',17,5,'There werent enough ice cubes in my drink');
INSERT INTO RATINGITEM
VALUES (11,'2017-8-2',39,1,'They ran out of water');
INSERT INTO RATINGITEM
VALUES (12,'2017-8-3',27,3,'The cutlery was so amazing');
INSERT INTO RATINGITEM
VALUES (13,'2017-8-4',13,1,'More food please');
INSERT INTO RATINGITEM
VALUES (14,'2017-8-5',23,1,'Hint of smoke in the air');
INSERT INTO RATINGITEM
VALUES (15,'2017-8-6',40,2,'Fantastic!');
INSERT INTO RATINGITEM
VALUES (1,'2017-8-7',33,2,'Finger licking good');
INSERT INTO RATINGITEM
VALUES (2,'2017-8-8',10,5,'Great');
INSERT INTO RATINGITEM
VALUES (3,'2017-8-9',41,5,'Scrumptious');
INSERT INTO RATINGITEM
VALUES (4,'2017-8-10',42,2,'Limited parking');
INSERT INTO RATINGITEM
VALUES (5,'2017-8-11',45,1,'Everything is awesome');
INSERT INTO RATINGITEM
VALUES (6,'2017-8-12',7,3,'I got to meet the owner');