<?php

$TableName = 'user';

$firstname = ucwords($_POST['firstname']);
$lastname = ucwords($_POST['lastname']);
$email = $_POST['email'];
$password = md5($_POST['password']);
$birthmonth = $_POST['birthmonth'];
$birthday = $_POST['birthday'];
$birthyear = $_POST['birthyear'];
$birthdate = $birthyear . "-" . $birthmonth . "-" . $birthday;
$gender = $_POST['gender'];
$address = ucwords($_POST['address']);

$Column = array("firstname", "lastname", "email", "password", "birthdate", "gender", "address");
$Data = array($firstname, $lastname, $email, $password, $birthdate, $gender, $address);

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
    session_destroy();
    session_start();
    $_SESSION["email"] = $_POST['email'];
    setcookie("createaccountsuccess", "0", time() + (1));
    header('Location: login.php');
} catch (PDOException $Exception) {
    echo "Error: " . $Exception->getMessage();
    header('Location: createAccount.php');
}
$Connection->close();
