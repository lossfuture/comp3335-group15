<?php
if (isset($_COOKIE["manager"])) {
	unset($_COOKIE["manager"]);
	setcookie("manager","",time()-1800);
	header('Location: login-form.php');
}
?>
