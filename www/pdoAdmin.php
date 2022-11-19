<?php
class pdoadmin{
    public function pdoConnection(){
    try {

        $db_name     = 'comp3335';
        $db_user     = 'validator1';
        $db_password = '87fd89asf02';
        $db_host     = 'db:3306';

        $pdo = new PDO('mysql:host=' . $db_host . '; dbname=' . $db_name, $db_user, $db_password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;

       } catch (PDOException $e) {

           echo $e->getMessage();

       }
    }
}

?>
