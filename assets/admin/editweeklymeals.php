<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$pageid = 'admin';
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 1/29/2018
 * Time: 5:52 PM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/header.php');

$db = new db();

$result = db::query("SELECT * FROM weeklymeals");

$selectOptions = "";

while ($row = mysqli_fetch_assoc($result))
{
    $currentWeek = "";
    if ($row['currentWeek'])
    {
        $currentWeek = "(Current Week)";
    }
    else
    {
        $currentWeek = "";
    }
    $selectOptions .= "<option value=\"{$row['wk_id']}\">{$row['weekly_meal_name']} {$currentWeek}</option>";
}

$dayOfWeek = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
?>


    <div class="container ">

        <div class="jumbotron">
            <div class="row">
                <div class="col-md-4 center-block">
                    <a class="btn btn-primary pull-left" data-toggle="modal" href="#myModal" id="newweek">Add new week</a>
                </div>
            </div>
            <div class="row">&nbsp;</div>
            <div class="well" style="margin-left: 10px;">
                <h2>Edit Weekly Recipe's</h2>
                <h5 class="text-center">Choose a week to edit.</h5>
                <select class="form-control" id="weekchoose">
                    <?php print $selectOptions; ?>
                </select>
                <br>
                <div class="row">
                    <div class="col-md-2 btn-group-vertical" style="">
                        <a class="btn btn-primary pull-left" data-toggle="modal" href="#myModal" id="modallink" name="">Edit Recipe</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-container"></div>




    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '.btn' , function (event) {
                event.stopPropagation();
                var id = $('#weekchoose').val();
                var url;
                var $link = event.target.id;
                if($link === "modallink")
                {
                    url = "showweek.php?week=" + id;
                    //alert(id);
                }
                else if ($link === "newweek")
                {   //alert("here");
                    url = "addnewweek.php";
                }
                $('.modal-container').load(url, function (result) {
                    $('#myModal').modal({show: true});
                });
            });
        });

        $(document).on("hidden.bs.modal", "#myModal", function () {
            $('#myModal').remove(); // Remove from DOM.
        });

    </script>


<?php include_once(root() . 'assets/include/footer.php');
?>