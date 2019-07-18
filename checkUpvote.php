<?php

$SQL2 = "SELECT * FROM `upvote` WHERE `postId`='" . $Column['postId'] . "' AND `userId` = '" . $_SESSION['userId'] . "'";
$Result2 = $Connection->query($SQL2);
if ($Result2->num_rows > 0) {
    // If exists
    while ($Column2 = $Result2->fetch_assoc()) {
        echo "<a class='btn btn-success btn-lg' disabled>
          <span class='glyphicon glyphicon-thumbs-up' style='color: black;'> " . $postUpvote . "</span>
          </a>";
    }
} else {
    echo "<a class='btn btn-success btn-lg' href='insertVote.php?tablename=upvote&postId=" . $Column['postId'] . "'>
          <span class='glyphicon glyphicon-thumbs-up' style='color: black;'> " . $postUpvote . "</span>
          </a>";
}