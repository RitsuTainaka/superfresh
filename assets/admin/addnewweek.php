<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 4/2/2018
 * Time: 9:57 AM
 */
$pageid = 'admin';
include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');

$db = new db();


?>

<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">Add new weekly recipes</h4>
            </div>
<div class="modal-body">

    <?php
    echo '<div class="row">';
    $selected = "";
    $dayOfWeek = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    ?>
    <form method="post" action="processweekly.php">
        <div class="col-md-6 col-md-offset-3 text-center"><label>Weekly Recipe Name</label></div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center"><input type="text" id="weeklyname"></div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
                <label>Weekly Recipes</label>
            </div>
        </div>
        <div class="row">
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
                $selectOptions .= "<option value=\"{$row['meal_id']}\" {$selected}>{$row['meal_name']}</option>";
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
            <input type="checkbox" name="iscurrent" value="Current Week" <?php ($row2['currentWeek'])? "checked":"" ?>><br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" name="save" class="btn btn-primary">Save</button>
        </div>
    </form>

</div>

</div>
</div>
</div>
</div>