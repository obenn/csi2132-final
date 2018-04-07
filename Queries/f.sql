/*
	f
	Find the total number of rating for each restaurant, for each rater. That is, the data should be
	grouped by the restaurant, the specific raters and the numeric ratings they have received.
	Verify with Oliver
*/
SELECT restaurant.name, rater.name, COUNT(rating.food) AS number_rating
FROM rating
JOIN rater ON rating.userid = rater.userid
JOIN restaurant ON rating.restaurantid = restaurant.restaurantid
GROUP BY 1,2;