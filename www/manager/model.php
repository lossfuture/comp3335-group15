<?php session_start();
class model
{

    private $ds;

    function __construct()
    {
       require_once __DIR__ .'/../manager/datasource.php';
       //require_once __DIR__.'/../manager/model.php';
       //$config_path = __DIR__.'/../mvc/datasource.php';
       //require $config_path;
        $this->ds = new datasource();
    }

    public function getMember($username)
    {
        $query = 'SELECT * FROM managers where username = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $loginUser = $this->ds->select($query, $paramType, $paramValue);
        //var_dump ($loginUser);
        return $loginUser;
    }

    public function loginMember()
    {
        $loginUserResult = $this->getMember($_POST["username"]);
        //$loginStatus = "";
        if(empty($loginUserResult)){
            $loginStatus = "Invalid username or password.";
            return $loginStatus;
        }
        if (! empty($_POST["signup-password"])) {
            
            $password = $_POST["signup-password"];
            if(!isset($_SESSION['attempt'])){
                $_SESSION['attempt'] = 1;
            }

        }
        //echo $_SESSION['attempt'];
        $hashedPassword = $loginUserResult[0]["password"];
        //echo $hashedPassword;
        $salt = $loginUserResult[0]["salt"];
        //echo "iam salt" + $salt;
        //echo "iam password" + $password;
        $verify_password = hash('sha256',$password . strval($salt));
        $loginPassword = 0;
        if ($verify_password == $hashedPassword) {
            $loginPassword = 1;
        }
        if ($loginPassword == 1 && $_SESSION['attempt'] < 4) {
            $_SESSION["username"] = $loginUserResult[0]["username"];
            setcookie("user","user",time()+1800);
            $loginurl = 'validate.php';
            //require_once $loginurl;
            header("Location: $loginurl");
        }
        else if ($loginPassword == 1 && $_SESSION['attempt'] > 4){
                $loginStatus = "Attempt limit reach please wait 10 seconds";
                //$_SESSION['locked'] = time();
        }
        else if ($loginPassword == 0) {
            $_SESSION['attempt'] += 1;
            if($_SESSION['attempt'] > 4){
                $loginStatus = "Attempt limit reach please wait 10 seconds";
                $_SESSION['locked'] = time() + 1 *10;
                //$_SESSION['attempt'] = 0;
            }
            else{
                $loginStatus = "Invalid username or password.";
            }
        }
        else{
            $loginStatus = "Invalid username or password.";
            $_SESSION['attempt'] += 1;
        }
            return $loginStatus;
    }
}
