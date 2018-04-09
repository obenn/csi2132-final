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
                if ($_POST['name'] != null) {
                    $name = $_POST['name'];
                } else {
                    $name = "*";
                }
                echo "<h2>Query A</h2>";
                echo "<p>Display all the information about a user‐specified restaurant. That is, the user should select the
	            name of the restaurant from a list, and the information as contained in the restaurant and
	            location tables should then displayed on the screen.</p>";
                $query = file_get_contents($query)."'$name'";
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
                $results = pg_query($query) or die('Query failed: ' . pg_last_error());
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
            }
            if ($query == "Queries/b.sql") {


                if ($_POST['name'] != null) {
                    $name = $_POST['name'];
                } else {
                    $name = "*";
                }


                echo "<h2>Query B</h2>";
                echo "<p>Display the full menu of a specific restaurant. That is, the user should select the name of the
	            restaurant from a list, and all menu items, together with their prices, should be displayed on the
	            screen. The menu should be displayed based on menu item categories.</p>";
                $query = file_get_contents($query)."'$name'";

                echo "<code>$query</code>";
                echo "<h2>$type</h2>\n";
                echo "<table class='table'>\n";
                echo "<thead>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Name</th>\n";
                echo "<th scope=\"col\">Type</th>\n";

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

                    echo "<tr>\n";
                    echo "<td>$name</td>\n";
                    echo "<td>$type</td>\n";
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
            echo "<input type='text' name='name' pattern='^[a-zA-Z0-9' ]+$' title='Accepted characters only'><br>\n";
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
            echo "<input type='text' name='name' pattern='^[a-zA-Z0-9' ]+$' title='Accepted characters only'><br>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/b.sql'>B</button>\n";
            echo "<br>";
            echo "<br>";

            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/c.sql'>C</button>\n";
            echo "<br>";
            echo "<br>";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/d.sql'>D</button>\n";
            echo "<br>";
            echo "<br>";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/e.sql'>E</button>\n";
            echo "<br>";
            echo "<br>";
            echo "\t<h3>Ratings of Restaurants</h3>\n";
            echo "<br>";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/f.sql'>F</button>\n";
            echo "<br>";
            echo "<br>";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/g.sql'>G</button>\n";
            echo "<br>";
            echo "<br>";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/h.sql'>H</button>\n";
            echo "<br>";
            echo "<br>";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/i.sql'>I</button>\n";
            echo "<br>";
            echo "<br>";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/j.sql'>J</button>\n";
            echo "<br>";
            echo "<br>";
            echo "\t<h3>Raters and their Ratings</h3>\n";
            echo "<br>";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/k.sql'>K</button>\n";
            echo "<br>";
            echo "<br>";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/l.sql'>L</button>\n";
            echo "<br>";
            echo "<br>";
            echo "\t<button type='submit' class='btn btn-lg btn-light' name='query' value='Queries/m.sql'>M</button>\n";
            echo "<br>";
            echo "<br>";
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