<!DOCTYPE html>
<html lang="en">
<head>
    <title>Restaurants</title>
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

<div class="container">
    <h1>Our Restaurants</h1>
    <a class="btn btn-lg btn-light" href="add.php" role="button">Create new restaurant &raquo;</a>
    <?php
    require "connection.php";

    $types = pg_query("SELECT DISTINCT type FROM restaurants.restaurant") or die('Query failed: ' . pg_last_error());


    while ($type = pg_fetch_array($types, null, PGSQL_ASSOC)['type']) {
        echo "<div class=\"col-xs-12\" style=\"height:50px;\"></div>";
        echo "<h4>$type</h4>\n";
        echo "<p style='font-size: smaller'><a href=\"managers.php?type=$type\">See managers and location open dates</a></p>";
        echo '<div class="row">';
        echo "\n";
        $restaurants = pg_query("SELECT * FROM restaurants.restaurant WHERE type='{$type}'") or die('Query failed: ' . pg_last_error());
        while ($restaurant = pg_fetch_array($restaurants, null, PGSQL_ASSOC)) {
            $id = $restaurant['restaurantid'];
            $name = $restaurant['name'];
            $url = $restaurant['url'];

            echo '<div class="col-sm-4">';
            echo "<a href=\"info.php?id=$id\">";
            echo $name;
            echo "</a></div>\n";

            echo '<div class="col-sm-4">';
            echo "<a href='https://$url'>$url</a>";
            echo "</div>\n";

            echo '<div class="col-sm-4">';
            echo "<a href=\"menu.php?id=$id\"><p>Menu information</p></a>";
            echo "</div>\n";
        }
        echo "</div>\n";
    }
    ?>
</div>

</body>
</html>