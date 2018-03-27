<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');

$user = new user();

$pattern = '/(?<=\d).*((?<=[a-z]).*[A-Z]|(?<=[A-Z]).*[a-z])|(?<=[a-z]).*((?<=[A-Z]).*\d|(?<=\d).*[A-Z])|(?<=[A-Z]).*((?<=[a-z]).*\d|(?<=\d).*[a-z])/';
$pass = trim($pass);
if($_SERVER["REQUEST_METHOD"] == "POST") 
{
	if (!empty($_POST['password']) && strlen($_POST['password']) > 7 && preg_match($pattern, $_POST['password']))
	{//not empty, match ANY character after trimming the string 8 or more times
			  
		$myusername = mysqli_real_escape_string(user::$mysqli,$_POST['username']);
		$mypassword = mysqli_real_escape_string(user::$mysqli,$_POST['password']);
		$myemail = mysqli_real_escape_string(user::$mysqli,$_POST['email']);
		
		$myAccessLevelCheck = $_POST['accessLevel'];
		$encryptedMessage = md5($mypassword . SECRETHASH);

		if(isset($myAccessLevelCheck))
		{
			$myAccessLevel = mysqli_real_escape_string(user::$mysqli,$_POST['accessLevel']);
		}
		else
		{
			$myAccessLevel = 1;
		}
		
		//check username does not exists
        $sqlUsernameCheck = user::query("SELECT username FROM users WHERE username = '$myusername'")
			or die("Error: ".mysqli_error(user::$mysqli));
        $usernameRow = mysqli_fetch_array($sqlUsernameCheck);
		if($usernameRow != null)
		{
			if($user->getAccessLevel($_SESSION['login_user']) == 100)
			{
			   $page = "assets/admin/adduser.php";
			}
			else
			{
			   $page = "register.php";
			}
            popup("Username exists, please choose another username",$page);
            exit($sqlUsernameCheck);
		}

		user::query("INSERT INTO users (username, email, password, accessLevel) VALUES ('$myusername','$myemail','$encryptedMessage', '$myAccessLevel')")
		    or die("Error: ".mysqli_error(user::$mysqli));

		if($user->getAccessLevel($_SESSION['login_user']) == 100)
		{
		    popup("Account Registered, Returning to Admin Dashboard","assets/admin/admin.php");
		}
		else
		{
			popup("Account Registered, Please login","index.php");
		}
		die("Error");
		//echo 'Worked';
	}
	else
	{
		popup("Password not accepted, please try again.","register.php");
		die();
	}
}
else
{
    pageReturn(siteroot());
}