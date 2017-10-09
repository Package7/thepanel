<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?= get_website_title($client['client_name'] . ' | Clients'); ?></title>
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
									<?= $client['client_name']; ?>
								</div>
								<div class="panel-body">
									<div class="table-responsive noSwipe">
										<table class="table table-striped table-hover">
											<tbody>
												<tr>
													<td>Company</td>
													<td><?= $client['client_company']; ?></td>
												</tr>
												<tr>
													<td>Address</td>
													<td><?= $client['client_company_address']; ?></td>
												</tr>
												<tr>
													<td>City</td>
													<td><?= $client['client_company_city']; ?></td>
												</tr>
												<tr>
													<td>Postcode</td>
													<td><?= $client['client_company_postcode']; ?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<!--<div class="panel-footer"></div>-->
							</div>
						</div>
						<div class="col-sm-4">
							<div class="panel panel-default panel-table">
								<div class="panel-heading">
									Team
								</div>
								<div class="panel-body">
									<div class="table-responsive noSwipe">
										<table class="table table-striped" width="100%">
										<?php
										
											if($team!=false)
											{
												foreach($team as $member)
												{
													echo '
													<tr>
														<td width="1"><img src="' . get_avatar($member['account_id']) . '" class="img-circle" style="height: 35px;"/></td>
														<td>' . $member['account_fname'] . ' ' . $member['account_lname'] . '</td>
													</tr>';
												}
											}
										
										?>
										</table>
									</div>
								</div>
								<!--<div class="panel-footer"></div>-->
							</div>
						</div>
						<div class="col-sm-4">
							<div class="panel panel-default panel-table">
								<div class="panel-heading">
									Projects
								</div>
								<div class="panel-body">
									<div class="table-responsive noSwipe">
										
										<table class="table table-striped" width="100%">
										<?php
										
											if($projects!=false)
											{
												foreach($projects as $project)
												{
													echo '
													<tr>
														<td><a href="'. base_url('projects/view/' . $project['project_id']) . '">' . $project['project_name'] . '</a></td>
													</tr>';
												}
											}
										
										?>
										</table>
									</div>
								</div>
								<!--<div class="panel-footer"></div>-->
							</div>
						</div>
						<div class="clearfix"></div>
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