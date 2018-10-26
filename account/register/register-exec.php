<?php

	session_start(); // Starting Session
        $error = "";
        $wrongcode = "";

        if (isset($_POST['Submit'])) {

	require_once('../login/config.php');


	//Connect to mysqli server
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	if(!$link) {
		die('Failed to connect to server: ' . mysqli_error());
	}

	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($link, $str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysqli_real_escape_string($link, $str);
	}

	//Sanitize the POST values
	$fname = clean($link, $_POST['fname']);
	$lname = clean($link, $_POST['lname']);
	$username = clean($link, $_POST['username']);
	$password = clean($link, $_POST['password']);
	$cpassword = clean($link, $_POST['cpassword']);
        $email = clean($link, $_POST['email']);
        $code = clean($link, $_POST['secretcode']);

	//Check for duplicate username
	if($username != '') {
		$qry = "SELECT * FROM users WHERE username='$username'";
		$result = mysqli_query($link, $qry);
		if($result) {
			if(mysqli_num_rows($result) > 0) {
	      $error = "Username Taken";
	      session_destroy();
	          //die("Username Taken");
	          //header("Location:register-form.php");
			}
		}
	}
  if($code!='')   {
      if($code != 'helloworld$BS#1')  {
          $wrongcode = 'Please enter the correct secret registration code';
          session_destroy();
      }
  }
	if($error==""&&$wrongcode=="")  {
		//Create INSERT query
		$qry = "INSERT INTO users(fname, lname, username, pass, email) VALUES('$fname','$lname','$username','".md5($password)."','$email')";
		$result = mysqli_query($link, $qry);

		//Check whether the query was successful or not
		if($result) {
			header("location: register-success.php");
			exit();
		}
	  else {
	      die("query failed");
		}
	 }
}
?>
