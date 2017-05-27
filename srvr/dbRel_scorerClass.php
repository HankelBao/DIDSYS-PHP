<?php
require_once('dbManager.php');
class rel_scorerClass {
    public static function getClassIdByScorerId($scorerId) {
        $tmpSQL = 'SELECT * FROM rel_scorerclass WHERE rsc_scorerId ='.$scorerId;
        $dbRowCollect = mysqli_query(dbManager::getConnection(), $tmpSQL);
        dbManager::checkResult($dbRowCollect);

        $classId = array();
        while ($row = mysqli_fetch_array($dbRowCollect)) {
            $classId[] = $row['rsc_classId'];
        }
        return $classId;
    }
}
?>
