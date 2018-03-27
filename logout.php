<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');
$db = new db();

if(!empty($_POST["logout"])) {
	//echo 'logout';
	$updatesql = "UPDATE users SET sessionid = NULL WHERE username='" . $_SESSION["login_user"] . "'";

	$result = db::query($updatesql) or
        die(mysqli_connect_error());
	$_SESSION["login_user"] = null;
	$_SESSION["sessionid"] = null;
	session_destroy();
    pageReturn(siteroot());
}
?>