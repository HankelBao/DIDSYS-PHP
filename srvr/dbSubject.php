<?php
require_once('dbManager.php');
class subject {
    public static function getIdArray() {
        $sub_id = array();
        $sub_id = dbManager::getArray("subject","subId");
        return $sub_id;
    }
    public static function getNameArray() {
        $sub_name = array();
        $sub_name = dbManager::getArray("subject","subName");
        return $sub_name;
    }
    public static function getNameById($id) {
        $result = mysqli_query(dbManager::getConnection(), 'SELECT * FROM subject WHERE subId="'.$id.'"');
        dbManager::checkResult($result);

        $row = mysqli_fetch_array($result);
        return $row['subName'];
    }
}
?>
