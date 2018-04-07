/*
	n
	Find the names and emails of all raters who gave ratings that are lower than that of a rater with a name 
	called John, in terms of the combined rating of Price, Food, Mood and Staff. (Note that there may be more than one rater with this name).
	Done
*/
SELECT rater.name, rater.email

FROM

(SELECT rating.userid, (SUM(rating.price) + SUM(rating.food) + SUM(rating.mood) + SUM(rating.staff)) AS sumrating
FROM rating
GROUP BY 1) AS combinedrating,

(SELECT rating.userid, (SUM(rating.price) + SUM(rating.food) + SUM(rating.mood) + SUM(rating.staff)) AS sumrating
FROM rating, rater
WHERE rating.UserID = rater.userid AND rater.name = 'Sugar'   /*Using suragr to demonstrate since no john */ /* $$$ */
GROUP BY 1) AS combinedjohn, RATER

WHERE combinedrating.sumrating < combinedjohn.sumrating AND combinedrating.userid = rater.userid;