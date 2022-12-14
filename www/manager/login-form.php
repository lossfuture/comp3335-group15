<?php session_start();
define('ROOT_DIR', realpath(__DIR__.'/..'));
require __DIR__.'/../manager/model.php';

if(isset($_SESSION['locked'])){
    $now = time();
    if($now >= $_SESSION['locked']){
        unset($_SESSION['attempt']);
        unset($_SESSION['locked']);
    }
}

//use model;
if (! empty($_POST["login-btn"])) {
   // require_once '../db/model.php';
    $member = new model();
    $loginResult = $member->loginMember();
}
?>

<div class="signup-align">
    <form name="login" action="" method="post"
        onsubmit="return loginValidation()">
        <div class="signup-heading">Login</div>
    <?php if(!empty($loginResult)){?>
    <div class="error-msg"><?php echo '<script type="text/javascript">alert("'.$loginResult.'");</script>';?></div>
    <?php }?>
    <div class="row">
            <div class="inline-block">
                <div class="form-label">
                    Username<span class="required error" id="username-info"></span>
                </div>
                <input class="input-box-330" type="text" name="username"
                    id="username">
            </div>
        </div>
        <div class="row">
            <div class="inline-block">
                <div class="form-label">
                    Password<span class="required error" id="signup-password-info"></span>
                </div>
                <input class="input-box-330" type="password"
                    name="signup-password" id="signup-password">
            </div>
        </div>
        <div class="row">
            <input class="sign-up-btn" type="submit" name="login-btn"
                id="login-btn" value="Login">
        </div>

    </form>
</div>
</div>

