<?php session_start(); ?>
<?php
include 'connect.php';
$SQL = "SELECT `postTitle` FROM `post` WHERE `postId` = '" . $_GET['postId'] . "'";
$Result = $Connection->query($SQL);
if ($Result->num_rows > 0) {
    while ($Column = $Result->fetch_assoc()) {
        $PostTitle = $Column['postTitle'];
    }
} else {
    $PostTitle = "User Post";
}
$Connection->close();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'head.php'; ?>
        <title><?php echo $PostTitle; ?> - TinyMeme</title>
    </head>

    <body>

        <div class="container">
            <?php include('adminNavbar.php'); ?>
            <br>
            <br>
            <?php
            if (isset($_COOKIE["reportsuccess"])) {
                echo "<div class='container' style='width: 500px;'>
                    <div class='alert alert-success'>
                        Your report was successfully sent.
                    </div>
                 </div>";
            } else if (isset($_COOKIE["reportfail"])) {
                echo "<div class='container' style='width: 500px;'>
                    <div class='alert alert-danger'>
                        There was an error sending your report.
                    </div>
                 </div>";
            } else if (isset($_COOKIE["logoutsuccess"])) {
                echo "<script>window.onload = $.notify('Until next time!','success')</script>";
            }
            ?>
            <!-- Page Content -->
            <div class="container">

                <?php
                include 'connect.php';
                $SQL = "SELECT * FROM `post` WHERE `postId` = '" . $_GET['postId'] . "'";
                $Result = $Connection->query($SQL);
                if ($Result->num_rows > 0) {
                    while ($Column = $Result->fetch_assoc()) {
                        include 'postUserActive.php';
                    }
                } else {
                    echo '<br><br><br><br><br><br><br><h1 style="color: darkgray;">Hey ' . $_SESSION["firstname"] . ', post something!</h1>';
                }
                $Connection->close();
                ?>
                <?php include 'commentSectionUser.php'; ?>
                <br>

            </div>

            <?php include('footer.php'); ?>

        </div>

    </body>

</html>