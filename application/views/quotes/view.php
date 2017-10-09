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
	  <div class="page-head">
          <h2 class="page-head-title">Quotes list</h2>
          <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Quotes</a></li>
            <li class="active">List</li>
          </ol>
        </div>
       <div class="main-content container-fluid">
         
          <div class="row">
            <!--Responsive table-->
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">Quotes
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
                          <th style="width:20%;">Client</th>
                          <th style="width:17%;">Items</th>
                          <th style="width:15%;">Progress</th>
                          <th style="width:10%;">Status</th>
                          <th style="width:10%;">Date</th>
                          <th style="width:10%;"></th>
                        </tr>
                      </thead>
                      <tbody>
					  
                        <tr>
                          <td>
                            <div class="be-checkbox be-checkbox-sm">
                              <input id="check2" type="checkbox">
                              <label for="check2"></label>
                            </div>
                          </td>
                          <td class="user-avatar cell-detail user-info"><img src="<?php echo base_url('public/img'); ?>/avatar6.png" alt="Avatar"><span>Penelope Thornton</span><span class="cell-detail-description">GRITNET LIMITED</span></td>
                          <td class="cell-detail"> <span>250</span><span class="cell-detail-description">items</span></td>
                          <td class="milestone"><span class="completed">8 / 250</span><span class="version">Printing Business Cards</span>
                            <div class="progress">
                              <div style="width: 8%" class="progress-bar progress-bar-primary"></div>
                            </div>
                          </td>
                          <td class="cell-detail"><span><span class="mdi mdi-time-restore"></span></span><span class="cell-detail-description">In progress</span></td>
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
                        </tr>
                        <tr>
                          <td>
                            <div class="be-checkbox be-checkbox-sm">
                              <input id="check2" type="checkbox">
                              <label for="check2"></label>
                            </div>
                          </td>
                          <td class="user-avatar cell-detail user-info"><img src="<?php echo base_url('public/img'); ?>/avatar6.png" alt="Avatar"><span>Penelope Thornton</span><span class="cell-detail-description">GRITNET LIMITED</span></td>
                          <td class="cell-detail"> <span>250</span><span class="cell-detail-description">items</span></td>
                          <td class="milestone"><span class="completed">8 / 250</span><span class="version">Printing Business Cards</span>
                            <div class="progress">
                              <div style="width: 8%" class="progress-bar progress-bar-primary"></div>
                            </div>
                          </td>
                          <td class="cell-detail"><span><span class="mdi mdi-time-restore"></span></span><span class="cell-detail-description">In progress</span></td>
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
                        </tr>
                        <tr>
                          <td>
                            <div class="be-checkbox be-checkbox-sm">
                              <input id="check2" type="checkbox">
                              <label for="check2"></label>
                            </div>
                          </td>
                          <td class="user-avatar cell-detail user-info"><img src="<?php echo base_url('public/img'); ?>/avatar6.png" alt="Avatar"><span>Penelope Thornton</span><span class="cell-detail-description">GRITNET LIMITED</span></td>
                          <td class="cell-detail"> <span>250</span><span class="cell-detail-description">items</span></td>
                          <td class="milestone"><span class="completed">8 / 250</span><span class="version">Printing Business Cards</span>
                            <div class="progress">
                              <div style="width: 8%" class="progress-bar progress-bar-primary"></div>
                            </div>
                          </td>
                          <td class="cell-detail"><span><span class="mdi mdi-time-restore"></span></span><span class="cell-detail-description">In progress</span></td>
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
                        </tr>
                        <tr>
                          <td>
                            <div class="be-checkbox be-checkbox-sm">
                              <input id="check2" type="checkbox">
                              <label for="check2"></label>
                            </div>
                          </td>
                          <td class="user-avatar cell-detail user-info"><img src="<?php echo base_url('public/img'); ?>/avatar6.png" alt="Avatar"><span>Penelope Thornton</span><span class="cell-detail-description">GRITNET LIMITED</span></td>
                          <td class="cell-detail"> <span>250</span><span class="cell-detail-description">items</span></td>
                          <td class="milestone"><span class="completed">8 / 250</span><span class="version">Printing Business Cards</span>
                            <div class="progress">
                              <div style="width: 8%" class="progress-bar progress-bar-primary"></div>
                            </div>
                          </td>
                          <td class="cell-detail"><span><span class="mdi mdi-time-restore"></span></span><span class="cell-detail-description">In progress</span></td>
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
                        </tr>
                        <tr>
                          <td>
                            <div class="be-checkbox be-checkbox-sm">
                              <input id="check2" type="checkbox">
                              <label for="check2"></label>
                            </div>
                          </td>
                          <td class="user-avatar cell-detail user-info"><img src="<?php echo base_url('public/img'); ?>/avatar6.png" alt="Avatar"><span>Penelope Thornton</span><span class="cell-detail-description">GRITNET LIMITED</span></td>
                          <td class="cell-detail"> <span>250</span><span class="cell-detail-description">items</span></td>
                          <td class="milestone"><span class="completed">8 / 250</span><span class="version">Printing Business Cards</span>
                            <div class="progress">
                              <div style="width: 8%" class="progress-bar progress-bar-primary"></div>
                            </div>
                          </td>
                          <td class="cell-detail"><span><span class="mdi mdi-time-restore"></span></span><span class="cell-detail-description">In progress</span></td>
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
                        </tr>
                        <tr class="online">
                          <td>
                            <div class="be-checkbox be-checkbox-sm">
                              <input id="check3" type="checkbox">
                              <label for="check3"></label>
                            </div>
                          </td>
                          <td class="user-avatar cell-detail user-info"><img src="<?php echo base_url('public/img'); ?>/avatar4.png" alt="Avatar"><span>Benji Harper</span><span class="cell-detail-description">Designer</span></td>
                          <td class="cell-detail"> <span>Main structure markup</span><span class="cell-detail-description">CLI Connector</span></td>
                          <td class="milestone"><span class="completed">22 / 30</span><span class="version">v1.1.5</span>
                            <div class="progress">
                              <div style="width: 75%" class="progress-bar progress-bar-primary"></div>
                            </div>
                          </td>
                          <td class="cell-detail"><span>develop</span><span class="cell-detail-description">4cc1bc2</span></td>
                          <td class="cell-detail"><span>April 22, 2016</span><span class="cell-detail-description">14:45</span></td>
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
                        </tr>
                        <tr>
                          <td>
                            <div class="be-checkbox be-checkbox-sm">
                              <input id="check4" type="checkbox">
                              <label for="check4"></label>
                            </div>
                          </td>
                          <td class="user-avatar cell-detail user-info"><img src="<?php echo base_url('public/img'); ?>/avatar5.png" alt="Avatar"><span>Justine Myranda</span><span class="cell-detail-description">Designer</span></td>
                          <td class="cell-detail"> <span>Left sidebar adjusments</span><span class="cell-detail-description">Back-end Manager</span></td>
                          <td class="milestone"><span class="completed">10 / 30</span><span class="version">v1.1.3</span>
                            <div class="progress">
                              <div style="width: 33%" class="progress-bar progress-bar-primary"></div>
                            </div>
                          </td>
                          <td class="cell-detail"><span>develop</span><span class="cell-detail-description">5477993</span></td>
                          <td class="cell-detail"><span>April 15, 2016</span><span class="cell-detail-description">10:00</span></td>
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
                        </tr>
                        <tr>
                          <td>
                            <div class="be-checkbox be-checkbox-sm">
                              <input id="check5" type="checkbox">
                              <label for="check5"></label>
                            </div>
                          </td>
                          <td class="user-avatar cell-detail user-info"><img src="<?php echo base_url('public/img'); ?>/avatar3.png" alt="Avatar"><span>Sherwood Clifford</span><span class="cell-detail-description">Developer</span></td>
                          <td class="cell-detail"> <span>Topbar dropdown style</span><span class="cell-detail-description">Bootstrap Admin</span></td>
                          <td class="milestone"><span class="completed">25 / 40</span><span class="version">v1.0.4</span>
                            <div class="progress">
                              <div style="width: 55%" class="progress-bar progress-bar-primary"></div>
                            </div>
                          </td>
                          <td class="cell-detail"><span>master</span><span class="cell-detail-description">8cb98ec</span></td>
                          <td class="cell-detail"><span>April 8, 2016</span><span class="cell-detail-description">17:24</span></td>
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
                        </tr>
                        <tr class="online">
                          <td>
                            <div class="be-checkbox be-checkbox-sm">
                              <input id="check6" type="checkbox">
                              <label for="check6"></label>
                            </div>
                          </td>
                          <td class="user-avatar cell-detail user-info"><img src="<?php echo base_url('public/img'); ?>/avatar.png" alt="Avatar"><span>Kristopher Donny</span><span class="cell-detail-description">Designer</span></td>
                          <td class="cell-detail"> <span>Right sidebar adjusments</span><span class="cell-detail-description">CLI Connector</span></td>
                          <td class="milestone"><span class="completed">38 / 40</span><span class="version">v1.0.1</span>
                            <div class="progress">
                              <div style="width: 98%" class="progress-bar progress-bar-primary"></div>
                            </div>
                          </td>
                          <td class="cell-detail"><span>master</span><span class="cell-detail-description">65bc2da</span></td>
                          <td class="cell-detail"><span>Mars 18, 2016</span><span class="cell-detail-description">13:02</span></td>
                          <td class="text-right">
                            <div class="btn-group btn-hspace">
                              <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Open <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                              <ul role="menu" class="dropdown-menu pull-right">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated lin</a></li>
                              </ul>
                            </div>
                          </td>
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