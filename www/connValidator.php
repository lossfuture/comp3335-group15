<?php
class connAdmin{
    public function getConnection(){
        $conn = new \mysqli("db:3306", "validator1", "87fd89asf02", "comp3335");

        if (mysqli_connect_errno()) {
            trigger_error("Problem with connecting to database.");
        }

        $conn->set_charset("utf8");
        return $conn;
    }
}
?>
