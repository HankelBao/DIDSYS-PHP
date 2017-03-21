<!DOCTYPE html>
<html>
    <head>
        <title>苏外纪检部</title>
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="theme/layout.css"/>
        <link tyoe="text/css" rel="stylesheet" href="theme/home-history.css" />
        <script type="text/javaScript" src="js/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <script type="text/javascript">
        var clasId;
        var subId;
        var scrrId;
        function clasChange(value) {
            clasId = value;
            AjaxUpdate();
        }
        function subChange(value) {
            subId = value;
            AjaxUpdate();
        }
        function scrrChange(value) {
            scrrId = value;
            AjaxUpdate();
        }
        function AjaxUpdate() {
            url = "handler/echoHistory.php?clasId="+clasId+"&subId="+subId+"&scrrId="+scrrId;
            //alert(url);En
            $("#history-div").load(url);
        }
        </script>
    </head>

    <body onload='AjaxUpdate()'>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <div class="nav-div">
            <img src="SFLS.jpg" width="70px" height="70px"/>
            <a href="index.php" class="link-div">苏外纪检部</a>
            <a href="home-rules.php" class="link-div">规则</a>
            <a href="home-scoreBoard.php" class="link-div">记分板</a>
            <a href="home-history.php" class="link-div active">历史</a>
            <a href="home-stat.php" class="link-div">统计</a>
            <a href="home-scorer.php" class="link-div">评分入口</a>
        </div>
        <div class="pos-center-div">
            <form>
                Scorer Name:
                <select onchange='scrrChange(this[selectedIndex].id);'>
                    <option id="undefined">ALL</option>
                <?php
                    require_once('srvr/dbScorer.php');
                    $scorerId = scorer::getIdArray();
                    $scorerName = scorer::getNameArray();
                    for ($i = 0; $i < count($scorerId); $i++) {
                        echo "<option id='".$scorerId[$i]."'>".$scorerName[$i]."</option>";
                    }
                ?>
                </select>

                Class:
                <select onchange='clasChange(this[selectedIndex].id);'>
                    <option id="undefined">ALL</option>
                <?php
                    require_once('srvr/dbClas.php');
                    $className = clas::getNameArray();
                    $classId = clas::getIdArray();
                    for ($i = 0; $i < count($classId); $i++) {
                        echo "<option id='".$classId[$i]."'>".$className[$i]."</option>";
                    }
                ?>
                </select>

                Subject:
                <select onchange='subChange(this[selectedIndex].id);'>
                    <option id="undefined">ALL</option>
                <?php
                    require_once('srvr/dbSubject.php');
                    $subjectName = subject::getNameArray();
                    $subjectId = subject::getIdArray();
                    for ($i = 0; $i < count($subjectId); $i++) {
                        echo "<option id='".$subjectId[$i]."'>".$subjectName[$i]."</option>";
                    }
                ?>
                </select>
            </form>
        </div>
        <div id="history-div" class="pos-center-div">
        </div>
    </body>
</html>
