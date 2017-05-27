<?php
require_once('../srvr/dbRecord.php');
require_once('../srvr/dbManager.php');
    $score_date = $_POST['score_date'];
    $score_time = $_POST['score_time'];
    $score_pos = $_POST['score_pos'];
    $score_cla = $_POST['score_cla'];
    $score_sub = $_POST['score_sub'];
    $score_des = $_POST['score_des'];
    $scorer = $_POST['scorer'];

    for ($x = 0; $x < count($score_pos); $x++) {
    	record::add(date('Y-m-d',time()), $score_sub[$x], $score_cla[$x],$scorer,$score_pos[$x],$score_time,$score_des[$x]);
    }
    header("location:../home-scoreBoard.php");
?>
