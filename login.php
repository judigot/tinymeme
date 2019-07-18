<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'head.php'; ?>
        <title>Log In - TinyMeme</title>
    </head>

    <body>

        <div class="container">

            <?php include("navbar.php"); ?>

            <!-- Page Content -->
            <div class="container">
                <!--Login Form-->
                <h1 class="page-header">Login</h1>
                <?php
                if (isset($_COOKIE["createaccountsuccess"])) {
                    echo "<div class='container' style='width: 500px;'>
                            <div class='alert alert-success'>
                                You have successfully created your account. Please log in.
                            </div>
                         </div>";
                } else if (isset($_COOKIE["loginerror"])) {
                    echo "<div class='container' style='width: 500px;'>
                            <div class='alert alert-danger'>
                                The email address and password that you have<br>entered did not match at all!
                            </div>
                         </div>";
                } else if (isset($_COOKIE["logoutsuccess"])) {
                    echo "<script>window.onload = $.notify('Until next time!','success')</script>";
                }
                ?>
                <div class="loginform">
                    <form action="loginFilter.php" method="post">
                        <input value="<?php
                        if (isset($_SESSION["email"])) {
                            echo htmlentities($_SESSION["email"]);
                        }
                        ?>" size="5" type="email" id="email" name="email" maxlength="32" class="form-control input-sm chat-input emailinput" placeholder="Email Address" required><br>
                        <input type="password" id="password" name="password" maxlength="32" class="form-control input-sm chat-input passinput" placeholder="Password" required>
                        <center><br><br>
                            <div class="wrapper">
                                <span class="group-btn">
                                    <input type="submit" class="btn login" value="Log In"><br><br>
                                    <!--<a href="createAccount.php" class="btn btn-default btn-createaccount">Create Account</a>-->
                                </span>
                            </div>
                        </center>
                    </form>
                </div>

            </div>

            <?php include("footer.php"); ?>

        </div>

    </body>

</html>