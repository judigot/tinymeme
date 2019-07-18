<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'head.php'; ?>
        <title>Create Account - TinyMeme</title>
    </head>

    <body>

        <div class="container">

            <?php include("navbar.php"); ?>

            <!-- Page Content -->
            <div class="container" style="max-width: 650px;">
                <h1 class="page-header">Create Account</h1>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $Error = 0;
                    // Email Validation
                    include 'connect.php';
                    $SQL = "SELECT * FROM `user` WHERE `email` = '" . $_POST['email'] . "'";
                    $Result = $Connection->query($SQL);
                    if ($Result->num_rows > 0) {
                        $Error += 1;
                        while ($Column = $Result->fetch_assoc()) {
                            echo "<div class='alert alert-danger'>
                                          The email address <strong>'" . $_POST['email'] . "'</strong> is already in use. Please use a different one.
                                 </div>";
                        }
                    }

                    $Connection->close();
                    // Password Validation
                    if ($_POST['password'] != $_POST['confirmpassword']) {
                        $Error += 1;
                        echo "<div class='alert alert-danger'>
                                The passwords do not match.
                              </div>";
                    }
                    if ($Error == 0) {
                        include 'insertUser.php';
                    }
                }
                ?>
                <?php include("createAccountForm.php"); ?>

            </div>

            <?php include("footer.php"); ?>

        </div>









    </body>

</html>