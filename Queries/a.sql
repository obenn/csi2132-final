/*
	Restaurents and menus
*/
/*
	a
	Display all the information about a user‐specified restaurant. That is, the user should select the
	name of the restaurant from a list, and the information as contained in the restaurant and
	location tables should then displayed on the screen.
*/
SET search_path = "restaurants";

SELECT restaurant.name, restaurant.type, restaurant.url, location.firstopendate, location.managername, location.phonenumber, location.streetaddress, location.houropen, location.hourclose
FROM RESTAURANT
INNER JOIN LOCATION ON RESTAURANT.RestaurantID = LOCATION.RestaurantID;