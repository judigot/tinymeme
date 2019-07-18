<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'head.php'; ?>
        <title>TinyMeme - Home</title>
    </head>

    <body>
        <?php
        if (isset($_COOKIE["success"])) {
            echo "<script>window.onload = $.notify('What\'s up, admin " . $_SESSION['firstname'] . "?','success')</script>";
        }
        ?>
        <div class="container">
            <?php include("adminNavbar.php"); ?>

            <!--Page Content -->
            <div class = "container">
                <h1 class="page-header">All Posts</h1>

                <?php
                include 'connect.php';
                $SQL = "SELECT * FROM `post` ORDER BY postId DESC";
                $Result = $Connection->query($SQL);
                if ($Result->num_rows > 0) {
                    while ($Column = $Result->fetch_assoc()) {
                        include 'postAdmin.php';
                    }
                } else {
                    echo '<br><br><h1 style="color: darkgray;">Hey ' . $_SESSION["firstname"] . ', post something!</h1>';
                }
                $Connection->close();
                ?>

                <?php include("footer.php"); ?>

            </div>
        </div>








    </body>

</html>