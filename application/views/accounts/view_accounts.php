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
						<div class="col-sm-12">
							<div class="panel panel-default panel-table">
								<div class="panel-heading">
									Accounts
								</div>
								<div class="panel-body">
									<div class="table-responsive noSwipe">
										<table class="table table-striped table-hover">
											<?php if($this->Permissions_Model->is_admin() && $this->Permissions_Model->has_access('view_accounts')): ?>
												<thead>
													<th style="width:20%;">Name</th>
													<th style="width:20%;">Group</th>
													<th style="width:20%;">Email address</th>
													<th style="width:17%;">Phone number</th>
													<th style="width:10%;" colspan="2">Options</th>
												</thead>
												<tbody>
													<?php 
													
														if(isset($accounts)) {
															foreach($accounts as $account) {
																echo '
																<tr>
																	<td>' . $account['account_fname'] . ' ' . $account['account_lname'] . '</td>
																	<td>' . $account['account_group_id'] . '</td>
																	<td>' . $account['account_email'] . '</td>
																	<td>' . $account['account_phone'] . '</td>
																</tr>';
															}
														} else {
															echo '<tr><td colspan="6" align="center">No accounts</td></tr>';
														}
														
													?>
												</tbody>
											<?php elseif($this->Permissions_Model->has_access('view_accounts')): ?>
											<thead>
												<th style="width:5%;">
													<div class="be-checkbox be-checkbox-sm">
														<input id="check1" type="checkbox">
														<label for="check1"></label>
													</div>
												</th>
												<th style="width:20%;">Name</th>
												<th style="width:20%;">Group</th>
												<th style="width:20%;">Email address</th>
												<th style="width:17%;">Phone number</th>
												<th style="width:10%;" colspan="2">Options</th>
											</thead>
											<tbody>
											<?php

												if($accounts==false)
												{
													echo '<tr><td>No accounts</td></tr>';
												}
												else
												{
													foreach($accounts as $account)
													{
														echo '
														<tr>
															<td><img src="' . get_avatar($account['account_id']) . '" class="img-circle" style="width:35px;"/></td>
															<td>' . $account['account_fname'] . ' ' . $account['account_lname'] . '</td>
															<td><span class="label label-default"><span class="mdi mdi-accounts"></span> ' . $account['account_group_name'] . '</span></td>
															<td>' . $account['account_email'] . '</td>
															<td>' . $account['account_phone'] . '</td>
															<td class="actions"><a href="' . base_url('accounts/view/' . $account['account_id']) . '" class="icon"><i class="mdi mdi-settings"></i></a></td>
															<td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
														</tr>';
													}
												}

											?>
											</tbody>
											<?php endif; ?>
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
		<?= global_load_scripts(); ?>
		<script type="text/javascript">
			$(document).ready(function()
			{
				App.init();
			});
		</script>
	</body>
</html>