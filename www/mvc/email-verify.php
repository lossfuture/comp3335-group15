<?php
define('ROOT_DIR', realpath(__DIR__.'/..'));
require __DIR__.'/../mvc/model.php';

    //Use get instad of post for verify

        if (!isset($_GET["token"])){
            echo'
            <form method="GET">
    <input type="text" name="token" placeholder="Enter verification code" required />
    <input type="submit" name="verify_email" value="Verify Email">
</form>';
            exit();
        }
        $token = $_GET["token"]; //md5 hash

 
        // connect with database
        $member = new model();
        $loginResult = $member-> verify_token($token);
 
        // mark email as verified
        $current_time = date("Y-m-d H:i:s");

        //change status of 2 fa

        //verify email if not yet verify yet

        //$sql = "UPDATE users SET email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
  //      $result  = mysqli_query($conn, $sql);
 
   //     if (mysqli_affected_rows($conn) == 0)
  //      {
   //         die("Verification code failed.");
   //     }
 
  //      echo "<p>You can login now.</p>";
        exit();
    
 
?>
