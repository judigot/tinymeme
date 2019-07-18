<?php

session_start();
if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
    // If someone is logged in
    include("connect.php");
    $SQL = "SELECT type FROM `user` WHERE `userId`='" . $_SESSION['userId'] . "'";
    $Result = $Connection->query($SQL);
    if ($Result->num_rows > 0) {
        while ($Column = $Result->fetch_assoc()) {
            if ($Column['type'] == "admin") {
                header('Location: adminHome.php');
            } else {
                header('Location: userHome.php');
            }
        }
    }
    $Connection->close();
}