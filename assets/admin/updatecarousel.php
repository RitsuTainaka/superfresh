<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 3/19/2018
 * Time: 8:32 AM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');

$db = new db();


list($currentCarousel, $newCarousel) = explode('=', file_get_contents('php://input'), 2);
//xdebug_var_dump($currentCarousel);

if($currentCarousel != "unused") {
    $result = db::query("SELECT * FROM carousel WHERE carousel_name = '$currentCarousel'")
    or die(mysqli_connect_error());
    $carouselCheck = mysqli_fetch_array($result);
    $carouselCheckBool = $carouselCheck['carousel_is_enabled'];
}
else
{
    $carouselCheckBool = FALSE;
}

if($carouselCheckBool == TRUE && $newCarousel != "disable") {

    db::query("UPDATE carousel SET carousel_is_enabled = FALSE WHERE carousel_name = 'currentCarousel'")
    or die(mysqli_connect_error());
    db::query("UPDATE carousel SET carousel_is_enabled = TRUE WHERE carousel_name = '$newCarousel'")
    or die(mysqli_connect_error());
    popup("updated carousel", "assets/admin/editcarousel.php");
}
else if($currentCarousel == "unused")
{
    db::query("UPDATE carousel SET carousel_is_enabled = TRUE WHERE carousel_name = '$newCarousel'")
    or die(mysqli_connect_error());
    popup("updated displayed carousel", "assets/admin/editcarousel.php");
}
else if($newCarousel == "disable")
{
    db::query("UPDATE carousel SET carousel_is_enabled = FALSE WHERE carousel_name = '$currentCarousel'")
    or die(mysqli_connect_error());
    popup("carousel item disabled", "assets/admin/editcarousel.php");
}
else
{

    popup("error, carousel is already set", "assets/admin/editcarousel.php");
}
