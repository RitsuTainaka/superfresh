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

?>

<div class="container ">

    <div class="jumbotron">
        <div class="row">
            <div class="col-md-4 center-block">
                <a class="btn btn-primary pull-left" data-toggle="modal" href="#myModal" id="addrecipe">Add new recipe</a>
            </div>
        </div>
        <div class="row">&nbsp;</div>
<?php

while($row = mysqli_fetch_assoc($result))
{
    ?>

        <div class="well padding50" style="margin-left: 10px;">

            <div class="col-md-2 btn-group-vertical" style="">
                <a class="btn btn-primary pull-left recipeModal" data-toggle="modal" href="#myModal" id="modallink<?php echo $row['meal_id']; ?>" name="<?php echo $row['meal_id']; ?>">Edit Recipe</a>
            </div>
            <div class="col-md-6 btn-group-vertical"><label style="padding-top: 5px;">Meal Name: <?php echo $row['meal_name']; ?></label></div>
        </div>


    <?php
}

?>

    </div>
</div>
        <div class="modal-container"></div>

<div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
<?php
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
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('body').on('click', '.btn' , function (event) {
            event.stopPropagation();
            var id = $('#'+event.target.id).attr("name");
            var url;
            var $test = event.target.id.substring(0,9);
            if($test === "modallink")
            {
                url = "recipebox.php?meal_id=" + id;
            }
            else
            {
                url = "addrecipebox.php";
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
<?php addfooter(); ?>


