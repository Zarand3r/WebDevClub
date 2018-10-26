<?php

//Start session
session_start(); // Starting Session

$error = ''; // Variable To Store Error Message
if (isset($_POST['submit'])) {

    //Include database connection details
    require_once('config.php');

    //Connect to mysql server
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if (!$link) {
        die('Failed to connect to server: ' . mysqli_error());
    }

    //Function to sanitize values received from the form. Prevents SQL injection
    function clean($link, $str) {
        $str = @trim($str);
        if (get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return mysqli_real_escape_string($link, $str);
    }

    //Sanitize the POST values
    $username = clean($link, $_POST['username']);
    $password = clean($link, $_POST['password']);
    $time = time()+18000;
    //Input Validations
    if ($username == "" && $password !== "") {
        $error = "Username missing";
    }
    if ($password == "" && $username !== "") {
        $error = "Password missing";
    }

    if ($username == "" && $password == "") {
        $error = "Username and Password are Missing";
    }



    //Create query
    $qry = "SELECT * FROM users WHERE BINARY username='$username' AND pass='" . md5($password) . "'";
    $result = mysqli_query($link, $qry);

    //Check whether the query was successful or not
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            //Login Successful
            session_regenerate_id();
            $member = mysqli_fetch_assoc($result);
            $_SESSION['SESS_MEMBER_ID'] = $member['id'];
            $_SESSION['SESS_USER_NAME'] = $member['username'];
            $_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
            $_SESSION['SESS_LAST_NAME'] = $member['lastname'];
            $_SESSION['SESS_EMAIL_ADDRESS'] = $member['email'];
            $_SESSION['SESS_TYPE'] = $member['type'];
            if (mysqli_num_rows(mysqli_query("SELECT * FROM active WHERE username='$username'")) == 0) {
                mysqli_query($link, "INSERT INTO active(username, timelog) VALUES('$username','$time')");
            }
            session_write_close();
            header("location: welcome.php");
            exit();
        } else {
            //Login failed
            if ($error == "") {
                $error = "Wrong username or password";
            }
        }
    } else {
        die("Query failed");
    }
}





      //$active = isset($_POST['stayLoggedIn']) && $_POST['stayLoggedIn']  ? "1" : "0";
      //$_SESSION['SESS_ACTIVE'] = $active;
