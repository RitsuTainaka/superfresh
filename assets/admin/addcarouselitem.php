<?php
$pageid = "admin";
/**
 * Created by PhpStorm.
 * User: rukia
 * Date: 3/19/2018
 * Time: 12:46 PM
 */
include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3">
            <h1 class="text-center login-title">Create new carousel item</h1>
            <div class="account-wall">
                <form id="register" class="form-signin" action = "processcarouselitem.php" method = "post">
                    <div class="block">
                        <input type="text" name = "newCName" class="form-control" placeholder="New Carousel Name" required autofocus>
                    </div>
                    <div class="block">
                        <input type="text" name = "newCImage" class="form-control" placeholder="URL to image" required>
                    </div>
                    <div class="block">
                        <input type="text" style="height:100px; padding: 0 5px 70px;" name = "newCBody" class="form-control" placeholder="Body Text" required>
                    </div>
                    <div class="block">
                        <input type="text" name = "newCURL" class="form-control" placeholder="Link to page" required>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Add Item</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php addfooter(); ?>
