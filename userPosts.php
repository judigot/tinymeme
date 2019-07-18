<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'head.php'; ?>
        <title><?php echo $_SESSION["fullname"]; ?> - TinyMeme</title>
    </head>

    <body>

        <div class="container">
            <?php include("userNavbar.php"); ?>

            <div style="margin-top: 30px;">
                <?php
                if (isset($_COOKIE["changeprofpicsuccess"])) {
                    echo "<div class='container' style='width: 500px;'>
                            <div class='alert alert-success'>
                                You have successfully changed your profile picture.
                            </div>
                         </div>";
                } else if (isset($_COOKIE["changeprofpicfail"])) {
                    echo "<div class='container' style='width: 500px;'>
                            <div class='alert alert-danger'>
                                There was an error changing your profile picture.
                            </div>
                         </div>";
                } else if (isset($_COOKIE["removeprofpicsuccess"])) {
                    echo "<div class='container' style='width: 500px;'>
                            <div class='alert alert-success'>
                                Your profile picture was set to default.
                            </div>
                         </div>";
                } else if (isset($_COOKIE["removeprofpicfail"])) {
                    echo "<div class='container' style='width: 500px;'>
                            <div class='alert alert-danger'>
                                There was an error changing your profile picture to default.
                            </div>
                         </div>";
                } else if (isset($_COOKIE["uploadsuccess"])) {
                    echo "<div class='container' style='width: 500px;'>
                            <div class='alert alert-success'>
                                You have successfully uploaded your post.
                            </div>
                         </div>";
                } else if (isset($_COOKIE["postdeletesuccess"])) {
                    echo "<div class='container' style='width: 500px;'>
                            <div class='alert alert-success'>
                                Your post was successfully deleted.
                            </div>
                         </div>";
                }

                include 'connect.php';
                $SQL = "SELECT `profilepicture` FROM `user` WHERE `userId`='" . $_SESSION['userId'] . ">';";
                $Result = $Connection->query($SQL);
                if ($Result->num_rows > 0) {
                    while ($Column = $Result->fetch_assoc()) {
                        $ProfilePicture = $Column['profilepicture'];
                        $_SESSION['profilepicture'] = $Column['profilepicture'];
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

            </div>

            <script>
                $(document).ready(function () {
                    $('#toggle').hover(function () {
                        $('#changeprofpic').toggle();
                    });
                });
            </script>

            <!-- Page Content -->
            <div class="container">
                <?php
                include 'connect.php';
                $SQL = "SELECT * FROM `post` WHERE `userId` = '" . $_SESSION['userId'] . "' ORDER BY `post`.`postId` DESC";
                $Result = $Connection->query($SQL);
                if ($Result->num_rows > 0) {
                    echo "<h1 class='page-header'>Your Posts</h1>";
                    while ($Column = $Result->fetch_assoc()) {
                        include 'postUser.php';
                    }
                } else {
                    echo '<br><br><h1 style="color: darkgray;">Hey ' . $_SESSION["firstname"] . ', post something!</h1>';
                }
                $Connection->close();
                ?>
                <br>
            </div>

            <?php include("footer.php"); ?>

        </div>

    </body>

</html>