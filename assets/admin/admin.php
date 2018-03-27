<?php
$pageid = 'admin';
include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/header.php');

$db = new db();
?>
<div class="container">
	Admin Page
	<br>
    Current Week Meals
    <?php
    $result = db::query("SELECT meal_id FROM weeklymeals");

    while($row = mysqli_fetch_assoc($result)) {
        $meals = unserialize($row["meal_id"]);
    }

    foreach($meals as $x => $x_value) {
        $meal_id = $x_value;
        $result = db::query("SELECT * FROM meals WHERE meal_id = $meal_id");

        $data = mysqli_fetch_assoc($result);

        echo '<div class="row">';
        echo '<div class="well">';
        echo 'Meal Name: <a href="single_meal.php?meal=' .$data["meal_name"]. '">' . $data["meal_name"]. "</a><br>";
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>

<?php include(root() . 'assets/include/footer.php'); ?>