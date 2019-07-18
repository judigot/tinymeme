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
            <?php include("navbar.php"); ?>
            <br>
            <br>

            <!-- Page Content -->
            <div class="container">
                <!--Post-->
                <?php
                include 'connect.php';
                $SQL = "SELECT * FROM `post` WHERE `postId` = '" . $_GET['postId'] . "'";
                $Result = $Connection->query($SQL);
                if ($Result->num_rows > 0) {
                    while ($Column = $Result->fetch_assoc()) {
                        include 'postActive.php';
                    }
                } else {
                    echo '<br><br><br><br><br><br><br><h1 style="color: darkgray;">Hey ' . $_SESSION["firstname"] . ', post something!</h1>';
                }
                $Connection->close();
                ?>
                <?php include 'commentSection.php'; ?>
                <br>

            </div>

            <?php include("footer.php"); ?>

        </div>









    </body>

</html>