<?php

if ($_POST['password'] == $_POST['confirmpassword']) {
    include 'connect.php';
    $SQL = "SELECT * FROM `user` WHERE `firstname` = '" . $_POST['email'] . "'";
    $Result = $Connection->query($SQL);
    if ($Result->num_rows > 0) {
        while ($Column = $Result->fetch_assoc()) {
            $Notice1 = "The email address that you have entered already exists.";
            $show_modal = true;
        }
    } else {
        $show_modal = false;
    }
    $Connection->close();
    $show_modal = false;
} else {
    echo '<script>alert(\'Passwords don\'t match!\');</script>';
    $Notice2 = "Your passwords do not match. Please try again.";
    $show_modal = true;
}
