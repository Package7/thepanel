<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="<?php echo base_url('public/img'); ?>/logo-fav.png">
		<title><?= get_website_title('Projects'); ?></title>
		<?= global_load_styles(); ?>
	</head>
	<body>
	<div class="be-wrapper<?= $style; ?>">
		<?php echo $header; ?>
		<?php echo $sidebar; ?>
		<div class="be-content">
			<div class="main-content container-fluid">
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default panel-table">
							<div class="panel-heading">
								Members
								<div class="tools dropdown">
									<a href="#" data-toggle="modal" data-target="#form-bp1" class="btn btn-warning">
										<span class="mdi mdi-account-add"></span> 
										Add member
									</a>
								</div>
							</div>
                <div class="panel-body">
                  <!--<div class="table-responsive noSwipe"> / enable responsivness -->
                  <div>
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th style="width:5%;">
                            &nbsp;
                          </th>
                          <th style="width:20%;">Name</th>
                          <th style="width:17%;">Email</th>
                          <th style="width:15%;">Phone</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						if($members)
						{
							foreach($members as $member)
							{
								echo '
								<tr>
									<td><img src="' . get_avatar($member['account_id']) . '" class="img-circle" style="height: 35px;"/></td>
									<td>' . $member['account_fname'] . ' ' . $member['account_lname'] . '</td>
									<td>' . $member['account_email'] . '</td>
									<td>' . $member['account_phone'] . '</td>
								</tr>';
							}
						}
						
					?>
                        <!--<tr>
                          <td>
                            <div class="be-checkbox be-checkbox-sm">
                              <input id="check2" type="checkbox">
                              <label for="check2"></label>
                            </div>
                          </td>
                          <td class="user-avatar cell-detail user-info"><img src="<?php echo base_url('public/img'); ?>/avatar6.png" alt="Avatar"><span>Penelope Thornton</span><span class="cell-detail-description">Developer</span></td>
                          <td class="cell-detail"> <span>Initial commit</span><span class="cell-detail-description">Bootstrap Admin</span></td>
                          <td class="milestone"><span class="completed">8 / 15</span><span class="version">v1.2.0</span>
                            <div class="progress">
                              <div style="width: 45%" class="progress-bar progress-bar-primary"></div>
                            </div>
                          </td>
                          <td class="cell-detail"><span>master</span><span class="cell-detail-description">63e8ec3</span></td>
                          <td class="cell-detail"><span>May 6, 2016</span><span class="cell-detail-description">8:30</span></td>
                          <td class="text-right">
                            <div class="btn-group btn-hspace">
                              <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Open <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                              <ul role="menu" class="dropdown-menu pull-right">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                            </div>
                          </td>
                        </tr>-->
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
	<!-- Add project modal start -->
	<div id="form-bp1" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-warning">
      <div class="modal-dialog custom-width">
        <div class="modal-content">
		
			<form id="add_member">
          <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
            <h3 class="modal-title">Add member</h3>
          </div>
          <div class="modal-body">
			<div id="add_member_console"></div>
			<div class="form-group">
				<label>Full name <span class="mandatory">*</span></label>
				<input name="account_name" id="account_name" type="text" placeholder="" class="form-control input-xs">
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Email <span class="mandatory">*</span></label>
						<input name="account_email" id="account_email" type="email" placeholder="" class="form-control input-xs">
					</div>
					<div class="form-group">
					  <label>Phone number <span class="mandatory">*</span></label>
					  <input name="account_phone" id="account_phone" type="phone" placeholder="" class="form-control input-xs">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
					  <label>Password <span class="mandatory">*</span></label>
					  <input name="account_password" id="account_password" type="password" placeholder="" class="form-control input-xs">
					</div>
					<div class="form-group">
					  <label>Confirm password <span class="mandatory">*</span></label>
					  <input name="account_password_confirm" id="account_password_confirm" type="password" placeholder="" class="form-control input-xs">
					 </div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div><strong>Send credentials to</strong></div> 
					<div class="be-checkbox be-checkbox-color inline">
						<input name="account_credentials_email" id="account_credentials_email" type="checkbox">
						<label for="account_credentials_email">Email</label>
					</div>
					<div class="be-checkbox be-checkbox-color inline">
						<input name="account_credentials_phone" id="account_credentials_phone" type="checkbox">
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
            <button type="button" id="add_member" class="btn btn-warning btn"><span class="mdi mdi-account-add"></span> Add member</button>
          </div>
		  </form>
        </div>
      </div>
    </div>
	<!-- Add project modal end   -->
    <?= global_load_scripts(); ?>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
		
		$('button#add_member').click(function(event)
		{
			event.preventDefault();
			$.ajax(
			{
				type: 'POST',
				url: '<?= base_url('teams/add_member/' . $this->session->userdata('account_id')); ?>',
				data: $('form#add_member').serialize(),
				dataType: 'html',
				success: function(data)
				{
					$('div#add_member_console').html(data);
					
					// var response=jQuery.parseJSON(data);
					
					// if(typeof response =='object')
					// {
					  // if(response.status==200)
					  // {
						  // window.location.replace(response.url);
					  // }
					  // else
					  // {
						  // alert('Error: ' + data);
					  // }
					// }
					// else
					// {
						// $('div#add_member_console').html(data);
					// }
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