<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'head.php'; ?>
        <title>Update Profile Picture - TinyMeme</title>
    </head>

    <body>

        <div class="container">
            <?php include("userNavbar.php"); ?>

            <!-- Page Content -->
            <div class="container" style="max-width: 650px;">
                <h1 class="page-header">Update Profile Picture</h1>
                <?php
                // Button Click Action
                if (isset($_POST['submit'])) {
                    // File Object
//                    $file = $_FILES['file'];
                    // Get file information
                    $fileName = $_FILES['file']['name'];
                    $fileType = $_FILES['file']['type'];
                    $fileSize = $_FILES['file']['size'];

                    /* Check for errors
                      $fileError = $_FILES['file']['error'];
                      if ($fileError === 0) {}
                     */

                    // Declare file types to be uploaded
                    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

                    // Separate filename from file extension
                    $fileExt = explode('.', $fileName);

                    // Convert file extension to lowercase
                    $fileActualExt = strtolower(end($fileExt));

                    $fileSizeLimitInKilobyte = 2000;
                    $Error = 0;

                    // Check file type
                    if (in_array($fileActualExt, $allowed) == false) {
                        // If not allowed
                        $Error += 1;
                        echo "<div class='alert alert-danger'>"
                        . "The file type <strong>'" . $fileActualExt . "'</strong> is not allowed here on <strong>TinyMeme</strong>. Upload your crap somewhere else.
                             </div>";
                    }

                    // Check file size
                    if ($fileSize > $fileSizeLimitInKilobyte * 1000 || $fileSize == 0) {
                        $Error += 1;
                        echo "<div class='alert alert-danger'>
                                Invalid file size. A maximum of <strong>2 MB</strong> is allowed.
                             </div>";
                    }

                    if ($Error == 0) {
                        $fileContent = ($_FILES['file']['tmp_name']);
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = 'Profile Pictures/' . $fileNameNew;

                        include 'connect.php';
                        $SQL = "UPDATE `user` SET `profilepicture` = '$fileNameNew' WHERE `user`.`userId` = " . $_SESSION['userId'] . ";";
                        try {
                            $PS = $Connection->prepare($SQL);
                            $PS->execute();
                            move_uploaded_file($fileContent, $fileDestination);
                            setcookie("changeprofpicsuccess", "0", time() + (1));
                            $_SESSION['profilepicture'] = $fileNameNew;
                            header("Location: userPosts.php?");
                        } catch (PDOException $ex) {
                            echo "Error: " . $Exception->getMessage();
                            setcookie("changeprofpicfail", "0", time() + (1));
                            header('Location: changeProfilePicture.php');
                        }
                        $Connection->close();
                    }
                }
                ?>
                <div class="uploadpost" style="margin-bottom: 50px; padding-top: 0%; padding-left: 10%; padding-right: 10%;">
                    <form action="changeProfilePicture.php" method="post" enctype="multipart/form-data">
                        <br>
                        <?php
                        if ($_SESSION['profilepicture'] != "Default.png") {
                            echo "<button type='button' class='btn btn-danger btn-block' data-toggle='confirmation' href='removeProfilePicture.php' title='Your profile picture will be set to default. Continue?'>Remove Profile Picture</button><br>";
                        }
                        ?>
                        <div style="display: table; margin: auto; background-color: #DDDDDD; color: black; padding: 10px; border-radius: 20px; font-size: 20px;">
                            <input type="file" name="file" accept="image/*" style="text-align: center;" required>
                        </div><br>
                        <div class="wrapper">
                            <span class="group-btn">
                                <input type="submit" name="submit" class="btn upload" value="Upload">
                            </span>
                        </div>
                    </form>
                </div>

                <script>
                    $('[data-toggle=confirmation]').confirmation({
                        rootSelector: '[data-toggle=confirmation]',
                    });
                </script>

            </div>

            <?php include("footer.php"); ?>

        </div>

    </body>

</html>