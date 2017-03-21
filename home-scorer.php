<?php
    require_once('srvr/account.php');
    account::checkSession();
?>

<html>
    <head>
        <title>苏外纪检部</title>
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="theme/layout.css"/>
        <link type="text/css" rel="stylesheet" href="theme/home-scorer.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    </head>

    <body>
        <script type="text/javascript" src="js/jquery.min.js"></script>

        <div class="nav-div">
            <img src="SFLS.jpg" width="70px" height="70px"/>
            <a href="index.php" class="link-div">苏外纪检部</a>
            <a href="home-rules.php" class="link-div">规则</a>
            <a href="home-scoreBoard.php" class="link-div">记分板</a>
            <a href="home-history.php" class="link-div">历史</a>
            <a href="home-stat.php" class="link-div">统计</a>
            <a href="home-scorer.php" class="link-div active">评分入口</a>
        </div>

        <div class="pos-center-div">
            <div class="title-div">Welcome! <?php echo $_SESSION['scorer_name']; ?> </div>
            <div class="subtitle-div">It's <?php echo date('y年m月d日',time())?> today. Your score will be updated to scoreboard at 5:30</div>
            <div class="warntitle-div">You must score carefully, very carefully!!</div>
        </div>

        <div class="pos-center-div">
       <?php
            require_once('srvr/dbManager.php');
            require_once('srvr/dbSubject.php');
            require_once('srvr/dbClas.php');
            require_once('srvr/table.php');
            require_once('srvr/form.php');
            require_once('srvr/dbRecord.php');
            require_once('srvr/dbRel_scorerClass.php');
            require_once('srvr/dbRel_scorerSubject.php');

            $classId = rel_scorerClass::getClassIdByScorerId(session::getScorerId());
            $className = array();
            for($i=0; $i<count($classId); $i++)
                $className[] = clas::getNameById($classId[$i]);
            $subjectName = array();
            $subjectId = rel_scorerSubject::getSubjectIdByScorerId(session::getScorerId());
            for($i=0; $i<count($subjectId); $i++) {
                $subjectName[] = subject::getNameById($subjectId[$i]);
            }

            echo "<form action='handler/scoreSubmit.php' method='POST'>";

            echo form::invisible("score_date", date('y-m-d',time()));
            echo form::invisible("score_time", date('y-m-d h:i:s',time()));
            echo form::invisible("scorer", $_SESSION['scorer_id']);

            table::echoHead($subjectName);
            for ($i = 0; $i < count($classId); $i++) {
                unset($score);
                for ($j = 0; $j < count($subjectId); $j++) {
                    $value = record::getScore(date('y-m-d',time()), $subjectId[$j], $classId[$i]);
                    $des = record::getDes(date('y-m-d',time()), $subjectId[$j], $classId[$i]);
                    if ($value)
                        $echoScoreInput = "<input class='input-def' value='".$value."' name='score_pos[]' type='text'/>";
                    else
                        $echoScoreInput = "<input class='input-def' name='score_pos[]' type='text'/>";
                    
                    if ($des)
                        $echoScoreInput .= "<input class='input-def' value='".$des."'name='score_des[]' type='text'/>";
                    else
                        $echoScoreInput .= "<input class='input-def' placeholder='description' name='score_des[]' type='text'/>";

                    $echoScoreCla = form::invisible("score_cla[]", $classId[$i]);
                    $echoScoreSub = form::invisible("score_sub[]", $subjectId[$j]);
                    $score[] = $echoScoreInput.' '.$echoScoreCla.' '.$echoScoreSub.' ';//.$echoDesInput;
                }
                table::echoRow($className[$i], $score);
            }
            table::echoEnd();

            echo "<button style='margin-top: 25px;' class='submit-button' style='height:35px;width:100%' type='submit'>Submit</button>";
            echo "</form>";
        ?>
        </div>
    </body>
</html>
