<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo "http://" . $_SERVER['SERVER_NAME'] . "/dwda1/"; ?>assets/css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<title>FarmShop</title>
	</head>
<body>
<?php

    session_start();
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dwda1/assets/include/core.php');
      ?>
	<div id="home">
        <img src="<?php echo siteroot() ?>assets/images/sflogo.png" class="center-block img-responsive">
		<?php if ($pageid == 'admin')
                {
                    include(root() . 'assets/admin/adminnav.php');
                }
                elseif ($pageid == 'nonav')
                {

                }
                else {
                    include(root() . 'assets/include/nav.php');
                }
        ?>