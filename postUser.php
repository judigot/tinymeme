<?php

//echo "
//<!--Title-->
//<div class='user-post' style='display: inline-block; background-color:'><a href='#' class='glyphicon glyphicon-trash' style='text-decoration: none; margin-top: 10px; font-size: 15px; color: gray;' data-toggle='modal' data-target='#myModal'></a>
//<a style='color: black; text-decoration: none;' href='mainPostUser.php?postId=" . $Column['postId'] . "'><h4 class='user-post-title'>" . $Column['postTitle'] . "</h4></a>
//<hr style='border-color: darkgray; margin: 10px;'>
//
//<!--Post-->
//<a href='mainPostUser.php?postId=" . $Column['postId'] . "'><img style='width: 80%; height: 80%;' src='data:image/jpeg;base64," . base64_encode($Column['post']) . "'/></a><br>
//
//
//
//<a href='mainPostUser.php?postId=" . $Column['postId'] . "' style='color: gray; font-size: 10px;'>View Comments</a>
//</div>
//";
echo "
<!--Title-->
<div class='user-post' style='display: inline-block; background-color:'><a href='deletePost.php?postId=" . $Column['postId'] . "' title='Delete this post?' data-toggle='confirmation' data-popout='true' data-singleton='true' data-placement='bottom' class='glyphicon glyphicon-trash' style='text-decoration: none; margin-top: 10px; font-size: 15px; color: gray;'></a>
<a style='color: black; text-decoration: none;' href='mainPostUser.php?postId=" . $Column['postId'] . "'><h4 class='user-post-title'>" . $Column['postTitle'] . "</h4></a>
<hr style='border-color: darkgray; margin: 10px;'>

<!--Post-->
<a href='mainPostUser.php?postId=" . $Column['postId'] . "'><img style='width: 80%; height: 80%;' src='data:image/jpeg;base64," . base64_encode($Column['post']) . "'/></a><br>



<a href='mainPostUser.php?postId=" . $Column['postId'] . "' style='color: gray; font-size: 10px;'>View Comments</a>
</div>
";

echo "<script>
        $('[data-toggle=confirmation]').confirmation({
          rootSelector: '[data-toggle=confirmation]',
        });
     </script>";

echo "
<!-- Modal -->
    <div class='modal fade' id='myModal' role='dialog' style='text-align: left;'>
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
