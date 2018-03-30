<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 3/19/2018
 * Time: 12:46 PM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');
$db = new db();
if(checkIfExistsInDB($_POST['newMealName'],'meals', 'meal_name') && !isset($_GET['u']))
{
    popup("Name exists, please choose another name", "assets/admin/addrecipe.php");
}
else if(isset($_POST['newMealName']) && !isset($_GET['u']))
{
    echo "insert works";
  /*  $newMealName = mysqli_real_escape_string(db::$mysqli,$_POST['newMealName']);
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

    $serialisedMethod = serialize($arrayMethod);
    $serialisedIngredient = serialize($arrayIngredients);

    $result = db::query("INSERT INTO meals (meal_name, veg, meal_image, meal_type, meal_time, short_description, meal_ingredients, meal_method, meal_cook_time, meal_serves, meal_prep_time, date_published) VALUES 
                                              ('$newMealName', '$newIsVeg', 
                                              '$newMealImage', '$newMealType', 
                                              '$newMealTime', '$newMealShortDescription', 
                                              '$serialisedIngredient', '$serialisedMethod', '$newCookTime', 
                                              '$newMealServes', '$newPrepTime', '$newDatePublished')");
    if($result)
    {
        popup("Recipe Added!, returning to all recipes","assets/admin/editmealsitems.php");
    }*/
}
else if (isset($_POST['mNameToDelete']) && isset($_GET['u']))
{
    echo 'delete works';
}

else if (!isset($_POST['mNameToDelete']) && isset($_GET['u']))
{
    echo ' update works';
}
?>