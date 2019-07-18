<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'head.php'; ?>
        <title>TinyMeme - Post Something Funny!</title>
    </head>

    <body>

        <div class="container">
            <?php include("navbar.php"); ?>

            <!-- Page Content -->
            <div class="container">
                <h1 class="page-header">All Posts</h1>
                <div id="postcontainer">
                </div>
                <div class="container" id="loadmessage"></div>
                <br>
            </div>

            <script>
                $(document).ready(function () {
                    var limit = 1;
                    var start = 0;
                    var action = 'inactive';
                    function load_country_data(limit, start) {
                        $.ajax({
                            // Data Source
                            url: "fetch.php",
                            method: "POST",
                            data: {limit: limit, start: start},
                            cache: false,
                            success: function (data) {
                                $('#postcontainer').append(data);
                                if (data == '') {
                                    // If No More Results
                                    $('#loadmessage').html('<br><h1 style="color: darkgray;">No more results.</h1>');
//                                    $('#loadmessage').html('');
                                    action = 'active';
                                } else {
                                    // Results Loaded
                                    $('#loadmessage').html("");
                                    action = "inactive";
                                }
                            }
                        });
                    }
                    if (action == 'inactive') {
                        action = 'active';
                        load_country_data(limit, start);
                    }
                    $(window).scroll(function () {
                        if ($(window).scrollTop() == $(document).height() - $(window).height() && action == 'inactive') {
                            action = 'active';
                            start = start + limit;
                            // Load Data
                            $('#loadmessage').html('<br><h1 style="color: darkgray;">Loading posts...</h1>');
                            setTimeout(function () {
                                load_country_data(limit, start);
                            }, 1000);
                        }
                    });
                });
            </script>

            <?php include("footer.php"); ?>

        </div>

    </body>

</html>