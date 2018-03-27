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

    /*$allresult = $db->query("SELECT id FROM carousel")
        or die(mysqli_connect_error());
    xdebug_var_dump($result);
    while($row = mysqli_fetch_assoc($result)) {
        $carouselitems += unserialize($row["id"]);
    }


    foreach($carouselitems as $x => $x_value) {
        $carousel_id = $x_value;
        $result = $db->query("SELECT * FROM carousel WHERE id = $carousel_id")
        or die(mysqli_connect_error());

        $data = mysqli_fetch_assoc($result);


    }*/
    $result = db::query("SELECT * FROM carousel WHERE carousel_is_enabled = TRUE")
        or die(mysqli_connect_error());
    $result2 = db::query("SELECT * FROM carousel")
    or die(mysqli_connect_error());
    $cItemNum = 0;
    $select_class = "";
    $selected="";
    while ($row2 = mysqli_fetch_assoc($result2))
    {
        $select_class .= "<option value=\"{$row2['carousel_name']}\">{$row2['carousel_name']}</option>";
    }
    $select_class .= "<option value=\"disable\">Remove</option>";
    ?>
<a href="addcarouselitem.php">Add new Carousel item</a><br>
    <a href="editcarouselitem.php">View and edit all Carousel items</a>
    <?php
    while($row = mysqli_fetch_assoc($result))
    {
        echo '<div class="row">';
        echo '    <div class="well">';
        echo '     <input value="Edit" type="button" onclick="myFunction(\''. $row["carousel_name"] .'\')"/> Current Carousel Item: ' . $row["carousel_name"]. "<br>";
        ?>
        <div id="<?php echo $row["carousel_name"] ?>" style="display:none">
            Select New Item<br>
            <form method="post" action="updatecarousel.php">
            <select name="<?php  echo $row["carousel_name"];?>">
                <?php
                print $select_class;
                ?>
            </select>
            <button type="submit" value="Save">Update</button>
            </form>
        </div>
        <?php

        echo '    </div>';
        echo '</div>';
        $cItemNum++;
    }
    while ($cItemNum < 5)
    {
        echo '<div class="row">';
        echo '    <div class="well">';
        echo '     <input value="Edit" type="button" onclick="myFunction(\'cItem'. $cItemNum .'\')"/> Current Carousel Item: unused<br>';
        ?>
        <div id="cItem<?php echo $cItemNum; ?>" style="display:none">
            Select New Item<br>
            <form method="post" action="updatecarousel.php">
            <select name="unused">
                <?php
                print $select_class;
                ?>
            </select>
            <button type="submit" value="Save">Update</button>
            </form>
        </div>
        <?php

        echo '    </div>';
        echo '</div>';
        $cItemNum++;
    }
    ?>
    <?php

addfooter();
    ?>