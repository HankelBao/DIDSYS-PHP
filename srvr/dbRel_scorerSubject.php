<?php
require_once('dbManager.php');
class rel_scorerSubject {
    public static function getSubjectIdByScorerId($scorerId) {
        $tmpSQL = 'SELECT * FROM rel_scorerSubject WHERE rss_ScorerId ='.$scorerId;
        $dbRowCollect = mysqli_query(dbManager::getConnection(), $tmpSQL);
        dbManager::checkResult($dbRowCollect);

        $subjectId = array();
        while ($row = mysqli_fetch_array($dbRowCollect)) {
            $subjectId[] = $row['rss_subjectId'];
        }
        return $subjectId;
    }
}
?>
