<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?= get_website_title('Clients'); ?></title>
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
									Clients
									<div class="tools dropdown">
										<a href="<?= base_url('clients/add_clients'); ?>" class="btn btn-primary">
											<span class="mdi mdi-plus-square"></span> 
											Add client
										</a>
									</div>
								</div>
								<div class="panel-body">
								  <div class="table-responsive noSwipe">
									<table class="table table-striped table-hover">
									  <thead>
										<tr>
										  <th style="width:5%;">
											<div class="be-checkbox be-checkbox-sm">
											  <input id="check1" type="checkbox">
											  <label for="check1"></label>
											</div>
										  </th>
										  <th style="width:17%;">Company</th>
										  <th style="width:15%;">Projects</th>
										  <th style="width:1%;">Tasks</th>
										  <th style="width:10%;">Accounts</th>
										  <th style="width:10%;"></th>
										</tr>
									  </thead>
									  <tbody>
										<?php
											foreach($clients as $client)
											{
												echo '
												<tr>
													<td>
														<div class="be-checkbox be-checkbox-sm">
															<input id="check2" type="checkbox">
															<label for="check2"></label>
														</div>
													</td>
													<td>' . $client['client_company'] . '</td>
													<td></td><td>0/0</td>
													<td>0/0</td>
													<td class="text-right">
														<div class="btn-group btn-hspace">
															<button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false">Options <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
											  <ul role="menu" class="dropdown-menu pull-right">
												<li><a href="' . base_url('projects/view/') . '">View</a></li>
											  </ul>
											</div>
										  </td>
												</tr>';
											}
											
										?>
										</tbody>
									</table>
								  </div>
								</div>
								<!--<div class="panel-footer"></div>-->
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