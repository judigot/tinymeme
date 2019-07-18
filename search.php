<?php

if (isset($_GET['userInput'])) {
    $input = $_GET['userInput'];
    $value = strtolower($input);
}

include 'connect.php';
$SQL = "SELECT * FROM `post` WHERE `postTitle` LIKE '%" . $value . "%';";
$Start = microtime(true);
$Result = $Connection->query($SQL);
$End = microtime(true);
if ($value == null) {
    
} elseif ($Result->num_rows > 0) {
    usleep(0.3 * 1000000);
    echo '<br>';
    if (mysqli_num_rows($Result) == 1) {
        echo "<p style='color: gray; font-size: 13px; position: relative;'>" . mysqli_num_rows($Result) . " result (" . substr(($End - $Start) * 100, 0, 5) . " seconds)</p>";
    } else {
        echo "<p style='color: gray; font-size: 13px; position: relative;'>About " . mysqli_num_rows($Result) . " results (" . substr(($End - $Start) * 100, 0, 5) . " seconds)</p>";
    }
    echo '<br>';
    echo "<p style='color: black; font-size: 18px; position: relative;'>Did you mean: <strong><a target='_blank' href='Assets/images/balot.jpg' style='color: #1A0DAB; font-style: italic;'>developing bird embryo</strong></a></p><br>";
    while ($Column = $Result->fetch_assoc()) {
        echo "
            <div>
            <a href='mainPostUser.php?postId=" . $Column['postId'] . "'><p style='color: #1A0DAB; font-size: 18px; line-height: 0%; background-color: red;'>" . $Column['postTitle'] . " - TinyMeme - Post Something Funny!</p></a>
            <span style='color: #006621; font-size: 14px;'>www.appjudigot_tinymeme.com/mainPostUser.php?postId=" . $Column['postId'] . "</span><br><br><br>
            ";
    }
    echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
} else {
    usleep(0.3 * 1000000);
    echo "<br>
        <div style='color: black; font-size: 16px;'>
        <p style='text-align: left;'>Your search - <strong>$value</strong> - did not match any documents.</p>
        <ul>
            <li>Make sure that all words are spelled correctly.</li>
            <li>Try different keywords.</li>
            <li>Try more general keywords.</li>
        </ul>
        <div>
        ";
    echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
}
$Connection->close();
