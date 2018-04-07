/*
	h
	Find the names and opening dates of the restaurants that obtained Staff rating that is lower
	than any rating given by rater X. Order your results by the dates of the ratings. (Here, X refers to
	any rater of your choice.)
	Good
*/
SELECT DISTINCT *
FROM (
      SELECT restaurant.name AS Name, location.firstopendate AS First_Open_Date
      FROM restaurant
      JOIN location ON location.restaurantid = restaurant.restaurantid
      JOIN rating ON rating.restaurantid = restaurant.restaurantid
      WHERE rating.staff <= (
			                        SELECT MIN(mintable.submin)
			                        FROM (
				                                  SELECT rating.userid,
				                                  CASE WHEN rating.price < rating.food AND rating.price < rating.mood AND rating.price < rating.staff THEN rating.price
					                                WHEN rating.food < rating.price AND rating.food < rating.mood AND rating.food < rating.staff THEN rating.food
					                                WHEN rating.mood < rating.price AND rating.mood < rating.food AND rating.mood < rating.staff THEN rating.mood
					                                ELSE rating.staff
				                                  END AS submin
				                                  From rating
				                                  JOIN rater ON rating.userid = rater.userid
				                                  WHERE rater.name = 'Big Joe' /* $$$ */) AS mintable)
                              ) AS noduptable
ORDER BY noduptable.First_Open_Date;