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
								<img src="/public/img/logo-xx.png" alt="logo" height="50" class="logo-img"><span class="splash-description">Please enter your activation code.</span>
							</div>
							<div class="panel-body">
								<form action="<?php echo base_url('activate'); ?>" method="post" data-parsley-validate=""><span class="splash-title xs-pb-20">Activate your account</span>
								<?php echo validation_errors('<div>', '</div>'); ?>
								<div role="alert" class="alert alert-primary alert-icon alert-icon-border alert-dismissible">
                    <div class="icon"><span class="mdi mdi-info-outline"></span></div>
                    <div class="message">
                      <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Info</strong> You should receive a text with your activation code. If the phone number you provided is incorect, please check your e-mail address
                    </div>
                  </div>
									<div class="form-group">
										<input type="text" name="account_code" id="account_code" value="<?php echo $account_code; ?>" required="required" data-required="true" parsley-error-message="Please insert your name" data-required-message="Please insert your Full name" placeholder="Activation code" autocomplete="off" class="form-control">
									</div>
									<div class="form-group xs-pt-10">
										<button type="submit" class="btn btn-block btn-primary btn-xl">Activate</button>
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
	</body>
</html>