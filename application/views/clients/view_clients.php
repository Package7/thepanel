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
		<link rel="stylesheet" type="text/css" href="myprintpanel.com/public/lib/bootstrap-slider/css/bootstrap-slider.css"/>
	</head>
	<body>
    <div class="be-wrapper">
      <?php echo $header; ?>
      <?php echo $sidebar; ?>
      <div class="be-content">

       <div class="main-content container-fluid">
         <?php
		 
			// echo '<pre>';
			// print_r($projects);
			// echo '</pre>';
			
		?>
          <div class="row">
            <!--Responsive table-->
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">Clients
                  <div class="tools dropdown">
					<a href="<?= base_url('clients/add_clients'); ?>" class="btn btn-primary">
						<span class="mdi mdi-plus-square"></span> 
						Add client
					</a>
                  </div>
                </div>
                <div class="panel-body">
                  <!--<div class="table-responsive noSwipe"> / enable responsivness -->
                  <div>
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
                        <!--<tr>
                          <td>
                            <div class="be-checkbox be-checkbox-sm">
                              <input id="check2" type="checkbox">
                              <label for="check2"></label>
                            </div>
                          </td>
                          <td class="user-avatar cell-detail user-info"><img src="<?php echo base_url('public/img'); ?>/avatar6.png" alt="Avatar"><span>Penelope Thornton</span><span class="cell-detail-description">Developer</span></td>
                          <td class="cell-detail"> <span>Initial commit</span><span class="cell-detail-description">Bootstrap Admin</span></td>
                          <td class="milestone"><span class="completed">8 / 15</span><span class="version">v1.2.0</span>
                            <div class="progress">
                              <div style="width: 45%" class="progress-bar progress-bar-primary"></div>
                            </div>
                          </td>
                          <td class="cell-detail"><span>master</span><span class="cell-detail-description">63e8ec3</span></td>
                          <td class="cell-detail"><span>May 6, 2016</span><span class="cell-detail-description">8:30</span></td>
                          <td class="text-right">
                            <div class="btn-group btn-hspace">
                              <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Open <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                              <ul role="menu" class="dropdown-menu pull-right">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                            </div>
                          </td>
                        </tr>-->
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
	<!-- Add project modal end   -->
    <?= global_load_scripts(); ?>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      });
    </script>
  </body>
</html>