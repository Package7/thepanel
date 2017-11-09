<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="<?php echo base_url('public/img'); ?>/logo-fav.png">
		<title><?= get_website_title('Accounts'); ?></title>
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
									Account 
								</div>
								<div class="panel-body">
									<table id="user" style="clear: both" class="table table-striped table-borderless">
									<tbody>
										<tr>
											<td width="35%">First name</td>
											<td width="65%"><a id="username2" href="#" data-type="text" data-title="First name" class="editable editable-click"><?= $account['account_fname']; ?></a></td>
										</tr>
										<tr>
											<td width="35%">Last name</td>
											<td width="65%"><a id="username" href="#" data-type="text" data-title="Last name" class="editable editable-click"><?= $account['account_lname']; ?></a></td>
										</tr>
										<tr>
											<td width="35%">Email address</td>
											<td width="65%"><a id="username" href="#" data-type="text" data-title="Email address" class="editable editable-click"><?= $account['account_email']; ?></a></td>
										</tr>
										<tr>
											<td width="35%">Phone number</td>
											<td width="65%"><a id="username" href="#" data-type="text" data-title="Phone number" class="editable editable-click"><?= $account['account_phone']; ?></a></td>
										</tr>
										<tr>
											<td width="35%">Administrator</td>
											<td width="65%"><a id="username" href="#" data-type="text" data-title="Enter username" class="editable editable-click">superuser</a></td>
										</tr>
									</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-default panel-table">
								<div class="panel-heading">
									Permissions
								</div>
								<div class="panel-body">
									<div class="table-responsive noSwipe">
										<table class="table table-striped table-hover">
											<thead>
												<th>Module</th>
												<th>View</th>
												<th>Edit</th>
												<th>Delete</th>
											</thead>
											<tbody>
											<?php
											
												foreach($permissions as $permission)
												{
													echo '
													<tr>
														<td><strong>' . $permission['account_role_category_name'] . '</strong></td>
														<td>
															<div class="be-checkbox be-checkbox-color inline">
																<input id="check10" type="checkbox">
																<label for="check10"></label>
															</div>
														</td>
														<td>
															<div class="be-checkbox be-checkbox-color inline">
																<input id="check10" type="checkbox">
																<label for="check10"></label>
															</div>
														</td>
														<td>
															<div class="be-checkbox be-checkbox-color inline">
																<input id="check10" type="checkbox">
																<label for="check10"></label>
															</div>
														</td>
													</tr>';
												}
												
											?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="panel-footer"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php echo $sidebar_right; ?>
		</div>
		<?= global_load_scripts(); ?>
		<script type="text/javascript">
			$(document).ready(function()
			{
				App.init();
				App.formEditable();
			});
		</script>
	</body>
</html>