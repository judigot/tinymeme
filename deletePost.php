<?php

$postId = $_GET['postId'];
include("connect.php");
try {
    $SQL = "DELETE FROM `upvote` WHERE `upvote`.`postId` = " . $postId . ";";
    $PS = $Connection->prepare($SQL);
    $PS->execute();

    $SQL = "DELETE FROM `downvote` WHERE `downvote`.`postId` = " . $postId . ";";
    $PS = $Connection->prepare($SQL);
    $PS->execute();

    $SQL = "DELETE FROM `comment` WHERE `comment`.`postId` = " . $postId . ";";
    $PS = $Connection->prepare($SQL);
    $PS->execute();

    $SQL = "DELETE FROM `report` WHERE `report`.`postId` = " . $postId . ";";
    $PS = $Connection->prepare($SQL);
    $PS->execute();

    $SQL = "DELETE FROM `post` WHERE `post`.`postId` = " . $postId . ";";
    $PS = $Connection->prepare($SQL);
    $PS->execute();
    setcookie("postdeletesuccess", "0", time() + (1));
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} catch (PDOException $Exception) {
    echo "Error: " . $Exception->getMessage();
    setcookie("postdeletefail", "0", time() + (1));
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$Connection->close();
