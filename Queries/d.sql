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