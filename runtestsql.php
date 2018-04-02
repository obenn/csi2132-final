<html>
<head>
    <title>Result</title>
</head>

<body>

<h1>Here's your query</h1>

<button type="button" formaction="index.php">Back</button>

<?php

$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=csi2132")
or die('Could not connect: ' . pg_last_error());

$query = file_get_contents('test.sql');
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);

?>

</body?
</html>

