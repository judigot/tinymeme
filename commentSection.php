<?php

// Layout 1
echo "<div style='text-align: left; color: black;'>";

// Layout 2
//echo "<div class='user-post' style='text-align: left;'>";

echo "<h4 class='user-post-title'>Comments</h4>
      <hr style='border-color: darkgray; margin: 10px;'>
     ";
include 'connect.php';
$SQL = "SELECT user.userId, CONCAT(`firstname`, ' ',`lastname`) AS fullname, comment.comment, comment.commentId FROM user INNER JOIN comment ON comment.userId=user.userId WHERE postId='" . $_GET['postId'] . "' ORDER BY `comment`.`commentId` ASC";
$Result = $Connection->query($SQL);
if ($Result->num_rows > 0) {
    while ($Column = $Result->fetch_assoc()) {
        echo "<div style='border-radius: 2px; border-radius: 5px; background-color: #CCCCCC; padding: 10px;'>";

        // Check if the comment belongs to the original poster and comment belongs to the logged in user
        $SQL1 = "SELECT * FROM `post` WHERE `postId` = '" . $_GET['postId'] . "'";
        $Result1 = $Connection->query($SQL1);
        if ($Result1->num_rows > 0) {
            while ($Column1 = $Result1->fetch_assoc()) {
                if ($Column['userId'] == $Column1['userId']) {
                    echo "<i title='Original Poster' style='color: #3C783C;' class='fa fa-check fa-2x' aria-hidden='true'></i>";
                }
            }
        }

        echo "<div style='display: inline-block; font-size: 14px; font-weight: bold;'><a style='color: #005795; text-decoration: none;' href='viewPost.php?userId=" . $Column['userId'] . "&fullname=" . $Column['fullname'] . "'>" . $Column['fullname'] . "</a></div>";
        echo "<div style='display: inline-block; font-size: 12px; font-style: italic;'>&nbsp\"" . $Column['comment'] . "\"</div>";
        include 'replySection.php';
        echo "</div><br>";
    }
} else {
    echo '<h1 style="color: darkgray; font-size: 30px;">No comments. No one gave a damn yet.';
}
$Connection->close();
echo "</div>";
