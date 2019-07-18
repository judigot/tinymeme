<?php

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
<div class='user-post active'>
<a style='color: black; text-decoration: none;' href='mainPost.php?postId=" . $Column['postId'] . "'><h4 class='user-post-title'>" . $Column['postTitle'] . "</h4></a>
<hr style='border-color: darkgray; margin: 10px;'>

<!--Post-->
<a href='mainPost.php?postId=" . $Column['postId'] . "'><img style='width: 80%; height: 80%;' src='data:image/jpeg;base64," . base64_encode($Column['post']) . "'/></a><br>

<div>
<h5 style='display: inline; font-weight: bold;'>Upvotes: <span style='color: #5CB85C;'>" . $postUpvote . "</span></h5>
<p style='display: inline; font-size: 20px; color: darkgray;'> | </p>
<h5 style='display: inline; font-weight: bold;'>Downvotes: <span style='color: #D9534F;'>" . $postDownvote . "</span></h5>
</div>

<a href='mainPost.php?postId=" . $Column['postId'] . "' style='color: gray; font-size: 10px;'>View Comments</a>
</div>
";
