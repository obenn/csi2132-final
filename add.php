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
    if ($_POST['name'] != null) {
        include 'connection.php';
        $ids = pg_query("SELECT restaurantid FROM restaurants.restaurant") or die('Query failed: ' . pg_last_error());
        $id = 0;
        while ($d_id = pg_fetch_array($ids, null, PGSQL_ASSOC)) {
            $d_id = $d_id['restaurantid'];
            if ($d_id != ($id + 1)) {
                break;
            }
            $id++;
        }
        $id++;

        $name = $_POST['name'];
        $type = $_POST['type'];
        $url = $_POST['url'];
        pg_query("INSERT INTO restaurants.restaurant VALUES ($id, '$name', '$type', '$url');") or die('Query failed: ' . pg_last_error());
        $manager = $_POST['managername'];
        $phone = $_POST['phonenumber'];
        $address = $_POST['streetaddress'];
        $open = $_POST['houropen'];
        $close = $_POST['hourclose'];
        $date = date('Y-m-d');
        pg_query("INSERT INTO restaurants.location VALUES ($id,'$date','$manager','$phone','$address','$open','$close',$id);") or die('Query failed: ' . pg_last_error());
    }
?>

<main role="main" class="container">
    <div class="jumbotron">
        <h1>Create a new restaurant</h1>
        <p>Be sure to fill out all fields</p>
        <form action="add.php" method="post">

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
                    Url:
                </div>
                <div class="col-md-8">
                    <input type="text" name="url" pattern="[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)" title="Valid url www.example.com"><br>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    Type:
                </div>
                <div class="col-md-8">
                    <input type="text" name="type" pattern="^[a-zA-Z' ]+$" title="Characters only"><br>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    Manager:
                </div>
                <div class="col-md-8">
                    <input type="text" name="managername" pattern="^([ 00c0-01ffa-zA-Z'\-])+$" title="Standard name only, no symbols or letters"><br>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    Phone Number:
                </div>
                <div class="col-md-8">
                    <input type="text" name="phonenumber" pattern="([2-9][0-8][0-9])\W*([2-9][0-9]{2})\W*([0-9]{4})(\se?x?t?(\d*))?" title="Standard phone number XXX-XXX-XXXX"><br>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    Street Address:
                </div>
                <div class="col-md-8">
                    <input type="text" name="streetaddress" pattern=" /^\s*\S+(?:\s+\S+){2}/" title="Number, street, type. E.g. 50 Varley Lane"><br>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    Open:
                </div>
                <div class="col-md-8">
                    <input type="text" name="houropen" pattern="^(?:0?[0-9]|1[0-2]):[0-5][0-9][AaPp][mM]$" title="Time in 12hr am/pm format, ex: 9:00am"><br>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    Close:
                </div>
                <div class="col-md-8">
                    <input type="text" name="hourclose" pattern="^(?:0?[0-9]|1[0-2]):[0-5][0-9][AaPp][mM]$" title="Time in 12hr am/pm format, ex: 10:00pm"><br>
                </div>
            </div>

            <input type="submit">
        </form>
        </div>
    </div>
</main>

</div>
</body>
</html>