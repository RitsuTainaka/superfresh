<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 3/22/2018
 * Time: 11:21 AM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/header.php');

$db = new db();

if(isset($_GET['meal_id'])) {
    $meal_id = mysqli_real_escape_string(db::$mysqli, $_GET['meal_id']);
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
                <div class="col-md-6">
                    <img class="img-fluid img-responsive img-thumbnail d-block" src="<?php echo $row['meal_image'];?>">
                </div>
                <div class="col-md-6">
                    <h3>Preparation Time</h3>
                    <?php echo $row['meal_prep_time'];?>
                    <h3>Cooking Time</h3>
                    <?php echo $row['meal_cook_time'];?>
                    <h3>Serves</h3>
                    <?php echo $row['meal_serves'];?><br>

                    <h3><span class="glyphicon glyphicon-print"></span> <a href="printrecipe.php?meal_id=<?php echo $row['meal_id'];?>" target="_blank">Print Recipe</a><br></h3>
                    <h3><span class="glyphicon glyphicon-globe"></span> <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo "http://" . $_SERVER['SERVER_NAME']. $_SERVER['REQUEST_URI']; ?>"target="_blank">Share Recipe</a><br></h3>
                    <h3><span class="glyphicon glyphicon-th-list"></span> <a href="shoppinglist.php?meal_id=<?php echo $row['meal_id'];?>" target="_blank">Recipe Shopping List</a></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1>Ingredients</h1>
                    <?php
                        foreach ($ingredients as $item => $value)
                        {
                            echo '<ul>';
                            echo '<li>'. $value. '</li>';
                            echo '</ul>';
                        }

                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1 class="">Method</h1>
                    <ol>
                    <?php
                    foreach ($method as $item => $value)
                    {
                        echo '<li>'. $value. '</li>';
                    }
                    ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- JSON+LD Area -->
    <script type="application/ld+json">
    {
    "@context":"http://schema.org",
    "@type":"Recipe",
    "name":"<?php echo $row['meal_name']; ?>",
    "datePublished":"<?php echo $row['date_published']; ?>",
    "description":"<?php echo $row['short_description']; ?>",
    "image":"<?php echo $row['meal_image'];?>",
    "cookTime":"<?php echo time_to_iso8601_duration(strtotime($row['meal_cook_time'],0)); ?>",
    "prepTime":"<?php echo time_to_iso8601_duration(strtotime($row['meal_prep_time'],0));?>",
    "recipeCategory":"<?php  echo $row['meal_time'];?>",
    "recipeCuisine":"<?php  echo $row['meal_type'];?>",
    "recipeIngredient":[<?php $len = count($ingredients); $i = 0; foreach ($ingredients as $data => $value)
        {

            if($i == 0)
            {
                echo '"';
            }
            else if ($i < $len)
            {
                echo'","';
            }
            elseif($i == $len-1)
            {
                echo '"';
            }
            echo $value;

            $i++;

        }?>"],
    "recipeInstructions":"<?php $len=count($method); $counter = 1; foreach ($method as $data => $value)
        {
            if($counter == 1)
            {
                echo '';
            }
            else if ($counter < $len)
            {
                echo',';
            }
            elseif($counter == $len)
            {
                echo '';
            }
            echo $counter . ". " . $value;
            $counter++;
        }?>",
    "recipeYield":"<?php echo $row['meal_serves'];?>"
    }
</script>
<?php
}
?>




