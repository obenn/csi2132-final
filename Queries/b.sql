SELECT menuitem.name, menuitem.type, menuitem.category, menuitem.description
FROM menuitem
INNER JOIN restaurant ON menuitem.restaurantid = restaurant.restaurantid
WHERE restaurant.name =
ORDER BY menuitem.category DESC;