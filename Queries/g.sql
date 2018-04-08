/*
	g
	Display the details of the restaurants that have not been rated in January 2015. That is, you should display the name of the 
	restaurant together with the phone number and the type of food.
  Good
*/
/*
SELECT restaurant.name, location.phonenumber, restaurant.type
FROM restaurant
JOIN location ON location.restaurantid = restaurant.restaurantid
JOIN rating ON restaurant.restaurantid = rating.restaurantid
WHERE rating.date NOT BETWEEN '2015-01-01' AND '2015-12-31'

SELECT restaurant.name, location.phonenumber, restaurant.type
FROM location, restaurant
WHERE location.restaurantid = restaurant.restaurantid AND
	EXISTS (SELECT *
		FROM rating
		WHERE restaurant.restaurantid = rating.restaurantid AND
			rating.date NOT BETWEEN '2015-01-01' AND '2015-12-31');
*/

SELECT restaurant.name, location.phonenumber, restaurant.type
FROM restaurant, location
WHERE EXISTS (SELECT *
		FROM restaurant, rating
		WHERE restaurant.restaurantid = rating.restaurantid AND
			rating.date NOT BETWEEN '2015-01-01' AND '2015-12-31') AND location.restaurantid = restaurant.restaurantid;