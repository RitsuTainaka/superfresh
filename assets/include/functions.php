<?php

function root()
{
    $rootdir = $_SERVER['DOCUMENT_ROOT'] . '/dwda1/';
    return $rootdir;
}

function addfooter()
{
    return include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/footer.php');
}

function includeFile($fileFromIncludeFolder)
{
    return "http://" . $_SERVER['SERVER_NAME'] . "/dwda1/" . $fileFromIncludeFolder;
}

function siteroot()
{
    return "http://" . $_SERVER['SERVER_NAME'] . "/dwda1/";
}

function popup($string,$returnpage)
{
    echo "<script type='text/javascript'>alert('$string');</script>";
    header("refresh:0; url=". siteroot() . $returnpage);
    die();
}

function pageReturn($string)
{
    header("refresh:0; url=" . $string);
}

function pageReturnPopup($string,$returnURL)
{
    echo "<script type='text/javascript'>alert('$string');</script>";
    header("refresh:0; url=" . $returnURL);
}

function adminCheck($username)
{
    include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/config/functions.php');
    $user = new user();
    if(user::getAccessLevel($username) != 100)
    {
        popup("Unauthorised Access", "index.php");
        die();
        //http_redirect("index.php");
    }
    return;
}

function checkIfExistsInDB($name, $table, $column )
{
    include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/config/functions.php');
    $db = new db();
    $result =  db::query("SELECT * from $table WHERE $column = '$name'");
    $count_row = $result->num_rows;
    if($count_row == 1)
    {
        return 1;
    }
    else {
        return 0;
    }
}

function debug()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

function classAutoLoad($class)
{
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/class/' . $class . '.class.php');
}

function time_to_iso8601_duration($time) {
    $units = array(
        "Y" => 365*24*3600,
        "D" =>     24*3600,
        "H" =>        3600,
        "M" =>          60,
        "S" =>           1,
    );

    $str = "P";
    $istime = false;

    foreach ($units as $unitName => &$unit) {
        $quot  = intval($time / $unit);
        $time -= $quot * $unit;
        $unit  = $quot;
        if ($unit > 0) {
            if (!$istime && in_array($unitName, array("H", "M", "S"))) { // There may be a better way to do this
                $str .= "T";
                $istime = true;
            }
            $str .= strval($unit) . $unitName;
        }
    }

    return $str;
}


?>