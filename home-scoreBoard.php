<html>
    <head>
        <title>苏外纪检部</title>
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="theme/layout.css"/>
        <link type="text/css" rel="stylesheet" href="theme/home-scoreboard.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    </head>

    <body>
        <script type="text/javascript" src="js/jquery.min.js"></script>

        <script type="text/javascript">
            $(function(){
                $("tr:odd").css("background","#FF5151");
               // $("tr:odd").css("color","#000000");
            })
        </script>

        <div class="nav-div">
            <img src="SFLS.jpg" width="70px" height="70px"/>
            <a href="index.php" class="link-div">苏外纪检部</a>
            <a href="home-rules.php" class="link-div">规则</a>
            <a href="home-scoreBoard.php" class="link-div active">记分板</a>
            <a href="home-history.php" class="link-div">历史</a>
            <a href="home-stat.php" class="link-div">统计</a>
            <a href="home-scorer.php" class="link-div">评分入口</a>
        </div>

        <div class="scoreboard-div">
        <?php
            $currentHour = date('H:i',time());
            if ($currentHour >= '17:30')
                $displayDate = date('Y-m-d',time());
            else
                $displayDate = date("Y-m-d",strtotime("-1 day"));
        ?>
            <div class="script-div">以下是<?php echo $displayDate?>的计分表:</div>
            <div class="subscript-div">为保证数据已被审核，当日数据会在下午5:30后刷新</div>
        <?php
            require_once('srvr/dbRecord.php');
            require_once('srvr/dbSubject.php');
            require_once('srvr/dbClas.php');
            require_once('srvr/table.php');

            $subjectName = subject::getNameArray();
            $subjectId = subject::getIdArray();
            $className = clas::getNameArray();
            $classId = clas::getIdArray();

            table::echoHead($subjectName);
            for ($i = 0; $i < count($classId); $i++) {
                unset($disStr);
                for ($j = 0; $j < count($subjectId); $j++) {
                    $str = record::getScore($displayDate, $subjectId[$j], $classId[$i]);
                    $des = record::getDes($displayDate, $subjectId[$j], $classId[$i]);
                    if($des)
                        $str .= " (".$des.")";
                    $disStr[] = $str;
                }
                table::echoRow($className[$i], $disStr);
            }
            table::echoEnd();
        ?>
        </div>
    </body>
</html>
