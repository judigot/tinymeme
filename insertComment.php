<?php

session_start();
$TableName = 'comment';

$comment = $_POST['comment'];
$postId = $_GET['postId'];
$userId = $_SESSION["userId"];

$Column = array("comment", "postId", "userId");
$Data = array($comment, $postId, $userId);

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
    $PS = $Connection->prepare($SQL);
    $PS->execute();
    header('Location: mainPostUser.php?postId=' . $postId);
} catch (PDOException $Exception) {
    echo "Error: " . $Exception->getMessage();
    header('Location: mainPostUser.php?postId=' . $postId);
    echo 'Error uploading post!';
}
$Connection->close();
