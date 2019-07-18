<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'head.php'; ?>
        <title>Home - TinyMeme</title>
    </head>

    <body>
        <?php
        if (isset($_COOKIE["loginsuccess"])) {
            echo "<script>window.onload = $.notify('What\'s up, " . $_SESSION['firstname'] . "?','success')</script>";
        }
        ?>
        <div class="container">
            <?php include("userNavbar.php"); ?>

            <!--Page Content -->
            <div class = "container">
                <h1 class="page-header">All Posts</h1>

                <?php
                include 'connect.php';
                $SQL = "SELECT * FROM `post` ORDER BY postId DESC";
                $Result = $Connection->query($SQL);
                if ($Result->num_rows > 0) {
                    while ($Column = $Result->fetch_assoc()) {
                        include 'post (With Votes).php';
                    }
                } else {
                    echo '<br><br><br><br><br><br><h1 style="color: darkgray;">Somebody post something!</h1>';
                }
                $Connection->close();
                ?>

                <br>
            </div>

            <?php include("footer.php"); ?>

        </div>

    </body>

</html>