<?php session_start();
require_once("send-email.php");

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

       public function generate_code(){
        return substr(number_format(time() * rand(), 0, '', ''), 0, 6);
    }

    public function verify_token($token){
        
        $query = 'SELECT user_id FROM email_verfiication where token = ? LIMIT 1';
        $paramType = 's';
        $paramValue = array(
            $token
        );
        $insertRecord = $this->ds->select($query, $paramType, $paramValue);
        //var_dump($insertRecord);
        $count = 0;
        if (is_array($insertRecord)) {
            $count = count($insertRecord);
        }else{
            echo "Error: token not exist";
            return;
        }

        $query = 'UPDATE users SET email_verified = 1 where id = ?';
        $paramType = 'i';
        $paramValue = array(
            $insertRecord[0]["user_id"]
        );
        //var_dump($paramValue);
        $insertRecord = $this->ds->execute($query, $paramType, $paramValue);
        //var_dump($insertRecord);

            echo "<a href=\"login-form.php\"><p>You can login now.</p></a>";


        
        
    }

   

        

    
    public function send_2fa_code($id_value,$email){
        
        $today_time=new DateTime();
        $timezone = new DateTimeZone('Asia/Hong_Kong');
        $today_time->setTimezone($timezone);

        $today_time->add(new DateInterval('PT10M'));
        $today_time=$today_time->format("Y-m-d H:i:s");

        $token=$this->generate_code();
        $query = 'INSERT INTO verification_code (user_id, user_type ,verification_code, expried_date) VALUES (?, "user",?, ?)';
        $paramType = 'iis';
        $paramValue = array(
            $id_value,
            $token,
     //       $email,
            $today_time, 
        );

        //var_dump( $paramValue);

        $memberId = $this->ds->insert($query, $paramType, $paramValue);
        send_email($email,$token);

    }

    public function verify_2fa_code($token){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $query = 'SELECT user_id FROM verification_code where verification_code = ? LIMIT 1';
        $paramType = 'i';
        $paramValue = array(
            $token
        );
        $insertRecord = $this->ds->select($query, $paramType, $paramValue);

        $count = 0;
        if (is_array($insertRecord)) {
            $_SESSION["2fa"] = TRUE;
            return true;
        }else{
            return false;
        }
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
            $token=hash('sha256', $this->generate_code());

            $today_time=new DateTime();
            $timezone = new DateTimeZone('Asia/Hong_Kong');
            $today_time->setTimezone($timezone);

            $today_time->add(new DateInterval('PT1H'));
            $today_time=$today_time->format("Y-m-d H:i:s");
            

            $query2 = 'INSERT INTO email_verfiication (id,token, expried_date, user_id ) VALUES (? ,? , ?, ?)';
            $paramType2 = 'issi';
            $paramValue2 = array(
                NULL,
                $token,
                $today_time,
                $memberId
            );

            $result2 = $this->ds->insert($query2, $paramType2, $paramValue2);

            send_email($_POST["email"],$token);
            if($memberId) {
                $response = array("status" => "success", "message" => "You have registered successfully.<br>An verification email has been sent, plesase verify <a href=\"email-verify.php\" > here</a>");
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
        if ($loginPassword == 1 && $_SESSION['attempt'] < 4) {
            $_SESSION["username"] = $loginUserResult[0]["username"];
            $_SESSION["2fa"] = FALSE;
            $_SESSION["user_id"] =  $loginUserResult[0]["id"];
            setcookie("user","user",time()+1800);
            
            // 2fa
            $this->send_2fa_code( $loginUserResult[0]["id"], $loginUserResult[0]["email"]);
            
            $loginurl = 'in.php';
            //require_once $loginurl;
            header("Location: $loginurl");
        }
        else if ($loginPassword == 1 && $_SESSION['attempt'] > 4){
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
