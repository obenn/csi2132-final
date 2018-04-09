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
        if ($_GET['delete'] != null) {
            $itemid = $_GET['delete'];
            pg_query("DELETE FROM restaurants.menuitem WHERE itemid='{$itemid}'") or die('Query failed: ' . pg_last_error());
            echo "<h1>It was that bad eh?</h1>";
            echo "<h3>Back to <a href='restaurants.php'>restaurants</a></h3>";
        } else if ($_GET['id'] != null) {
            $id = $_GET['id'];
            $restaurant = pg_query("SELECT * FROM restaurants.restaurant WHERE restaurantid='{$id}'") or die('Query failed: ' . pg_last_error());
            $restaurant = pg_fetch_array($restaurant, null, PGSQL_ASSOC);
            $types = pg_query("SELECT DISTINCT type FROM restaurants.menuitem WHERE restaurantid='{$id}'") or die('Query failed: ' . pg_last_error());
            while ($type = pg_fetch_array($types, null, PGSQL_ASSOC)['type']) {
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "\t<thead>\n";
                echo "\t\t<tr>\n";
                echo "\t\t\t<th scope=\"col\">Name</th>\n";
                echo "\t\t\t<th scope=\"col\">Category</th>\n";
                echo "\t\t\t<th scope=\"col\">Description</th>\n";
                echo "\t\t\t<th scope=\"col\">Price</th>\n";
                echo "\t\t\t<th scope=\"col\"></th>\n";
                echo "\t\t</tr>\n";
                echo "\t</thead>\n";
                echo "\t<tbody>\n";
                $menuitems = pg_query("SELECT * FROM restaurants.menuitem WHERE type='{$type}' AND restaurantid='{$id}'") or die('Query failed: ' . pg_last_error());
                while ($menuitem = pg_fetch_array($menuitems, null, PGSQL_ASSOC)) {
                    $itemid = $menuitem['itemid'];
                    $name = $menuitem['name'];
                    $category = $menuitem['category'];
                    $description = $menuitem['description'];
                    $price = $menuitem['price'];
                    echo "\t\t<tr>\n";
                    echo "\t\t\t<td>$name</td>\n";
                    echo "\t\t\t<td>$category</td>\n";
                    echo "\t\t\t<td>$description</td>\n";
                    echo "\t\t\t<td>$price</td>\n";
                    echo "\t\t\t<td><a href=\"menu.php?delete=$itemid\">delete</a></td>\n";
                    echo "\t\t</tr>\n";
                }
                echo "\t</tbody>\n";
                echo "</table>\n";
            }

            $exp = pg_query("
                    SELECT menuitem.name, location.managername, location.houropen, restaurant.url
                    FROM menuitem
                    JOIN restaurant ON menuitem.restaurantid = restaurant.restaurantid
                    JOIN location ON restaurant.restaurantid = location.restaurantid
                    WHERE restaurant.restaurantid = $id AND 
                    menuitem.price IN (
                        SELECT MAX(menuitem.price)
                        FROM menuitem
                        JOIN restaurant ON menuitem.restaurantid = restaurant.restaurantid
                        WHERE restaurant.restaurantid = $id /* $$$ */
                        GROUP BY menuitem.restaurantid);") or die('Query failed: ' . pg_last_error());
            $exp = pg_fetch_array($exp, null, PGSQL_ASSOC);
            $name = $exp['name'];
            $manager = $exp['managername'];
            $open = $exp['houropen'];
            $url = $exp['url'];
            echo "<br>";
            echo "<i>Most expensive item is $name</i><br>\n";
            echo "<a class=\"btn btn-lg btn-light\" href=\"additem.php?id=$id\" role=\"button\">New item&raquo;</a>";
            echo "</div>";
            echo "<footer class='footer'>";
            echo "<div class='container'>";
            echo "<span class='text-muted'>Managed by $manager. Opens at $open. <a href=https://$url>$url</a> </span><br>";
            echo "</div>";
            echo "</footer>";
        } else {
            echo "<h4>What are you doing here? Make sure you pick a restaurant</h4>";
        }
        ?>

</main>
</body>
</html>