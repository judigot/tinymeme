<?php

//Store Credentials
$email = $_POST['email'];
$password = md5($_POST['password']);

include("connect.php");
$SQL = "SELECT * FROM `user` WHERE `email` = '$email' AND `password` = '$password'";
$Result = $Connection->query($SQL);
if ($Result->num_rows > 0) {
    while ($Column = $Result->fetch_assoc()) {
        session_start();
        include 'sessionSet.php';
        if ($Column['type'] == "admin") {
            setcookie("loginsuccess", "0", time() + (1));
            header('Location: adminHome.php');
        } else {
            setcookie("loginsuccess", "0", time() + (1));
            header('Location: userHome.php');
        }
    }
} else {
    session_start();
    $_SESSION["email"] = $_POST['email'];
    setcookie("loginerror", "0", time() + (1));
    header('Location: login.php');
}
$Connection->close();
