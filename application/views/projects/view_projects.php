<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url('public/img'); ?>/logo-fav.png">
    <title><?= get_website_title('Projects'); ?></title>
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
                <div class="panel-heading">Projects
                  <div class="tools">
				  <?php
				  
					if($this->session->userdata('account_isadmin')==1)
					{
						echo '<a href="#" data-toggle="modal" data-target="#form-bp1" class="btn btn-success"><span class="mdi mdi-plus-square"></span> Add project</a> ';
					}
					
				?>
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
                          <th style="width:20%;">Name</th>
                          <th style="width:17%;">Milestones</th>
                          <th style="width:15%;">Tasks</th>
                          <th style="width:1%;">Cloud</th>
                          <th style="width:10%;">Created</th>
                          <th style="width:10%;">Last modified</th>
                        </tr>
                      </thead>
                      <tbody>
					  
						<?php
						
							if($projects!=false)
							{
								foreach($projects as $project)
								{
									echo '
									<tr style="cursor: pointer; cursor: hand;"id="project_link" data-href="' . base_url('projects/view/' . $project['project_id']) . '">
										<td>
											<div class="be-checkbox be-checkbox-sm">
												<input id="check2" type="checkbox">
												<label for="check2"></label>
											</div>
										</td>
										<td>' . $project['project_name'] . '</td>
										<td></td>
										<td>' . $project['project_tasks_count'] . '</td>
										<td align="center"></td>
										<td>0/0</td>
										<td>0/0</td>
									</tr>';
								}
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
				<div class="panel-footer">
					<p>With selected</p>
				</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php echo $sidebar_right; ?>
    </div>
	<!-- Add project modal start -->
	<div id="form-bp1" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-success">
      <div class="modal-dialog custom-width">
        <div class="modal-content">
			<form id="add_project">
          <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
            <h3 class="modal-title">Add project</h3>
          </div>
          <div class="modal-body">
			<div id="add_project_console"></div>
			<div class="form-group">
				<label>Client <span class="mandatory">*</span></label>
				<select name="client_id" id="client_id" class="form-control">
					<option value="0">-- Select client --</option>
					<?php
					
						foreach($clients as $client)
						{
							echo '<option value="' . $client['client_id'] . '">' . $client['client_company'] . '</option>';
						}
						
					?>
				</select>
			</div>
            <div class="form-group">
              <label>Name <span class="mandatory">*</span></label>
              <input name="project_name" id="project_name" type="text" placeholder="(eg. Package7 App)" class="form-control">
            </div>
            <div class="form-group">
              <label>Description <span class="mandatory">*</span></label>
              <textarea name="project_description" id="project_description" rows="5" class="form-control" placeholder="(eg. Description of the Package7 App project)"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
            <button type="button" id="add_project" class="btn btn-success"><span class="mdi mdi-plus-square"></span> Add project</button>
          </div>
		  </form>
        </div>
      </div>
    </div>
	<!-- Add project modal end   -->
	<!-- Delete project modal start -->
	<div id="delete_project_modal" class="modal-container modal-full-color modal-full-color-danger modal-effect-8">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" data-dismiss="modal" aria-hidden="true" class="close modal-close"><span class="mdi mdi-close"></span></button>
	  </div>
	  <div class="modal-body">
		<div class="text-center"><span class="modal-main-icon mdi mdi-close-circle-o"></span>
		  <h3>Danger!</h3>
		  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
		  <div class="xs-mt-50">
			<button type="button" data-dismiss="modal" class="btn btn-default btn-space modal-close">Cancel</button>
			<button type="button" data-dismiss="modal" class="btn btn-success btn-space modal-close">Proceed</button>
		  </div>
		</div>
	  </div>
	  <div class="modal-footer"></div>
	</div>
  </div>
	<!-- Delete project modal end   -->
    <?= global_load_scripts(); ?>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
		
		$('tr#project_link').click(function(event)
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
		
		$('button#add_project').click(function(event)
		{
			event.preventDefault();
			$.ajax(
			{
				type: 'POST',
				url: '<?= base_url('projects/add_project'); ?>',
				data: $('form#add_project').serialize(),
				dataType: 'html',
				success: function(data)
				{
					var response=jQuery.parseJSON(data);
					
					if(typeof response =='object')
					{
					  if(response.status==200)
					  {
						  window.location.replace(response.url);
					  }
					  else
					  {
						  alert('Error: ' + data);
					  }
					}
					else
					{
						$('div#add_project_console').html(data);
					}
					
				}
			});
		});
      });
      
    </script>
  </body>
</html>