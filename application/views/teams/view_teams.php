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
							<div class="panel-heading">
								Teams
								<div class="tools dropdown">
									<a href="#" data-toggle="modal" data-target="#add_team_modal" class="btn btn-primary">
										<span class="mdi mdi-accounts-add" style="vertical-align: middle;"></span> 
										Team
									</a>
								</div>
							</div>
                <div class="panel-body">
                  <!--<div class="table-responsive noSwipe"> / enable responsivness -->
                  <div>
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th style="width:20%;">Team name</th>
                          <th style="width:17%;">Members</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						if(count($teams) == 0)
						{
							echo '
							<tr>
								<td colspan="2" align="center">No records</td>
							</tr>';
						}
						else
						{
							foreach($teams as $team)
							{
								echo '
								<tr>
									<td><i class="mdi mdi-accounts-list" style="font-size: 24px; margin-right: 15px; vertical-align: middle;"></i> ' . $team['team_name'] . '</td>
									<td>-</td>
								</tr>';
							}
						}
						
					?>
                        
						</tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php echo $sidebar_right; ?>
    </div>
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
							<input type="hidden" name="company_id" id="company_id" value="<?= $this->session->userdata('company')['company_id']; ?>"/>
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
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
		
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
	<?php
	
		echo '<pre>';
		print_r($_SESSION);
		echo '</pre>';
		
	?>
  </body>
</html>