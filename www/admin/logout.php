<?php
if (isset($_COOKIE["admin"])) {
	unset($_COOKIE["admin"]);
	setcookie("admin","",time()-1800);
	header('Location: login-form.php');
}
?>
