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
		        <li><a href=" <?php echo siteroot() . 'index.php'; ?>">Home</a></li>
		        <li><a href="<?php echo siteroot() . 'recipe/displayallrecipes.php'; ?>">Recipes</a></li>
                  <li><a href="#">Subscribe</a></li>
		        <!---->
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span id="loginname">notext</span><b id="caret" class="caret"></b></a>
				  <?php
                  $user=new user();
				  if(!isset($_SESSION['sessionid']))
				  {
					  echo '<script>
								document.getElementById("loginname").textContent="Login ";
							</script>';
					 echo '<form id="navlogin" class="dropdown-menu p-4" role="login" method="post" action="'. includeFile("login.php") .'">
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
						<br><a href="'.includeFile("register.php").'">Register a new account.</a>
					  </form>';
					  
					  
					  
				  }
				  else
				  {
					  echo '<script>
								document.getElementById("loginname").textContent="'. $_SESSION["login_user"] .' ";
							 </script>';
					echo '
						<form class="dropdown-menu p-4" role="logout" action="'.includeFile("logout.php").'" method="post" id="navlogin">
						  <div class="form-group">
							<input type="submit" name="logout" value="Logout" class="logout-button">.
						  </div>
						</form>';
						if(user::getAccessLevel($_SESSION['login_user']) == 100)
						{
							echo '<li><a href="'.siteroot().'assets/admin/admin.php">Admin</a></li>';
						}
				  }
				  
					
				  ?>
				</li>		        
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>	