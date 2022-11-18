<?php
//$logouturl = __DIR__.'/../mvc/home.php';
//require $logouturl;
//session_start();
//user logout page

	// variable declaration
	//$username = "";
	//$email    = "";$password ="";
	
	//$errors = array(); 
	//$_SESSION['success'] = "";

	// connect to database
//$connect = mysqli_connect('127.0.0.1', 'root', '12581258', 'user-registration');
//include_once("logout.php");
if (isset($_COOKIE["user"])) {
	unset($_COOKIE["user"]);
	setcookie("user","",time()-1800);
	header("Location: home.php");
}
//echo <script> location.href="userLogin.php"</script>;
?>
