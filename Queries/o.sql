/*
	o
	Find the names, types and emails of the raters that provide the most diverse ratings. Display this information together 
	with the restaurants names and the ratings. For example, Jane Doe may have rated the Food at the Imperial Palace restaurant 
	as a 1 on 1 January 2015, as a 5 on 15 January 2015, and a 3 on 4 February 2015. Clearly, she changes her mind quite often.
*/
SELECT DISTINCT rater.name, rater.type, rater.email
FROM rating, rater
WHERE rating.UserID = rater.UserID AND RATING.userid IN (SELECT DISTINCT rating.UserID FROM rating, RESTAURANT WHERE rating.RestaurantID = restaurant.RestaurantID AND rating.food = 10 ORDER BY rating.UserID) AND
      rating.userid IN (SELECT DISTINCT rating.UserID FROM rating, RESTAURANT WHERE
        rating.RestaurantID = restaurant.RestaurantID AND rating.food = 1 ORDER BY rating.UserID)
ORDER BY rater.name;