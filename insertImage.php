<?php

//session_start();
$TableName = 'post';

$posttitle = $_POST['posttitle'];
$postUpvote = "0";
$postDownvote = "0";
$userId = $_SESSION["userId"];

$Column = array("postTitle", "post", "postUpvote", "postDownvote", "userId");
$Data = array($posttitle, $fileContent, $postUpvote, $postDownvote, $userId);

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
    setcookie("uploadsuccess", "0", time() + (1));
    header('Location: userPosts.php');
} catch (PDOException $Exception) {
    echo "Error: " . $Exception->getMessage();
    header('Location: createPost.php');
    echo 'Error uploading post!';
}
$Connection->close();
