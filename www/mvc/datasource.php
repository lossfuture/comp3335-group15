<?php
/** this code helps to connect model class where we develop select and insert queries */
/**
 * Copyright (C) 2019 Phppot
 *
 * Distributed under MIT license with an exception that,
 * you don’t have to include the full MIT License in your code.
 * In essense, you can use it on commercial software, modify and distribute free.
 * Though not mandatory, you are requested to attribute this URL in your code or website.
 */
//namespace Phppot;

/**
 * Generic datasource class for handling DB operations.
 * Uses MySqli and PreparedStatements.
 *
 * @version 2.5 - recordCount function added
 */
class datasource
{

    // PHP 7.1.0 visibility modifiers are allowed for class constants.
    // when using above 7.1.0, declare the below constants as private
    const HOST = 'db:3306';

    const USERNAME = 'root';

    const PASSWORD = 'Ip38w#*5tA%hwJLy';

    const DATABASENAME = 'comp3335';

    private $conn;

    /**
     * PHP implicitly takes care of cleanup for default connection types.
     * So no need to worry about closing the connection.
     *
     * Singletons not required in PHP as there is no
     * concept of shared memory.
     * Every object lives only for a request.
     *
     * Keeping things simple and that works!
     */
    function __construct()
    {
        $this->conn = $this->getConnection();
    }

    /**
     * If connection object is needed use this method and get access to it.
     * Otherwise, use the below methods for insert / update / etc.
     *
     * @return \mysqli
     */
    public function getConnection()
    {
        $conn = new \mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASENAME);

        if (mysqli_connect_errno()) {
            trigger_error("Problem with connecting to database.");
        }

        $conn->set_charset("utf8");
        return $conn;
    }

/** 
    *@param string $query
    *@param string $paramType
    *@param array $paramArray
    *@return array
*/
    public function select($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);

        if (! empty($paramType) && ! empty($paramArray)) {

            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        if (! empty($resultset)) {
            return $resultset;
        }
    }


    public function insert($query, $paramType, $paramArray)
    {
        $stmt = $this->conn->prepare($query);
        $this->bindQueryParams($stmt, $paramType, $paramArray);

        $stmt->execute();
        $insertId = $stmt->insert_id;
        return $insertId;
    }


    
     
    public function execute($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);

        if (! empty($paramType) && ! empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
    }


     
    public function bindQueryParams($stmt, $paramType, $paramArray = array())
    {
        $paramValueReference[] = & $paramType;
        echo $stmt;
        for ($i = 0; $i < count($paramArray); $i ++) {
            $paramValueReference[] = & $paramArray[$i];
        }
        call_user_func_array(array(& $stmt,'bind_param'), $paramValueReference);
    }


    
    public function getRecordCount($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);
        if (! empty($paramType) && ! empty($paramArray)) {

            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
        $stmt->store_result();
        $recordCount = $stmt->num_rows;

        return $recordCount;
    }
}
