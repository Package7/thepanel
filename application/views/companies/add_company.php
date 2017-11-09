<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?= get_website_title('Dashboard'); ?></title>
		<?= global_load_styles(); ?>
	</head>
	<body>
		<div class="be-wrapper">
			<?php echo $header; ?>
			<?php echo $sidebar; ?>
			<div class="be-content">
				<div class="main-content container-fluid">    
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3">
							<form id="create_company">
								<div class="panel panel-default panel-border-color panel-border-color-primary">
									<div class="panel-heading panel-heading-divider">
										Add a company
										<span class="panel-subtitle">Start up by creating a new company</span>
									</div>
									<div class="panel-body">
										<div id="create_company_console"></div>
										<div class="form-group xs-pt-10">
											<label>Company name <span class="mandatory">*</span></label>
											<input name="company_name" id="company_name" type="text" placeholder="(eg. Agency7 LLP)" class="form-control" data-validation="required" data-validation-error-msg="Please type in your company name">
										</div>
										<div class="form-group xs-pt-10">
											<label>Registration number</label>
											<input name="company_registration_number" id="company_registration_number" type="text" placeholder="(eg. Agency7 LLP)" class="form-control">
										</div>
										<div class="form-group">
											<label>Address</label>
											<input name="company_address" id="company_address" type="text" placeholder="(eg. 123 High street)" class="form-control">
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label>City</label>
													<input name="company_city" id="company_city" type="text" placeholder="(eg. Birmingham)" class="form-control">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label>Postcode</label>
													<input name="company_postcode" id="company_postcode" type="text" placeholder="(eg. B12 0JU)" class="form-control">
												</div>
											</div>
										</div>
									</div>
									<div class="panel-heading panel-heading-divider">
										First project
										<span class="panel-subtitle">Your first project details</span>
									</div>
									<div class="panel-body">
										<div class="form-group xs-pt-10">
											<label>Project name <span class="mandatory">*</span></label>
											<input name="project_name" id="project_name" type="text" placeholder="(eg. package7.com)" class="form-control" data-validation="required" data-validation-error-msg="Please type in a name for your first project">
										</div>
										<div class="form-group xs-pt-10">
											<label>Description</label>
											<input name="project_description" id="project_description" type="text" placeholder="(eg. My first website)" class="form-control">
										</div>
									</div>
									<div class="panel-footer">
										<p class="text-right">
											<button class="btn btn-space btn-default">Cancel</button>
											<button id="create_company" type="submit" class="btn btn-space btn-primary">Save</button>
										</p>
									</div>
									
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		  <?php echo $sidebar_right; ?>
		</div>
		<?= global_load_scripts(); ?>
		<script type="text/javascript" src="<?= base_url('public/js/app-companies.js'); ?>"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				App.init();
				App.companies('<?= base_url(); ?>');
			});
		</script>
	</body>
</html>