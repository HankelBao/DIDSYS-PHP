<?php
require_once('dbManager.php');
class scorer {
    public static function checkPw($username, $password) {
        $account = self::selectAccount($username);
        if ($account != FALSE) {
            if ($account['scrrPassword'] == $password) {
                $scrrId = $account['scrrId'];
                $scrrName = $account['scrrName'];
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public static function add($username, $password) {
        mysqli_query(dbManager::getConnection(), "INSERT INTO scorer(scrrName, scrrPassword) VALUES ('".$username."','".$password."')");
    }

    public static function selectAccount($username) {
        $result = mysqli_query(dbManager::getConnection(), 'SELECT * FROM scorer WHERE scrrName="'.$username.'"');
        if ($result == False) {
            return FALSE;
        }

        while ($row = mysqli_fetch_array($result)) {
            return $row;
        }

        return FALSE;
    }

    public static function getNameById($id) {
        $result = mysqli_query(dbManager::getConnection(), 'SELECT * FROM scorer WHERE scrrId="'.$id.'"');
        dbManager::checkResult($result);

        $row = mysqli_fetch_array($result);
        return $row['scrrName'];
    }

    public static function getIdArray() {
        $scrr_id = array();
        $scrr_id = dbManager::getArray("scorer","scrrId");
        return $scrr_id;
    }
    public static function getNameArray() {
        $scrr_name = array();
        $scrr_name = dbManager::getArray("scorer","scrrName");
        return $scrr_name;
    }
}
?>
