<?php

$CurrentPage = substr(basename($_SERVER['PHP_SELF']), 0, strlen(basename($_SERVER['PHP_SELF'])) - 4);

if ($CurrentPage == "adminReportedPosts") {
    echo "
        <!--Title-->
        <div class='user-post' style='background-color:'>
        <a href='deletePost.php?postId=" . $Column['postId'] . "' title='Delete this reported post?' class='fa fa-trash fa-2x' style='text-decoration: none; margin-top: 10px; color: gray;' data-toggle='confirmation' data-popout='true' data-singleton='true'></a><span>&nbsp&nbsp</span>
        <a href='deleteReport.php?reportId=" . $Column['reportId'] . "' title='Dismiss this reported post?' class='fa fa-times fa-2x' style='text-decoration: none; margin-top: 10px; color: gray;' data-toggle='confirmation' data-popout='true' data-singleton='true'></a>
        <a style='color: black; text-decoration: none;' href='adminMainPost.php?postId=" . $Column['postId'] . "'><h4 class='user-post-title'>" . $Column['postTitle'] . "</h4></a>
        <hr style='border-color: darkgray; margin: 10px;'>
        
        <!--Post-->
        <a href='adminMainPost.php?postId=" . $Column['postId'] . "'><img style='width: 80%; height: 80%;' src='data:image/jpeg;base64," . base64_encode($Column['post']) . "'/></a><br>
        <a href='adminMainPost.php?postId=" . $Column['postId'] . "' style='color: gray; font-size: 10px;'>View Comments</a>
        </div>
        ";
} else {
    echo "
        <!--Title-->
        <div class='user-post' style='background-color:'>
        <a href='deletePost.php?postId=" . $Column['postId'] . "' title='Delete this post?' class='fa fa-trash fa-2x' style='text-decoration: none; margin-top: 10px; color: gray;' data-toggle='confirmation' data-popout='true' data-singleton='true'></a><span>&nbsp&nbsp</span>
        <a style='color: black; text-decoration: none;' href='adminMainPost.php?postId=" . $Column['postId'] . "'><h4 class='user-post-title'>" . $Column['postTitle'] . "</h4></a>
        <hr style='border-color: darkgray; margin: 10px;'>

        <!--Post-->
        <a href='adminMainPost.php?postId=" . $Column['postId'] . "'><img style='width: 80%; height: 80%;' src='data:image/jpeg;base64," . base64_encode($Column['post']) . "'/></a><br>
        <a href='adminMainPost.php?postId=" . $Column['postId'] . "' style='color: gray; font-size: 10px;'>View Comments</a>
        </div>
        ";
}

echo "<script>
        $('[data-toggle=confirmation]').confirmation({
          rootSelector: '[data-toggle=confirmation]',
          onCancel: function() {
            <!--window.location.href = '';-->
          },
        });
     </script>";

echo "
<!-- Modal -->
    <div class='modal fade' id='delete' role='dialog' style='text-align: left;'>
        <div class='modal-dialog'>

            <!-- Modal content-->
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h1 class='modal-title'>Delete post?</h1>
                </div>
                <div class='modal-body'>
                    <p>This post will be deleted. Continue?</p>
                </div>
                <div class='modal-footer'>
                    <a type='button' href='deletePost.php?postId=" . $Column['postId'] . "' style='color: gray;' class='btn btn-close'>Yes</a>
                    <button type='button' style='color: gray;' class='btn btn-close' data-dismiss='modal'>No</button>
                </div>
            </div>

        </div>
    </div>
<!-- Modal -->
";
echo "
<!-- Modal -->
    <div class='modal fade' id='dismiss' role='dialog' style='text-align: left;'>
        <div class='modal-dialog'>

            <!-- Modal content-->
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h1 class='modal-title'>Dissmiss this report?</h1>
                </div>
                <div class='modal-body'>
                    <p>This report will be ignored. Continue?</p>
                </div>
                <div class='modal-footer'>
                    <a type='button' href='deletePost.php?postId=" . $Column['postId'] . "' style='color: gray;' class='btn btn-close'>Yes</a>
                    <button type='button' style='color: gray;' class='btn btn-close' data-dismiss='modal'>No</button>
                </div>
            </div>

        </div>
    </div>
<!-- Modal -->
";
