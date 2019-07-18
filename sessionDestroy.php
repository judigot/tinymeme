<?php

session_start();
//session_destroy();
unset($_SESSION["userId"]);
unset($_SESSION["firstname"]);
unset($_SESSION["fullname"]);
setcookie("logoutsuccess", "0", time() + (1));
header('Location: login.php');
