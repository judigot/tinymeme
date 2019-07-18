<?php

session_start();
if (isset($_SESSION[$email])) {
    header('Location: ' . $_SERVER['REQUEST_URI']);
    include 'createPost.php';
} else {
    echo '<script language="javascript">alert("Please log in first!");</script>';
}