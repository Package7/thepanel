<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="<?php echo base_url('public/img'); ?>/logo-fav.png">
		<title><?= get_website_title('Teams'); ?></title>
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
                  <div class="user-display-bg"><img src="/public/assets/img/user-profile-display.png" alt="Profile Background"></div>
                  <div class="user-display-bottom">
                    <div class="user-display-avatar"><img src="assets/img/avatar-150.png" alt="Avatar"></div>
                    <div class="user-display-info">
                      <div class="name">Kristopher Donny</div>
                      <div class="nick"><span class="mdi mdi-account"></span> KDonny</div>
                    </div>
                    <div class="row user-display-details">
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
                    </div>
                  </div>
                </div>
                <div class="user-info-list panel panel-default">
                  <div class="panel-heading panel-heading-divider">About Me<span class="panel-subtitle">I am a web developer and designer based in Montreal - Canada, I like read books, good music and nature.</span></div>
                  <div class="panel-body">
                    <table class="no-border no-strip skills">
                      <tbody class="no-border-x no-border-y">
                        <tr>
                          <td class="icon"><span class="mdi mdi-case"></span></td>
                          <td class="item">Name<span class="icon s7-portfolio"></span></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td class="icon"><span class="mdi mdi-cake"></span></td>
                          <td class="item">Birthday<span class="icon s7-gift"></span></td>
                          <td>16 September 1989</td>
                        </tr>
                        <tr>
                          <td class="icon"><span class="mdi mdi-smartphone-android"></span></td>
                          <td class="item">Mobile<span class="icon s7-phone"></span></td>
                          <td>(999) 999-9999</td>
                        </tr>
                        <tr>
                          <td class="icon"><span class="mdi mdi-globe-alt"></span></td>
                          <td class="item">Location<span class="icon s7-map-marker"></span></td>
                          <td>Montreal, Canada</td>
                        </tr>
                        <tr>
                          <td class="icon"><span class="mdi mdi-pin"></span></td>
                          <td class="item">Website<span class="icon s7-global"></span></td>
                          <td>www.website.com</td>
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
      </div>
		<?php echo $sidebar_right; ?>
    </div>
    <?= global_load_scripts(); ?>
    <script type="text/javascript">
		$(document).ready(function() {
			App.init();
		});
    </script>
  </body>
</html>