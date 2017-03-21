<?php
require_once('dbManager.php');
class record {
    public static function search($srchDate, $srchSub_id, $srchCla_id) {
        $tmpSQL = 'SELECT * FROM record WHERE
                rcrdDate = "'.$srchDate.'" and rcrd_subjectId = '.$srchSub_id.' and rcrd_classId = '.$srchCla_id;
        $dbRowCollect = mysqli_query(dbManager::getConnection(), $tmpSQL);
        if($dbRowCollect) {
            $dbRow = mysqli_fetch_array($dbRowCollect);
            if ($dbRow)
                return $dbRow;
            else
                return NULL;
        } else {
            return NULL;
        }
    }

    public static function getScore($srchDate, $srchSub_id, $srchCla_id) {
        $dbRow = self::search($srchDate, $srchSub_id, $srchCla_id);
        return $dbRow['rcrdScore'];
    }

    public static function getDes($srchDate, $srchSub_id, $srchCla_id) {
        $dbRow = self::search($srchDate, $srchSub_id, $srchCla_id);
        return $dbRow['rcrdDescription'];
    }

    public static function add($addDate, $addSub_id, $addCla_id, $addScorer_id, $addScore, $addTime, $addDes) {
        $dbRow = self::search($addDate, $addSub_id, $addCla_id);
        if ($dbRow == NULL) {
	if ($addScore != "") {
            $tmpSQL = "INSERT INTO record
                    (rcrdId, rcrdDate, rcrd_classId, rcrd_subjectId, rcrd_scorerId, rcrdScore, rcrdScoreTime, rcrdDescription)
                VALUES
                    (NULL, '".$addDate."','".$addCla_id."','".$addSub_id."','".$addScorer_id."','".$addScore."','".$addTime."','".$addDes."');";
            //echo $tmpSQL."</br>";
            mysqli_query(dbManager::getConnection(), $tmpSQL);
	}
        } else {
		if ($addScore=="") 
			$tmpSQL = "DELETE FROM record WHERE rcrdId = ".$dbRow['rcrdId'];
		else
			if($addDes=="")
            			$tmpSQL = "UPDATE record SET rcrdScore='".$addScore."' , rcrdDescription='' WHERE rcrdId = ".$dbRow['rcrdId'];
			else
				$tmpSQL = "UPDATE record SET rcrdScore='".$addScore."' , rcrdDescription='".$addDes."' WHERE rcrdId = ".$dbRow['rcrdId'];
            //echo $tmpSQL."</br>";
            mysqli_query(dbManager::getConnection(), $tmpSQL);
        }
    }
}
?>
