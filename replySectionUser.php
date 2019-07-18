<?php

$SQL2 = "SELECT user.userId, CONCAT(`firstname`, ' ',`lastname`) AS fullname, reply.replyId, reply.reply, comment.commentId, post.postId FROM user INNER JOIN reply ON reply.userId=user.userId INNER JOIN comment ON reply.commentId=comment.commentId INNER JOIN post ON reply.postId=post.postId WHERE post.postId='" . $_GET['postId'] . "' AND comment.commentId=" . $Column['commentId'] . " ORDER By replyId ASC";
$Result2 = $Connection->query($SQL2);
if ($Result2->num_rows > 0) {
    while ($Column2 = $Result2->fetch_assoc()) {
        echo "<div style='position: relative; border-radius: 5px; margin: 10px; margin-bottom: 0px; padding: 5px; line-height: 100%; background-color: white;'>";
        // Check if the reply belongs to the logged in user
        if ($_SESSION['userId'] == $Column2['userId']) {
            // Dropdown Menu
            echo "
                <div class='dropdown' style='position: absolute; top: 0px; right: 0px;'>
                <button style='border: none; color: black; background-color: transparent;' class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'><span class='caret'></span></button>
                <ul class='dropdown-menu'>
                  <li><a href='#'>Edit</a></li>
                  <li><a href='deleteReply.php?replyId=" . $Column2['replyId'] . "' title='Delete this reply?' data-toggle='confirmation' data-popout='true' data-singleton='true' data-placement='left'>Delete</a></li>
                  <li><a href='#'>View Edit History</a></li>
                </ul>
                </div>
                 ";

            echo "<script>
                    $('[data-toggle=confirmation]').confirmation({
                      rootSelector: '[data-toggle=confirmation]',
                      onCancel: function() {
                        <!--window.location.href = '';-->
                      },
                    });
                 </script>";
        }

        echo "<div title='View " . $Column2['fullname'] . "&#39s profile' data-toggle='tooltip' style='display: inline-block; font-size: 12px; font-weight: bold;'><a style='color: #005795; text-decoration: none;' href='viewPostUser.php?userId=" . $Column2['userId'] . "&fullname=" . $Column2['fullname'] . "'>" . $Column2['fullname'] . "</a></div>";
        echo "<div style='display: inline-block; font-size: 12px; font-style: italic;'>&nbsp\"" . $Column2['reply'] . "\"</div>";
        echo "</div><br>";
    }
}