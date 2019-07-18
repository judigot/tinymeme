<?php

$SQL3 = "SELECT * FROM `downvote` WHERE `postId`='" . $Column['postId'] . "' AND `userId` = '" . $_SESSION['userId'] . "'";
$Result3 = $Connection->query($SQL3);
if ($Result3->num_rows > 0) {
    // If exists
    while ($Column3 = $Result3->fetch_assoc()) {
        echo "<a class='btn btn-danger btn-lg' disabled>
          <span class='glyphicon glyphicon-thumbs-down' style='color: black;'> " . $postDownvote . "</span>
          </a>";
    }
} else {
    echo "<a class='btn btn-danger btn-lg' href='insertVote.php?tablename=downvote&postId=" . $Column['postId'] . "'>
          <span class='glyphicon glyphicon-thumbs-down' style='color: black;'> " . $postDownvote . "</span>
          </a>";
}