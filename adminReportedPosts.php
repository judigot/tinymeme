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
                <h1 class="page-header">Reported Posts</h1>

                <?php
                if (isset($_COOKIE["reportdeletesuccess"])) {
                    echo "<div class='container' style='width: 500px;'>
                            <div class='alert alert-success'>
                                You have successfully dismissed the report.
                            </div>
                         </div>";
                } else if (isset($_COOKIE["reportdeletefail"])) {
                    echo "<div class='container' style='width: 500px;'>
                            <div class='alert alert-danger'>
                                There was an error dismissing the report.
                            </div>
                         </div>";
                } else if (isset($_COOKIE["postdeletesuccess"])) {
                    echo "<div class='container' style='width: 500px;'>
                            <div class='alert alert-success'>
                                The reported post was successfully deleted.
                            </div>
                         </div>";
                } else if (isset($_COOKIE["postdeletefail"])) {
                    echo "<div class='container' style='width: 500px;'>
                            <div class='alert alert-danger'>
                                There was an error deleting the reported post.
                            </div>
                         </div>";
                }
                ?>

                <?php
                include 'connect.php';
                $SQL = "SELECT * FROM `report` INNER JOIN `post` ON report.postId=post.postId ORDER BY reportId DESC";
                $Result = $Connection->query($SQL);
                if ($Result->num_rows > 0) {
                    while ($Column = $Result->fetch_assoc()) {
                        include 'postAdmin.php';
                    }
                } else {
                    echo '<br><br><h1 style="color: darkgray;">No reported posts.</h1>';
                }
                $Connection->close();
                ?>

                <?php include("footer.php"); ?>

            </div>
        </div>








    </body>

</html>