<?php
require_once('../srvr/dbManager.php');

$subId  = dbManager::getArray("subject", "subId");
$subName= dbManager::getArray("subject", "subName");

$tmpSQL = 'SELECT * FROM record WHERE
    rcrdDate = "'.$srchDate.'" and rcrd_subjectId = '.$srchSub_id.' and rcrd_classId = '.$srchCla_id;
$dbRowCollect = mysqli_query(dbManager::getConnection(), $tmpSQL);

 ?>
