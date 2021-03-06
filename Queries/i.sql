/*
	i
	List the details of the Type Y restaurants that obtained the highest Food rating. Display the
	restaurant name together with the name(s) of the rater(s) who gave these ratings. (Here, Type Y refers to any 
	restaurant type of your choice, e.g. Indian or Burger.)
	Done
*/
SELECT DISTINCT *
FROM (
			 SELECT restaurant.name AS rename, rater.name AS raname
			 FROM (	SELECT restaurant.restaurantid, MAX(rating.food)
							 FROM rating, restaurant
							 GROUP BY restaurant.restaurantid) AS tmp, rating
				 JOIN restaurant ON restaurant.restaurantid = rating.restaurantid
				 JOIN rater ON rater.userid = rating.userid
			 WHERE restaurant.type = 'italian' /* $$$ */ AND tmp.restaurantid = restaurant.restaurantid) AS tmp
ORDER BY tmp.rename;