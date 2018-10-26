<?php
    session_start();
    require'../../account/login/config.php';
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$link) {
            die('Failed to connect to server: ' . mysqli_error());
        }

if (isset($_POST['add'])) {
    $username = $_POST['member'];
    $pointchange = $_POST['points'];
    mysqli_query($link, "UPDATE users SET score=score+$pointchange WHERE username = '$username'");
}
if (isset($_POST['subtract'])) {
    $username = $_POST['member'];
    $pointchange = $_POST['points'];
    mysqli_query($link, "UPDATE users SET score=score-$pointchange WHERE username = '$username'");
}

if (isset($_POST['submit'])) {
    $newsource = mysql_real_escape_string($link, $_POST['code1']);
    mysqli_query($link, "UPDATE pagecodes SET sourcecode='$newsource' WHERE typename='news'");
}
