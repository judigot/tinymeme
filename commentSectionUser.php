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
        echo "<div style='position: relative; border-radius: 2px; border-radius: 5px; background-color: #CCCCCC; padding: 10px;'>";

        // Check if the comment belongs to another user
        $SQL1 = "SELECT * FROM `post` WHERE `userId` = '" . $_SESSION['userId'] . "'";
        $Result1 = $Connection->query($SQL1);
        if ($Result1->num_rows > 0) {
            while ($Column1 = $Result1->fetch_assoc()) {
                if ($_GET['postId'] == $Column1['postId']) {
                    // Dropdown Menu
                    echo "
                        <div class='dropdown' style='position: absolute; top: 0px; right: 0px;'>
                        <button style='border: none; color: black; background-color: transparent;' class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'><span class='caret'></span></button>
                        <ul class='dropdown-menu'>
                          <li><a href='deleteComment.php?commentId=" . $Column['commentId'] . "' title='Delete this comment?' data-toggle='confirmation' data-popout='true' data-singleton='true' data-placement='left'>Delete</a></li>
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
            }
        }

        // Check if the comment belongs to the original poster and comment belongs to the logged in user
        $SQL1 = "SELECT * FROM `post` WHERE `postId` = '" . $_GET['postId'] . "'";
        $Result1 = $Connection->query($SQL1);
        if ($Result1->num_rows > 0) {
            while ($Column1 = $Result1->fetch_assoc()) {
                if ($Column['userId'] == $Column1['userId'] && $_SESSION['userId'] != $Column['userId']) {
                    echo "<i title='Original Poster' data-toggle='tooltip' style='color: #3C783C;' class='fa fa-check fa-2x' aria-hidden='true'></i>";
                }
            }
        }

        // Check if the comment belongs to the logged in user
        if ($_SESSION['userId'] == $Column['userId']) {
            // Dropdown Menu
            echo "
                <div class='dropdown' style='position: absolute; top: 0px; right: 0px;'>
                <button style='border: none; color: black; background-color: transparent;' class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'><span class='caret'></span></button>
                <ul class='dropdown-menu'>
                  <li><a href='#'>Edit</a></li>
                  <li><a href='deleteComment.php?commentId=" . $Column['commentId'] . "' title='Delete this comment?' data-toggle='confirmation' data-popout='true' data-singleton='true' data-placement='left'>Delete</a></li>
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
            echo "<i title='It&#39s you!' data-toggle='tooltip' style='color: #005795;' class='fa fa-user fa-2x' aria-hidden='true'></i>";
            echo "<div title='It&#39s you!' data-toggle='tooltip' style='display: inline-block; font-size: 14px; font-weight: bold;'>&nbsp<a style='color: #005795; text-decoration: none;' href='viewPostUser.php?userId=" . $Column['userId'] . "&fullname=" . $Column['fullname'] . "'>" . $Column['fullname'] . "</a></div>";
        } else {
            // Default user display
            echo "<div title='View " . $Column['fullname'] . "&#39s profile' data-toggle='tooltip' style='display: inline-block; font-size: 14px; font-weight: bold;'>&nbsp<a style='color: #005795; text-decoration: none;' href='viewPostUser.php?userId=" . $Column['userId'] . "&fullname=" . $Column['fullname'] . "'>" . $Column['fullname'] . "</a></div>";
        }

        // Comment
        echo "<div style='display: inline-block; font-size: 12px; font-style: italic;'>&nbsp\"" . $Column['comment'] . "\"</div>";

        // Action
        echo "<div style='width: inherit; font-size: 12px; color: #005795;'>";
        // Like
//        echo "<i class='fa fa-thumbs-o-up fa-1x' aria-hidden='true'>&nbsp<span class='like-unlike' style='cursor: pointer; cursor: hand; font-family: Trebuchet MS;'>Like</span><span title='" . $_SESSION['fullname'] . "' data-toggle='tooltip' style='cursor: pointer; cursor: hand; font-family: Trebuchet MS;'><strong> 11, 983</strong></span></i> · ";
        echo "<i class='fa fa-thumbs-o-up fa-1x' aria-hidden='true'>&nbsp<span class='like-unlike' style='cursor: pointer; cursor: hand; font-family: Trebuchet MS;'>Like</span><span title='A lot of &#39em' data-toggle='tooltip' style='cursor: pointer; cursor: hand; font-family: Trebuchet MS;'><strong> 11, 983</strong></span></i> · ";

        // Reply
        echo "<i class='fa fa-reply fa-1x' aria-hidden='true'>&nbsp<span class='reply-cancel' id='replyformtoggle" . $Column['commentId'] . "' style='cursor: pointer; cursor: hand; font-family: Trebuchet MS;'>Reply</span></i>";
        echo "</div>";

        echo "<p hidden>This is a paragraph with little content.</p>";

        // Reply Text Area
        echo "<div style='font-size: 12px;' id='replyform" . $Column['commentId'] . "' hidden>";
        echo "<form action='insertReply.php?commentId=" . $Column['commentId'] . "&postId=" . $_GET['postId'] . "' method='post'>";
        echo "<textarea id='reply' name='reply' style='width: 100%; max-height: 200px; max-width: 100%;' required></textarea>";
        echo "<button type='submit' id='submit' name='submit' class='btn btn-default'>Reply</button></div>";
        echo "</form>";
        include 'replySectionUser.php';
        echo "</div><br>";

        // Reply Form Toggle
        echo "
            <script>
            $(document).ready(function(){
                $('#replyformtoggle" . $Column['commentId'] . "').click(function(){
                    $('#replyform" . $Column['commentId'] . "').toggle(100);
                });
            });
            </script>
        ";
    }
} else {
    echo '<h1 style="color: darkgray; font-size: 30px;">No comments. No one gave a damn yet.';
}
$Connection->close();
echo "</div>";
// User Action Toggle
echo "<script>
        $('.like-unlike').click(function (e) {
            var like = $.trim($(this).text())
            if (like == 'Like') {
                $(this).contents().filter(function () {  // find the text node inside the button
                    return this.nodeType == 3
                }).replaceWith('Unlike');
                $(this).css('border-radius', '2px');
                $(this).css('background-color', 'white');
            } else {
                $(this).contents().filter(function () {
                    return this.nodeType == 3
                }).replaceWith('Like');
                $(this).css('background-color', 'transparent');
            }
            return false;
        });
        $('.reply-cancel').click(function (e) {
            var reply = $.trim($(this).text())
            if (reply == 'Reply') {
                $(this).contents().filter(function () {  // find the text node inside the button
                    return this.nodeType == 3
                }).replaceWith('Cancel');
            } else {
                $(this).contents().filter(function () {
                    return this.nodeType == 3
                }).replaceWith('Reply');
            }
            return false;
        });
    </script>";
