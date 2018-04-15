<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 4/2/2018
 * Time: 8:20 AM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');
$db = new db();

$weekID = mysqli_real_escape_string(db::$mysqli,$_POST['weekid']);
$weeklyMealName = mysqli_real_escape_string(db::$mysqli,$_POST['weeklyname']);
$weeklyMeals = mysqli_real_escape_string(db::$mysqli,$_POST['meal']);
$currentWeek = mysqli_real_escape_string(db::$mysqli,$_POST['iscurrent']);

$mealsArray = array();;
foreach ($_POST['meal'] as $data => $value)
{
    array_push($mealsArray ,$value);
}

$mealsSerilized = serialize($mealsArray);

if(isset($currentWeek))
{
    $result = db::query("SELECT wk_id FROM weeklymeals WHERE currentWeek = '1'");
    if($result)
    {
        $row = mysqli_fetch_assoc($result);
        $currentid = $row['wk_id'];
        db::query("UPDATE weeklymeals SET currentWeek = '0' WHERE wk_id = '$currentid'");
    }
}


if(isset($_POST['save']))
{
    //echo 'Save';
    $result = db::query("UPDATE weeklymeals SET weekly_meal_name = '$weeklyMealName', meal_id = '$mealsSerilized', currentWeek = '$currentWeek' WHERE wk_id = '$weekID'");
    if($result)
    {
        popup("Week Updated!, returning to all weeks","assets/admin/editweeklymeals.php");
    }

}
elseif (isset($_POST['new']))
{
    //echo "new";
    $result = db::query("INSERT INTO weeklymeals (weekly_meal_name, meal_id, currentWeek) VALUES ('$weeklyMealName','$mealsSerilized','$currentWeek')");
    if($result)
    {
        popup("New Week Added!, returning to all weeks","assets/admin/editweeklymeals.php");
    }
}
elseif(isset($_POST['weeklyDelete']) && $_POST['weeklyDelete'] === "dwda1AllowDelete")
{
    //echo 'Delete';
    $result = db::query("DELETE FROM weeklymeals WHERE wk_id = '$weekID'");
    if($result)
    {
        popup("Week Deleted!, returning to all weeks","assets/admin/editweeklymeals.php");
    }
}


