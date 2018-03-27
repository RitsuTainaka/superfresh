<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 3/16/2018
 * Time: 10:34 AM
 */
include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');

class Meals extends db
{
    public function ShowAllMeals()
    {
        $test = self::$mysqli("SELECT * FROM `meals`");
        foreach ($test as $data)
        {
            echo $data['meal_name'];
            echo "<br>";
        }
    }
}