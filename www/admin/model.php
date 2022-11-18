<?php session_start();
class model
{

    private $ds;

    function __construct()
    {
       require_once __DIR__ .'/../admin/datasource.php';
       require_once __DIR__.'/../admin/model.php';
       //$config_path = __DIR__.'/../mvc/datasource.php';
       //require $config_path;
        $this->ds = new datasource();
    }

    public function getMember($username)
    {
        $query = 'SELECT * FROM admin where username = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $loginUser = $this->ds->select($query, $paramType, $paramValue);
        return $loginUser;
    }

    public function loginMember()
    {
        $loginUserResult = $this->getMember($_POST["username"]);
        if(empty($loginUserResult)){
            $loginStatus = "Invalid username or password.";
            return $loginStatus;
        }
        if (! empty($_POST["signup-password"])) {
            
            $password = $_POST["signup-password"];
        }
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
        if ($loginPassword == 1) {
            $_SESSION["username"] = $loginUserResult[0]["username"];
            //$url = "user/index.php";
            $loginurl = 'index.php';

           header("Location: $loginurl");
        } else if ($loginPassword == 0) {
            $loginStatus = "Invalid username or password.";
            return $loginStatus;
        }
    }
}
