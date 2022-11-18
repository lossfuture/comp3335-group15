<?php session_start();
class model
{

    private $ds;

    function __construct()
    {
       //require_once __DIR__ . '../mvc/datasource.php';
       require_once __DIR__ . '/../mvc/datasource.php';
       require_once __DIR__.'/../mvc/model.php';
       //$config_path = __DIR__.'/../mvc/datasource.php';
       //require $config_path;
        $this->ds = new datasource();
    }

    public function isMemberExists($email)
    {
        $query = 'SELECT * FROM users where email = ?';
        $paramType = 's';
        $paramValue = array(
            $email
        );
        $insertRecord = $this->ds->select($query, $paramType, $paramValue);
        $count = 0;
        if (is_array($insertRecord)) {
            $count = count($insertRecord);
        }
        
        return $count;
    }

    public function registerMember()
    {
        $result = $this->isMemberExists($_POST["email"]);
        if ($result < 1) {
            if (! empty($_POST["signup-password"])) {
                $salt = rand(1, 9999);
                $hashedPassword = hash('sha256',$_POST["signup-password"] + $salt);
               // echo $hashedPassword; 
            }
            $id_value = null;
            $query = 'INSERT INTO users (id, username, email , password, salt) VALUES (?, ?, ?, ?, ?)';
            $paramType = 'isssi';
            $paramValue = array(
                $id_value,
                $_POST["username"],
                $_POST["email"],
                $hashedPassword,
                $salt   
            );

            $memberId = $this->ds->insert($query, $paramType, $paramValue);
            if($memberId) {
                $response = array("status" => "success", "message" => "You have registered successfully.");
            }
            else{
                echo "having error";
            }
        } else if ($result == 1) {
            $response = array("status" => "error", "message" => "Email already exists.");
        }
        return $response;
    }

    public function getMember($username)
    {
        $query = 'SELECT * FROM users where username = ?';
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
        if (! empty($_POST["signup-password"])) {
            
            $password = $_POST["signup-password"];
        }
        $hashedPassword = $loginUserResult[0]["password"];
        $salt = $loginUserResult[0]["salt"];
        $verify_password = hash('sha256',$password + $salt);
        $loginPassword = 0;
        if ($verify_password == $hashedPassword) {
            $loginPassword = 1;
        }
        if ($loginPassword == 1) {
            $_SESSION["username"] = $loginUserResult[0]["username"];
            //$url = "user/index.php";
            $loginurl = __DIR__.'/../mvc/in.php';
            require $loginurl;
            header("Location: $loginurl");
        } else if ($loginPassword == 0) {
            $loginStatus = "Invalid username or password.";
            return $loginStatus;
        }
    }
}
