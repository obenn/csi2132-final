<!DOCTYPE html>
<html lang="en">
<head>
    <title>Restaurants</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/grid.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/solid.js" integrity="sha384-P4tSluxIpPk9wNy8WSD8wJDvA8YZIkC6AQ+BfAFLXcUZIPQGu4Ifv4Kqq+i2XzrM" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/fontawesome.js" integrity="sha384-2IUdwouOFWauLdwTuAyHeMMRFfeyy4vqYNjodih+28v2ReC+8j+sLF9cK339k5hY" crossorigin="anonymous"></script>
    <script defer src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script defer src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        a {
            color: #2a2730;
        }
    </style>
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
                <a class="nav-link" href="raters.php"><i class="fas fa-pencil-alt"></i> Raters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="queries.php"><i class="fas fa-database"></i> Queries</a>
            </li>
        </ul>
    </div>
</nav>

<main role="main" class="container">
    <div class="jumbotron">
        <?php
        require "connection.php";
        if ($_GET['type'] != null) {
            $type = $_GET['type'];
            echo "<h2>$type</h2>\n";
            echo "<table class='table'>\n";
            echo "\t<thead>\n";
            echo "\t\t<tr>\n";
            echo "\t\t\t<th scope=\"col\">Name</th>\n";
            echo "\t\t\t<th scope=\"col\">Manager</th>\n";
            echo "\t\t\t<th scope=\"col\">Opening Date</th>\n";
            echo "\t\t</tr>\n";
            echo "\t</thead>\n";
            echo "\t<tbody>\n";

            $locations = pg_query("
                    SELECT restaurants.restaurant.restaurantid,
                    restaurants.restaurant.name,
                    restaurants.location.managername,
                    restaurants.location.firstopendate
                    FROM restaurants.location
                    INNER JOIN restaurants.restaurant ON location.restaurantid = restaurant.restaurantid
                    WHERE restaurant.type = '{$type}';") or die('Query failed: ' . pg_last_error());

                    while ($location = pg_fetch_array($locations, null, PGSQL_ASSOC)) {
                        $id = $location['restaurantid'];
                        $name = $location['name'];
                        $manager = $location['managername'];
                        $date = $location['firstopendate'];

                        echo "<tr>\n";
                        echo "<td>";
                        echo "<a href='info.php?id=$id'>$name</a>";
                        echo "</td>\n";

                        echo "<td>";
                        echo "$manager";
                        echo "</td>\n";

                        echo "<td>";
                        echo "$date";
                        echo "</td>\n";

                        echo "<tr>\n";
                    }
                    echo "\t</tbody>\n";
                    echo "</table>\n";

        } else {
            $types = pg_query("SELECT DISTINCT type FROM restaurants.restaurant") or die('Query failed: ' . pg_last_error());
            while ($type = pg_fetch_array($types, null, PGSQL_ASSOC)['type']) {
                echo "<h2><a href=\"managers.php?type=$type\"'>$type</a></h2>\n";
                echo "<table class='table'>\n";
                echo "\t<thead>\n";
                echo "\t\t<tr>\n";
                echo "\t\t\t<th scope=\"col\">Name</th>\n";
                echo "\t\t\t<th scope=\"col\">Manager</th>\n";
                echo "\t\t\t<th scope=\"col\">Opening Date</th>\n";
                echo "\t\t</tr>\n";
                echo "\t</thead>\n";
                echo "\t<tbody>\n";
                $locations = pg_query("
                    SELECT restaurants.restaurant.restaurantid,
                    restaurants.restaurant.name,
                    restaurants.location.managername,
                    restaurants.location.firstopendate
                    FROM restaurants.location
                    INNER JOIN restaurants.restaurant ON location.restaurantid = restaurant.restaurantid
                    WHERE restaurant.type = '{$type}';") or die('Query failed: ' . pg_last_error());

                while ($location = pg_fetch_array($locations, null, PGSQL_ASSOC)) {
                    $id = $location['restaurantid'];
                    $name = $location['name'];
                    $manager = $location['managername'];
                    $date = $location['firstopendate'];

                    echo "<tr>\n";
                    echo "<td>";
                    echo "<a href='info.php?id=$id'>$name</a>";
                    echo "</td>\n";

                    echo "<td>";
                    echo "$manager";
                    echo "</td>\n";

                    echo "<td>";
                    echo "$date";
                    echo "</td>\n";

                    echo "<tr>\n";
                }
                echo "\t</tbody>\n";
                echo "</table>\n";
            }
        }
        ?>
    </div>
</main>

</body>
</html>