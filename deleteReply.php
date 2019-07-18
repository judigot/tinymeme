<?php

include("connect.php");
try {
    $SQL = "DELETE FROM `reply` WHERE `replyId`='" . $_GET['replyId'] . "';";
    $PS = $Connection->prepare($SQL);
    $PS->execute();

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
