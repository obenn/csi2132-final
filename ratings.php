<!DOCTYPE html>
<html lang="en">
<head>
    <title>Urbanspork</title>
    <link rel="icon" href="utensil-spoon.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <style>
        a {
            color: #2a2730;
        }
    </style>
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
            <li class="nav-item active">
                <a class="nav-link" href="ratings.php"><i class="fas fa-thumbs-up"></i> Ratings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reviewers.php"><i class="fas fa-pencil-alt"></i> Reviewers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="queries.php"><i class="fas fa-database"></i> Queries</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1>Ratings</h1>
    <?php
    require "connection.php";

    if ($_GET['id'] != null) {
        $id = $_GET['id'];
        $name = pg_query("SELECT name FROM restaurants.restaurant WHERE restaurantid = {$id}") or die('Query failed: ' . pg_last_error());
        $name = pg_fetch_array($name, null, PGSQL_ASSOC)['name'];

        echo "<div class=\"col-xs-12\" style=\"height:50px;\"></div>\n";
        echo "<h2><a href='info.php?id=$id'>$name</a></h2>\n";
        echo "<div class=\"col-xs-12\" style=\"height:50px;\"></div>\n";
        echo "<h4>Ratings</h4>\n";
        echo "<table class='table'>\n";
        echo "<thead>\n";
        echo "<tr>\n";
        echo "<th scope=\"col\">Name</th>\n";
        echo "<th scope=\"col\">Price</th>\n";
        echo "<th scope=\"col\">Food</th>\n";
        echo "<th scope=\"col\">Mood</th>\n";
        echo "<th scope=\"col\">Staff</th>\n";
        echo "<th scope=\"col\">Date</th>\n";
        echo "</tr>\n";
        echo "</thead>\n";
        echo "<tbody>\n";
        $avg_name = 0;
        $avg_price = 0;
        $avg_food = 0;
        $avg_mood = 0;
        $avg_staff = 0;
        $count = 0;
        $ratings = pg_query("SELECT userid, name, price, food, mood, staff, date FROM restaurants.rating NATURAL JOIN restaurants.rater WHERE restaurantid={$id} ORDER BY date DESC;") or die('Query failed: ' . pg_last_error());
        while ($rating = pg_fetch_array($ratings, null, PGSQL_ASSOC)) {
            $userid = $rating['userid'];
            $name = $rating['name'];
            $avg_name += $name;
            $price = $rating['price'];
            $avg_price += $price;
            $food = $rating['food'];
            $avg_food += $food;
            $mood = $rating['mood'];
            $avg_mood += $mood;
            $staff = $rating['staff'];
            $avg_staff += $staff;
            $date = $rating['date'];
            $count++;

            echo "<tr>\n";
            echo "<td><a href='reviewers.php?id={$userid}'>$name</a></td>\n";
            echo "<td>$price</td>\n";
            echo "<td>$food</td>\n";
            echo "<td>$mood</td>\n";
            echo "<td>$staff</td>\n";
            echo "<td>$date</td>\n";
            echo "</tr>\n";
        }

        $avg_price = round($avg_price/$count,1);
        $avg_food = round($avg_food/$count,1);
        $avg_mood = round($avg_mood/$count,1);
        $avg_staff = round($avg_staff/$count,1);

        echo "<tr>\n";
        echo "<td><b>Average</b></td>\n";
        echo "<td><b>$avg_price</b></td>\n";
        echo "<td><b>$avg_food</b></td>\n";
        echo "<td><b>$avg_mood</b></td>\n";
        echo "<td><b>$avg_staff</b></td>\n";
        echo "<td>-</td>\n";
        echo "</tr>\n";
        echo "</tbody>\n";
        echo "</table>\n";

        echo "<div class=\"col-xs-12\" style=\"height:50px;\"></div>\n";
        echo "<h4>Menu Item Ratings</h4>\n";
        echo "<table class='table'>\n";
        echo "<thead>\n";
        echo "<tr>\n";
        echo "<th scope=\"col\">Name</th>\n";
        echo "<th scope=\"col\">Item</th>\n";
        echo "<th scope=\"col\">Rating</th>\n";
        echo "<th scope=\"col\">Comment</th>\n";
        echo "<th scope=\"col\">Date</th>\n";
        echo "</tr>\n";
        echo "</thead>\n";
        echo "<tbody>\n";
        $avg_val = 0;
        $count = 0;

        $ratings = pg_query("select rater.userid, rater.name as rater, menuitem.name as item, rating, comment, date from restaurants.ratingitem natural join restaurants.menuitem left join restaurants.rater on ratingitem.userid = rater.userid where restaurantid=$id order by date desc
") or die('Query failed: ' . pg_last_error());
        while ($rating = pg_fetch_array($ratings, null, PGSQL_ASSOC)) {
            $userid = $rating['userid'];
            $rater = $rating['rater'];
            $item = $rating['item'];
            $value = $rating['rating'];
            $comment = $rating['comment'];
            $date = $rating['date'];
            $avg_val += $value;
            $count++;

            echo "<tr>\n";
            echo "<td><a href='reviewers.php?id={$userid}'>$rater</a></td>\n";
            echo "<td><a href='menu.php?id={$id}'>$item</a></td>\n";
            echo "<td>$value</td>\n";
            echo "<td>$comment</td>\n";
            echo "<td>$date</td>\n";
            echo "</tr>\n";

        }
        $avg_val = round($avg_val/$count, 1);
        echo "</tbody>\n";
        echo "</table>\n";
        echo "<p><b>Average item rating is $avg_val</b></p>";

    } else {
        $restaurants = pg_query("SELECT restaurantid, name FROM restaurants.restaurant") or die('Query failed: ' . pg_last_error());

        while ($restaurant = pg_fetch_array($restaurants, null, PGSQL_ASSOC)) {
            $id = $restaurant['restaurantid'];
            $name = $restaurant['name'];
            echo "<div class=\"col-xs-12\" style=\"height:50px;\"></div>";
            echo "<h4><a href='ratings.php?id=$id'>$name</a></h4>\n";

            $price = pg_query("SELECT AVG(price) AS price FROM restaurants.rating WHERE restaurantid={$id}") or die('Query failed: ' . pg_last_error());
            $price = round(pg_fetch_array($price, null, PGSQL_ASSOC)['price'], 1);
            echo "<div class=\"row\">\n";
            echo "<div class=\"col-md-4\">Price</div>\n";
            echo "<div class='col-md-8'>$price</div>\n";
            echo "</div>\n";

            $food = pg_query("SELECT AVG(food) AS food FROM restaurants.rating WHERE restaurantid={$id}") or die('Query failed: ' . pg_last_error());
            $food = round(pg_fetch_array($food, null, PGSQL_ASSOC)['food'], 1);
            echo "<div class=\"row\">\n";
            echo "<div class=\"col-md-4\">Food</div>\n";
            echo "<div class='col-md-8'>$food</div>\n";
            echo "</div>";

            $mood = pg_query("SELECT AVG(mood) AS mood FROM restaurants.rating WHERE restaurantid={$id}") or die('Query failed: ' . pg_last_error());
            $mood = round(pg_fetch_array($mood, null, PGSQL_ASSOC)['mood'], 1);
            echo "<div class=\"row\">\n";
            echo "<div class=\"col-md-4\">Mood</div>\n";
            echo "<div class='col-md-8'>$mood</div>\n";
            echo "</div>";

            $staff = pg_query("SELECT AVG(staff) AS food FROM restaurants.rating WHERE restaurantid={$id}") or die('Query failed: ' . pg_last_error());
            $staff = round(pg_fetch_array($staff, null, PGSQL_ASSOC)['food'], 1);
            echo "<div class=\"row\">\n";
            echo "<div class=\"col-md-4\">Staff</div>\n";
            echo "<div class='col-md-8'>$staff</div>\n";
            echo "</div>";

            $overall = round(($price + $food + $mood + $staff)/4, 1);
            echo "<div class=\"row\">\n";
            echo "<div class=\"col-md-4\"><b>Overall</b></div>\n";
            echo "<div class='col-md-8'><b>$overall</b></div>\n";
            echo "</div>";
        }
    }

    ?>
</div>
</body>
</html>