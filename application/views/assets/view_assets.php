<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?= get_website_title('Assets'); ?></title>
		<?= global_load_styles(); ?>
	</head>
	<body>
		<div class="be-wrapper">
			<?php echo $header; ?>
			<?php echo $sidebar; ?>
			<div class="be-content">
				<div class="main-content container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="mdi mdi-attachment" style="font-size: 24px; vertical-align: middle"></i> Assets
								</div>
								<div class="panel-body">
									<?php
									
										if(isset($assets) && count($assets)!=0)
										{
											echo 'sunt';
										}
										else
										{
											echo '<div class="alert alert-warning" style="margin-bottom: 0;"><strong>Info</strong> No assets have been uploaded</div>';
										}
									
									?>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="panel panel-default panel-table">
								<div class="panel-heading">
									<i class="mdi mdi-upload" style="font-size: 24px; vertical-align: middle"></i> Upload
								</div>
								<div class="panel-body">
									
								</div>
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