<?php

session_start();
$_SESSION["userId"] = $Column['userId'];
$_SESSION["profilepicture"] = $Column['profilepicture'];
$_SESSION["email"] = $Column['email'];
$_SESSION["firstname"] = $Column['firstname'];
$_SESSION["fullname"] = $Column['firstname'] . " " . $Column['lastname'];
