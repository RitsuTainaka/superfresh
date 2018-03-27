<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 3/16/2018
 * Time: 9:27 AM
 */
$pageid = 'admin';
include($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/header.php');



$db = new db();

$isSelected="";

//-----Pagination part 1------
$maxDisplay= 5;
$currentPage = 0;
$totalPages;
$maxRangeOfPagesToShow = 3;

$countRow = db::query("SELECT * FROM meals");

$rowCount = mysqli_num_rows($countRow); //count the number of rows
$totalPages = ceil($rowCount / $maxDisplay); //find the total number of pages to be created

if (isset($_GET['currentpage'])) {
    $currentPage = $_GET['currentpage'];
} else {
    // default page num
    $currentPage = 1;
}
// if current page is greater than total pages...
if ($currentPage > $totalPages) {
    // set current page to last page
    $currentPage = $totalPages;
} // end if
// if current page is less than first page...
if ($currentPage < 1) {
    // set current page to first page
    $currentPage = 1;
} // end if

$offset = ($currentPage-1) * $maxDisplay;



$result = db::query("SELECT * FROM meals LIMIT $offset, $maxDisplay");

//----------End pagination part 1-------



while($row = mysqli_fetch_assoc($result))
{
echo '<div class="row">';
echo '    <div class="well" style="margin-left: 10px;     ">';
echo '     <input value="Amend" type="button" id="myBtn"/> Meal Name: ' . $row["meal_name"]. "<br>";
?>
<div id="<?php //echo $row["meal_name"];
            echo "myModal"; ?>" style="display:none" class="modal">
    <div class="modal-content">
    <span class="close">&times;</span>
    <form method="post" action="processmeals.php" class="">
        <div class="entry input-group col-xs-6 col-xs-offset-3">
            <label>Recipe Name</label>
            <input class="form-control" name="newMealName" type="text" placeholder="Recipe Name" value="<?php echo $row['meal_name']; ?>">
        </div><br>
        <div class="entry input-group col-xs-6 col-xs-offset-3">
            <label>Meal Image URL</label>
            <input class="form-control" name="newMealImage" type="text" placeholder="Meal Image URL" value="<?php echo $row['meal_image']; ?>">
        </div><br>
        <div class="entry input-group col-xs-6 col-xs-offset-3">
            <label>Meal Type</label>
            <input class="form-control" name="newMealType" type="text" placeholder="Meal Type, e.g. British, Indian, Chinese" value="<?php echo $row['meal_type']; ?>">
        </div><br>
        <div class="entry input-group col-xs-6 col-xs-offset-3">
            <label>Meal Time</label>
            <input class="form-control" name="newMealTime" type="text" placeholder="Meal Type, e.g. Starter, Main, Dessert" value="<?php echo $row['meal_time']; ?>">
        </div><br>
        <div class="entry input-group col-xs-6 col-xs-offset-3">
            <label>Recipe Description</label>
            <input class="form-control" name="newMealShortDescription" type="text" placeholder="Meal Short Description" value="<?php echo $row['short_description']; ?>">
        </div><br>
        <div class="entry input-group col-xs-6 col-xs-offset-3">
            <label>Cooking Time</label>
            <input class="form-control" name="newMealCookTime" type="text" placeholder="Meal Cook Time, e.g. 1 hour 30 minutes" value="<?php echo $row['meal_cook_time']; ?>">
        </div><br>
        <div class="entry input-group col-xs-6 col-xs-offset-3">
            <label>Preparation Time</label>
            <input class="form-control" name="newMealPrepTime" type="text" placeholder="Meal Prep Time, e.g. 1 hour 30 minutes" value="<?php echo $row['meal_prep_time']; ?>">
        </div><br>
        <div class="entry input-group col-xs-6 col-xs-offset-3">
            <label>Meal Serves</label>
            <input class="form-control" name="newMealServes" type="text" placeholder="How many people the meal serves, e.g. 3" value="<?php echo $row['meal_serves']; ?>">
        </div><br>
        <div class="entry input-group col-xs-6 col-xs-offset-3">
            <label>Vegetarian meal?</label>&nbsp;
            <select name="newIsVeg">
                <option value="0" <?php (!$row['veg'])?"selected":"" ?>>No</option>
                <option value="1" <?php ($row['veg'])?"selected":"" ?>>Yes</option>
            </select>
        </div><br>
        <div class="fld_wrap" id="newMealIngredients">
            <label class="col-xs-6 col-xs-offset-3">Ingredients</label>
            <?php
            $first = 1;
            $ingredients = unserialize($row['meal_ingredients']);
            if(isset($row['meal_ingredients']))
            {
                foreach ($ingredients as $data => $value)
                {
                    if(!$first)
                    {
                        echo '<div class="input-group col-xs-6 col-xs-offset-3">
                              <input class="form-control" type="text" name="newMealIngredients[]" value=" '. $value .'">
                              <span class="input-group-btn"><button class="btn btn-danger remove_button" type="button">
                              <span class="glyphicon glyphicon-minus"></span></button></span></div>';
                    }
                    else
                    {
                        echo '<div class="input-group col-xs-6 col-xs-offset-3">
                              <input class="form-control" type="text" name="newMealIngredients[]" placeholder="One ingredient per line" value=" '. $value .'">
                              <span class="input-group-btn"><button name="newMealIngredients" class="btn btn-success add_button newMealIngredients" type="button">
                              <span class="glyphicon glyphicon-plus"></span></button></span></div>';
                        $first=0;
                    }

                }
            }
            else
            {
                echo '<div class="input-group col-xs-6 col-xs-offset-3">
                      <input class="form-control" type="text" name="newMealIngredients[]" placeholder="One ingredient per line">
                      <span class="input-group-btn"><button name="newMealIngredients" class="btn btn-success add_button newMealIngredients" type="button">
                      <span class="glyphicon glyphicon-plus"></span></button></span></div>';
            }

            ?>
        </div><br>
        <div class="fld_wrap" id="newMealMethod">
            <label class="col-xs-6 col-xs-offset-3">Method</label>
            <?php
            $first = 1;
            $method = unserialize($row['meal_method']);
            if(isset($row['meal_method']))
            {
                foreach ($method as $data => $value)
                {
                    if(!$first)
                    {
                        echo '<div class="input-group col-xs-6 col-xs-offset-3"><input class="form-control" type="text" name="newMealMethod[]" value=" '. $value .'"><span class="input-group-btn"><button class="btn btn-danger remove_button" type="button"><span class="glyphicon glyphicon-minus"></span></button></span></div>';
                    }
                    else
                    {
                        echo '<div class="input-group col-xs-6 col-xs-offset-3">
                            <input class="form-control" type="text" name="newMealMethod[]" placeholder="One method per line" value=" '. $value .'">
                            <span class="input-group-btn"><button name="newMealMethod" class="btn btn-success add_button newMealMethod" type="button"><span class="glyphicon glyphicon-plus"></span></button></span>
                            </div>';
                            $first=0;
                    }
                }
            }
            else
            {
                echo '<div class="input-group col-xs-6 col-xs-offset-3">
                <input class="form-control" type="text" name="newMealMethod[]" placeholder="One method per line">
                <span class="input-group-btn"><button name="newMealMethod" class="btn btn-success add_button newMealMethod" type="button"><span class="glyphicon glyphicon-plus"></span></button></span>
                </div>';
            }
             ?>
        </div>

        <br><button type="submit" value="Save" class="col-xs-6 col-xs-offset-3">Update</button><br>
    </form>
    <form method="post" action="processmeals.php" >
        <input type="hidden" name="mNameToDelete" value="<?php echo $row["meal_id"]; ?>">
        <br><button onclick="return confirm('Are you sure?')" type="submit" value="delete" class="col-xs-6 col-xs-offset-3">Delete</button>
    </form>
</div>
</div>


<?php
    echo '    </div>';
    echo '</div>';
}
//-------Pagination part 2
if($currentPage > 1)
{
    echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> "; //Back to Page 1
    $prevPage = $currentPage - 1;
    echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevPage'><</a> "; //back to previous page
}

// loop to show links to range of pages around current page
for ($x = ($currentPage - $maxRangeOfPagesToShow); $x < (($currentPage + $maxRangeOfPagesToShow) + 1); $x++) {
    // if it's a valid page number...
    if (($x > 0) && ($x <= $totalPages)) {
        // if we're on current page...
        if ($x == $currentPage) {
            // 'highlight' it but don't make a link
            echo " [<b>$x</b>] ";
            // if not current page...
        } else {
            // make it a link
            echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
        } // end else
    } // end if
} // end for

// if not on last page, show forward and last page links
if ($currentPage != $totalPages) {
    // get next page
    $nextpage = $currentPage + 1;
    // echo forward link for next page
    echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
    // echo forward link for lastpage
    echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalPages'>>></a> ";
} // end if

//--------end pagination part 2------------
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.add_button').click(function(){
            var kakoi=$(this).attr('name');
            var insHTML = '<div class="input-group col-xs-6 col-xs-offset-3"><input class="form-control" type="text" name="'+kakoi+'[]"><span class="input-group-btn"><button class="btn btn-danger remove_button" type="button"><span class="glyphicon glyphicon-minus"></span></button></span></div>';
            $("#"+kakoi).append(insHTML);
        });

        $('.fld_wrap').on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parents(':eq(1)').remove();
        });
    });


</script>

<script src="<?php echo  siteroot() . "assets/js/modal.js"?>"></script>
<?php addfooter(); ?>


