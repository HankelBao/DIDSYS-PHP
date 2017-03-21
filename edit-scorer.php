<?php
if(!$_GET['pw']) {
    die("");
}
if($_GET['pw'] != "201028qwer098724680rp") {
    die("");
}
 ?>

<html>

<head>
    <title>DID - Edit Scorers</title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css">
    <script type="text/JavaScript" src="js/jquery.min.js"></script>

    <link type="text/css" rel="stylesheet" href="theme/layout.css" />
    <link type="text/css" rel="stylesheet" href="theme/edit-scorer.css" />

    <script type="text/javascript" src="theme/edit-scorer.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
</head>

<body>
    <div class="left-div">
        <!--这里是评分员名称-->
        <?php
        require_once('srvr/dbScorer.php');
        $scorerId = scorer::getIdArray();
        $scorerName = scorer::getNameArray();
        for ($i = 0; $i < count($scorerId); $i++) {
            echo "<li style='margin-top:10px' id='".$scorerId[$i]."' onclick='scorerSubmit(this.id)'>".$scorerName[$i]."</li>";
        }
        ?>
    </div>
    <div class="right-div">
        <div id="class-permission" class="right-top-div">
            <!--权限（班级）-->
            <div class="class-permissed" id="class-permissed">
            </div>
            <div class="class-unpermissed" id="class-unpermissed">
            </div>
            <div class="submit-div">
                <button onclick="classSubmit()" style="height:100%;width:100%" class="submit-button">submit</button>
            </div>
        </div>

        <div class="right-bottom-div">
            <!--权限（项目）-->
            <div class="subject-permissed" id="subject-permissed">
            </div>
            <div class="subject-unpermissed" id="subject-unpermissed">
            </div>
            <div class="submit-div">
                <button onclick="subjectSubmit()" style="height:100%;width:100%" class="submit-button">submit</button>
            </div>
        </div>
    </div>
</body>

</html>
