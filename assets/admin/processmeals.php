<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 3/19/2018
 * Time: 12:46 PM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');
$db = new db();

$meal_id = mysqli_real_escape_string(db::$mysqli,$_POST['meal_id']);
$newMealName = mysqli_real_escape_string(db::$mysqli,$_POST['newMealName']);
$newMealImage = mysqli_real_escape_string(db::$mysqli,$_POST['newMealImage']);
$newMealIngredients = mysqli_real_escape_string(db::$mysqli,$_POST['newMealIngredients']);
$newMealMethod = mysqli_real_escape_string(db::$mysqli,$_POST['newMealMethod']);
$newMealShortDescription = mysqli_real_escape_string(db::$mysqli,$_POST['newMealShortDescription']);
$newMealType = mysqli_real_escape_string(db::$mysqli,$_POST['newMealType']);
$newIsVeg = mysqli_real_escape_string(db::$mysqli,$_POST['newIsVeg']);
$newCookTime = mysqli_real_escape_string(db::$mysqli,$_POST['newMealCookTime']);
$newPrepTime = mysqli_real_escape_string(db::$mysqli,$_POST['newMealPrepTime']);
$newDatePublished = mysqli_real_escape_string(db::$mysqli,date('o-m-d'));
$newMealServes = mysqli_real_escape_string(db::$mysqli,$_POST['newMealServes']);
$newMealTime = mysqli_real_escape_string(db::$mysqli,$_POST['newMealTime']);

if(checkIfExistsInDB($_POST['newMealName'],'meals', 'meal_name') && !isset($_GET['u']))
{
    popup("Name exists, please choose another name", "assets/admin/addrecipe.php");
}
else if(isset($_POST['newMealName']) && !isset($_GET['u']))
{
    //echo "insert works";

    $arrayIngredients = array();
    $arrayMethod = array();

    foreach ($_POST['newMealIngredients'] as $data => $value)
    {
        array_push($arrayIngredients,$value);
    }
    foreach ($_POST['newMealMethod'] as $data => $value)
    {
        array_push($arrayMethod,$value);
    }

    $serialisedMethod = mysqli_real_escape_string(db::$mysqli,serialize($arrayMethod));
    $serialisedIngredient = mysqli_real_escape_string(db::$mysqli,serialize($arrayIngredients));

    $result = db::query("INSERT INTO meals (meal_name, veg, meal_image, meal_type, meal_time, short_description, meal_ingredients, meal_method, meal_cook_time, meal_serves, meal_prep_time, date_published) VALUES 
                                              ('$newMealName', '$newIsVeg', 
                                              '$newMealImage', '$newMealType', 
                                              '$newMealTime', '$newMealShortDescription', 
                                              '$serialisedIngredient', '$serialisedMethod', '$newCookTime', 
                                              '$newMealServes', '$newPrepTime', '$newDatePublished')");
    if($result)
    {
        popup("Recipe Added!, returning to all recipes","assets/admin/editmealsitems.php");
    }
}
else if (isset($_POST['mNameToDelete']) && isset($_GET['u']))
{
    $delete = $_POST['mNameToDelete'];
    $result = db::query("DELETE FROM meals WHERE meal_id = '$delete'");

    if($result)
    {
        popup("Recipe Deleted!, returning to all recipes","assets/admin/editmealsitems.php");
    }
}

else if (!isset($_POST['mNameToDelete']) && isset($_GET['u']))
{
    //echo "update";

    $arrayIngredients = array();
    $arrayMethod = array();

    foreach ($_POST['newMealIngredients'] as $data => $value)
    {
        array_push($arrayIngredients,$value);
    }
    foreach ($_POST['newMealMethod'] as $data => $value)
    {
        array_push($arrayMethod,$value);
    }

    $serialisedMethod = mysqli_real_escape_string(db::$mysqli,serialize($arrayMethod));
    $serialisedIngredient = mysqli_real_escape_string(db::$mysqli,serialize($arrayIngredients));


    $sql = "UPDATE meals SET meal_name = '$newMealName', veg = '$newIsVeg', meal_image = '$newMealImage', meal_type = '$newMealType', meal_time = '$newMealTime', short_description = '$newMealShortDescription', meal_ingredients = '$serialisedIngredient', meal_method = '$serialisedMethod', meal_cook_time = '$newCookTime', meal_serves = '$newMealServes', meal_prep_time = '$newPrepTime' WHERE meal_id = '$meal_id'";

    echo $sql;
    $result = db::query($sql);

    if($result)
    {
        popup("Recipe Updated!, returning to all recipes","assets/admin/editmealsitems.php");
    }
}
?>