/*
	i
	List the details of the Type Y restaurants that obtained the highest Food rating. Display the
	restaurant name together with the name(s) of the rater(s) who gave these ratings. (Here, Type Y refers to any 
	restaurant type of your choice, e.g. Indian or Burger.)
*/
SELECT restaurant.name, rater.name
FROM (	SELECT restaurant.restaurantid, MAX(rating.food)
	FROM rating, restaurant
	GROUP BY restaurant.restaurantid) AS tmp, rating
JOIN restaurant ON restaurant.restaurantid = rating.restaurantid
JOIN rater ON rater.userid = rating.userid
WHERE restaurant.type = 'italian' AND tmp.restaurantid = restaurant.restaurantid;