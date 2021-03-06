/*
	m
	Find the names and reputations of the raters that rated a specific restaurant (say Restaurant Z)
	the most frequently. Display this information together with their comments and the names and prices 
	of the menu items they discuss. (Here Restaurant Z refers to a restaurant of your own choice, e.g. Ma Cuisine).
	Done
*/
SELECT DISTINCT *
FROM (
       SELECT rater.name AS raname, rater.reputation, rating.comments, menuitem.name AS mname, menuitem.price
       FROM 	  (SELECT rater.userid AS userid, rating.restaurantid AS restaurantid, SUM(rating.restaurantid) AS smu
                FROM rating
                  JOIN rater ON rating.userid = rater.userid
                  JOIN restaurant ON rating.RestaurantID = RESTAURANT.RestaurantID
                WHERE RESTAURANT.name = 'Ottawa Pizza House' /* $$$ */
                GROUP BY 1, rating.restaurantid) AS tmp, rater, rating, menuitem, ratingitem
       WHERE tmp.smu IN (SELECT MAX(tmp.smu) FROM  (SELECT rater.userid AS userid, rating.restaurantid AS restaurantid, SUM(rating.restaurantid) AS smu
                                                    FROM rating
                                                      JOIN rater ON rating.userid = rater.userid
                                                      JOIN restaurant ON rating.RestaurantID = RESTAURANT.RestaurantID
                                                    WHERE RESTAURANT.name = 'Ottawa Pizza House' /* $$$ */
                                                    GROUP BY 1, rating.restaurantid) AS tmp)
             AND tmp.userid = rater.userid AND tmp.userid = rating.userid
             AND tmp.restaurantid = rating.restaurantid AND tmp.userid = ratingitem.userid AND ratingitem.itemid = menuitem.itemid
             AND tmp.restaurantid = menuitem.restaurantid) AS finaltable;