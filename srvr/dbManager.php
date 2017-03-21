<?php
class dbManager {
    public static function createConnection() {
        $connection = mysqli_connect("localhost", "system", "102233");
        if (!$connection)
            die("Could not connect to the databse, please contact Hankel G1C4(c)");

        $database = mysqli_select_db($connection,'did');
        return $connection;
    }

    public static function closeConnection($connection) {
        mysqli_close($connection);
    }

    public static $connection;
    public static function getConnection(){
        if(!self::$connection)
            self::$connection = self::createConnection();
        return self::$connection;
    }

    public static function checkResult($result) {
        if ($result == False) {
           die('null database');
        }
    }

    public static function getArray($tableName, $fieldName) {
        $connection = self::createConnection();

        $tmp_sql = "SELECT * FROM ".$tableName;
        $result = mysqli_query($connection, $tmp_sql);
        self::checkResult($result);

        $return_array = array();
        while ($row = mysqli_fetch_array($result)) {
            $return_array[] = $row[$fieldName];
        }

        self::closeConnection($connection);
        return $return_array;
    }
}
?>
