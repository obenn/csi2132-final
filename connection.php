<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=csi2132")
or die('Could not connect: ' . pg_last_error());
pg_query('SET search_path = "restaurants";');