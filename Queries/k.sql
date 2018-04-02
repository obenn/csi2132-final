/*
	k
	Find the names, join‐date and reputations of the raters that give the highest overall rating, in
	terms of the Food and the Mood of restaurants. Display this information together with the
	names of the restaurant and the dates the ratings were done.
	*****Im going to keep this easy by giving two tables, one giving the top food avg and the other the top mood avg
	*****Not sure if it is works well
*/
SELECT rater.name, rater.joindate, rater.reputation, restaurant.name, rating.date
FROM	(SELECT rating.userid, AVG(rating.food) AS foodavg
	FROM rating
	GROUP BY rating.userid
	ORDER BY foodavg DESC) AS tablefoodavg
JOIN rater ON tablefoodavg.userid = rater.userid
JOIN rating ON tablefoodavg.userid = rating.userid
JOIN restaurant ON rating.userid = restaurant.restaurantid;

SELECT rater.name, rater.joindate, rater.reputation, restaurant.name, rating.date
FROM	(SELECT rating.userid, AVG(rating.mood) AS foodavg
	FROM rating
	GROUP BY rating.userid
	ORDER BY foodavg DESC) AS tablefoodavg
JOIN rater ON tablefoodavg.userid = rater.userid
JOIN rating ON tablefoodavg.userid = rating.userid
JOIN restaurant ON rating.userid = restaurant.restaurantid;