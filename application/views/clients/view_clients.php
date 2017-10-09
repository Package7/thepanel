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
														<div class="be-checkbox be-checkbox-sm be-checkbox-color inline">
															<input id="check9" type="checkbox">
															<label for="check9"></label>
														</div>
													</th>
													<th style="width:70%;">Company</th>
													<th style="width:5%;">Projects</th>
													<th style="width:5%;">Tasks</th>
													<th style="width:5%;">Files</th>
													<th style="width:5%;">Notes</th>
													<th style="width:5%;">Accounts</th>
												</tr>
											</thead>
											<tbody>
											<?php
												foreach($clients as $client)
												{
													echo '
													<tr style="cursor: pointer; cursor: hand;" id="view_client" data-href="' . base_url('clients/view/' . $client['client_id']) . '">
														<td>
															<div class="be-checkbox be-checkbox-sm be-checkbox-color inline">
																<input id="client_id_' . $client['client_id'] . '" type="checkbox">
																<label for="client_id_' . $client['client_id'] . '"></label>
															</div>
														</td>
														<td>' . $client['client_company'] . '</td>
														<td>' . $client['projects_count'] . '</td>
														<td>' . $client['project_tasks_count'] . '</td>
														<td>' . $client['project_files_count'] . '</td>
														<td>' . $client['project_notes_count'] . '</td>
														<td>' . $client['accounts_count'] . '</td>
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
		
				$('tr#view_client').click(function(event)
				{
					if (event.target.type == "checkbox") 
					{
						event.stopPropagation();
					} 
					else
					{
						window.location = $(this).data('href');
					}
				});
			});
		</script>
	</body>
</html>