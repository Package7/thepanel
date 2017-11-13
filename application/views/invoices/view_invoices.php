<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="<?php echo base_url('public/img'); ?>/logo-fav.png">
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
									Invoices
									<div class="tools">
										<?php

											if($this->Permissions_Model->is_admin()) {
												echo '<a href="' . base_url('invoices/create') . '" class="btn btn-primary"><i class="mdi mdi-plus-square"></i> Invoice</a>';
											}

										?>
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
													<th style="width:20%;">Client</th>
													<th style="width:17%;">Items</th>
													<th style="width:15%;">Progress</th>
													<th style="width:10%;">Status</th>
													<th style="width:10%;">Date</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td colspan="6" align="center">No records</td>
												</tr>
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
		<script type="text/javascript">
			$(document).ready(function(){
			//initialize the javascript
			App.init();
			});
		</script>
	</body>
</html>