<!DOCTYPE html>
<html lang="en">
<head>
    <title>Restaurants</title>
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
            <li class="nav-item active">
                <a class="nav-link" href="restaurants.php"><i class="fas fa-utensils"></i> Restaurants</a>
            </li>
            <li class="nav-item">
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

<?php


?>
<main role="main" class="container">
    <div class="jumbotron">
        <?php
        if ($_POST['id'] != null) {
            require 'connection.php';
            $id = $_POST['id'];
            pg_query("DELETE FROM restaurants.menuitem WHERE restaurantid='{$id}'") or die('Query failed: ' . pg_last_error());
            pg_query("DELETE FROM restaurants.location WHERE restaurantid='{$id}'") or die('Query failed: ' . pg_last_error());
            pg_query("DELETE FROM restaurants.rating WHERE restaurantid='{$id}'") or die('Query failed: ' . pg_last_error());
            pg_query("DELETE FROM restaurants.restaurant WHERE restaurantid='{$id}'") or die('Query failed: ' . pg_last_error());
            echo "<h1>It's gone, completely. <i class=\"fas fa-frown\"></i></h1>";
            echo "<h3>Select a different <a href='restaurants.php'>Restaurant</a></h3>";
            echo "</div>";

        } else if ($_GET['id'] != null) {
            require "connection.php";
            $id = $_GET['id'];

            $restaurant = pg_query("SELECT * FROM restaurants.restaurant WHERE restaurantid='{$id}'") or die('Query failed: ' . pg_last_error());
            $restaurant = pg_fetch_array($restaurant, null, PGSQL_ASSOC);

            $location = pg_query("SELECT * FROM restaurants.location WHERE restaurantid='{$id}'") or die('Query failed: ' . pg_last_error());
            $location = pg_fetch_array($location, null, PGSQL_ASSOC);

            $type = $restaurant['type'];
            $name = $restaurant['name'];
            $url = $restaurant['url'];
            $manager = $location['managername'];
            $phone = $location['phonenumber'];
            $address = $location['streetaddress'];
            $date = $location['firstopendate'];
            $open = $location['houropen'];
            $close = $location['hourclose'];
            echo "<h1>$name</h1>";
            echo "<p>$type</p>";
            echo "<a href=https://$url><p>$url</p></a>";
            echo "<h3>$address</h3>";
            echo "<p>Since $date</p>";
            echo "<p>Managed by $manager : $phone</p>";
            echo "<h4>Hours: $open - $close</h4>";
            echo "<a class=\"btn btn-lg btn-primary\" href=\"menu.php?id=$id\" role=\"button\">Menu &raquo;</a>\n";
            echo "<a class=\"btn btn-lg btn-light\" href=\"ratings.php?id=$id\" role=\"button\">View ratings</a>\n";
            echo "</div>";
            echo "<footer class='footer'>";
            echo "<form action=\"info.php\" method=\"post\">\n";
            echo "<button class=\"btn btn-danger\" type=\"submit\" name='id' value=$id>Delete?</button>\n";
            echo "</footer>";
            echo "</form>";
        } else {
            echo "<h1>Select a <a href='restaurants.php'>Restaurant</a></h1>";
            echo "</div>";
        }
        ?>
</main>


</div>

</body>
</html>