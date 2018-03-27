<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 3/16/2018
 * Time: 9:59 AM
 */
include_once ($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/config/functions.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/config/config.php');

class db
{
    public static $mysqli;

    public function __construct()
    {
        session_start();
        self::$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if(mysqli_connect_errno()) {
            echo("Could not connect to DB: " . mysqli_connect_error());
            exit();
        }
    }

    public static function query($sql)
    {
        //xdebug_var_dump($sql);
        $result = mysqli_query(self::$mysqli,$sql)
            or die(mysqli_connect_error());
        return $result;
    }

    public static function test()
    {
        return "works";
    }
}