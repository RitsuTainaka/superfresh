<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$pageid = 'admin';
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 1/29/2018
 * Time: 5:52 PM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/header.php');

$db = new db();


$dayOfWeek = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");

foreach ($dayOfWeek as $item) {
    echo $item . '<br>';
}
include_once(root() . 'assets/include/footer.php');
?>