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