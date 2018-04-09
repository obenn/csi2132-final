<!DOCTYPE html>
<html lang="en">
<head>
    <title>Urbanspork</title>
    <link rel="icon" href="utensil-spoon.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/solid.js" integrity="sha384-P4tSluxIpPk9wNy8WSD8wJDvA8YZIkC6AQ+BfAFLXcUZIPQGu4Ifv4Kqq+i2XzrM" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/fontawesome.js" integrity="sha384-2IUdwouOFWauLdwTuAyHeMMRFfeyy4vqYNjodih+28v2ReC+8j+sLF9cK339k5hY" crossorigin="anonymous"></script>
    <script defer src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script defer src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-light bg-light mb-4">
    <a class="navbar-brand" href="index.php"><i class="fas fa-utensil-spoon"></i> Urbanspork</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="restaurants.php"><i class="fas fa-utensils"></i> Restaurants</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ratings.php"><i class="fas fa-thumbs-up"></i> Ratings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reviewers.php"><i class="fas fa-pencil-alt"></i> Reviewers</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="queries.php"><i class="fas fa-database"></i> Queries</a>
            </li>
        </ul>
    </div>
</nav>

<!-- -->


<main role="main" class="container">
    <div class="jumbotron">

        <?php
        if ($_POST['query'] != null) {
            $query = $_POST['query'];
            include 'connection.php';

            if ($query == "Queries/a.sql") {
                if ($_POST['a'] != null) {
                    $name = $_POST['a'];
                } else {
                    $name = "*";
                }
                echo "<h2>Query A</h2>";
                echo "<p>Display all the information about a user‐specified restaurant. That is, the user should select the
	            name of the restaurant from a list, and the information as contained in the restaurant and
	            location tables should then displayed on the screen.</p>";
                $query = "SELECT restaurant.name, restaurant.type, restaurant.url, location.firstopendate, location.managername, location.phonenumber, location.streetaddress, location.houropen, location.hourclose
                FROM RESTAURANT
                INNER JOIN LOCATION ON RESTAURANT.RestaurantID = LOCATION.RestaurantID
                WHERE restaurant.name = '$name';";
                echo "<code>$query</code>";
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "<thead>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Name</th>\n";
                echo "<th scope=\"col\">Type</th>\n";
                echo "<th scope=\"col\">Url</th>\n";
                echo "<th scope=\"col\">First Open Date</th>\n";
                echo "<th scope=\"col\">Manager Name</th>\n";
                echo "<th scope=\"col\">Phone Number</th>\n";
                echo "<th scope=\"col\">Street Address</th>\n";
                echo "<th scope=\"col\">Opening Hour</th>\n";
                echo "<th scope=\"col\">Closing Hour</th>\n";
                echo "</tr>\n";
                echo "</thead>\n";
                echo "<tbody>\n";
                $results = pg_query("SELECT restaurant.name, restaurant.type, restaurant.url, location.firstopendate, location.managername, location.phonenumber, location.streetaddress, location.houropen, location.hourclose
                FROM RESTAURANT
                INNER JOIN LOCATION ON RESTAURANT.RestaurantID = LOCATION.RestaurantID
                WHERE restaurant.name = '$name';") or die('Query failed: ' . pg_last_error());
                while ($result = pg_fetch_array($results, null, PGSQL_ASSOC)) {
                    $name = $result['name'];
                    $type = $result['type'];
                    $url = $result['url'];
                    $firstopendate = $result['firstopendate'];
                    $managername = $result['managername'];
                    $phonenumber = $result['phonenumber'];
                    $streetaddress = $result['streetaddress'];
                    $houropen = $result['houropen'];
                    $hourclose = $result['hourclose'];
                    echo "<tr>\n";
                    echo "<td>$name</td>\n";
                    echo "<td>$type</td>\n";
                    echo "<td>$url</td>\n";
                    echo "<td>$firstopendate</td>";
                    echo "<td>$managername</td>";
                    echo "<td>$phonenumber</td>";
                    echo "<td>$streetaddress</td>";
                    echo "<td>$houropen</td>";
                    echo "<td>$hourclose</td>";
                    echo "</tr>\n";
                }

            } else if ($query == "Queries/b.sql") {


                if ($_POST['b'] != null) {
                    $name = $_POST['b'];
                } else {
                    $name = "*";
                }


                echo "<h2>Query B</h2>";
                echo "<p>Display the full menu of a specific restaurant. That is, the user should select the name of the
	            restaurant from a list, and all menu items, together with their prices, should be displayed on the
	            screen. The menu should be displayed based on menu item categories.</p>";
                $query = "SELECT menuitem.name, menuitem.type, menuitem.category, menuitem.description
                FROM menuitem
                INNER JOIN restaurant ON menuitem.restaurantid = restaurant.restaurantid
                WHERE restaurant.name = '$name'
                ORDER BY menuitem.category DESC";

                echo "<code>$query</code>";
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "<thead>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Name</th>\n";
                echo "<th scope=\"col\">Type</th>\n";
                echo "<th scope=\"col\">Category</th>\n";
                echo "<th scope=\"col\">Description</th>\n";

                echo "</tr>\n";
                echo "</thead>\n";
                echo "<tbody>\n";
                $results = pg_query("SELECT menuitem.name, menuitem.type, menuitem.category, menuitem.description
                FROM menuitem
                INNER JOIN restaurant ON menuitem.restaurantid = restaurant.restaurantid
                WHERE restaurant.name = '$name'
                ORDER BY menuitem.category DESC") or die('Query failed: ' . pg_last_error());
                while ($result = pg_fetch_array($results, null, PGSQL_ASSOC)) {
                    $name = $result['name'];
                    $type = $result['type'];
                    $category = $result['category'];
                    $description = $result['description'];

                    echo "<tr>\n";
                    echo "<td>$name</td>\n";
                    echo "<td>$type</td>\n";
                    echo "<td>$category</td>\n";
                    echo "<td>$description</td>\n";
                    echo "</tr>\n";
                }
            } else if ($query == "Queries/c.sql") {


                if ($_POST['c'] != null) {
                    $name = $_POST['c'];
                } else {
                    $name = "*";
                }


                echo "<h2>Query C</h2>";
                echo "<p>	For each user‐specified category of restaurant, list the manager names together with the date
	            that the locations have opened. The user should be able to select the category (e.g. Italian or
	            Thai) from a list.</p>";
                $query = "SELECT restaurant.name, location.managername, location.firstopendate
                FROM location
                INNER JOIN restaurant ON location.restaurantid = restaurant.restaurantid
                WHERE restaurant.type = '$name';";

                echo "<code>$query</code>";
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "<thead>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Name</th>\n";
                echo "<th scope=\"col\">Manager Name</th>\n";
                echo "<th scope=\"col\">First Open Date</th>\n";

                echo "</tr>\n";
                echo "</thead>\n";
                echo "<tbody>\n";
                $results = pg_query("SELECT restaurant.name, location.managername, location.firstopendate
                FROM location
                INNER JOIN restaurant ON location.restaurantid = restaurant.restaurantid
                WHERE restaurant.type = '$name';") or die('Query failed: ' . pg_last_error());
                while ($result = pg_fetch_array($results, null, PGSQL_ASSOC)) {
                    $name = $result['name'];
                    $managername = $result['managername'];
                    $firstopendate = $result['firstopendate'];

                    echo "<tr>\n";
                    echo "<td>$name</td>\n";
                    echo "<td>$managername</td>\n";
                    echo "<td>$firstopendate</td>\n";

                    echo "</tr>\n";
                }
            } else if ($query == "Queries/d.sql") {


                if ($_POST['d'] != null) {
                    $name = $_POST['d'];
                } else {
                    $name = "*";
                }


                echo "<h2>Query D</h2>";
                echo "<p>Given a user‐specified restaurant, find the name of the most expensive menu item. List this
	            information together with the name of manager, the opening hours, and the URL of the
	            restaurant. The user should be able to select the restaurant name (e.g. El Camino) from a list.</p>";
                $query = "SELECT menuitem.name, location.managername, location.houropen, restaurant.url
                FROM menuitem
                JOIN restaurant ON menuitem.restaurantid = restaurant.restaurantid
                JOIN location ON restaurant.restaurantid = location.restaurantid
                WHERE menuitem.price IN (
                    SELECT MAX(menuitem.price)
                    FROM menuitem
                    JOIN restaurant ON menuitem.restaurantid = restaurant.restaurantid
                    WHERE restaurant.name = '$name'
                    GROUP BY menuitem.restaurantid);";

                echo "<code>$query</code>";
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "<thead>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Name</th>\n";
                echo "<th scope=\"col\">Manager Name</th>\n";
                echo "<th scope=\"col\">Hour Open</th>\n";
                echo "<th scope=\"col\">Url</th>\n";


                echo "</tr>\n";
                echo "</thead>\n";
                echo "<tbody>\n";
                $results = pg_query("SELECT menuitem.name, location.managername, location.houropen, restaurant.url
                FROM menuitem
                JOIN restaurant ON menuitem.restaurantid = restaurant.restaurantid
                JOIN location ON restaurant.restaurantid = location.restaurantid
                WHERE menuitem.price IN (
                    SELECT MAX(menuitem.price)
                    FROM menuitem
                    JOIN restaurant ON menuitem.restaurantid = restaurant.restaurantid
                    WHERE restaurant.name = '$name'
                    GROUP BY menuitem.restaurantid);") or die('Query failed: ' . pg_last_error());
                while ($result = pg_fetch_array($results, null, PGSQL_ASSOC)) {
                    $name = $result['name'];
                    $managername = $result['managername'];
                    $houropen = $result['houropen'];
                    $url = $result['url'];

                    echo "<tr>\n";
                    echo "<td>$name</td>\n";
                    echo "<td>$managername</td>\n";
                    echo "<td>$houropen</td>\n";
                    echo "<td>$url</td>\n";

                    echo "</tr>\n";
                }
            } else if ($query == "Queries/e.sql") {

                /*
                if ($_POST['name'] != null) {
                    $name = $_POST['name'];
                } else {
                    $name = "*";
                }
                */


                echo "<h2>Query E</h2>";
                echo "<p>	For each type of restaurant (e.g. Indian or Irish) and the category of menu item (appetiser, main
	            or desert), list the average prices of menu items for each category.</p>";
                $query = "SELECT restaurant.type, menuitem.category, CAST(AVG(CAST(menuitem.price AS decimal)) AS money)
                FROM menuitem, RESTAURANT
                WHERE restaurant.restaurantid = MENUITEM.RestaurantID
                GROUP BY 1, 2
                ORDER BY RESTAURANT.Type;";

                echo "<code>$query</code>";
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "<thead>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Type</th>\n";
                echo "<th scope=\"col\">Category</th>\n";
                echo "<th scope=\"col\">Average</th>\n";

                echo "</tr>\n";
                echo "</thead>\n";
                echo "<tbody>\n";
                $results = pg_query("SELECT restaurant.type, menuitem.category, CAST(AVG(CAST(menuitem.price AS decimal)) AS money)
                FROM menuitem, RESTAURANT
                WHERE restaurant.restaurantid = MENUITEM.RestaurantID
                GROUP BY 1, 2
                ORDER BY RESTAURANT.Type;") or die('Query failed: ' . pg_last_error());
                while ($result = pg_fetch_array($results, null, PGSQL_ASSOC)) {
                    $type = $result['type'];
                    $category = $result['category'];
                    $avg = $result['avg'];

                    echo "<tr>\n";
                    echo "<td>$type</td>\n";
                    echo "<td>$category</td>\n";
                    echo "<td>$avg</td>\n";

                    echo "</tr>\n";
                }
            } else if ($query == "Queries/e.sql") {

                /*
                if ($_POST['name'] != null) {
                    $name = $_POST['name'];
                } else {
                    $name = "*";
                }
                */


                echo "<h2>Query E</h2>";
                echo "<p>	For each type of restaurant (e.g. Indian or Irish) and the category of menu item (appetiser, main
	            or desert), list the average prices of menu items for each category.</p>";
                $query = "SELECT restaurant.type, menuitem.category, CAST(AVG(CAST(menuitem.price AS decimal)) AS money)
                FROM menuitem, RESTAURANT
                WHERE restaurant.restaurantid = MENUITEM.RestaurantID
                GROUP BY 1, 2
                ORDER BY RESTAURANT.Type;";

                echo "<code>$query</code>";
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "<thead>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Type</th>\n";
                echo "<th scope=\"col\">Category</th>\n";
                echo "<th scope=\"col\">Average</th>\n";

                echo "</tr>\n";
                echo "</thead>\n";
                echo "<tbody>\n";
                $results = pg_query("SELECT restaurant.type, menuitem.category, CAST(AVG(CAST(menuitem.price AS decimal)) AS money)
                FROM menuitem, RESTAURANT
                WHERE restaurant.restaurantid = MENUITEM.RestaurantID
                GROUP BY 1, 2
                ORDER BY RESTAURANT.Type;") or die('Query failed: ' . pg_last_error());
                while ($result = pg_fetch_array($results, null, PGSQL_ASSOC)) {
                    $type = $result['type'];
                    $category = $result['category'];
                    $avg = $result['avg'];

                    echo "<tr>\n";
                    echo "<td>$type</td>\n";
                    echo "<td>$category</td>\n";
                    echo "<td>$avg</td>\n";

                    echo "</tr>\n";
                }
            } else if ($query == "Queries/f.sql") {

                /*
                if ($_POST['name'] != null) {
                    $name = $_POST['name'];
                } else {
                    $name = "*";
                }
                */


                echo "<h2>Query F</h2>";
                echo "<p>Find the total number of rating for each restaurant, for each rater. That is, the data should be
	            grouped by the restaurant, the specific raters and the numeric ratings they have received.</p>";
                $query = "SELECT restaurant.name, rater.name, COUNT(rating.food) AS number_rating
                FROM rating
                JOIN rater ON rating.userid = rater.userid
                JOIN restaurant ON rating.restaurantid = restaurant.restaurantid
                GROUP BY 1,2;";

                echo "<code>$query</code>";
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "<thead>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Restaurant Name</th>\n";
                echo "<th scope=\"col\">Rater Name</th>\n";
                echo "<th scope=\"col\">Number of Rating</th>\n";

                echo "</tr>\n";
                echo "</thead>\n";
                echo "<tbody>\n";
                $results = pg_query("SELECT restaurant.name, rater.name, COUNT(rating.food) AS number_rating
                FROM rating
                JOIN rater ON rating.userid = rater.userid
                JOIN restaurant ON rating.restaurantid = restaurant.restaurantid
                GROUP BY 1,2;") or die('Query failed: ' . pg_last_error());
                while ($result = pg_fetch_array($results, null, PGSQL_ASSOC)) {
                    $name = $result['restaurant.name'];
                    $name = $result['rater.name'];
                    $number_rating = $result['number_rating'];

                    echo "<tr>\n";
                    echo "<td>$name</td>\n";
                    echo "<td>$name</td>\n";
                    echo "<td>$number_rating</td>\n";

                    echo "</tr>\n";
                }
            } else if ($query == "Queries/g.sql") {

                /*
                if ($_POST['name'] != null) {
                    $name = $_POST['name'];
                } else {
                    $name = "*";
                }
                */

                echo "<h2>Query G</h2>";
                echo "<p>	Display the details of the restaurants that have not been rated in January 2015. That is, you should display the name of the 
	            restaurant together with the phone number and the type of food.</p>";
                $query = "SELECT restaurant.name, location.phonenumber, restaurant.type
                FROM restaurant, location
                WHERE EXISTS (SELECT *
                        FROM restaurant, rating
                        WHERE restaurant.restaurantid = rating.restaurantid AND
                            rating.date NOT BETWEEN '2015-01-01' AND '2015-12-31') AND location.restaurantid = restaurant.restaurantid;";

                echo "<code>$query</code>";
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "<thead>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Restaurant Name</th>\n";
                echo "<th scope=\"col\">Phone Number</th>\n";
                echo "<th scope=\"col\">Restaurant Type</th>\n";

                echo "</tr>\n";
                echo "</thead>\n";
                echo "<tbody>\n";
                $results = pg_query("SELECT restaurant.name, location.phonenumber, restaurant.type
                FROM restaurant, location
                WHERE EXISTS (SELECT *
                        FROM restaurant, rating
                        WHERE restaurant.restaurantid = rating.restaurantid AND
                            rating.date NOT BETWEEN '2015-01-01' AND '2015-12-31') AND location.restaurantid = restaurant.restaurantid;") or die('Query failed: ' . pg_last_error());
                while ($result = pg_fetch_array($results, null, PGSQL_ASSOC)) {
                    $name = $result['name'];
                    $phonenumber = $result['phonenumber'];
                    $type = $result['type'];

                    echo "<tr>\n";
                    echo "<td>$name</td>\n";
                    echo "<td>$phonenumber</td>\n";
                    echo "<td>$type</td>\n";

                    echo "</tr>\n";
                }
            } else if ($query == "Queries/h.sql") {


                if ($_POST['h'] != null) {
                    $name = $_POST['h'];
                } else {
                    $name = "*";
                }


                echo "<h2>Query H</h2>";
                echo "<p>	Find the names and opening dates of the restaurants that obtained Staff rating that is lower
                than any rating given by rater X. Order your results by the dates of the ratings. (Here, X refers to
                any rater of your choice.)</p>";
                $query = "SELECT DISTINCT *
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
                                                                  WHERE rater.name = '$name') AS mintable)
                                              ) AS noduptable
                ORDER BY noduptable.First_Open_Date;";

                echo "<code>$query</code>";
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "<thead>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Restaurant Name</th>\n";
                echo "<th scope=\"col\">First Open Date</th>\n";

                echo "</tr>\n";
                echo "</thead>\n";
                echo "<tbody>\n";
                $results = pg_query("SELECT DISTINCT *
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
                                                                  WHERE rater.name = '$name') AS mintable)
                                              ) AS noduptable
                ORDER BY noduptable.First_Open_Date;") or die('Query failed: ' . pg_last_error());
                while ($result = pg_fetch_array($results, null, PGSQL_ASSOC)) {
                    $name = $result['name'];
                    $firstopendate = $result['first_open_date'];

                    echo "<tr>\n";
                    echo "<td>$name</td>\n";
                    echo "<td>$firstopendate</td>\n";

                    echo "</tr>\n";
                }
            } else if ($query == "Queries/i.sql") {


                if ($_POST['i'] != null) {
                    $name = $_POST['i'];
                } else {
                    $name = "*";
                }


                echo "<h2>Query I</h2>";
                echo "<p>	List the details of the Type Y restaurants that obtained the highest Food rating. Display the
                restaurant name together with the name(s) of the rater(s) who gave these ratings. (Here, Type Y refers to any 
                restaurant type of your choice, e.g. Indian or Burger.)</p>";
                $query = "SELECT DISTINCT *
                FROM (
                  SELECT restaurant.name AS rename, rater.name AS raname
                  FROM (	SELECT restaurant.restaurantid, MAX(rating.food)
                    FROM rating, restaurant
                    GROUP BY restaurant.restaurantid) AS tmp, rating
                  JOIN restaurant ON restaurant.restaurantid = rating.restaurantid
                  JOIN rater ON rater.userid = rating.userid
                  WHERE restaurant.type = '$name' AND tmp.restaurantid = restaurant.restaurantid) AS tmp
                ORDER BY tmp.rename;";

                echo "<code>$query</code>";
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "<thead>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Restaurant NAME</th>\n";
                echo "<th scope=\"col\">Rater Name</th>\n";

                echo "</tr>\n";
                echo "</thead>\n";
                echo "<tbody>\n";
                $results = pg_query("SELECT DISTINCT *
                FROM (
                  SELECT restaurant.name AS rename, rater.name AS raname
                  FROM (	SELECT restaurant.restaurantid, MAX(rating.food)
                    FROM rating, restaurant
                    GROUP BY restaurant.restaurantid) AS tmp, rating
                  JOIN restaurant ON restaurant.restaurantid = rating.restaurantid
                  JOIN rater ON rater.userid = rating.userid
                  WHERE restaurant.type = '$name' AND tmp.restaurantid = restaurant.restaurantid) AS tmp
                ORDER BY tmp.rename;") or die('Query failed: ' . pg_last_error());
                while ($result = pg_fetch_array($results, null, PGSQL_ASSOC)) {
                    $rename = $result['rename'];
                    $raname = $result['raname'];

                    echo "<tr>\n";
                    echo "<td>$rename</td>\n";
                    echo "<td>$raname</td>\n";

                    echo "</tr>\n";
                }
            } else if ($query == "Queries/j.sql") {


                if ($_POST['j'] != null) {
                    $name = $_POST['j'];
                } else {
                    $name = "*";
                }


                echo "<h2>Query J</h2>";
                echo "<p>	Provide a query to determine whether Type Y restaurants are “more popular” than other restaurants. 
                (Here, Type Y refers to any restaurant type of your choice, e.g. Indian or Burger.) Yes, this query 
                is open to your own interpretation!</p>";
                $query = "SELECT DISTINCT *
                FROM (
                  SELECT restaurant.name AS rename, rater.name AS raname
                  FROM (	SELECT restaurant.restaurantid, MAX(rating.mood)
                    FROM rating, restaurant
                    GROUP BY restaurant.restaurantid) AS tmp, rating
                  JOIN restaurant ON restaurant.restaurantid = rating.restaurantid
                  JOIN rater ON rater.userid = rating.userid
                  WHERE restaurant.type = '$name' AND tmp.restaurantid = restaurant.restaurantid) AS tmp
                ORDER BY tmp.rename;";

                echo "<code>$query</code>";
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "<thead>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Restaurant Name</th>\n";
                echo "<th scope=\"col\">Rater Name</th>\n";

                echo "</tr>\n";
                echo "</thead>\n";
                echo "<tbody>\n";
                $results = pg_query("SELECT DISTINCT *
                FROM (
                  SELECT restaurant.name AS rename, rater.name AS raname
                  FROM (	SELECT restaurant.restaurantid, MAX(rating.mood)
                    FROM rating, restaurant
                    GROUP BY restaurant.restaurantid) AS tmp, rating
                  JOIN restaurant ON restaurant.restaurantid = rating.restaurantid
                  JOIN rater ON rater.userid = rating.userid
                  WHERE restaurant.type = '$name' AND tmp.restaurantid = restaurant.restaurantid) AS tmp
                ORDER BY tmp.rename;") or die('Query failed: ' . pg_last_error());
                while ($result = pg_fetch_array($results, null, PGSQL_ASSOC)) {
                    $rename = $result['rename'];
                    $raname = $result['raname'];

                    echo "<tr>\n";
                    echo "<td>$rename</td>\n";
                    echo "<td>$raname</td>\n";

                    echo "</tr>\n";
                }
            } else if ($query == "Queries/k.sql") {

                /*
                if ($_POST['name'] != null) {
                    $name = $_POST['name'];
                } else {
                    $name = "*";
                }
                */


                echo "<h2>Query K</h2>";
                echo "<p>	Find the names, join‐date and reputations of the raters that give the highest overall rating, in
                terms of the Food and the Mood of restaurants. Display this information together with the
                names of the restaurant and the dates the ratings were done.</p>";
                $query = "SELECT rater.name AS raname, rater.joindate, rater.reputation, restaurant.name AS rename, rating.date
                FROM rating
                JOIN rater ON rater.userid = rating.userid
                JOIN restaurant ON rating.restaurantid = restaurant.restaurantid
                WHERE rating.food IN 	(SELECT MAX(rating.food)
                            FROM rating) AND rating.mood IN (SELECT MAX(rating.mood)
                            FROM rating);";

                echo "<code>$query</code>";
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "<thead>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Rater Name</th>\n";
                echo "<th scope=\"col\">Rater Join Date</th>\n";
                echo "<th scope=\"col\">Rater Reputation</th>\n";
                echo "<th scope=\"col\">Restaurant Name</th>\n";
                echo "<th scope=\"col\">Rating Date</th>\n";

                echo "</tr>\n";
                echo "</thead>\n";
                echo "<tbody>\n";
                $results = pg_query("SELECT rater.name AS raname, rater.joindate, rater.reputation, restaurant.name AS rename, rating.date
                FROM rating
                JOIN rater ON rater.userid = rating.userid
                JOIN restaurant ON rating.restaurantid = restaurant.restaurantid
                WHERE rating.food IN 	(SELECT MAX(rating.food)
                            FROM rating) AND rating.mood IN (SELECT MAX(rating.mood)
                            FROM rating);") or die('Query failed: ' . pg_last_error());
                while ($result = pg_fetch_array($results, null, PGSQL_ASSOC)) {
                    $raname = $result['raname'];
                    $joindate = $result['joindate'];
                    $reputation = $result['reputation'];
                    $rename = $result['rename'];
                    $date = $result['date'];

                    echo "<tr>\n";
                    echo "<td>$raname</td>\n";
                    echo "<td>$joindate</td>\n";
                    echo "<td>$reputation</td>\n";
                    echo "<td>$rename</td>\n";
                    echo "<td>$date</td>\n";

                    echo "</tr>\n";
                }
            } else if ($query == "Queries/l.sql") {

                /*
                if ($_POST['name'] != null) {
                    $name = $_POST['name'];
                } else {
                    $name = "*";
                }
                */


                echo "<h2>Query L</h2>";
                echo "<p>Find the names and reputations of the raters that give the highest overall rating, in terms of the
                Food or the Mood of restaurants. Display this information together with the names of the
                restaurant and the dates the ratings were done.</p>";
                $query = "SELECT rater.name AS raname, rater.reputation, restaurant.name AS rename, rating.date
                FROM rating
                JOIN rater ON rater.userid = rating.userid
                JOIN restaurant ON rating.restaurantid = restaurant.restaurantid
                WHERE rating.food IN 	(SELECT MAX(rating.food)
                            FROM rating) AND rating.mood IN (SELECT MAX(rating.mood)
                            FROM rating);";

                echo "<code>$query</code>";
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "<thead>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Rater Name</th>\n";
                echo "<th scope=\"col\">Rater Reputation</th>\n";
                echo "<th scope=\"col\">Restaurant Name</th>\n";
                echo "<th scope=\"col\">Rating Date</th>\n";

                echo "</tr>\n";
                echo "</thead>\n";
                echo "<tbody>\n";
                $results = pg_query("SELECT rater.name AS raname, rater.reputation, restaurant.name AS rename, rating.date
                FROM rating
                JOIN rater ON rater.userid = rating.userid
                JOIN restaurant ON rating.restaurantid = restaurant.restaurantid
                WHERE rating.food IN 	(SELECT MAX(rating.food)
                            FROM rating) AND rating.mood IN (SELECT MAX(rating.mood)
                            FROM rating);") or die('Query failed: ' . pg_last_error());
                while ($result = pg_fetch_array($results, null, PGSQL_ASSOC)) {
                    $raname = $result['raname'];
                    $reputation = $result['reputation'];
                    $rename = $result['rename'];
                    $date = $result['date'];

                    echo "<tr>\n";
                    echo "<td>$raname</td>\n";
                    echo "<td>$reputation</td>\n";
                    echo "<td>$rename</td>\n";
                    echo "<td>$date</td>\n";

                    echo "</tr>\n";
                }
            } else if ($query == "Queries/m.sql") {


                if ($_POST['m'] != null) {
                    $name = $_POST['m'];
                } else {
                    $name = "*";
                }


                echo "<h2>Query M</h2>";
                echo "<p>	Find the names and reputations of the raters that rated a specific restaurant (say Restaurant Z)
                the most frequently. Display this information together with their comments and the names and prices 
                of the menu items they discuss. (Here Restaurant Z refers to a restaurant of your own choice, e.g. Ma Cuisine).</p>";
                $query = "SELECT DISTINCT *
                FROM (
                  SELECT rater.name AS raname, rater.reputation, rating.comments, menuitem.name AS mname, menuitem.price
                  FROM 	  (SELECT rater.userid AS userid, rating.restaurantid AS restaurantid, SUM(rating.restaurantid) AS smu
                          FROM rating
                          JOIN rater ON rating.userid = rater.userid
                          WHERE rating.restaurantid = 1 /* $$$ */
                          GROUP BY 1, rating.restaurantid) AS tmp, rater, rating, menuitem, ratingitem
                  WHERE tmp.smu IN (SELECT MAX(tmp.smu) FROM  (SELECT rater.userid AS userid, rating.restaurantid AS restaurantid, SUM(rating.restaurantid) AS smu
                                                              FROM rating
                                                              JOIN rater ON rating.userid = rater.userid
                                                              JOIN restaurant ON rating.RestaurantID = RESTAURANT.RestaurantID
                                                              WHERE RESTAURANT.name = '$name'
                                                              GROUP BY 1, rating.restaurantid) AS tmp)
                        AND tmp.userid = rater.userid AND tmp.userid = rating.userid
                        AND tmp.restaurantid = rating.restaurantid AND tmp.userid = ratingitem.userid AND ratingitem.itemid = menuitem.itemid
                        AND tmp.restaurantid = menuitem.restaurantid) AS finaltable;";

                echo "<code>$query</code>";
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "<thead>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Rater Name</th>\n";
                echo "<th scope=\"col\">Rater Reputation</th>\n";
                echo "<th scope=\"col\">Comments</th>\n";
                echo "<th scope=\"col\">Menu Item Name</th>\n";
                echo "<th scope=\"col\">Price</th>\n";


                echo "</tr>\n";
                echo "</thead>\n";
                echo "<tbody>\n";
                $results = pg_query("SELECT DISTINCT *
                FROM (
                  SELECT rater.name AS raname, rater.reputation, rating.comments, menuitem.name AS mname, menuitem.price
                  FROM 	  (SELECT rater.userid AS userid, rating.restaurantid AS restaurantid, SUM(rating.restaurantid) AS smu
                          FROM rating
                          JOIN rater ON rating.userid = rater.userid
                          JOIN restaurant ON rating.RestaurantID = RESTAURANT.RestaurantID
                          WHERE RESTAURANT.name = '$name'
                          GROUP BY 1, rating.restaurantid) AS tmp, rater, rating, menuitem, ratingitem
                  WHERE tmp.smu IN (SELECT MAX(tmp.smu) FROM  (SELECT rater.userid AS userid, rating.restaurantid AS restaurantid, SUM(rating.restaurantid) AS smu
                                                              FROM rating
                                                              JOIN rater ON rating.userid = rater.userid
                                                              JOIN restaurant ON rating.RestaurantID = RESTAURANT.RestaurantID
                                                              WHERE RESTAURANT.name = '$name'
                                                              GROUP BY 1, rating.restaurantid) AS tmp)
                        AND tmp.userid = rater.userid AND tmp.userid = rating.userid
                        AND tmp.restaurantid = rating.restaurantid AND tmp.userid = ratingitem.userid AND ratingitem.itemid = menuitem.itemid
                        AND tmp.restaurantid = menuitem.restaurantid) AS finaltable;") or die('Query failed: ' . pg_last_error());
                while ($result = pg_fetch_array($results, null, PGSQL_ASSOC)) {
                    $raname = $result['raname'];
                    $reputation = $result['reputation'];
                    $comments = $result['comments'];
                    $mname = $result['mname'];
                    $price = $result['price'];

                    echo "<tr>\n";
                    echo "<td>$raname</td>\n";
                    echo "<td>$reputation</td>\n";
                    echo "<td>$comments</td>\n";
                    echo "<td>$mname</td>\n";
                    echo "<td>$price</td>\n";

                    echo "</tr>\n";
                }
            } else if ($query == "Queries/n.sql") {

                /*
                if ($_POST['name'] != null) {
                    $name = $_POST['name'];
                } else {
                    $name = "*";
                }
                */


                echo "<h2>Query N</h2>";
                echo "<p>	Find the names and emails of all raters who gave ratings that are lower than that of a rater with a name 
	            called John, in terms of the combined rating of Price, Food, Mood and Staff. (Note that there may be more than one rater with this name).</p>";
                $query = "SELECT rater.name, rater.email

                FROM
                
                (SELECT rating.userid, (SUM(rating.price) + SUM(rating.food) + SUM(rating.mood) + SUM(rating.staff)) AS sumrating
                FROM rating
                GROUP BY 1) AS combinedrating,
                
                (SELECT rating.userid, (SUM(rating.price) + SUM(rating.food) + SUM(rating.mood) + SUM(rating.staff)) AS sumrating
                FROM rating, rater
                WHERE rating.UserID = rater.userid AND rater.name = 'Sugar'
                GROUP BY 1) AS combinedjohn, RATER
                
                WHERE combinedrating.sumrating < combinedjohn.sumrating AND combinedrating.userid = rater.userid;";

                echo "<code>$query</code>";
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "<thead>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Rater Name</th>\n";
                echo "<th scope=\"col\">Rater Email</th>\n";

                echo "</tr>\n";
                echo "</thead>\n";
                echo "<tbody>\n";
                $results = pg_query("SELECT rater.name, rater.email

                FROM
                
                (SELECT rating.userid, (SUM(rating.price) + SUM(rating.food) + SUM(rating.mood) + SUM(rating.staff)) AS sumrating
                FROM rating
                GROUP BY 1) AS combinedrating,
                
                (SELECT rating.userid, (SUM(rating.price) + SUM(rating.food) + SUM(rating.mood) + SUM(rating.staff)) AS sumrating
                FROM rating, rater
                WHERE rating.UserID = rater.userid AND rater.name = 'Sugar'
                GROUP BY 1) AS combinedjohn, RATER
                
                WHERE combinedrating.sumrating < combinedjohn.sumrating AND combinedrating.userid = rater.userid;") or die('Query failed: ' . pg_last_error());
                while ($result = pg_fetch_array($results, null, PGSQL_ASSOC)) {
                    $name = $result['name'];
                    $email = $result['email'];

                    echo "<tr>\n";
                    echo "<td>$name</td>\n";
                    echo "<td>$email</td>\n";

                    echo "</tr>\n";
                }
            }

        } else {
            echo "<h1>Queries</h1>\n";
            echo "<br>";
            echo "<form action='queries.php' method='post'>\n";

            echo "\t<h3>Restaurants and Menus</h3>\n";
            echo "<br>";

            echo "<p>A) Restaurant Information:</p>";
            echo "<div class='row'>\n";
            echo "<div class='col-md-3'>\n";
            echo "Enter Restaurant Name:\n";
            echo "</div>\n";
            echo "<div class='col-md-3'>\n";
            echo "<input type='text' name='a' pattern='^[a-zA-Z0-9' ]+$' title='Accepted characters only'><br>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/a.sql'>A</button>\n";
            echo "<br>";
            echo "<br>";

            echo "<p>B) Restaurant Menu:</p>";
            echo "<div class='row'>\n";
            echo "<div class='col-md-3'>\n";
            echo "Enter Restaurant Name:\n";
            echo "</div>\n";
            echo "<div class='col-md-3'>\n";
            echo "<input type='text' name='b' pattern='^[a-zA-Z0-9' ]+$' title='Accepted characters only'><br>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/b.sql'>B</button>\n";
            echo "<br>";
            echo "<br>";

            echo "<p>C) Location Opening and Manager:</p>";
            echo "<div class='row'>\n";
            echo "<div class='col-md-3'>\n";
            echo "Enter Restaurant Category:\n";
            echo "</div>\n";
            echo "<div class='col-md-3'>\n";
            echo "<input type='text' name='c' pattern='^[a-zA-Z0-9' ]+$' title='Accepted characters only'><br>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/c.sql'>C</button>\n";
            echo "<br>";
            echo "<br>";

            echo "<p>D) Most Expensive Menu Item:</p>";
            echo "<div class='row'>\n";
            echo "<div class='col-md-3'>\n";
            echo "Enter Restaurant Name:\n";
            echo "</div>\n";
            echo "<div class='col-md-3'>\n";
            echo "<input type='text' name='d' pattern='^[a-zA-Z0-9' ]+$' title='Accepted characters only'><br>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/d.sql'>D</button>\n";
            echo "<br>";
            echo "<br>";

            echo "<p>E) Average Price of Category Menu Item:</p>";
            echo "<div class='row'>\n";
            echo "<div class='col-md-3'>\n";
            echo "Entry not required.\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/e.sql'>E</button>\n";
            echo "<br>";
            echo "<br>";

            echo "\t<h3>Ratings of Restaurants</h3>\n";
            echo "<br>";

            echo "<p>F) Rating Per Restaurant:</p>";
            echo "<div class='row'>\n";
            echo "<div class='col-md-3'>\n";
            echo "Entry not required.\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/f.sql'>F</button>\n";
            echo "<br>";
            echo "<br>";

            echo "<p>G) Not Rated in January 2015:</p>";
            echo "<div class='row'>\n";
            echo "<div class='col-md-3'>\n";
            echo "Entry not required.\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/g.sql'>G</button>\n";
            echo "<br>";
            echo "<br>";

            echo "<p>H) Staff Rating Lower then Rater:</p>";
            echo "<div class='row'>\n";
            echo "<div class='col-md-3'>\n";
            echo "Enter Rater Name:\n";
            echo "</div>\n";
            echo "<div class='col-md-3'>\n";
            echo "<input type='text' name='h' pattern='^[a-zA-Z0-9' ]+$' title='Accepted characters only'><br>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/h.sql'>H</button>\n";
            echo "<br>";
            echo "<br>";

            echo "<p>I) Highest Food Rating:</p>";
            echo "<div class='row'>\n";
            echo "<div class='col-md-3'>\n";
            echo "Enter Restaurant Type:\n";
            echo "</div>\n";
            echo "<div class='col-md-3'>\n";
            echo "<input type='text' name='i' pattern='^[a-zA-Z0-9' ]+$' title='Accepted characters only'><br>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/i.sql'>I</button>\n";
            echo "<br>";
            echo "<br>";

            echo "<p>J) Most Popular:</p>";
            echo "<div class='row'>\n";
            echo "<div class='col-md-3'>\n";
            echo "Enter Restaurant Type:\n";
            echo "</div>\n";
            echo "<div class='col-md-3'>\n";
            echo "<input type='text' name='j' pattern='^[a-zA-Z0-9' ]+$' title='Accepted characters only'><br>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/j.sql'>J</button>\n";
            echo "<br>";
            echo "<br>";

            echo "\t<h3>Raters and their Ratings</h3>\n";
            echo "<br>";

            echo "<p>K) Information from Highest Overall Rating</p>";
            echo "<div class='row'>\n";
            echo "<div class='col-md-3'>\n";
            echo "Entry not required.\n";
            echo "</div>\n";
            echo "<div class='col-md-3'>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/k.sql'>K</button>\n";
            echo "<br>";
            echo "<br>";

            echo "<p>L) Information from Highest Overall Rating</p>";
            echo "<div class='row'>\n";
            echo "<div class='col-md-3'>\n";
            echo "Entry not required.\n";
            echo "</div>\n";
            echo "<div class='col-md-3'>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/l.sql'>L</button>\n";
            echo "<br>";
            echo "<br>";

            echo "<p>M) Most Frequent Raters:</p>";
            echo "<div class='row'>\n";
            echo "<div class='col-md-3'>\n";
            echo "Enter Restaurant Name:\n";
            echo "</div>\n";
            echo "<div class='col-md-3'>\n";
            echo "<input type='text' name='m' pattern='^[a-zA-Z0-9' ]+$' title='Accepted characters only'><br>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/m.sql'>M</button>\n";
            echo "<br>";
            echo "<br>";

            echo "<p>N) Ratings Lower then Rater John:</p>";
            echo "<div class='row'>\n";
            echo "<div class='col-md-3'>\n";
            echo "Enter Rater Name:\n";
            echo "</div>\n";
            echo "<div class='col-md-3'>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/n.sql'>N</button>\n";
            echo "<br>";
            echo "<br>";

            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/o.sql'>O</button>\n";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "</form>\n";
            echo "<a class='btn btn-lg btn-light' href='adminer.php?pgsql=&username=postgres&db=postgres&ns=restaurants' role='button'>Log into Adminer &raquo;</a>";
        }
        ?>
    </div>
</main>


</body>
</html>