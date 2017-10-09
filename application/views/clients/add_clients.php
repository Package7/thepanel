<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="<?php echo base_url('public/img'); ?>/logo-fav.png">
		<title><?= get_website_title('Clients'); ?></title>
		<?= global_load_styles(); ?>
	</head>
	<body>
		<div class="be-wrapper">
			<?php echo $header; ?>
			<?php echo $sidebar; ?>
			<div class="be-content">
				<div class="main-content container-fluid">
					<div class="row">
						<div class="col-sm-6">
						  <div class="panel panel-default panel-border-color panel-border-color-default">
							<div class="panel-heading panel-heading-divider">Account info<span class="panel-subtitle">This is the default bootstrap form layout</span></div>
							<div class="panel-body">
							  <form action="<?php echo base_url('clients/add_clients'); ?>" method="post" data-parsley-validate="">
								<?php echo validation_errors('<div>', '</div>'); ?>
								<div class="form-group xs-pt-10">
								  <label>Email address</label>
								  <input name="account_email" type="email" placeholder="(eg. george@package7.com)" class="form-control">
								</div>
								<div class="form-group">
								  <label>Password</label>
								  <input name="account_password" type="password" placeholder="Password" class="form-control">
								</div>
								<div class="form-group">
								  <label>Confirm password</label>
								  <input name="account_password_confirm" type="password" placeholder="Confirm password" class="form-control">
								</div>
								<div class="form-group">
								  <label>Mobile number</label>
								  <input name="account_phone" type="text" placeholder="(eg. 07841582659)" class="form-control">
								</div>
								<div class="form-group">
								  <label>Main contact</label>
								  <input name="account_name" type="text" placeholder="(eg. Jon Snow)" class="form-control">
								</div>
								<div class="form-group">
								  <label>Company name</label>
								  <input name="client_company" type="text" placeholder="(eg. Agency7 LLP)" class="form-control">
								</div>
								<div class="form-group">
								  <label>Address</label>
								  <input name="client_company_address" type="text" placeholder="(eg. 123 High Street)" class="form-control">
								</div>
								<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
									  <label>City</label>
									  <input name="client_company_city" type="text" placeholder="(eg. Birmingham)" class="form-control">
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
									  <label>State</label>
									  <input name="client_company_state" type="text" placeholder="(eg. West Midlands)" class="form-control">
									</div>
								</div>
								</div>
								<div class="form-group">
								  <label>Postcode</label>
								  <input name="client_company_postcode" type="text" placeholder="(eg. B12 0JU)" class="form-control">
								</div>
									<div class="be-checkbox">
									  <input id="check1" type="checkbox">
									  <label for="check1">I let the customer know about our terms and condition</label>
									</div>
									<p class="text-right">
									  <button class="btn btn-space btn-default">Cancel</button>
									  <button type="submit" class="btn btn-space btn-primary">Submit</button>
									</p>
							  </form>
							</div>
						  </div>
						</div>
					</div>
				</div>
			</div>
			<?php echo $sidebar_right; ?>
		</div>
		<?= global_load_scripts(); ?>
    <script src="/public/lib/fuelux/js/wizard.js" type="text/javascript"></script>
    <script src="/public/lib/select2/js/select2.min.js" type="text/javascript"></script>
    <script src="/public/lib/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="/public/lib/bootstrap-slider/js/bootstrap-slider.js" type="text/javascript"></script>
    <script src="/public/js/app-form-wizard.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				App.init();
				App.wizard();
			});
		</script>
	</body>
</html>