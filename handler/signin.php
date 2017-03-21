<?php

require_once('../srvr/account.php');
require_once('../srvr/dbManager.php');

$username = mysqli_real_escape_string(dbManager::getConnection(), $_POST["username"]);
$password = mysqli_real_escape_string(dbManager::getConnection(), $_POST["password"]);

account::signIn($username, $password);

?>
