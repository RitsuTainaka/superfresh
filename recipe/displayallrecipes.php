<?php
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 3/22/2018
 * Time: 11:35 AM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/header.php');

$db = new db();

//-----Pagination part 1------
$maxDisplay= 6;
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

$rowCount=0;
$firstRow=1;

?>
    <div class="py-5">
    <div class="container-fluid">
    <div class="row border-secondary border w-75 mx-auto">
    <div class="col-md-12">
<?php
while ($row = mysqli_fetch_assoc($result))
{
    ?>
                    <?php
                        if($rowCount==2 || $firstRow)
                        {
                            echo "<div class=\"row\">";
                            $firstRow=0;
                        }
                        ?>
                        <div class="col-md-4">
                            <img class="img-thumbnail img-responsive center-block imgsize" src="<?php echo $row['meal_image'];?>">
                            <h3 class="text-center"><a href="showrecipe.php?meal_id=<?php echo $row["meal_id"];?>"><?php echo $row["meal_name"];?></a></h3>
                            <p class="center-block text-center" style="width: 50%"><?php echo $row['short_description'];?></p>
                        </div>


<?php
    if($rowCount < 2)
    {
        $rowCount++;
    }
    elseif ($rowCount == 2)
    {
        echo "</div>";
        $rowCount=0;
        $newRowEnd=1;
    }
?>
    <?php echo ($newRowEnd)?"</div>":"";$newRowEnd=0;?>
    <?php
}
?>
    </div>
    </div>
        <div class="text-center" style="font-size: larger; font-weight: bold">
            <?php
            //-------Pagination part 2
            if($currentPage > 1)
            {
            echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> "; //Back to Page 1
            $prevPage = $currentPage - 1;
            echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=$prevPage'><</a> "; //back to previous page
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
            echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a>";
            } // end else
            } // end if
            } // end for

            // if not on last page, show forward and last page links
            if ($currentPage != $totalPages) {
            // get next page
            $nextpage = $currentPage + 1;
            // echo forward link for next page
            echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a>";
            // echo forward link for lastpage
            echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=$totalPages'>>></a>";
            } // end if
            //--------end pagination part 2------------
?>
        </div>
    </div>
    </div>
