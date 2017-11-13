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
						<div class="col-xs-12 col-md-6 col-lg-4">
							<div class="widget widget-tile">
							<div id="spark2" class="chart sparkline"><canvas width="81" height="35" style="display: inline-block; width: 81px; height: 35px; vertical-align: top;"></canvas></div>
							<div class="data-info">
							<div class="desc">In progress</div>
							<div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span data-toggle="counter" data-end="80" data-suffix="%" class="number">80%</span>
							</div>
							</div>
							</div>
						</div>
						<div class="col-xs-12 col-md-6 col-lg-4">
							<div class="widget widget-tile">
							<div id="spark3" class="chart sparkline"><canvas width="85" height="35" style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas></div>
							<div class="data-info">
							<div class="desc">Closed</div>
							<div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span data-toggle="counter" data-end="532" class="number">532</span>
							</div>
							</div>
							</div>
						</div>
						<div class="col-xs-12 col-md-6 col-lg-4">
							<div class="widget widget-tile">
							<div id="spark4" class="chart sparkline"><canvas width="85" height="35" style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas></div>
							<div class="data-info">
							<div class="desc">Downloads</div>
							<div class="value"><span class="indicator indicator-negative mdi mdi-chevron-down"></span><span data-toggle="counter" data-end="113" class="number">113</span>
							</div>
							</div>
							</div>
						</div>
					</div>
						<div class="row">
							<div class="col-md-12">
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
												<table class="table table-striped table-borderless">
												<thead>
													<th>Full name</th>
													<th>Email address</th>
													<th>Phone number</th>
												</thead>
												<tbody>';
												
												
												
												foreach($accounts as $account)
												{
													echo '
													<tr>
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
					
					<!-- <div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading panel-heading-divider">
									Teams
									<div class="tools">
										<a href="#" data-toggle="modal" data-target="#add_team_modal" class="btn btn-primary"><span class="mdi mdi-accounts-add" style="vertical-align: middle;"></span> Team</a>
									</div>
								</div>
								<div class="panel-body">
									<?php
									
										if(count($teams)==0)
										{
											echo '
											<div role="alert" class="alert alert-warning alert-icon alert-icon-colored alert-dismissible">
												<div class="icon">
													<span class="mdi mdi-alert-triangle"></span>
												</div>
												<div class="message">
													<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
													Currently no teams have been created.
												</div>
											</div>';
										}
										else
										{
											echo '
											<table class="table table-striped">
											<thead>
												<th>Team name</th>
												<th>Members</th>
											</thead>
											<tbody>';
											
											foreach($teams as $team)
											{
												echo '
												<tr>
													<td>' . $team['team_name'] . '</td>
													<td>0</td>
												</tr>';
											}
											
											echo '
											</tbody>
											</table>';
										}
										
									?>
								</div>
							</div>
						</div>
					</div> -->
				</div>
		  <?php echo $sidebar_right; ?>
		</div>
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
		<!-- Add team modal start -->
		<div id="add_team_modal" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
			<div class="modal-dialog custom-width">
				<div class="modal-content">
					<form id="add_team">
						<div class="modal-header">
							<button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
							<h3 class="modal-title">Team</strong></h3>
						</div>
						<div class="modal-body">
							<div id="add_team_console"></div>
							<input type="hidden" name="company_id" id="company_id" value="<?= $project['company_id']; ?>"/>
							<input type="hidden" name="account_id" id="account_id" value="<?= $this->session->userdata('account_id'); ?>"/>
							<div class="form-group">
								<label>Team name <span class="mandatory">*</span></label>
								<input type="text" name="team_name" id="team_name" class="form-control"/>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
							<button type="button" id="add_team" class="btn btn-primary">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--  Add team modal end  -->
		<?= global_load_scripts(); ?>
		<script type="text/javascript">
			$(document).ready(function()
			{
				App.init();
			
				function test_not(message)
				{
					$.gritter.add({
        title: 'Samantha new msg!',
        text: message,
        image: 'http://thepanel.package7.com/public/img/profiles/avatars/avatar5.png',
        time: '',
        class_name: 'img-rounded'
      });
				return false;}
				// Stomp.js boilerplate
      if (location.search == '?ws') {
          var ws = new WebSocket('ws://' + window.location.hostname + ':15674/ws');
      } else {
          var ws = new SockJS('http://' + window.location.hostname + ':15674/stomp');
      }
      var client = Stomp.over(ws);

      var on_connect = function(x) {
          client.subscribe("/queue/hello_queue2", function(d) {
               console.log(d.headers.type);
			   console.log(d);
			   
			   if(d.headers.type=='json')
			   {
				   if(d.headers.type=='json')
				{
					test_not(d.body);
				}
			   }
			   
          });
      };
      var on_error =  function() {
        console.log('error');
      };
      client.connect('test', 'test', on_connect, on_error, '/');
				
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
				
				/* Add team */
				$('button#add_team').on('click', function(event)
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
		<script>

      

    </script>
	</body>
</html>