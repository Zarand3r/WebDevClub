<?php
//session_set_cookie_params(0);
session_start();
if (!isset($_SESSION['SESS_MEMBER_ID'])) {
    header("Location: ../account/login/login-form.php");
}
include('detectidle.php');

require_once('../account/login/config.php');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$sourcecode = mysqli_query($link, "SELECT sourcecode FROM pagecodes WHERE typename ='news'");
$source = mysqli_fetch_assoc($sourcecode);
echo $source['source'];
