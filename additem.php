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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
        </ul>
    </div>
</nav>

<?php
    if ($_GET['id'] == null) {
        echo "<h2>Whoops, make sure you get here from a restaurant's menu page!</h2>";
    } else {
        $restaurantid = $_GET['id'];
    }
    if ($_POST['name'] != null && $_GET['id'] != null) {
        include 'connection.php';
        $ids = pg_query("SELECT itemid FROM restaurants.menuitem") or die('Query failed: ' . pg_last_error());
        $id = 0;
        while ($d_id = pg_fetch_array($ids, null, PGSQL_ASSOC)) {
            $d_id = $d_id['itemid'];
            if ($d_id != ($id + 1)) {
                break;
            }
            $id++;
        }
        $id++;

        $name = $_POST['name'];
        $type = $_POST['type'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        pg_query("INSERT INTO restaurants.menuitem VALUES ($id, '$name', '$type', '$category', '$description', $price, $restaurantid);") or die('Query failed: ' . pg_last_error());
    }
?>

<main role="main" class="container">
    <div class="jumbotron">
        <h1>Add an item</h1>
        <p>Be sure to fill out all fields</p>
        <?php echo "<form action=\"additem.php?id=$restaurantid\" method=\"post\">"?>

            <div class="row">
                <div class="col-md-4">
                    Name:
                </div>
                <div class="col-md-8">
                    <input type="text" name="name" pattern="^[a-zA-Z0-9' ]+$" title="Accepted characters only"><br>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    Type:
                </div>
                <div class="col-md-8">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-light active">
                            <input type="radio" name="type" value="food" autocomplete="off" checked> Food
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="type" value="beverage" autocomplete="off"> Beverage
                        </label>
                    </div>
                </div>
            </div>

        <div class="row">
            <div class="col-md-4">
                Category:
            </div>
            <div class="col-md-8">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-light active">
                        <input type="radio" name="category" value="starter" autocomplete="off" checked> Starter
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="category" value="main" autocomplete="off"> Main
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="category" value="dessert" autocomplete="off"> Dessert
                    </label>
                </div>
            </div>
        </div>


            <div class="row">
                <div class="col-md-4">
                    Price:
                </div>
                <div class="col-md-8">
                    <input type="text" name="price" pattern="\d*.\d\d" title="In this format XX.XX"><br>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    Description:
                </div>
                <div class="col-md-8">
                    <input type="text" name="description" pattern="^[a-zA-Z0-9' ]+$" title="Accepted characters only"><br>
                </div>
            </div>


            <input type="submit">
        </form>
        </div>

</main>

</div>
</body>
</html>