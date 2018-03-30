<?php $pageid = 'admin';
adminCheck($_SESSION['login_user'])?>


<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-brand-centered">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-brand-centered">
            <ul class="nav navbar-nav">
                <li><a href=" <?php echo '../../index.php'; ?>">Site Home</a></li>
                <li><a href="admin.php">Admin Dashboard</a> </li>
                <li><a href="editcarousel.php">Edit Carousel</a></li>
                <li><a href="adduser.php">Add User</a></li>
                <li><a href="editweeklymeals.php">Edit Weekly Recipes</a></li>
                <li><a href="editmealsitems.php">Recipes</a></li>
                <!---->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span id="loginname">notext</span><b id="caret" class="caret"></b></a>
                    <?php
                    if(!isset($_SESSION['sessionid']))
                    {
                        echo '<script>
								document.getElementById("loginname").textContent="Login ";
							</script>';
                        echo '<form id="navlogin" class="dropdown-menu p-4" role="login" method="post" action="login.php">
					  <h3>Login</h3>
					   <li class="divider"></li>
						<div class="form-group">
							<label for="username">Username</label>
							<input name="username" autocomplete="username" type="text" class="form-control" id="username" placeholder="username">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input name="password" autocomplete="current-password" type="password" class="form-control" id="password" placeholder="Password">
						</div>
						<button name="login" type="submit" class="btn btn-primary">Sign in</button>
						<li class="divider"></li>
						<a href="#TODO">Forgot Password.</a>
						<br>
						<a href="register.php">Register a new account.</a>
					  </form>';



                    }
                    else
                    {
                        echo '<script>
								document.getElementById("loginname").textContent="'. $_SESSION["login_user"] .' ";
							 </script>';
                        echo '
						<form class="dropdown-menu p-4" role="logout" action="'. siteroot() . 'logout.php" method="post" id="navlogin">
						  <div class="form-group">
							<input type="submit" name="logout" value="Logout" class="logout-button">.
						  </div>
						</form>';
                    }


                    ?>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>