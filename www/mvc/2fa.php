<?php
define('ROOT_DIR', realpath(__DIR__.'/..'));
require __DIR__.'/../mvc/model.php';
session_start();

if (!isset($_COOKIE["user"])){
	header("Location:login-form.php");
  exit;
}

if (isset($_POST["verification_code"])){

    $member = new model();
$loginResult = $member->verify_2fa_code($_POST["verification_code"]);

if ($loginResult){
    $loginurl = 'in.php';
    header("Location: $loginurl");
    exit();
}else{
    echo $_POST["verification_code"];
    echo"token not correct, please input again.";
}
/* 
echo $_POST["verification_code"];
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
*/
}

?>
We have sent the verifcation code to your email, please view it.
<form method="POST">

    <input type="text" name="verification_code" placeholder="Enter verification code" required />
 
    <input type="submit" name="verify_email" value="Verify Email">
</form>

<?php



?>
