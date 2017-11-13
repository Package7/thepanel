<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="<?php echo base_url('public/img'); ?>/logo-fav.png">
		<title><?= get_website_title('Create company / Companies'); ?></title>
		<?= global_load_styles(); ?>
	</head>
	<body>
	<div class="be-wrapper">
		<?php echo $header; ?>
		<?php echo $sidebar; ?>
		<div class="be-content">
			<div class="main-content container-fluid">
				<form id="create_company">
					<div class="row equal">
						<div class="col-sm-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									Company details
								</div>
								<div class="panel-body">
									<?php
									
										echo '<pre>';
										$this->Account->debug();
										echo '</pre>';
										
									?>
									<div class="form-group xs-pt-10">
										<label>Company name <span class="mandatory">*</span></label>
										<input name="company_name" id="company_name" type="text" placeholder="(eg. Agency7 LLP)" class="form-control input-xs" data-validation="required" data-validation-error-msg="Please type in your company name">
									</div>
									<div class="form-group xs-pt-10">
										<label>Registration number</label>
										<input name="company_registration_number" id="company_registration_number" type="text" placeholder="(eg. Agency7 LLP)" class="form-control input-xs">
									</div>
									<div class="form-group">
										<label>Address</label>
										<input name="company_address" id="company_address" type="text" placeholder="(eg. 123 High street)" class="form-control input-xs">
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>City</label>
												<input name="company_city" id="company_city" type="text" placeholder="(eg. Birmingham)" class="form-control input-xs">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Postcode</label>
												<input name="company_postcode" id="company_postcode" type="text" placeholder="(eg. B12 0JU)" class="form-control input-xs">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									Owner details
								</div>
								<div class="panel-body">
									<div class="form-group xs-pt-10">
										<label>Existing account</label>
										<select name="account_id" id="account_id" class="select2" data-validation="required" data-validation-error-msg="Please type in your company name">
											<option value="null">-- Select account --</option>
											<?php
											
												if(isset($accounts)) {
													foreach($accounts as $account) {
														echo '<option value="' . $account['account_id'] . '">' . $account['account_fname'] . ' ' . $account['account_lname'] . ' (' . $account['account_email'] . ')</option>';
													}
												} 
												
											?>
										</select>
									</div>
									<div align="center" style="padding: 15px;">
										<span align="center" style="background-color: #ddd; border-radius: 50px; width: auto; padding: 10px; font-size: 18px; ">OR</span>
									</div>
									<div class="form-group xs-pt-10">
										<label>Full name <span class="mandatory">*</span></label>
										<input name="account_name" id="account_name" type="text" placeholder="(eg. Agency7 LLP)" class="form-control input-xs" data-validation="required" data-validation-error-msg="Please type in your company name">
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group xs-pt-10">
												<label>Email <span class="mandatory">*</span></label>
												<input name="account_email" id="account_email" type="text" class="form-control input-xs" data-validation="required" data-validation-error-msg="Please type in your company name">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group xs-pt-10">
												<label>Phone <span class="mandatory">*</span></label>
												<input name="account_phone" id="account_phone" type="text" class="form-control input-xs" data-validation="required" data-validation-error-msg="Please type in your company name" value="">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group xs-pt-10">
												<label>Password <span class="mandatory">*</span></label>
												<input name="account_password" id="account_password" type="password" class="form-control input-xs" data-validation="required" data-validation-error-msg="Please type in your company name">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group xs-pt-10">
												<label>Confirm password <span class="mandatory">*</span></label>
												<input name="account_password_confirm" id="account_password_confirm" type="text" class="form-control input-xs" data-validation="required" data-validation-error-msg="Please type in your company name">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									Project details
								</div>
								<div class="panel-body">
									<div class="form-group xs-pt-10">
										<label>Project name <span class="mandatory">*</span></label>
										<input name="project_name" id="project_name" type="text" placeholder="(eg. Agency7 LLP)" class="form-control input-xs" data-validation="required" data-validation-error-msg="Please type in your company name">
									</div>
									<div class="form-group xs-pt-10">
										<label>Description <span class="mandatory">*</span></label>
										<textarea name="project_description" id="project_description" class="form-control input-xs" rows="5" data-validation="required" data-validation-error-msg="Please type in your company name"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<p>
								<a href="<?= base_url('companies'); ?>" class="btn btn-danger">
									<span class="mdi mdi-long-arrow-return" style="vertical-align: middle;"></span> 
									Cancel
								</a>
								<button type="submit" class="btn btn-primary">Create company</button>
							</p>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php echo $sidebar_right; ?>
    </div>
	<?= $footer; ?>
    <?= global_load_scripts(); ?>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
		
		
	$("input:text").val("");
	$("input:text").text("");
	$('input').val(' ').on('click', function(event) {
		$(this).val('');
	});;
   
	$("select#account_id").select2({
      width: '100%'
    });
		
			/* Add team */
				$('button#create_company').on('click', function(event)
				{
					event.preventDefault();
					
					$.ajax(
					{
						type: 'POST',
						url: '<?= base_url('teams/add_team'); ?>',
						data: $('form#add_team').serialize(),
						success: function(data, status, xhr)
						{
							try 
							{
								var response = $.parseJSON(JSON.stringify(data));
								
								if(response.status==200)
								{
								  if(response['url'] == 'refresh')
								  {
									  window.location.reload();
								  }
								  else
								  {
									  window.location.replace(response['url']);
								  }
								}
								else
								{
									$('div#add_team_console').html('<div class="alert alert-danger"><strong>Please correct the following:</strong>' + response.errors + '</div>');
								}
							} catch(e) {
								$('div#add_team_console').html(response.errors);
							}
						}
					});
				});
      });
      
    </script>
  </body>
</html>