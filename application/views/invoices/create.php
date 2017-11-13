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
				<div class="row wizard-row">
            <div class="col-md-12 fuelux">
              <div class="block-wizard panel panel-default">
                <div id="wizard1" class="wizard wizard-ux no-steps-container">
                  <ul class="steps" style="margin-left: 0">
                    <li data-step="1" class="complete">Step 1<span class="chevron"></span></li>
                    <li data-step="2" class="active">Step 2<span class="chevron"></span></li>
                    <li data-step="3">Step 3<span class="chevron"></span></li>
                  </ul>
                  <div class="actions">
                    <button type="button" class="btn btn-xs btn-prev btn-default"><i class="icon mdi mdi-chevron-left"></i>Prev</button>
                    <button type="button" data-last="Finish" class="btn btn-xs btn-next btn-default">Next<i class="icon mdi mdi-chevron-right"></i></button>
                  </div>
                  <div class="step-content">
                    <div data-step="1" class="step-pane">
                      <form action="#" data-parsley-namespace="data-parsley-" data-parsley-validate="" novalidate="" class="form-horizontal group-border-dashed">
                        <div class="form-group no-padding">
                          <div class="col-sm-7">
                            <h3 class="wizard-title">User Info</h3>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">User Name</label>
                          <div class="col-sm-6">
                            <input type="text" placeholder="User name" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">E-Mail</label>
                          <div class="col-sm-6">
                            <input type="text" placeholder="User E-Mail" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Password</label>
                          <div class="col-sm-6">
                            <input type="password" placeholder="Enter your password" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Verify Password</label>
                          <div class="col-sm-6">
                            <input type="password" placeholder="Enter your password again" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button class="btn btn-default btn-space">Cancel</button>
                            <button data-wizard="#wizard1" class="btn btn-primary btn-space wizard-next">Next Step</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div data-step="2" class="step-pane active">
                      <form action="#" data-parsley-namespace="data-parsley-" data-parsley-validate="" novalidate="" class="form-horizontal group-border-dashed">
                        <div class="form-group no-padding">
                          <div class="col-sm-7">
                            <h3 class="wizard-title">Notifications</h3>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-7">
                            <label class="control-label">E-Mail Notifications</label>
                            <p>This option allow you to recieve email notifications by us.</p>
                          </div>
                          <div class="col-sm-3 xs-pt-15">
                            <div class="switch-button">
                              <input type="checkbox" checked="" name="swt1" id="swt1"><span>
                                <label for="swt1"></label></span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-7">
                            <label class="control-label">Phone Notifications</label>
                            <p>Allow us to send phone notifications to your cell phone.</p>
                          </div>
                          <div class="col-sm-3 xs-pt-15">
                            <div class="switch-button">
                              <input type="checkbox" checked="" name="swt2" id="swt2"><span>
                                <label for="swt2"></label></span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-7">
                            <label class="control-label">Global Notifications</label>
                            <p>Allow us to send notifications to your dashboard.</p>
                          </div>
                          <div class="col-sm-3 xs-pt-15">
                            <div class="switch-button">
                              <input type="checkbox" checked="" name="swt3" id="swt3"><span>
                                <label for="swt3"></label></span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-12">
                            <button data-wizard="#wizard1" class="btn btn-default btn-space wizard-previous">Previous</button>
                            <button data-wizard="#wizard1" class="btn btn-primary btn-space wizard-next">Next Step</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div data-step="3" class="step-pane">
                      <form action="#" data-parsley-namespace="data-parsley-" data-parsley-validate="" novalidate="" class="form-horizontal group-border-dashed">
                        <div class="form-group no-padding">
                          <div class="col-sm-7">
                            <h3 class="wizard-title">Configuration</h3>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-6">
                            <label class="control-label">Buy Credits: <span id="credits">$30</span></label>
                            <p>This option allow you to buy an amount of credits.</p>
                            <div class="slider slider-horizontal" id=""><div class="slider-track"><div class="slider-track-low" style="left: 0px; width: 0%;"></div><div class="slider-selection" style="left: 0%; width: 50%;"></div><div class="slider-track-high" style="right: 0px; width: 50%;"></div><div class="slider-handle min-slider-handle round" tabindex="0" style="left: 50%;"></div><div class="slider-handle max-slider-handle round hide" tabindex="0" style="left: 0%;"></div></div><div class="tooltip tooltip-main top" style="left: 50%; margin-left: 0px;"><div class="tooltip-arrow"></div><div class="tooltip-inner">5</div></div><div class="tooltip tooltip-min top"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div><div class="tooltip tooltip-max top"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div></div><input id="credit_slider" type="text" value="5" class="bslider form-control" data="value: '5'" style="display: none;">
                          </div>
                          <div class="col-sm-6">
                            <label class="control-label">Change Plan</label>
                            <p>Change your plan many times as you want.</p>
                            <select class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                              <optgroup label="Personal">
                                <option value="p1">Basic</option>
                                <option value="p2">Medium</option>
                              </optgroup>
                              <optgroup label="Company">
                                <option value="p3">Standard</option>
                                <option value="p4">Silver</option>
                                <option value="p5">Gold</option>
                              </optgroup>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-nfii-container"><span class="select2-selection__rendered" id="select2-nfii-container" title="Basic">Basic</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-6">
                            <label class="control-label">Payment Rate: <span id="rate">5%</span></label>
                            <p>Choose your payment rate to calculate how much money you will recieve.</p>
                            <div class="slider slider-horizontal" id=""><div class="slider-track"><div class="slider-track-low" style="left: 0px; width: 0%;"></div><div class="slider-selection" style="left: 0%; width: 5%;"></div><div class="slider-track-high" style="right: 0px; width: 95%;"></div><div class="slider-handle min-slider-handle round" tabindex="0" style="left: 5%;"></div><div class="slider-handle max-slider-handle round hide" tabindex="0" style="left: 0%;"></div></div><div class="tooltip tooltip-main top" style="left: 5%; margin-left: 0px;"><div class="tooltip-arrow"></div><div class="tooltip-inner">5</div></div><div class="tooltip tooltip-min top"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div><div class="tooltip tooltip-max top"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div></div><input id="rate_slider" data-slider-min="0" data-slider-max="100" type="text" value="5" class="bslider form-control" data="value: '5'" style="display: none;">
                          </div>
                          <div class="col-sm-6">
                            <label class="control-label">Keywords</label>
                            <p>Write your keywords to do a successful SEO with web search engines.</p>
                            <select multiple="" class="tags select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                              <option value="1">Twitter</option>
                              <option value="2">Google</option>
                              <option value="3">Facebook</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-12">
                            <button data-wizard="#wizard1" class="btn btn-default btn-space wizard-previous">Previous</button>
                            <button data-wizard="#wizard1" class="btn btn-success btn-space wizard-next">Complete</button>
                          </div>
                        </div>
                      </form>
                    </div>
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
			$(document).ready(function(){
			//initialize the javascript
			App.init();
			});
		</script>
	</body>
</html>