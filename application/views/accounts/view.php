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
          <div class="user-profile">
            <div class="row">
              <div class="col-md-5">
                <div class="user-display">
                  <div class="user-display-bg"><img src="http://myprintpanel.com/public/img/user-profile-display.png" alt="Profile Background"></div>
                  <div class="user-display-bottom">
                    <div class="user-display-avatar"><img src="<?= get_avatar($account['account_id']); ?>" alt="Avatar"></div>
                    <div class="user-display-info">
                      <div class="name"><?= $account['account_fname'] . ' ' . $account['account_lname']; ?></div>
                      <!--<div class="nick"><span class="mdi mdi-account"></span> KDonny</div> -->
				
                    </div>
                   <!-- <div class="row user-display-details">
                      <div class="col-xs-4">
                        <div class="title">Issues</div>
                        <div class="counter">26</div>
                      </div>
                      <div class="col-xs-4">
                        <div class="title">Commits</div>
                        <div class="counter">26</div>
                      </div>
                      <div class="col-xs-4">
                        <div class="title">Followers</div>
                        <div class="counter">26</div>
                      </div>
                    </div> -->
                  </div>
                </div>
                <div class="user-info-list panel panel-default">
                  <div class="panel-heading panel-heading-divider">
					Basic info
					<span class="panel-subtitle">From here you can change your basic information</span></div>
                  <div class="panel-body">
                    <table class="no-border no-strip skills">
                      <tbody class="no-border-x no-border-y">
                        <tr>
                          <td class="icon"><span class="mdi mdi-account"></span></td>
                          <td class="item">First name<span class="icon s7-portfolio"></span></td>
                          <td><?= $account['account_fname']; ?></td>
                        </tr>
                        <tr>
                          <td class="icon"></td>
                          <td class="item">Last name<span class="icon s7-portfolio"></span></td>
                          <td><?= $account['account_lname']; ?></td>
                        </tr>
                        <tr>
                          <td class="icon"><span class="mdi mdi-email"></span></td>
                          <td class="item">E-mail address<span class="icon s7-portfolio"></span></td>
                          <td><?= $account['account_email']; ?></td>
                        </tr>
                        <tr>
                          <td class="icon"><span class="mdi mdi-smartphone-android"></span></td>
                          <td class="item">Phone number<span class="icon s7-gift"></span></td>
                          <td><?= $account['account_phone']; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-md-7">
              </div>
            </div>
           <!--  <div class="row">
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading panel-heading-divider">Current Progress<span class="panel-subtitle">This is the user current progress widget</span></div>
                  <div class="panel-body">
                    <div class="row user-progress">
                      <div class="col-md-10"><span class="title">Bootstrap Admin</span>
                        <div class="progress">
                          <div style="width: 78%" class="progress-bar progress-bar-primary"></div>
                        </div>
                      </div>
                      <div class="col-md-2"><span class="value">78%</span></div>
                    </div>
                    <div class="row user-progress">
                      <div class="col-md-10"><span class="title">Custom Work</span>
                        <div class="progress">
                          <div style="width: 57%" class="progress-bar progress-bar-primary"></div>
                        </div>
                      </div>
                      <div class="col-md-2"><span class="value">57%</span></div>
                    </div>
                    <div class="row user-progress">
                      <div class="col-md-10"><span class="title">Clients Module</span>
                        <div class="progress">
                          <div style="width: 45%" class="progress-bar progress-bar-primary"></div>
                        </div>
                      </div>
                      <div class="col-md-2"><span class="value">45%</span></div>
                    </div>
                    <div class="row user-progress">
                      <div class="col-md-10"><span class="title">Email Templates</span>
                        <div class="progress">
                          <div style="width: 36%" class="progress-bar progress-bar-danger"></div>
                        </div>
                      </div>
                      <div class="col-md-2"><span class="value">36%</span></div>
                    </div>
                    <div class="row user-progress">
                      <div class="col-md-10"><span class="title">Plans Module</span>
                        <div class="progress">
                          <div style="width: 30%" class="progress-bar progress-bar-danger"></div>
                        </div>
                      </div>
                      <div class="col-md-2"><span class="value">30%</span></div>
                    </div>
                    <div class="row user-progress">
                      <div class="col-md-10"><span class="title">User Managemenet System</span>
                        <div class="progress">
                          <div style="width: 21%" class="progress-bar progress-bar-danger"></div>
                        </div>
                      </div>
                      <div class="col-md-2"><span class="value">21%</span></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading panel-heading-divider">Latest Activity<span class="panel-subtitle">This is a custom timeline widget</span></div>
                  <div class="panel-body">
                    <ul class="user-timeline">
                      <li class="latest">
                        <div class="user-timeline-date">Just Now</div>
                        <div class="user-timeline-title">Create New Page</div>
                        <div class="user-timeline-description">Quisque sed est felis. Vestibulum lectus nulla, maximus in eros non, tristique consectetur lorem. Nulla molestie sem quis imperdiet facilisis</div>
                      </li>
                      <li>
                        <div class="user-timeline-date">Today - 15:35</div>
                        <div class="user-timeline-title">Back Up Theme</div>
                        <div class="user-timeline-description">Quisque sed est felis. Vestibulum lectus nulla, maximus in eros non, tristique consectetur lorem. Nulla molestie sem quis imperdiet facilisis</div>
                      </li>
                      <li>
                        <div class="user-timeline-date">Yesterday - 10:41</div>
                        <div class="user-timeline-title">Changes In The Structure</div>
                        <div class="user-timeline-description">Quisque sed est felis. Vestibulum lectus nulla, maximus in eros non, tristique consectetur lorem. Nulla molestie sem quis imperdiet facilisis</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>--></div>
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