<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 3/30/2018
 * Time: 2:54 PM
 */
$pageid = 'admin';
include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');

$db = new db();

$getID = mysqli_real_escape_string(db::$mysqli,$_GET['meal_id']);

$result = db::query("SELECT * FROM meals WHERE meal_id = $getID");

$row = mysqli_fetch_assoc($result);

?>


<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">Edit <?php echo $row['meal_name']; ?></h4>
            </div>
            <div class="modal-body">
                <form method="post" action="processmeals.php?u=update" class="">
                    <div class="entry input-group col-md-10 col-md-offset-1">
                        <label>Recipe Name</label>
                        <input class="form-control" name="newMealName" type="text" placeholder="Recipe Name" value="<?php echo $row['meal_name']; ?>">
                    </div><br>
                    <div class="entry input-group col-md-10 col-md-offset-1">
                        <label>Meal Image URL</label>
                        <input class="form-control" name="newMealImage" type="text" placeholder="Meal Image URL" value="<?php echo $row['meal_image']; ?>">
                    </div><br>
                    <div class="entry input-group col-md-10 col-md-offset-1">
                        <label>Meal Type</label>
                        <input class="form-control" name="newMealType" type="text" placeholder="Meal Type, e.g. British, Indian, Chinese" value="<?php echo $row['meal_type']; ?>">
                    </div><br>
                    <div class="entry input-group col-md-10 col-md-offset-1">
                        <label>Meal Time</label>
                        <input class="form-control" name="newMealTime" type="text" placeholder="Meal Type, e.g. Starter, Main, Dessert" value="<?php echo $row['meal_time']; ?>">
                    </div><br>
                    <div class="entry input-group col-md-10 col-md-offset-1">
                        <label>Recipe Description</label>
                        <input class="form-control" name="newMealShortDescription" type="text" placeholder="Meal Short Description" value="<?php echo $row['short_description']; ?>">
                    </div><br>
                    <div class="entry input-group col-md-10 col-md-offset-1">
                        <label>Cooking Time</label>
                        <input class="form-control" name="newMealCookTime" type="text" placeholder="Meal Cook Time, e.g. 1 hour 30 minutes" value="<?php echo $row['meal_cook_time']; ?>">
                    </div><br>
                    <div class="entry input-group col-md-10 col-md-offset-1">
                        <label>Preparation Time</label>
                        <input class="form-control" name="newMealPrepTime" type="text" placeholder="Meal Prep Time, e.g. 1 hour 30 minutes" value="<?php echo $row['meal_prep_time']; ?>">
                    </div><br>
                    <div class="entry input-group col-md-10 col-md-offset-1">
                        <label>Meal Serves</label>
                        <input class="form-control" name="newMealServes" type="text" placeholder="How many people the meal serves, e.g. 3" value="<?php echo $row['meal_serves']; ?>">
                    </div>
                    <input type="hidden" name="meal_id" value="<?php echo $getID; ?>">
                    <br>
                    <div class="entry input-group col-md-10 col-md-offset-1">
                        <label>Vegetarian meal?</label>&nbsp;
                        <select name="newIsVeg" title="vegetarian">
                            <option value="0" <?php (!$row['veg'])?"selected":"" ?>>No</option>
                            <option value="1" <?php ($row['veg'])?"selected":"" ?>>Yes</option>
                        </select>
                    </div><br>
                    <div class="fld_wrap" id="newMealIngredients">
                        <label class="col-md-10 col-md-offset-1">Ingredients</label>
                        <?php
                        $first = 1;
                        $ingredients = unserialize($row['meal_ingredients']);
                        if(isset($row['meal_ingredients']))
                        {
                            foreach ($ingredients as $data => $value)
                            {
                                if(!$first)
                                {
                                    echo '<div class="input-group col-md-10 col-md-offset-1">
                              <input class="form-control" type="text" name="newMealIngredients[]" value=" '. $value .'">
                              <span class="input-group-btn"><button class="btn btn-danger remove_button" type="button">
                              <span class="glyphicon glyphicon-minus"></span></button></span></div>';
                                }
                                else
                                {
                                    echo '<div class="input-group col-md-10 col-md-offset-1">
                              <input class="form-control" type="text" name="newMealIngredients[]" placeholder="One ingredient per line" value=" '. $value .'">
                              <span class="input-group-btn"><button name="newMealIngredients" class="btn btn-success add_button newMealIngredients" type="button">
                              <span class="glyphicon glyphicon-plus"></span></button></span></div>';
                                    $first=0;
                                }

                            }
                        }
                        else
                        {
                            echo '<div class="input-group col-md-10 col-md-offset-1">
                      <input class="form-control" type="text" name="newMealIngredients[]" placeholder="One ingredient per line">
                      <span class="input-group-btn"><button name="newMealIngredients" class="btn btn-success add_button newMealIngredients" type="button">
                      <span class="glyphicon glyphicon-plus"></span></button></span></div>';
                        }

                        ?>
                    </div><br>
                    <div class="fld_wrap" id="newMealMethod">
                        <label class="col-md-10 col-md-offset-1">Method</label>
                        <?php
                        $first = 1;
                        $method = unserialize($row['meal_method']);
                        if(isset($row['meal_method']))
                        {
                            foreach ($method as $data => $value)
                            {
                                if(!$first)
                                {
                                    echo '<div class="input-group col-md-10 col-md-offset-1"><input class="form-control" type="text" name="newMealMethod[]" value=" '. $value .'"><span class="input-group-btn"><button class="btn btn-danger remove_button" type="button"><span class="glyphicon glyphicon-minus"></span></button></span></div>';
                                }
                                else
                                {
                                    echo '<div class="input-group col-md-10 col-md-offset-1">
                                          <input class="form-control" type="text" name="newMealMethod[]" placeholder="One method per line" value=" '. $value .'">
                                          <span class="input-group-btn"><button name="newMealMethod" class="btn btn-success add_button newMealMethod" type="button"><span class="glyphicon glyphicon-plus"></span></button></span>
                                          </div>';
                                    $first=0;
                                }
                            }
                        }
                        else
                        {
                            echo '<div class="input-group col-md-10 col-md-offset-1">
                                  <input class="form-control" type="text" name="newMealMethod[]" placeholder="One method per line">
                                  <span class="input-group-btn"><button name="newMealMethod" class="btn btn-success add_button newMealMethod" type="button"><span class="glyphicon glyphicon-plus"></span></button></span>
                                  </div>';
                        }
                        ?>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    </div>
                </form>
                <form method="post" action="processmeals.php?u=update" >
                    <input type="hidden" name="mNameToDelete" value="<?php echo $row["meal_id"]; ?>">
                    <br><button onclick="return confirm('Are you sure?')" type="submit" value="delete" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.add_button').click(function(){
            var kakoi=$(this).attr('name');
            var insHTML = '<div class="input-group col-md-10 col-md-offset-1"><input class="form-control" type="text" name="'+kakoi+'[]"><span class="input-group-btn"><button class="btn btn-danger remove_button" type="button"><span class="glyphicon glyphicon-minus"></span></button></span></div>';
            $("#"+kakoi).append(insHTML);
        });

        $('.fld_wrap').on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parents(':eq(1)').remove();
        });
    });
</script>
