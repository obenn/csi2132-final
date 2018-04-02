/*
	j
	Provide a query to determine whether Type Y restaurants are “more popular” than other restaurants. 
	(Here, Type Y refers to any restaurant type of your choice, e.g. Indian or Burger.) Yes, this query 
	is open to your own interpretation!
	*****My interpretaion is the restaurants with the highest mood ratings
*/
SELECT restaurant.name, rater.name
FROM (	SELECT restaurant.restaurantid, MAX(rating.mood)
	FROM rating, restaurant
	GROUP BY restaurant.restaurantid) AS tmp, rating
JOIN restaurant ON restaurant.restaurantid = rating.restaurantid
JOIN rater ON rater.userid = rating.userid
WHERE restaurant.type = 'italian' AND tmp.restaurantid = restaurant.restaurantid;