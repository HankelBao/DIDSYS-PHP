<!DOCTYPE html>
<html>
    <head>
        <title>苏外纪检部</title>
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="theme/layout.css"/>
        <link type="text/css" rel="stylesheet" href="theme/home-stat.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <script type="text/javascript">
        function showWeek() {
            $("#WeekStat").show();
            $("#MonthStat").hide();
            $("#SemesterStat").hide();
        }
        function showMonth() {
            $("#WeekStat").hide();
            $("#MonthStat").show();
            $("#SemesterStat").hide();
        }
        function showSemester() {
            $("#WeekStat").hide();
            $("#MonthStat").hide();
            $("#SemesterStat").show();
        }
        </script>
    </head>

    <body>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <div class="nav-div">
            <img src="SFLS.jpg" width="70px" height="70px"/>
            <a href="index.php" class="link-div">苏外纪检部</a>
            <a href="home-rules.php" class="link-div">规则</a>
            <a href="home-scoreBoard.php" class="link-div">记分板</a>
            <a href="home-history.php" class="link-div">历史</a>
            <a href="home-stat.php" class="link-div active">统计</a>
            <a href="home-scorer.php" class="link-div">评分入口</a>
        </div>
        <div class="pos-center-div">
            <button onclick="showWeek()" class="button-select-view">Week View</button>
            <button onclick="showMonth()" class="button-select-view">Month View</button>
            <button onclick="showSemester()" class="button-select-view">Semester View</button>
        </div>
        <div class="pos-center-div">
        <?php
        require_once('srvr/dbManager.php');

        $claId  = dbManager::getArray("class", "clsId");
        $claName= dbManager::getArray("class", "clsName");

        echo '<div id="WeekStat">';
	require_once('srvr/table.php');
	table::echoHead(array("Mon","Tue","Wed","Thu","Fri","Sum"));

        for ($i = 0; $i < count($claId); $i++) {
            unset($echoArrayWeek);
	        for ($j = 0; $j < 5; $j++) { 
		        $tmpSQL = 'SELECT * FROM record WHERE rcrd_classId = '.$claId[$i].' AND  DATE_FORMAT(rcrdScoreTime,"%U") = DATE_FORMAT(now(),"%U") AND DATE_FORMAT(rcrdScoreTime,"%w") = '.($j+1);
                $dbRowCollect = mysqli_query(dbManager::getConnection(), $tmpSQL);
                $dbRow = mysqli_fetch_array($dbRowCollect);
                $echoArrayWeek[] = $dbRow["rcrdScore"];                    
	        }
            $tmpSQL = 'SELECT sum(rcrdScore) FROM record WHERE rcrd_classId = '.$claId[$i].' AND  DATE_FORMAT(rcrdScoreTime,"%U") = DATE_FORMAT(now(),"%U")';
            $dbRowCollect = mysqli_query(dbManager::getConnection(), $tmpSQL);
            $dbRow = mysqli_fetch_array($dbRowCollect);
            $echoArrayWeek[] = $dbRow[0];
	        table::echoRow($claName[$i], $echoArrayWeek);
        }
	table::echoEnd();
        echo '</div>';

        echo '<div style="display:none" id="MonthStat"><ul>';
        for ($i = 0; $i < count($claId); $i++) {
            echo "<li>".$claName[$i].":";
            $tmpSQL = 'SELECT sum(rcrdScore) FROM record WHERE rcrd_classId = '.$claId[$i]." AND DATE_FORMAT( rcrdScoreTime, '%Y%m' ) = DATE_FORMAT( CURDATE() , '%Y%m' );";
            $dbRowCollect = mysqli_query(dbManager::getConnection(), $tmpSQL);
            $dbRow = mysqli_fetch_array($dbRowCollect);
            echo $dbRow[0]."</li>";
        }
        echo '</ul></div>';

        echo '<div style="display:none" id="SemesterStat"><ul>';
        for ($i = 0; $i < count($claId); $i++) {
            echo "<li>".$claName[$i].":";
            $tmpSQL = 'SELECT sum(rcrdScore) FROM record WHERE rcrd_classId = '.$claId[$i].' AND rcrdDate>="2017-2-12" AND rcrdDate<="2017-6-30";';
            $dbRowCollect = mysqli_query(dbManager::getConnection(), $tmpSQL);
            $dbRow = mysqli_fetch_array($dbRowCollect);
            echo $dbRow[0]."</li>";
        }
        echo '</ul></div>';
        ?>
        </div>
    </body>
</html>
