<?php

if (!isset($_SESSION['userId']) && empty($_SESSION['userId'])) {
    header('Location: index.php');
}