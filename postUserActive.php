<?php

// Atay ay!
// Getting Vote Count
$SQL1 = "SELECT (SELECT COUNT(postId) FROM upvote WHERE postId='" . $Column['postId'] . "') AS 'postUpvote', (SELECT COUNT(postId) FROM downvote WHERE postId='" . $Column['postId'] . "') AS 'postDownvote', post.userId FROM post WHERE post.postId='" . $Column['postId'] . "'";
$Result1 = $Connection->query($SQL1);
if ($Result1->num_rows > 0) {
    while ($Column1 = $Result1->fetch_assoc()) {
        $postUpvote = $Column1['postUpvote'];
        $postDownvote = $Column1['postDownvote'];
    }
} else {
    $postUpvote = 0;
    $postDownvote = 0;
}

echo "
<!--Title-->
<div class='user-post active' style='position: relative;'>";

// Check if the post doesn't belong to the logged in user display report option
if ($Column['userId'] == $_SESSION['userId']) {
    echo "<i title='Your post' data-toggle='tooltip' style='color: #005795;' class='fa fa-user fa-2x' aria-hidden='true'></i>";
} else if ($_SESSION['userId'] != $Column['userId']) {
    echo "<div href='insertReport.php?postId=" . $Column['postId'] . "&postOwnerId=" . $Column['userId'] . "' class='dropdown' style='cursor: pointer; cursor: hand; position: absolute; top: 5px; right: 25px;' data-toggle='confirmation' data-placement='bottom' data-popout='true' title='Are you sure you want to report this post?'>
            <i class='fa fa-flag fa-1x' aria-hidden='true' style='color: gray;'><span style='color: gray; font-size: 10px; font-family: Trebuchet MS;'>&nbsp Report</span></i>
        </div>
        <script>
            $('[data-toggle=confirmation]').confirmation({
              rootSelector: '[data-toggle=confirmation]',
              onCancel: function() {
                <!--window.location.href = '';-->
              },
            });
        </script>";
}

echo "
<a style='color: black; text-decoration: none;' href='mainPostUser.php?postId=" . $Column['postId'] . "'><h4 class='user-post-title'>" . $Column['postTitle'] . "</h4></a>
<hr style='border-color: darkgray; margin: 10px;'>

<!--Post-->
<a href='mainPostUser.php?postId=" . $Column['postId'] . "'><img style='width: 80%; height: 80%;' src='data:image/jpeg;base64," . base64_encode($Column['post']) . "'/></a><br>

<div style='padding-top: 15px; padding-bottom: 15px;'>";

include 'checkUpvote.php';
include 'checkDownvote.php';

echo "</div>

<!--Comment-->
<form action='insertComment.php?postId=" . $Column['postId'] . "' method='post'>
<textarea type='text' maxlength='2000' id='comment' name='comment' class='fieldinput comment-box' placeholder='Say something funny...' required></textarea><br>
<input type='submit' name='submit' style='margin: 0px' class='btn btn-primary' value='Comment'>
</form><br>
<a href='mainPostUser.php?postId=" . $Column['postId'] . "' style='color: gray; font-size: 10px;'>View Comments</a>
</div>
";
