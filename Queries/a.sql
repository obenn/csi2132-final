SELECT restaurant.name, restaurant.type, restaurant.url, location.firstopendate, location.managername, location.phonenumber, location.streetaddress, location.houropen, location.hourclose
FROM RESTAURANT
INNER JOIN LOCATION ON RESTAURANT.RestaurantID = LOCATION.RestaurantID
WHERE restaurant.name =