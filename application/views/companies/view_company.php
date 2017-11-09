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
						<div class="col-sm-4">
							<div class="panel panel-default panel-table">
								<div class="panel-heading">
									Company
									<div class="tools dropdown">
										<?php
										
											if(intval($this->session->userdata('account_isadmin'))==1)
											{
												echo '<a href="#" class="btn btn-success" data-toggle="modal" data-target="#create_company_modal" ><i class="mdi mdi-plus-square"></i> Company</a>';
											}
											
										?>
									</div>
								</div>
								<div class="panel-body">
									<table id="user" style="clear: both" class="table table-striped table-borderless">
										<tbody>
											<tr>
												<td width="50%">Company name</td>
												<td width="50%"><a id="company_name" href="#" data-type="text" data-title="Company name" data-pk="<?= $company['company_id']; ?>" class="editable editable-click"><?= $company['company_name']; ?></a></td>
											</tr>
											<tr>
												<td width="50%">Registration number</td>
												<td width="50%"><a id="company_registration_number" href="#" data-type="text" data-title="Registration number"  data-pk="<?= $company['company_id']; ?>"class="editable editable-click"><?= $company['company_registration_number']; ?></a></td>
											</tr>
											<tr>
												<td width="50%">Address</td>
												<td width="50%"><a id="company_address" href="#" data-type="text" data-title="Address" data-pk="<?= $company['company_id']; ?>" class="editable editable-click"><?= $company['company_address']; ?></a></td>
											</tr>
											<tr>
												<td width="50%">City</td>
												<td width="50%"><a id="company_city" href="#" data-type="text" data-title="City" data-pk="<?= $company['company_id']; ?>" class="editable editable-click"><?= $company['company_city']; ?></a></td>
											</tr>
											<tr>
												<td width="50%">Postcode</td>
												<td width="50%"><a id="company_postcode" href="#" data-type="text" data-title="Postcode" data-pk="<?= $company['company_id']; ?>" class="editable editable-click"><?= $company['company_postcode']; ?></a></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--<div class="row" style="display: inline-blk;law>
						<div class="col-sm-12">
						<div class="panel panel-default">
                <div class="tab-container">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab">Projects</a></li>
                    <li><a href="#profile" data-toggle="tab">Accounts</a></li>
                    <li><a href="#messages" data-toggle="tab">Invoices</a></li>
                  </ul>
                  <div class="tab-content">
                    <div id="home" class="tab-pane active cont">
                      <h4>Top Tabs</h4>
                      <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam porta lacus ipsum, tempus consequat turpis auctor sit amet. Pellentesque porta mollis nisi, pulvinar convallis tellus tristique nec.</p>
                      <p> Nam aliquet consequat quam sit amet dignissim. Quisque vel massa est. Donec dictum nisl dolor, ac malesuada tellus efficitur non. Pellentesque pellentesque odio neque, eget imperdiet eros vehicula lacinia.</p>
                    </div>
                    <div id="profile" class="tab-pane cont">
                      <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima praesentium laudantium ipsa, enim maxime placeat, dolores quos sequi nisi iste velit perspiciatis rerum eveniet voluptate laboriosam perferendis ipsum. Expedita, maiores.</p>
                      <p> Consectetur adipisicing elit. Minima praesentium laudantium ipsa, enim maxime placeat, dolores quos sequi nisi iste velit perspiciatis rerum eveniet voluptate laboriosam perferendis ipsum. Expedita, maiores.</p>
                    </div>
                    <div id="messages" class="tab-pane">
                      <p>Consectetur adipisicing elit. Ipsam ut praesentium, voluptate quidem necessitatibus quam nam officia soluta aperiam, recusandae.</p>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos facilis laboriosam, vitae ipsum tenetur atque vel repellendus culpa reiciendis velit quas, unde soluta quidem voluptas ipsam, rerum fuga placeat rem error voluptate eligendi modi. Delectus, iure sit impedit? Facere provident expedita itaque, magni, quas assumenda numquam eum! Sequi deserunt, rerum.</p><a href="#">Read more  </a>
                    </div>
                  </div>
                </div>
              </div>
						</div>-->
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