/*
	f
	Find the total number of rating for each restaurant, for each rater. That is, the data should be
	grouped by the restaurant, the specific raters and the numeric ratings they have received.
*/
SELECT restaurant.name as restaurant, tmp.name as rater, number_rating FROM
(SELECT rating.restaurantid, rater.name, COUNT(rating.food) AS number_rating
FROM restaurants.rating
  JOIN restaurants.rater ON rating.userid = rater.userid
GROUP BY rater.name, rating.restaurantid ORDER BY rating.restaurantid) as tmp
LEFT OUTER JOIN restaurants.restaurant ON tmp.restaurantid = restaurant.restaurantid;