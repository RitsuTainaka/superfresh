<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 31/03/18
 * Time: 10:17
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');


$db = new db();


$result = db::query("SELECT meal_id FROM weeklymeals WHERE currentWeek = TRUE");

$rowCount = 0;
$firstRow = 1;
$newRowEnd = 0;
$meals="";

$dayOfWeekCount = 0;

$dayOfWeek = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");

while($row = mysqli_fetch_assoc($result))
{
    $meals = unserialize($row['meal_id']);
}
?>

    <div class="py-5">
        <div class="container-fluid">
            <div class="row border-secondary border w-75 mx-auto">
                <div class="col-md-12">

                    <?php
                    foreach ($meals as $x => $value)
                    {
                        $meal_id = $value;
                        $result = db::query("SELECT * FROM meals WHERE meal_id = '$meal_id'");

                        $row = mysqli_fetch_assoc($result);

                        if ($rowCount == 2 || $firstRow) {
                            echo "<div class=\"row\">";
                            $firstRow = 0;
                        }
                        ?>
                        <div class="col-md-4">
                            <h4 class="text-center"><?php echo $dayOfWeek[$dayOfWeekCount]; ?></h4>
                            <img class="img-thumbnail img-responsive center-block imgsize" src="<?php echo $row['meal_image']; ?>">
                            <h3 class="text-center"><a href="showrecipe.php?meal_id=<?php echo $row["meal_id"]; ?>"><?php echo $row["meal_name"]; ?></a>
                            </h3>
                            <p class="center-block text-center" style="width: 50%"><?php echo $row['short_description']; ?></p>
                        </div>


                        <?php
                        if ($rowCount < 2) {
                            $rowCount++;
                        } elseif ($rowCount == 2) {
                            echo "</div>";
                            $rowCount = 0;
                            $newRowEnd = 1;
                        }
                        ?>
                        <?php echo ($newRowEnd) ? "</div>" : "";
                        $newRowEnd = 0;
                        $dayOfWeekCount++;

                    }?>
                </div>
            </div>
        </div>
    </div>

<?php


