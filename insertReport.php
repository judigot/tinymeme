<?php

session_start();
$TableName = 'report';

$postId = $_GET['postId'];
$postOwnerId = $_GET["postOwnerId"];
$reporterId = $_SESSION["userId"];

$Column = array("postId", "postOwnerId", "reporterId");
$Data = array($postId, $postOwnerId, $reporterId);

include("connect.php");
try {
    $SQL = "INSERT INTO `" . $TableName . "` (";
    // Retrieve Column Names
    foreach ($Column as $Value) {
        $SQL = $SQL . "`" . $Value . "`, ";
    }
    $SQL = substr($SQL, 0, -2) . ") VALUES ('";
    // Retrieve Data Input
    foreach ($Data as $Value) {
        // Escape User Input
        $SQL = $SQL . mysqli_real_escape_string($Connection, $Value) . "', '";
    }
    $SQL = substr($SQL, 0, -3) . ");";
    echo $SQL;
    $PS = $Connection->prepare($SQL);
    $PS->execute();
    setcookie("reportsuccess", "0", time() + (1));
    header('Location: mainPostUser.php?postId=' . $postId);
} catch (PDOException $Exception) {
    echo "Error: " . $Exception->getMessage();
    setcookie("reportfail", "0", time() + (1));
    header('Location: mainPostUser.php?postId=' . $postId);
    echo 'Error uploading post!';
}
$Connection->close();
