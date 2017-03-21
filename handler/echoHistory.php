<?php
$clasId = $_GET['clasId'];
$subId = $_GET['subId'];
$scrrId = $_GET['scrrId'];

if($clasId != 'undefined')
    $clasSQL = " rcrd_classId = '".$clasId."'";
else
    $clasSQL = "";

if($subId != 'undefined')
    if ($clasSQL == "")
        $subSQL = " rcrd_subjectId = '".$subId."'";
    else
        $subSQL = " AND rcrd_subjectId = '".$subId."'";
else
    $subSQL = "";

if($scrrId != 'undefined')
    if (($clasSQL == "") && ($subSQL == ""))
        $scrrSQL = " rcrd_scorerId = '".$scrrId."'";
    else
        $scrrSQL = " AND rcrd_scorerId = '".$scrrId."'";
else
    $scrrSQL = "";

$SQL = "";
if ( ($clasSQL != "") || ($subSQL != "") || ($scrrSQL != ""))
    $SQL = "WHERE".$clasSQL.$subSQL.$scrrSQL;

require_once('../srvr/history.php');
//echo $SQL."</br>";
history::echoHistory($SQL);
?>
