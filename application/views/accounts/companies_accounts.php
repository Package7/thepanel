<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="<?php echo base_url('public/img'); ?>/logo-fav.png">
		<title><?= get_website_title('Teams'); ?></title>
		<?= global_load_styles(); ?>
	</head>
	<body>
	<div class="be-wrapper">
		<?php echo $header; ?>
		<?php echo $sidebar; ?>
		<div class="be-content">
			<div class="main-content container-fluid">
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default panel-table">
							<div class="panel-heading panel-heading-divider">
								Accounts
								<div class="tools">
									<a href="#" data-toggle="modal" data-target="#add_account_modal" class="btn btn-primary"><span class="mdi mdi-account-add" style="vertical-align: middle;"></span> Account</a>
								</div>
							</div>
							<div class="panel-body">
							<?php
										
								if(count($accounts)==0)
								{
									echo '
									<div role="alert" class="alert alert-warning alert-icon alert-icon-colored alert-dismissible">
									<div class="icon">
									<span class="mdi mdi-alert-triangle"></span>
									</div>
									<div class="message">
									<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
									<strong>Accounts</strong> Currently no accounts have been created.
									</div>
									</div>';
								}
								else
								{
									echo '
									<table class="table table-striped">
									<thead>
										<th>Full name</th>
										<th>Email address</th>
										<th>Phone number</th>
									</thead>
									<tbody>';
									
									
									
									foreach($accounts as $account)
									{
										echo '
										<tr id="account_options" data-href="' . base_url('accounts/assign_account/' . $this->session->userdata('company')['company_id'] . '/' . $account['account_id']) . '">
											<td>' . $account['account_fname'] . ' ' . $account['account_lname'];
											
										if($this->session->userdata('account_id') == $account['account_id'])
										{
											echo ' <small><strong>(You)</strong></small>';
										}
										echo '</td>
											<td>' . $account['account_email'] . '</td>
											<td>' . $account['account_phone'] . '</td>
										</tr>';
									}
									
									echo '</tbody>
									</table>';
								}
								
							?>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
		<?php echo $sidebar_right; ?>
    </div>
		<!-- Team assign modal start -->
		<div id="assign_account_modal" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
			<div class="modal-dialog custom-width">
				<div class="modal-content">
					Loading ...
				</div>
			</div>
		</div>
		<!-- Team assign modal end   -->
		<!-- Add account modal start -->
		<div id="add_account_modal" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
			<div class="modal-dialog custom-width">
				<div class="modal-content">
					<form id="add_account">
						<div class="modal-header">
							<button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
							<h3 class="modal-title">Account</strong></h3>
						</div>
						<div class="modal-body">
							<div id="add_account_console"></div>
							<input type="hidden" name="company_id" id="company_id" value="<?= $this->session->userdata('company')['company_id']; ?>"/>
							<div class="form-group">
								<label>Full name <span class="mandatory">*</span></label>
								<input name="account_name" id="account_name" type="text" placeholder="" class="form-control">
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Email <span class="mandatory">*</span></label>
										<input name="account_email" id="account_email" type="email" placeholder="" class="form-control">
									</div>
									<div class="form-group">
									  <label>Phone number <span class="mandatory">*</span></label>
									  <input name="account_phone" id="account_phone" type="phone" placeholder="" class="form-control">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
									  <label>Password <span class="mandatory">*</span></label>
									  <input name="account_password" id="account_password" type="password" placeholder="" class="form-control">
									</div>
									<div class="form-group">
									  <label>Confirm password <span class="mandatory">*</span></label>
									  <input name="account_password_confirm" id="account_password_confirm" type="password" placeholder="" class="form-control">
									 </div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div><strong>Send credentials to</strong></div> 
									<div class="be-checkbox be-checkbox-color inline">
										<input name="account_credentials_email" id="account_credentials_email" value="1" type="checkbox">
										<label for="account_credentials_email">Email</label>
									</div>
									<div class="be-checkbox be-checkbox-color inline">
										<input name="account_credentials_phone" id="account_credentials_phone" value="1" type="checkbox">
										<label for="account_credentials_phone">Text message</label>
									</div>
								</div>
								<div class="col-sm-6">
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
							<button type="button" id="add_account" class="btn btn-primary">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--  Add account modal end  -->
    <?= global_load_scripts(); ?>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
		
		$('tr#account_options').click(function(event)
		{
			event.preventDefault();
			var url = $(this).data('href');
			// alert(url);
			$('div#assign_account_modal .modal-content').html('');
			$('div#assign_account_modal .modal-content').load(url);
			$('div#assign_account_modal').modal({show: true});
		});
		
		/* Add account */
		$('button#add_account').on('click', function(event)
		{
			event.preventDefault();
			$('button#add_account').attr('disabled', 'disabled');
			$.ajax(
			{
				type: 'POST',
				url: '<?= base_url('accounts/create_account'); ?>',
				data: $('form#add_account').serialize(),
				success: function(data)
				{
					// $('div#add_account_console').html(data);
					
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
							$('div#add_account_console').html('<div class="alert alert-danger"><strong>Please correct the following:</strong>' + response.errors + '</div>');
						}
					}
					catch(e)
					{
					}
					
					$('button#add_account').removeAttr('disabled');					
				}
			});
		});
      });
      
    </script>
  </body>
</html>