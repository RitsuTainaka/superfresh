<?php
$pageid='admin';
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 3/25/2018
 * Time: 6:00 AM
 */
include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/header.php');
?>

    <div class="container">
        <div class="row">
            <div class="control-group" id="fields">
                <div class="controls">
                    <form role="form" autocomplete="off" action = "processmeals.php" method = "post">
                        <div class="entry input-group col-xs-6 col-xs-offset-3">
                            <input class="form-control" name="newMealName" type="text" placeholder="Recipe Name">
                        </div><br>
                        <div class="entry input-group col-xs-6 col-xs-offset-3">
                            <input class="form-control" name="newMealImage" type="text" placeholder="Meal Image URL">
                        </div><br>
                        <div class="entry input-group col-xs-6 col-xs-offset-3">
                            <input class="form-control" name="newMealType" type="text" placeholder="Meal Type, e.g. British, Indian, Chinese">
                        </div><br>
                        <div class="entry input-group col-xs-6 col-xs-offset-3">
                            <input class="form-control" name="newMealTime" type="text" placeholder="Meal Type, e.g. Starter, Main, Dessert">
                        </div><br>
                        <div class="entry input-group col-xs-6 col-xs-offset-3">
                            <input class="form-control" name="newMealShortDescription" type="text" placeholder="Meal Short Description">
                        </div><br>
                        <div class="entry input-group col-xs-6 col-xs-offset-3">
                            <input class="form-control" name="newMealCookTime" type="text" placeholder="Meal Cook Time, e.g. 1 hour 30 minutes">
                        </div><br>
                        <div class="entry input-group col-xs-6 col-xs-offset-3">
                            <input class="form-control" name="newMealPrepTime" type="text" placeholder="Meal Prep Time, e.g. 1 hour 30 minutes">
                        </div><br>
                        <div class="entry input-group col-xs-6 col-xs-offset-3">
                            <input class="form-control" name="newMealServes" type="text" placeholder="How many people the meal serves, e.g. 3">
                        </div><br>
                        <div class="entry input-group col-xs-6 col-xs-offset-3">
                            <label>Vegetarian meal?</label>&nbsp;
                            <select name="newIsVeg">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div><br>
                        <div class="fld_wrap" id="newMealIngredients">
                            <div class="input-group col-xs-6 col-xs-offset-3">
                                <input class="form-control" type="text" name="newMealIngredients[]" placeholder="One ingredient per line">
                                <span class="input-group-btn"><button name="newMealIngredients" class="btn btn-success add_button newMealIngredients" type="button"><span class="glyphicon glyphicon-plus"></span></button></span>
                            </div>
                        </div><br>
                        <div class="fld_wrap" id="newMealMethod">
                            <div class="input-group col-xs-6 col-xs-offset-3">
                                <input class="form-control" type="text" name="newMealMethod[]" placeholder="One method per line">
                                <span class="input-group-btn"><button name="newMealMethod" class="btn btn-success add_button newMealMethod" type="button"><span class="glyphicon glyphicon-plus"></span></button></span>
                            </div>
                        </div>
                        <div class="col-xs-6 col-xs-offset-3">
                            <br><br><button class="btn btn-lg btn-primary btn-block" type="submit">Add Item</button>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>


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

<?php addfooter(); ?>