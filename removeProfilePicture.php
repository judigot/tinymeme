<?php

session_start();
include 'connect.php';
$DefaultProfilePicture = "Default.png";
$SQL = "UPDATE `user` SET `profilepicture` = '$DefaultProfilePicture' WHERE `user`.`userId` = " . $_SESSION['userId'] . ";";

try {
    $PS = $Connection->prepare($SQL);
    $PS->execute();
    setcookie("removeprofpicsuccess", "0", time() + (1));
    unlink("Profile Pictures/" . $_SESSION['profilepicture']);
    $_SESSION['profilepicture'] = $DefaultProfilePicture;
    header("Location: userPosts.php?");
} catch (PDOException $ex) {
    echo "Error: " . $Exception->getMessage();
    setcookie("removeprofpicfail", "0", time() + (1));
    header('Location: changeProfilePicture.php');
}
$Connection->close();
