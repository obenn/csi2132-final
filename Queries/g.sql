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