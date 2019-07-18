<?php ob_start(); ?>
<?php include 'checkLoggedOutUser.php'; ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #DDDDDD;">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="adminHome.php"><img class="navbar-brand" src="Assets/images/logo.png" style="width: 10%; height: 10%; padding: opx;"></a>
            <a class="navbar-brand" href="adminHome.php">TinyMeme</a>

        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right admin">
                <li>
                    <a href="adminHome.php">Home</a>
                </li>
                <li>
                    <a href="adminAnnouncements.php"><?php echo $_SESSION["fullname"]; ?></a>
                </li>
                <li>
                    <a href="adminReportedPosts.php">Reported Posts</a>
                </li>
                <li>
                    <a href="sessionDestroy.php">Log Out</a>
                </li>
            </ul>
        </div>
    </div>

</nav>