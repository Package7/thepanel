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
						<div class="col-sm-12">
							<div class="panel panel-default panel-table">
								<div class="panel-heading">
									Companies
									<div class="tools dropdown">
										<?php
										
											if(intval($this->session->userdata('account_isadmin'))==1)
											{
												echo '<a href="#" class="btn btn-success"><i class="mdi mdi-plus-square"></i> Company</a>';
											}
											
										?>
									</div>
								</div>
								<div class="panel-body">
									<div class="table-responsive noSwipe">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th style="width:45%;">Company name</th>
													<th style="width:15%;">Registration number</th>
													<th style="width:10%;">Projects</th>
													<th style="width:10%;">Teams</th>
													<th style="width:10%;">Accounts</th>
													<th style="width:10%;">Default</th>
												</tr>
											</thead>
											<tbody>
												<?php
												
													if($companies)
													{
														foreach($companies as $company)
														{
															echo '
															<tr id="company_link" data-href="' . base_url('companies/view/' . $company['company_id']) . '">
																<td>' . $company['company_name'] . '</td>
																<td>' . $company['company_registration_number'] . '</td>
																<td>' . $company['company_projects_count'] . '</td>
																<td>' . $company['company_teams_count'] . '</td>
																<td>' . $company['company_accounts_count'] . '</td>
																<td>';
																
																if(intval($company['company_account_isdefault'])==1)
																{
																	echo '<i class="mdi mdi-badge-check" style="font-size: 18px; color:green;"></i>';
																}
																
															echo '
																</td>
															</tr>';
														}
													}
													else
													{
														echo '
														<tr>
															<td colspan="6" align="center">
																<p>No companies</p>
															</td>
														</tr>';
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