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
            <li class="nav-item active">
                <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
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

<?php
    if ($_GET['reset']) {
        include 'connection.php';
        $query = file_get_contents('Queries/dropall.sql');
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
        $query = file_get_contents('Queries/Tables.sql');
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    }
?>

<div class="container">
    <div class="jumbotron">
        <h1><i class="fas fa-utensil-spoon"></i> Urbanspork</h1>
        <p><i>A simple site for simple people simply focused on simplicity.</i></p>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <h3><i class="fas fa-utensils"></i> Restaurants and Menus</h3>
            <p>We provide detailed information about restaurants including their locations, hours and menus.</p>
            <p>Don't see you favorite restaurant? Go ahead and add it, you have full control over our database, what could possibly
            go wrong...</p>
            <p><a href="restaurants.php">Get info about a particular resturant</a></p>
            <div class="col-xs-12" style="height:50px;"></div>
        </div>
        <div class="col-sm-3">
            <h3><i class="fas fa-thumbs-up"></i> Ratings and Reviews</h3>
            <p>Browse for your next favorite restaurant by looking what others have to say about it.</p>
            <p>This may or may not be PG-13, depending on how much Bill from accounting despised that casserole.</p>
            <p><a href="ratings.php">Checkout ratings for a particular restaurant</a></p>
            <div class="col-xs-12" style="height:50px;"></div>
        </div>
        <div class="col-sm-3">
            <h3><i class="fas fa-pencil-alt"></i> Raters and reviewers</h3>
            <p>See who's decided to be an armchair critic by looking through our list of raters and see all their reviews.</p>
            <p>Keep in mind that these are anonymous identites, unless someone really was given the name "Meat Lover" at birth, yikes.</p>
            <p><a href="raters.php">Browse through the raters</a></p>
            <div class="col-xs-12" style="height:50px;"></div>
        </div>
        <div class="col-sm-3">
            <h3><i class="fas fa-database"></i> Queries to the database</h3>
            <p>Checkout a few pre-made queries and their outcomes, it's not like we had to make this for a project or anything...</p>
            <p>If you're feeling adventurous hop into our Admin panel directly, our whole security policy is basically just the reset button down below.</p>
            <p><a href="queries.php">Checkout some queries</a></p>
            <div class="col-xs-12" style="height:50px;"></div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <span class="text-muted">By Oliver and Alexandre</span><br>
        <a class="btn btn-sm btn-light mx-auto center-block" href=index.php?reset=true role=button>Reset database</a>
    </div>
</footer>
</body>
</html>