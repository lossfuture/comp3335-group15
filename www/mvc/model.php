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

    public function strongpassword($password){
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        if(!$uppercase || !$lowercase || !$number || strlen($password) < 8){
            $count = 2;
        }
        return $count;
    }

    public function registerMember()
    {
        $result = $this->isMemberExists($_POST["email"]);
        if($result != 1 ){
            $result = $this->strongpassword($_POST["signup-password"]);
        }
        if ($result < 1) {
            if (! empty($_POST["signup-password"])) {
                $salt = rand(1, 9999);
                $hashedPassword = hash('sha256',$_POST["signup-password"] . strval($salt));
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
                //$_POST["signup-password"],
                $salt   
            );

            $memberId = $this->ds->insert($query, $paramType, $paramValue);
            if($memberId) {
                $response = array("status" => "success", "message" => "You have registered successfully.");
            }
            else{
                $response = array("status" => "error", "message" => "cant be empty in * column");
            }
        } else if ($result == 1) {
            $response = array("status" => "error", "message" => "Email already exists.");
        }
        else if ($result == 2) {
            $response = array("status" => "error", "message" => "Password must contain at least 8 characters with capital letter, small letter and numeric");
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
        if ($loginPassword == 1 && $_SESSION['attempt'] < 3) {
            $_SESSION["username"] = $loginUserResult[0]["username"];
            setcookie("user","user",time()+1800);
            $loginurl = 'in.php';
            //require_once $loginurl;
            header("Location: $loginurl");
        }
        else if ($loginPassword == 1 && $_SESSION['attempt'] > 2){
                $loginStatus = "Attempt limit reach please wait 10 seconds";
                //$_SESSION['locked'] = time();
        }
        else if ($loginPassword == 0) {
            $_SESSION['attempt'] += 1;
            if($_SESSION['attempt'] > 2){
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
