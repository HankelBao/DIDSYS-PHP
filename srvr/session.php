<?php
class session {
    public static function active() {
        if(!isset($_SESSION)){
            session_start();
        }
    }

    public static function register($scorerId, $scorerName) {
        self::active();
        $_SESSION['log'] = true;
        $_SESSION['scorer_id'] = $scorerId;
        $_SESSION['scorer_name'] = $scorerName;
    }

    public static function destory() {
        self::active();
        unset($_SESSION);
        session_destroy();
    }

    public static function check() {
        self::active();
        if(!isset($_SESSION['log'])) {
	        return FALSE;
        } else {
            return TRUE;
        }
    }

    public static function getScorerId() {
        if (self::check() == TRUE) {
            return $_SESSION['scorer_id'];
        } else {
            return 0;
        }
    }

    public static function getScorerName() {
        if ($this->check() == TRUE) {
            return $_SESSION['scorer_id'];
        } else {
            return 0;
        }
    }
}
?>
