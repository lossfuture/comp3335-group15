<?php
define('ROOT_DIR', realpath(__DIR__.'/..'));
require __DIR__.'/../mvc/model.php';

    //Use get instad of post for verify

        $token = $_GET["token"]; //md5 hash
        $verification_code = $_GET["verification_code"]; //number
 
        // connect with database
        $member = new model();
        $loginResult = $member-> verifytoken();
 
        // mark email as verified
        $current_time = date("Y-m-d H:i:s");

        //change status of 2 fa

        //verify email if not yet verify yet

        //$sql = "UPDATE users SET email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
        $result  = mysqli_query($conn, $sql);
 
        if (mysqli_affected_rows($conn) == 0)
        {
            die("Verification code failed.");
        }
 
        echo "<p>You can login now.</p>";
        exit();
    
 
?>
