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
            <!--Responsive table-->
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">Accounts
                  <div class="tools dropdown"><span class="icon mdi mdi-download"></span><a href="#" type="button" data-toggle="dropdown" class="dropdown-toggle"><span class="icon mdi mdi-more-vert"></span></a>
                    <ul role="menu" class="dropdown-menu pull-right">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                    </ul>
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
                          <th style="width:20%;">Name</th>
                          <th style="width:20%;">Group</th>
                          <th style="width:20%;">Email address</th>
                          <th style="width:17%;">Phone number</th>
                          <th style="width:15%;" colspan="2">Notifications</th>
                          <th style="width:10%;" colspan="2">Options</th>
                        </tr>
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
								<td class="actions">' . is_verified($account['account_email_notifications']) . '</td>
								<td class="actions">' . is_verified($account['account_phone_notifications']) . '</td>
								<td class="actions"><a href="#" class="icon"><i class="mdi mdi-settings"></i></a></td>
								<td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
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
   
    <?= global_load_scripts(); ?>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      });
      
    </script>
  </body>
</html>