<?php

/* Provide table name ($TableName).
 * Store column names ($Column) and field values ($Data) in an array.
 * Provide database connection ($Server, $Username, $Password, $DatabaseName)
 * */

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
    header('Location: login.php');
} catch (PDOException $Exception) {
    echo "Error: " . $Exception->getMessage();
    header('Location: createAccount.php');
}
$Connection->close();
