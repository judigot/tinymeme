<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'head.php'; ?>
        <title><?php echo $_GET['fullname']; ?> - TinyMeme</title>
    </head>

    <body>

        <div class="container">
            <?php include("navbar.php"); ?>

            <!-- Page Content -->
            <div class="container">
                <?php
                include 'connect.php';
                $SQL = "SELECT * FROM `post` WHERE `userId` = '" . $_GET['userId'] . "' ORDER BY `post`.`postId` DESC";
                $Result = $Connection->query($SQL);
                if ($Result->num_rows > 0) {
                    if (substr($_GET['fullname'], -1) == 's' || substr($_GET['fullname'], -1) == 'z') {
                        echo "<h1 class='page-header'>" . $_GET['fullname'] . "' Posts</h1>";
                    } else {
                        echo "<h1 class='page-header'>" . $_GET['fullname'] . "'s Posts</h1>";
                    }
                    while ($Column = $Result->fetch_assoc()) {
                        include 'postII.php';
                    }
                } else {
                    echo '<br><br><br><br><br><br><br><br><h1 style="color: darkgray;">' . $_GET['fullname'] . ' has no posts yet.</h1>';
                }
                $Connection->close();
                ?>

                <br>

            </div>

            <?php include("footer.php"); ?>

        </div>









    </body>

</html>