<html>
<body>
<?php
    session_start();
    include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');
	$user = new user();
	if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $username = mysqli_real_escape_string($user::$mysqli,$_POST['username']);
        $password = mysqli_real_escape_string($user::$mysqli,$_POST['password']);

        $login = $user::login($username,$password);
        if($login)
        {
            popup("Login Successful","index.php");
        }
        else
        {
            popup("Invalid Username or Password","index.php");
        }
    }
?>
</body>
</html>