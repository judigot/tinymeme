<?php

$reportId = $_GET['reportId'];
include("connect.php");
try {
    $SQL = "DELETE FROM `report` WHERE `report`.`reportId` = " . $reportId . ";";
    $PS = $Connection->prepare($SQL);
    $PS->execute();
    setcookie("reportdeletesuccess", "0", time() + (1));
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} catch (PDOException $Exception) {
    echo "Error: " . $Exception->getMessage();
    setcookie("reportdeletefail", "0", time() + (1));
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$Connection->close();
