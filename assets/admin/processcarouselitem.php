<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 3/19/2018
 * Time: 12:46 PM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');

$db = new db();

if(checkIfExistsInDB($_POST['newCName'],'carousel', 'carousel_name'))
{
    popup("Name exists, please choose another name", "assets/admin/addcarouselitem.php");
}
else if(isset($_POST['newCName']))
{
    $newCName = mysqli_real_escape_string(db::$mysqli,$_POST['newCName']);
    $newCImage = mysqli_real_escape_string(db::$mysqli,$_POST['newCImage']);
    $newCBody = mysqli_real_escape_string(db::$mysqli,$_POST['newCBody']);
    $newCURL = mysqli_real_escape_string(db::$mysqli,$_POST['newCURL']);
    if (isset($_POST['enabled'])) {
        $enabled = mysqli_real_escape_string(db::$mysqli, $_POST['enabled']);
    }
    else
    {
        $enabled = 0;
    }

    $result = db::query("INSERT INTO carousel (carousel_name, carousel_image_link, carousel_body, carousel_url, carousel_is_enabled) VALUES ('$newCName', '$newCImage', '$newCBody', '$newCURL', '$enabled')");
    //xdebug_var_dump($result);
    if($result)
    {
        popup("success","assets/admin/editcarousel.php");
    }
}
else if (isset($_POST['cNameToDelete']))
{
    $name = $_POST['cNameToDelete'];
    $result = db::query("DELETE FROM carousel WHERE carousel_name = '$name'")
        or die(mysqli_connect_error());

    if($result)
    {
        popup("Carousel item deleted", "assets/admin/editcarousel.php");
    }
    else
    {
        popup("error", "assets/admin/editcarousel.php");
    }
}
?>