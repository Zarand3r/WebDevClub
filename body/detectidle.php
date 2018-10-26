<?php
require('../account/login/config.php');
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    $username = $_SESSION['SESS_USER_NAME'];
    //$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
    $last = time();
    mysqli_query($link, "UPDATE active SET timelog='$last' WHERE username='$username'");
