<?php

$SQL1 = "SELECT user.userId, CONCAT(`firstname`, ' ',`lastname`) AS fullname, reply.reply, comment.commentId, post.postId FROM user INNER JOIN reply ON reply.userId=user.userId INNER JOIN comment ON reply.commentId=comment.commentId INNER JOIN post ON reply.postId=post.postId WHERE post.postId='" . $_GET['postId'] . "' AND comment.commentId=" . $Column['commentId'] . " ORDER By replyId ASC";
$Result1 = $Connection->query($SQL1);
if ($Result1->num_rows > 0) {
    while ($Column1 = $Result1->fetch_assoc()) {
        echo "<div style='border-radius: 5px; margin: 10px; margin-bottom: 0px; padding: 5px; line-height: 100%; background-color: white;'>";
        echo "<div style='display: inline-block; font-size: 12px; font-weight: bold;'><a style='color: #005795; text-decoration: none;' href='viewPost.php?userId=" . $Column1['userId'] . "&fullname=" . $Column1['fullname'] . "'>" . $Column1['fullname'] . "</a></div>";
        echo "<div style='display: inline-block; font-size: 12px; font-style: italic;'>&nbsp\"" . $Column1['reply'] . "\"</div>";
        echo "</div><br>";
    }
}