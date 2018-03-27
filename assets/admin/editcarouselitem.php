<?php
$pageid='admin';
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 3/19/2018
 * Time: 1:56 PM
 */
include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/header.php');


$db = new db();

//-----Pagination part 1------
$maxDisplay= 5;
$currentPage = 0;
$totalPages;
$maxRangeOfPagesToShow = 3;

$countRow = db::query("SELECT * FROM carousel");

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

$result = db::query("SELECT * FROM carousel LIMIT $offset, $maxDisplay");

//----------End pagination part 1-------

$cItemNum=0;

while($row = mysqli_fetch_array($result))
{
    echo '<div class="row">';
    echo '    <div class="well">';
    echo '     <input value="Amend" type="button" onclick="myFunction(\''. $row["carousel_name"] .'\')"/> Carousel Item: ' . $row["carousel_name"]. "<br>";
    ?>
    <div id="<?php echo $row["carousel_name"]; ?>" style="display:none">
        <form method="post" action="processcarouselitem.php">
            <div class="block">
                Carousel Name: <input title="CarouselName" type="text" name = "newCName" class="form-control" value="<?php echo $row['carousel_name']; ?>" required autofocus>
            </div>
            <div class="block">
                Carousel Image URL: <input title = "CarouselImage" type="text" name = "newCImage" class="form-control" value="<?php echo $row['carousel_image_link']; ?>" required>
            </div>
            <div class="block">
                Carousel Body Text: <input title = "CarouselBody" type="text" style="height:100px; padding: 0 5px 70px;" name = "newCBody" class="form-control" value="<?php echo $row['carousel_body']; ?>" required>
            </div>
            <div class="block">
                Carousel Link URL: <input title = "CarouselURL" type="text" name = "newCURL" class="form-control" value="<?php echo $row['carousel_url']; ?>" required>
            </div>
            <div class="block">
                <input type="hidden" name = "enabled" value="<?php echo $row['carousel_is_enabled']; ?>" readonly>
            </div>
            <button type="submit" value="Save">Update</button>
        </form>
        <form method="post" action="processcarouselitem.php">
            <input type="hidden" name="cNameToDelete" value="<?php echo $row["carousel_name"]; ?>">
            <br><button onclick="return confirm('Are you sure?')" type="submit" value="delete">Delete</button>
        </form>
    </div>
    <?php

    echo '    </div>';
    echo '</div>';
    $cItemNum++;
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
addfooter();
?>

