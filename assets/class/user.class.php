<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 3/17/2018
 * Time: 3:28 PM
 */


include_once 'assets/config/config.php';
include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');

class user extends db
{
    public static function userQuery($sql)
    {
        $result = mysqli_query(self::$mysqli,$sql) or
        die(mysqli_connect_error());
        $user_data = mysqli_fetch_array($result);
        $count_row = $result->num_rows;
        if($count_row == 1) {
            return $user_data;
        }
        else {
            return mysqli_connect_error();
        }
    }

    public static function login($username,$password)
    {
        session_start();
        $hashedpassword = md5($password . SECRETHASH);
        $loginsql = "SELECT username, password, accessLevel FROM users WHERE username = '" . $username . "'AND password = '" . $hashedpassword . "'";
        $row = self::userQuery($loginsql);
        if(is_array($row))
        {
            $_SESSION["login_user"] = $row['username'];
            $_SESSION["accessLevel"] = $row['accessLevel'];
            $RNGsessionid = bin2hex(openssl_random_pseudo_bytes(16));
            $updatesql = "UPDATE users SET sessionid = ' " . $RNGsessionid . " ' WHERE username='" . $_POST["username"] . "'";
            $result = self::query($updatesql) or
                die(mysqli_connect_error());
            $_SESSION['sessionid'] = $RNGsessionid;
            return $result;
        }
        else{
            popup('Invalid Username or Password!',"index.php");
        }
    }

    public static function getSessionUsername($username,$session)
    {
        $sessionCheckSQL = "SELECT sessionid FROM users WHERE username = '$username'";
        $userData = self::userQuery($sessionCheckSQL);
        if($userData != -1) {
            return $_SESSION['login_user'];
        }
        else
        {
            popup("Not logged in, please login.","index.php");
        }
    }

    public static function getAccessLevel($username)
    {
        $accessCheckSQL = "SELECT accessLevel FROM users WHERE username = '$username'";

        $result = mysqli_query(self::$mysqli,$accessCheckSQL);
        $user_data = mysqli_fetch_array($result);
        $count_row = $result->num_rows;
        if($count_row == 1)
        {
            return $user_data['accessLevel'];
        }
        else {
            return 0;
        }
    }
}