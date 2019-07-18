<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'head.php'; ?>
        <title>Upload a Post - TinyMeme</title>
    </head>

    <body>

        <div class="container">
            <?php include("userNavbar.php"); ?>

            <!-- Page Content -->
            <div class="container" style="max-width: 650px;">
                <h1 class="page-header">Upload a Post</h1>
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
                        $fileContent = file_get_contents($_FILES['file']['tmp_name']);
                        include 'insertImage.php';
                    }
                }
                ?>
                <div class="uploadpost" style="margin-bottom: 50px;">
                    <form action="createPost.php" method="post" enctype="multipart/form-data">
                        <textarea maxlength="100" id="posttitle" name="posttitle" placeholder="Title" class="fieldinput post-title"class="fieldinput post-title" required><?php
                            if (isset($_POST['posttitle'])) {
                                echo htmlentities($_POST['posttitle']);
                            }
                            ?></textarea>
                        <br><br>
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

            </div>

            <?php include("footer.php"); ?>

        </div>

    </body>

</html>