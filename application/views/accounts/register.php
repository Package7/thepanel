<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="assets/img/logo-fav.png">
		<title><?php echo get_website_title('Sign Up'); ?></title>
		<?php echo global_load_styles(); ?>
	</head>
	<body class="be-splash-screen">
		<div class="be-wrapper be-login be-signup">
			<div class="be-content">
				<div class="main-content container-fluid">
					<div class="splash-container sign-up">
						<div class="panel panel-default panel-border-color panel-border-color-primary">
							<div class="panel-heading">
								<img src="<?= base_url('public/img/logo.png'); ?>" alt="logo" class="logo-img"><span class="splash-description">Please enter your user information.</span>
							</div>
							<div class="panel-body">
								<form action="<?php echo base_url('register'); ?>" method="post" data-parsley-validate=""><span class="splash-title xs-pb-20">Sign Up</span>
								<?php echo validation_errors('<div>', '</div>'); ?>
									<div class="form-group">
										<input type="text" name="account_name" id="account_name" required="required" data-required="true" parsley-error-message="Please insert your name" data-required-message="Please insert your Full name" placeholder="Full name" autocomplete="off" class="form-control">
									</div>
									<div class="form-group">
										<input type="email" name="account_email" id="account_email" required="required" placeholder="E-mail address" autocomplete="off" class="form-control">
									</div>
									<div class="form-group row signup-password">
										<div class="col-xs-6">
											<input type="password" name="account_password" id="account_password" required="required" placeholder="Password" autocomplete="off" class="form-control">
										</div>
										<div class="col-xs-6">
											<input type="password" name="account_password_confirm" id="account_password_confirm" required="required" placeholder="Confirm password" autocomplete="off" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<input type="tel" name="account_phone" id="account_phone" required="required" placeholder="Mobile number" autocomplete="off" class="form-control">
									</div>
									<div class="form-group xs-pt-10">
										<div class="be-checkbox">
											<input type="checkbox" id="remember">
											<label for="remember">By creating an account, you agree the <a href="#">terms and conditions</a>.</label>
										</div>
									</div>
									<div class="form-group xs-pt-10">
										<button type="submit" class="btn btn-block btn-primary btn-xl">Sign Up</button>
									</div>
								</form>
							</div>
						</div>
						<div class="splash-footer">&copy; <?php echo date('Y'); ?> <strong>MyPrintPanel</strong>. Some rights reserved.</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo global_load_scripts(); ?>

	<script type="text/javascript">
	$(document).ready(function(){
	//initialize the javascript
	App.init();
	$('form').parsley();
	});
	</script>
	<!-- <script type="text/javascript">
	// $(document).ready(function(){
	initialize the javascript
	// App.init();
	// $('form').parsley();

	// var App = (function () {

	// App.moduleName = function( ){
	// 'use strict'

	// alert('register');

	// };

	// return App;
	// })(App || {});
	// });
	// </script>-->
	</body>
</html>