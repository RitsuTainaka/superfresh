<?php
	include_once('assets/include/header.php');
?>
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-4 col-md-offset-4">
			<h1 class="text-center login-title">Create a new user</h1>
			<div class="account-wall">
				<form id="register" class="form-signin" action = "processregistration.php" method = "post">
				<div class="block">
					<input type="text" autocomplete="username" name = "username" class="form-control" placeholder="Username" required autofocus>
				</div>
				<div class="block">
					<input type="text" name = "email" class="form-control" placeholder="example@email.com" required>
				</div>
				<div class="block">
					<input id="password" autocomplete="new-password" type="password" name = "password" class="form-control" placeholder="Password" required><br>
				</div>				
				<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	include('assets/include/footer.php');
?>