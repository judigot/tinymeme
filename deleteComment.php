<?php

include("connect.php");
try {
    $SQL = "DELETE FROM `reply` WHERE `reply`.`commentId`='" . $_GET['commentId'] . "';";
    $PS = $Connection->prepare($SQL);
    $PS->execute();

    $SQL = "DELETE FROM `comment` WHERE `commentId`='" . $_GET['commentId'] . "';";
    echo $SQL;
    $PS = $Connection->prepare($SQL);
    $PS->execute();

    setcookie("postdeletesuccess", "0", time() + (1));
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} catch (PDOException $Exception) {
    echo "Error: " . $Exception->getMessage();
    header('Location: mainPostUser.php');
}
$Connection->close();
