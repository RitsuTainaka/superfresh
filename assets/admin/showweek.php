<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 4/2/2018
 * Time: 12:12 AM
 */

$pageid = 'admin';
include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');

$db = new db();

$getID = mysqli_real_escape_string(db::$mysqli,$_GET['week']);
$meals = "";

$result = db::query("SELECT * FROM weeklymeals WHERE wk_id = $getID");

while($row = mysqli_fetch_assoc($result))
{
    $meals = unserialize($row['meal_id']);
}

$dayOfWeek = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");


$selectOptions = "";

$result2 = db::query("SELECT * FROM weeklymeals WHERE wk_id = $getID");
$row2 = mysqli_fetch_assoc($result2);


?>

<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">Edit <?php echo $row2['weekly_meal_name']; ?></h4>
            </div>
            <div class="modal-body">

                <?php
                echo '<div class="row">';
                $selected = "";
                ?>
                <form role="form" autocomplete="off" action = "processweekly.php" method = "post">
                <?php
                for ($i=0; $i < count($dayOfWeek); $i++) {
                    echo '    <div class="well text-center col-md-6 col-md-offset-3">';
                    echo $dayOfWeek[$i];
                    echo '<br><select>';
                    $resultmeals = db::query("SELECT * FROM meals");
                    while ($row = mysqli_fetch_assoc($resultmeals))
                    {
                        if($row['meal_id'] == $meals[$i])
                        {
                            $selected = 'selected';
                        }
                        else
                        {
                            $selected = "";
                        }
                        $selectOptions .= "<option value=\"{$row['meal_id']}\" name='{$dayOfWeek[$i]}' {$selected}>{$row['meal_name']}</option>";
                    }

                    print $selectOptions;
                    $selectOptions = '';
                    echo '</select>';
                    echo '  </div>';
                }
                ?>
            </div>
                <div class="row text-center">
                    <label>Current Week</label>
                    <?php
                    $checked = "";
                    if ($row2['currentWeek'])
                    {
                        $checked = "checked";
                    }
                    else
                    {
                        $checked = "";
                    }?>
                    <input type="checkbox" name="iscurrent" value="Current Week" <?php echo $checked; ?>><br>


                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name="save" class="btn btn-primary">Save</button>
            </div>
                <?php
                echo '</form>';


                ?>
            </div>
        </div>
    </div>
</div>
