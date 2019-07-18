<?php

include 'connect.php';
$SQL = "SELECT * FROM `user`";

$Result = $Connection->query($SQL);
if ($Result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
    while ($Column = $Result->fetch_assoc()) {
        echo "<tr><td>" . $Column["firstname"] . "</td><td>" . $Column["lastname"] . " " . $Column["type"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$Connection->close();
?>