<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'head.php'; ?>
        <title><?php echo $_GET['fullname']; ?> - TinyMeme</title>
    </head>

    <body>

        <div class="container">
            <?php include("userNavbar.php"); ?>

            <!-- Page Content -->
            <div style="margin-top: 30px;">
                <?php
                include 'connect.php';
                $SQL = "SELECT `profilepicture` FROM `user` WHERE `userId`='" . $_GET['userId'] . ">';";
                $Result = $Connection->query($SQL);
                if ($Result->num_rows > 0) {
                    while ($Column = $Result->fetch_assoc()) {
                        $ProfilePicture = $Column['profilepicture'];
                    }
                }
                $Connection->close();
                ?>

                <!--Profile Picture-->
                <div id="toggle" style="position: relative; display: inline-block; height: 200px; width: 200px; box-shadow: inset 0px 10px 20px 10px rgba(0, 0, 0, .6); border-radius: 10px; background-position: center; background-size: cover; background-image: url('Profile Pictures/<?php echo $ProfilePicture; ?>');">
                    <div hidden id="changeprofpic">
                        <a href="changeProfilePicture.php" style="text-decoration: none;"><p class="" style="color: gray; background-color: #EEEEEE; position: absolute; bottom: 0px; font-size: 20px;">Update Profile Picture</p></a>
                    </div>
                </div>


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
                        include 'post (With Votes).php';
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