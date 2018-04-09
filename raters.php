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
            <li class="nav-item">
                <a class="nav-link" href="ratings.php"><i class="fas fa-thumbs-up"></i> Ratings</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="raters.php"><i class="fas fa-pencil-alt"></i> Raters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="queries.php"><i class="fas fa-database"></i> Queries</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container jumbotron">
    <?php
    require "connection.php";
    if ($_GET['id'] != null) {
        $id = $_GET['id'];
        if ($_POST['delete']) {
            pg_query("DELETE FROM restaurants.rating WHERE userid=$id") or die('Query failed: ' . pg_last_error());
            pg_query("DELETE FROM restaurants.rater WHERE userid=$id") or die('Query failed: ' . pg_last_error());
            echo "<h2>Boom, banned <i class=\"fas fa-gavel\"></i></h2>";
            echo "<p>Back to <a href='raters.php'>raters</a></p>";
        } else {
            $rater = pg_query("SELECT * FROM restaurants.rater WHERE userid=$id") or die('Query failed: ' . pg_last_error());
            $rater = pg_fetch_array($rater, null, PGSQL_ASSOC);

            $email = $rater['email'];
            $name = $rater['name'];
            $date = $rater['joindate'];
            $type = $rater['type'];
            $reputation = $rater['reputation'];

            echo "<h3>$name</h3>\n";
            echo "<p>$email</p>\n";
            echo "<p>Joined on $date</p>\n";
            echo "<p>type $type with reputation $reputation</p>";

            echo "<h4>Reviews</h4>";
            echo "<table class='table'>\n";
            echo "<thead>\n";
            echo "<tr>\n";
            echo "<th scope=\"col\">Name</th>\n";
            echo "<th scope=\"col\">Price</th>\n";
            echo "<th scope=\"col\">Food</th>\n";
            echo "<th scope=\"col\">Mood</th>\n";
            echo "<th scope=\"col\">Staff</th>\n";
            echo "<th scope=\"col\">Comments</th>\n";
            echo "<th scope=\"col\">Date</th>\n";
            echo "</tr>\n";
            echo "</thead>\n";
            echo "<tbody>\n";
            $avg_price = 0;
            $avg_food = 0;
            $avg_mood = 0;
            $avg_staff = 0;
            $count = 0;
            $ratings = pg_query("SELECT restaurantid, name, price, food, mood, staff, comments, date FROM restaurants.rating NATURAL JOIN restaurants.restaurant WHERE userid=$id ORDER BY date DESC;") or die('Query failed: ' . pg_last_error());
            while ($rating = pg_fetch_array($ratings, null, PGSQL_ASSOC)) {
                $resaurantid = $rating['restaurantid'];
                $name = $rating['name'];
                $price = $rating['price'];
                $avg_price += $price;
                $food = $rating['food'];
                $avg_food += $food;
                $mood = $rating['mood'];
                $avg_mood += $mood;
                $staff = $rating['staff'];
                $avg_staff += $staff;
                $date = $rating['date'];
                $comment = $rating['comment'];
                $count++;

                echo "<tr>\n";
                echo "<td><a href='info.php?id={$resaurantid}'>$name</a></td>\n";
                echo "<td>$price</td>\n";
                echo "<td>$food</td>\n";
                echo "<td>$mood</td>\n";
                echo "<td>$staff</td>\n";
                echo "<td>$comment</td>\n";
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
            echo "</tr>\n";
            echo "</tbody>\n";
            echo "</table>\n";

            echo "<h4>Menu Item Reviews</h4>";
            echo "<table class='table'>\n";
            echo "<thead>\n";
            echo "<tr>\n";
            echo "<th scope=\"col\">Restaurant</th>\n";
            echo "<th scope=\"col\">Item</th>\n";
            echo "<th scope=\"col\">Rating</th>\n";
            echo "<th scope=\"col\">Date</th>\n";
            echo "</tr>\n";
            echo "</thead>\n";
            echo "<tbody>\n";
            $avg_rating = 0;
            $count = 0;
            $ratings = pg_query("SELECT restaurant.restaurantid, restaurant.name as restaurant, menuitem.name, rating, date FROM restaurants.ratingitem NATURAL JOIN restaurants.menuitem LEFT JOIN restaurants.restaurant ON restaurants.menuitem.restaurantid = restaurants.restaurant.restaurantid WHERE userid = $id ORDER BY date DESC" .
                "") or die('Query failed: ' . pg_last_error());
            while ($rating = pg_fetch_array($ratings, null, PGSQL_ASSOC)) {
                $restaurantid = $rating['restaurantid'];
                $restaurant = $rating['restaurant'];
                $name = $rating['name'];
                $value = $rating['rating'];
                $date = $rating['date'];
                $avg_rating += $value;
                $count++;

                echo "<tr>\n";
                echo "<td><a href='info.php?id={$restaurantid}'>$restaurant</a></td>\n";
                echo "<td><a href='menu.php?id={$restaurantid}'>$name</td></a>\n";
                echo "<td>$value</td>\n";
                echo "<td>$date</td>\n";
                echo "</tr>\n";
            }

            $avg_rating = round($avg_rating/$count,1);

            echo "<tr>\n";
            echo "<td><b></b></td>\n";
            echo "<td><b>Average</b></td>\n";
            echo "<td><b>$avg_rating</b></td>\n";
            echo "</tr>\n";
            echo "</tbody>\n";
            echo "</table>\n";

            echo "<form action=\"raters.php?id=$id\" method=\"post\">\n";
            echo "<button class=\"btn btn-danger\" type=\"submit\" name='delete' value=true>Delete?</button>\n";
            echo "</form>";
        }
    } else {
        echo "<h1>Raters</h1>";

        $raters = pg_query("SELECT * FROM restaurants.rater ORDER BY reputation DESC") or die('Query failed: ' . pg_last_error());

        echo "<div class=\"row\">\n";
        echo "<div class=\"col-sm-3\">\n";
        echo "<b>Name</b>\n";
        echo "</div>";

        echo "<div class=\"col-sm-3\">\n";
        echo "<b>Join date</b>\n";
        echo "</div>";

        echo "<div class=\"col-sm-3\">\n";
        echo "<b>Reputation</b>\n";
        echo "</div>";

        echo "</div>";
        echo "<br>";

        while ($rater = pg_fetch_array($raters, null, PGSQL_ASSOC)) {
            $id = $rater['userid'];
            $name = $rater['name'];
            $date = $rater['joindate'];
            $reputation = $rater['reputation'];

            echo "<div class=\"row\">\n";
            echo "<div class=\"col-sm-3\">\n";
            echo "<a href='raters.php?id=$id'>$name</a>\n";
            echo "</div>";

            echo "<div class=\"col-sm-3\">\n";
            echo "$date\n";
            echo "</div>";

            echo "<div class=\"col-sm-3\">\n";
            echo "$reputation\n";
            echo "</div>";

            echo "</div>";
            echo "<br>";

        }
        echo "<a class=\"btn btn-lg btn-light\" href=\"addrater.php\" role=\"button\">Add a new rater &raquo;</a>";
    }
    ?>
</div>


</body>
</html>