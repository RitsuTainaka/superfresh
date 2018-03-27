<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 3/22/2018
 * Time: 11:21 AM
 */
$pageid = 'nonav';
include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/header.php');

$db = new db();

if(isset($_GET['meal_id'])) {
    $meal_id = $_GET['meal_id'];
}
else
{
    $lastpage= $_SERVER['HTTP_REFERER'];
    pageReturnPopup("Nothing is set",$lastpage);
}


$result = db::query("SELECT * FROM meals WHERE meal_id = '$meal_id'");

while ($row = mysqli_fetch_assoc($result))
{
    $ingredients = unserialize($row['meal_ingredients']);
    $method = unserialize($row['meal_method']);
    ?>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="display-1"><?php echo $row["meal_name"];?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1>Shopping List</h1>
                    <?php
                    foreach ($ingredients as $item => $value)
                    {
                        echo '<input type="checkbox"> '. $value . '<br><br>';
                    }
                    ?>
                </div>
            </div>

    <?php
}

?>
            <form action="" method="post">
                <button type="submit" onclick="window.print();">Print</button>
            </form>
        </div>
</div>
</div>






