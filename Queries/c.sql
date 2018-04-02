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
