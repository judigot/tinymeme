<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'head.php'; ?>
        <title>Home - TinyMeme</title>
        <script>
            function search() {
                if (window.XMLHttpRequest) {
                    xhr = new XMLHttpRequest();
                } else
                {
                    xhr = new ActiveObject('Microsoft.XMLHTTP');
                }
                xhr.onreadystatechange = function () {
                    if ((xhr.readyState == 4) && (xhr.status == 200 || xhr.status == 304))
                    {
                        document.getElementById("feedback").innerHTML = xhr.responseText;

                        document.getElementById("didyoumean").innerHTML = "Did you mean: "
                    }
                };
                xhr.open("GET", 'search.php?userInput=' + document.yolo.userInput.value, true);
                xhr.send();
            }
        </script>
    </head>

    <body>
        <?php
        if (isset($_COOKIE["loginsuccess"])) {
            echo "<script>window.onload = $.notify('What\'s up, " . $_SESSION['firstname'] . "?','success')</script>";
        }
        ?>
        <div class="container">
            <?php include("userNavbar.php"); ?>
            <br>
            <div style="max-width: 600px; min-width: 200px; margin-left: auto; margin-right: auto; text-align: left; font-family: sans-serif;">
                <form id='yolo' name="yolo">
                    <div style="margin-left: auto; margin-right: auto; background-size: 100px 33px; height:33px; width:100px; background-image: url('Assets/images/googlelogo_color_272x92dp.png');" title="Google"></div><br>
                    <div style="margin-left: auto; margin-right: auto;">
                        <input style="font-size: 16px; color: black;" list="suggestions" type="text" class="form-control" name="userInput" id="userInput" onkeyup="search();"/>
                        <datalist id="suggestions" style="font">
                            <option value="how to graduate">
                            <option value="cats">
                            <option value="funny memes">
                            <option value="how to make a baby">
                            <option value="how to fly properly">
                        </datalist>
                    </div>
                    <div id="feedback"></div>
                </form>
            </div>

            <!--Page Content -->
            <div class = "container">
                <br>
                <h1 class="page-header" id="posts">All Posts</h1>

                <?php
                include 'connect.php';
                $SQL = "SELECT * FROM `post` ORDER BY postId DESC";
                $Result = $Connection->query($SQL);
                if ($Result->num_rows > 0) {
                    while ($Column = $Result->fetch_assoc()) {
                        include 'post (With Votes).php';
                    }
                } else {
                    echo '<br><br><br><br><br><br><h1 style="color: darkgray;">Somebody post something!</h1>';
                }
                $Connection->close();
                ?>

                <br>
            </div>

            <?php include("footer.php"); ?>

        </div>

    </body>

</html>