<?php
class error {
    public static function show($errorType) {
        switch($errorType) {
            case 'dbConnectionError':
                die('database connect failed, Please contact HankelBao');
                break;
            case 'dbQueryError':
                die('database query error, Please contact HankelBao');
                break;
            case 'attack':
                die();
                break;
        }
    }
}
