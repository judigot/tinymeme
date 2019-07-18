<?php

include 'connect.php';
$SQL = "SELECT * FROM `post` ORDER BY postId DESC LIMIT " . $_POST["start"] . ", " . $_POST["limit"];
//$SQL = "SELECT * FROM `post` WHERE `postId`='100514' ";
$Result = $Connection->query($SQL);
if ($Result->num_rows > 0) {
    while ($Column = $Result->fetch_assoc()) {
        include 'post.php';
    }
}
$Connection->close();
