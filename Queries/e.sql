/*
	e
	For each type of restaurant (e.g. Indian or Irish) and the category of menu item (appetiser, main
	or desert), list the average prices of menu items for each category.
	Good
*/
/*
SELECT restaurant.type, menuitem.category, CAST(AVG(CAST(menuitem.price AS decimal)) AS money)
FROM menuitem
JOIN restaurant ON menuitem.restaurantid = restaurant.restaurantid
WHERE restaurant.type = 'italian' AND menuitem.category = 'dessert'
GROUP BY 1, 2;
*/
SELECT restaurant.type, menuitem.category, CAST(AVG(CAST(menuitem.price AS decimal)) AS money)
FROM menuitem, RESTAURANT
WHERE restaurant.restaurantid = MENUITEM.RestaurantID
GROUP BY 1, 2
ORDER BY RESTAURANT.Type;