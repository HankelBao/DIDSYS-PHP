<?php
require_once('../srvr/dbClas.php');
require_once('../srvr/dbSubject.php');
require_once('../srvr/dbRel_scorerClass.php');
require_once('../srvr/dbRel_scorerSubject.php');

if($_GET['action']) {
    $action = $_GET['action'];
    switch($action) {
    case 'getClassAll':
        $classId = clas::getIdArray();
        $className = clas::getNameArray();
        $ret_arr = array('idArray' => $classId,
                    'nameArray' => $className);
        echo json_encode($ret_arr);
        break;
    case 'getClassPermissed':
        $scorerId = $_GET['scorerId'];
        $classId =  rel_scorerClass::getClassIdByScorerId($scorerId);
        echo json_encode($classId);
        break;
    case 'getSubjectAll':
        $subjectId = subject::getIdArray();
        $subjectName = subject::getNameArray();
        $ret_arr = array('idArray' => $subjectId,
                    'nameArray' => $subjectName);
        echo json_encode($ret_arr);
        break;
    case 'getSubjectPermissed':
        $scorerId = $_GET['scorerId'];
        $subjectId =  rel_scorerSubject::getSubjectIdByScorerId($scorerId);
        echo json_encode($subjectId);
        break;
    case "submitClass":
        $JSONClass = $_GET['classPermissed'];
        $class = json_decode($JSONClass);

        $tmpSQL = 'DELETE FROM rel_scorerClass WHERE rsc_scorerId='.$_GET['scorerId'].';';
        mysqli_query(dbManager::getConnection(), $tmpSQL);
        for ($i=0; $i<count($class); $i++) {
            $tmpSQL = 'INSERT INTO rel_scorerClass(rsc_scorerId, rsc_classId) VALUES ('.$_GET['scorerId'].','.$class[$i].');';
            mysqli_query(dbManager::getConnection(), $tmpSQL);
        }
        break;
    case "submitSubject":
        $JSONSubject = $_GET['subjectPermissed'];
        $subject = json_decode($JSONSubject);

        $tmpSQL = 'DELETE FROM rel_scorerSubject WHERE rss_scorerId='.$_GET['scorerId'].';';
        mysqli_query(dbManager::getConnection(), $tmpSQL);
        for ($i=0; $i<count($subject); $i++) {
            $tmpSQL = 'INSERT INTO rel_scorerSubject(rss_scorerId, rss_subjectId) VALUES ('.$_GET['scorerId'].','.$subject[$i].');';
            mysqli_query(dbManager::getConnection(), $tmpSQL);
        }
        break;
    }
}

?>
