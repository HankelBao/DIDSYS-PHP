<?php
require_once('session.php');
require_once('dbScorer.php');

class account {
    public static function SignIn($username,$password) {
        $account = scorer::selectAccount($username);
        if ($account) {
            if ($account['scrrPassword'] == $password) {
                session::register($account['scrrId'], $account['scrrName']);
                self::turnToEntry();
            } else {
                self::turnToLogin();
            }
        } else {
            self::turnToLogin();
        }
    }

    public static function checkSession() {
        if (session::check() == FALSE) {
	        self::turnToLogin();
        }
    }

    private static function turnToLogin() {
        header("location:../home-scorer-login.php");
        exit;
    }

    private static function turnToEntry() {
        header("location:../home-scorer.php");
        exit;
    }
}
?>
