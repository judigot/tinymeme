<?php

$Server = "localhost";
$Username = "root";
$Password = "";
$DatabaseName = "appjudigot_tinymeme";

$Connection = new mysqli($Server, $Username, $Password, $DatabaseName);
if ($Connection->connect_error) {
    die("Connection failed: " . $Connection->connect_error);
}