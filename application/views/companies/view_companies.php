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
									Company
									<div class="tools dropdown">
										<?php
										
											if($this->Permissions_Model->is_admin()) {
												echo '<a href="'. base_url('companies/create') . '" class="btn btn-success"><i class="mdi mdi-plus-square"></i> Company</a>';
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
												
													if(count($companies) == 0)
													{
														echo 'No records';
													}
													else
													{
														foreach($companies as $company)
														{
															echo '
															<tr id="company_link" data-href="' . base_url('company/view/' . $company['company_id']) . '">
																<td>' . $company['company_name'] . '</td>
																<td>' . $company['company_registration_number'] . '</td>
																<td>' . $company['company_projects_count'] . '</td>
																<td>' . $company['company_teams_count'] . '</td>
																<td>' . $company['company_accounts_count'] . '</td>
																<td>';
																
																if(intval($this->session->userdata('account_isadmin'))!=1)
																{
																	if(intval($company['company_account_isdefault'])==1)
																	{
																		echo '<i class="mdi mdi-badge-check" style="font-size: 18px; color:green;"></i>';
																	}
																}
																
															echo '
																</td>
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
		<!-- Add company modal start -->
		<div id="create_company_modal" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-success">
			<div class="modal-dialog custom-width">
				<div class="modal-content">
					<div id="create_company_console"></div>
					<form id="create_company">
					<div class="modal-header">
					<button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
					<h3 class="modal-title">New company</h3>
					</div>
					<div class="modal-body">
						<div id="create_company_console"></div>
						<div class="form-group xs-pt-10">
							<label>Business owner</label>
							<select name="account_id" id="account_id" class="form-control">
								<option value="0"> -- Select account --</option>
							</select>
						</div>
						<div class="form-group xs-pt-10">
							<label>Company name</label>
							<input name="company_name" id="company_name" type="text" placeholder="(eg. Agency7 LLP)" class="form-control">
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
					<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
					<button type="button" id="create_company" class="btn btn-success">Save</button>
					</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Add project note modal end   -->
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