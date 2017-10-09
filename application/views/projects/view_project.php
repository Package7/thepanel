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
	 <link rel="stylesheet" type="text/css" href="<?= base_url('public/lib/summernote/summernote.css'); ?>"/>
  </head>
  <body>
    <div class="be-wrapper">
      <?php echo $header; ?>
      <?php echo $sidebar; ?>
      <div class="be-content">

       <div class="main-content container-fluid">
	   <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-3">
                        <div class="widget widget-tile">
                          <div id="spark1" class="chart sparkline"><canvas width="85" height="35" style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas></div>
                          <div class="data-info">
                            <div class="desc">Milestones</div>
                            <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="113" class="number">0/0</span>
                            </div>
                          </div>
                        </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3">
                        <div class="widget widget-tile">
                          <div id="spark2" class="chart sparkline"><canvas width="81" height="35" style="display: inline-block; width: 81px; height: 35px; vertical-align: top;"></canvas></div>
                          <div class="data-info">
                            <div class="desc">Projects</div>
                            <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span data-toggle="counter" data-end="80" data-suffix="%" class="number">80%</span>
                            </div>
                          </div>
                        </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3">
                        <div class="widget widget-tile">
                          <div id="spark3" class="chart sparkline"><canvas width="85" height="35" style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas></div>
                          <div class="data-info">
                            <div class="desc">Performance index</div>
                            <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span data-toggle="counter" data-end="532" class="number">532</span>
                            </div>
                          </div>
                        </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3">
                        <div class="widget widget-tile">
                          <div id="spark4" class="chart sparkline"><canvas width="85" height="35" style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas></div>
                          <div class="data-info">
                            <div class="desc">Time management</div>
                            <div class="value"><span class="indicator indicator-negative mdi mdi-chevron-down"></span><span data-toggle="counter" data-end="113" class="number">113</span>
                            </div>
                          </div>
                        </div>
            </div>
          </div>
          <div class="row">
            <!--Responsive table-->
            <div class="col-sm-8">
              <div class="panel panel-default panel-table">
			  <div class="panel-heading">
				<?= $project['project_name']; ?>
                  <div class="tools dropdown">
					<a href="#" id="add_project_task"  data-toggle="modal" data-target="#add_task_modal" class="btn btn-success"><span class="mdi mdi-plus-square"></span> Add task</a>  
                    <!--<a href="#" id="add_project_milestone" class="btn btn-default"><span class="mdi mdi-plus-square"></span> Add milestone</a>-->
					
                  </div>
                </div>
				  <div class="tab-container">
                  <ul class="nav nav-tabs nav-tabs-success">
                    <li class="active"><a href="#tasks" data-toggle="tab">Tasks</a></li>
                    <li><a href="#project_files" data-toggle="tab">Files</a></li>
                    <li><a href="#project_notes" data-toggle="tab">Notes</a></li>
                    <li><a href="#activity" data-toggle="tab">Activity</a></li>
                  </ul>
                  <div class="tab-content">
                    <div id="tasks" class="tab-pane active cont">
					
				  
                
				
                <div class="panel-body">
					<table class="table table-striped">
						<thead>
							<th>&nbsp;</th>
							<th>Name</th>
							<th>Asignee</th>
						</thead>
						<tbody id="sortable">
						<?php

						foreach($project_tasks as $project_task)
						{
						echo '
						<tr id="view_project_task" data-toggle="modal" data-target="#view_project_task_modal"  href="' . base_url('projects/view_project_task/' . $project_task['project_id'] . '/' . $project_task['project_task_id']) . '">
							<td width="1"><span class="mdi mdi-more-vert" style="cursor: move;"></span></td>
							<td>
								<div class="be-checkbox">
									<input id="check1" value="' . $project_task['project_task_id'] . '" type="checkbox">
									<label for="check1">' . $project_task['project_task_name'] . '</label>
								</div>
							</td>
							<td align="center" width="1"><img src="' . get_avatar($project_task['asignee_id']) . '" class="img-circle" style="height: 35px;" title="' . $project_task['account_fname'] . ' ' . $project_task['account_lname'] . '"></td>
						</tr>';
						}

						?>
						</tbody>
					</table>
                </div>
                    </div>
                    <div id="project_files" class="tab-pane cont">
						<h3 title="Files">Files <a href="#" data-toggle="modal" data-target="#add_project_file_modal" class="btn btn-success btn-xs"><span class="mdi mdi-plus"></span> New file</a></h3>
						<?php
						
							if($project['project_files_count']===0 || $project['project_files_count']===NULL)
							{
								echo '
								<div class="empty_page">
									<div class="empty_page_image"></div>
									<div class="empty_page_content">There aren\'t any files in this project at the moment.<br/>When someone uploads a file or attaches it to a task, note, discussion, or comment - it\'ll show up here.</div>
									<div class="empty_page_link"><a href="https://help.activecollab.com/books/projects/notes.html" target="_blank" class="print_hide">Learn more about working with notes.</a></div>
								</div>';
							}
							else
							{
								echo '<hr/>';
								echo 'here are your files';
							}
							
						?>
					</div>
                    <div id="project_notes" class="tab-pane">
						<h3 title="Notes">Notes <a href="#" data-toggle="modal" data-target="#add_project_note_modal" class="btn btn-success btn-xs"><span class="mdi mdi-plus"></span> New note</a></h3>
						
						<?php
						
							if($project['project_notes_count']===0 || $project['project_notes_count']===NULL)
							{
								echo '
								<div class="empty_page">
									<div class="empty_page_image"></div>
									<div class="empty_page_content">Nobody has written anything yet.<br>Use notes for collaborative writing and group your ideas into collections.</div>
									<div class="empty_page_link"><a href="https://help.activecollab.com/books/projects/notes.html" target="_blank" class="print_hide">Learn more about working with notes.</a></div>
								</div>';
							}
							else
							{
								$project_notes_count = 0;
								echo '<hr/><div class="row">';
								foreach($project_notes as $note)
								{
									$project_notes_count++;
									
									echo '
									<div class="col-md-6">
										<div class="panel panel-contrast">
											<div class="panel-heading panel-heading-contrast">
												' . $note['project_note_title'] . '
												<span class="panel-subtitle">Written by ' . $note['account_fname'] . ' ' . $note['account_lname'] . '</span>
											</div>
											<div class="panel-body" style="background: #ffface; padding: 10px;">' . $note['project_note_content'] . '</div>
											<div class="panel-footer">
												' . strip_tags($note['project_note_created']) . '
											</div>
										</div>
									</div>';
									
									if($project_notes_count==$project['project_notes_count'])
									{
										echo '<div class="clearfix"></div>';
									}
								}
								echo '</div>';
							}
							
						?>
                    </div>
                    <div id="activity" class="tab-pane">
						<h3 title="Activity">Activity</h3>
                      <p>Consectetur adipisicing elit. Ipsam ut praesentium, voluptate quidem necessitatibus quam nam officia soluta aperiam, recusandae.</p>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos facilis laboriosam, vitae ipsum tenetur atque vel repellendus culpa reiciendis velit quas, unde soluta quidem voluptas ipsam, rerum fuga placeat rem error voluptate eligendi modi. Delectus, iure sit impedit? Facere provident expedita itaque, magni, quas assumenda numquam eum! Sequi deserunt, rerum.</p><a href="#">Read more  </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--Responsive table-->
            <div class="col-sm-4">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">Team</div>
                <div class="panel-body">
                  <!--<div class="table-responsive noSwipe"> / enable responsivness -->
                  <div>
                    
                  </div>
                </div>
              </div>
              <div class="panel panel-default panel-table">
                <div class="panel-heading">Notifications</div>
                <div class="panel-body">
					<form action="#" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Email</label>
                      <div class="col-sm-6 xs-pt-5">
                        <div class="switch-button switch-button-success">
                          <input type="checkbox" checked="" name="swt5" id="swt5"><span>
                            <label for="swt5"></label></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">SMS</label>
                      <div class="col-sm-6 xs-pt-5">
                        <div class="switch-button switch-button-success">
                          <input type="checkbox" checked="" name="swt5" id="swt5"><span>
                            <label for="swt5"></label></span>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
				<div class="panel-footer">
					<button class="btn btn-primary">Save settings</button>
				</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php echo $sidebar_right; ?>
    </div>
	<!-- Add project modal start -->
	<div id="add_task_modal" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
      <div class="modal-dialog custom-width">
        <div class="modal-content">
			<form id="add_project_task">
				<input type="hidden" name="project_id" id="project_id" value="<?= $project['project_id']; ?>"/>
          <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
            <h3 class="modal-title">Add task to <?= $project['project_name']; ?></h3>
          </div>
          <div class="modal-body">
			<div id="add_project_task_console"></div>
			<div class="form-group">
				<label>Name <span class="mandatory">*</span></label>
				<input type="text" name="project_task_name" id="project_task_name" class="form-control"/>
			</div>
            <div class="form-group">
              <label>Description <span class="mandatory">*</span></label>
              <textarea name="project_task_description" id="project_task_description" rows="5" class="form-control" placeholder="Task description"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
            <button type="button" id="add_project_task" class="btn btn-primary"><span class="mdi mdi-plus-square"></span> Add task</button>
          </div>
		  </form>
        </div>
      </div>
    </div>
	<!-- Add project modal end   -->
	<!-- Add project modal start -->
	<div id="view_project_task_modal" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
			<!-- loading -->
        </div>
      </div>
    </div>
	<!-- Add project modal end   -->
	
	<!-- Add project file modal start -->
	<div id="add_project_file_modal" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-success">
		<div class="modal-dialog custom-width">
			<div class="modal-content">
				<div id="add_project_note_console"></div>
				<form id="add_project_note">
				<input type="hidden" name="project_id" id="project_id" value="<?= $project['project_id']; ?>"/>
				<div class="modal-header">
				<button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
				<h3 class="modal-title">Add file to <?= $project['project_name']; ?></h3>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Title <span class="mandatory">*</span></label>
						<input type="text" name="project_note_title" id="project_note_title" class="form-control"/>
					</div>
					<div id="project_note_content"></div>
				</div>
				<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
				<button type="button" id="add_project_note" class="btn btn-success"><span class="mdi mdi-plus-square"></span> Add note</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Add project file modal end   -->
	
	<!-- Add project note modal start -->
	<div id="add_project_note_modal" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-success">
		<div class="modal-dialog custom-width">
			<div class="modal-content">
				<div id="add_project_note_console"></div>
				<form id="add_project_note">
				<input type="hidden" name="project_id" id="project_id" value="<?= $project['project_id']; ?>"/>
				<div class="modal-header">
				<button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
				<h3 class="modal-title">Add note to <?= $project['project_name']; ?></h3>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Title <span class="mandatory">*</span></label>
						<input type="text" name="project_note_title" id="project_note_title" class="form-control"/>
					</div>
					<div id="project_note_content"></div>
				</div>
				<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
				<button type="button" id="add_project_note" class="btn btn-success"><span class="mdi mdi-plus-square"></span> Add note</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Add project note modal end   -->
    <?= global_load_scripts(); ?>
	
    <script src="<?= base_url('public/lib/summernote/summernote.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('public/lib/summernote/summernote-ext-beagle.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('public/js/app-form-wysiwyg.js'); ?>" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
		
      	App.textEditors();
		
		$( "#sortable" ).sortable({
      placeholder: "ui-state-highlight"
    });
	
		$('tr#view_project_task').click(function(event)
		{
			event.preventDefault();
			var url = $(this).attr('href');
			$('div#view_project_task_modal .modal-content').load(url);
		});
		
		$('button#add_project_note').click(function(event)
		{
			event.preventDefault();
			var form_data = $('form#add_project_note').serializeArray();
			form_data.push({name: 'project_note_content', value: $('div#project_note_content').summernote('code')});
			
			$.ajax(
			{
				type: 'POST',
				url: '<?= base_url('projects/add_project_note'); ?>',
				data: form_data,
				success: function(data, status, xhr)
				{
					try 
					{
						var response = $.parseJSON(JSON.stringify(data));
						console.log(response);
						
						if(response.status==200)
						{
						  window.location.replace(response['url']);
						  console.log(response['url']);
						}
						else
						{
							$('div#add_project_note_console').html(data);
						}
					} catch(e) 
					{
					}
				}
			});
		});
		
		$('button#add_project_task').click(function(event)
		{
			event.preventDefault();
			$.ajax(
			{
				type: 'POST',
				url: '<?= base_url('projects/add_project_task'); ?>',
				data: $('form#add_project_task').serialize(),
				success: function(data, status, xhr)
				{
					try {
					var response = $.parseJSON(JSON.stringify(data));
						console.log(response);
					  if(response.status==200)
					  {
						  window.location.replace(response['url']);
						  console.log(response['url']);
					  }
					  else
					  {
						$('div#add_project_task_console').html(data);
					  }
					} catch(e) {
					}
					
				}
			});
		});
		
		
		
		
		// $('a#add_project_milestone').on('click', function(event)
		// {
			// $('ul#projects_milestones').append('<li class="dd-item"><form id="add_project_milestone"><input type="text" placeholder="Milestone" name="project_milestone_name" id="project_milestone_name" class="form-control"/><input type="submit" id="submit-btn" value="Add milestone" class="btn btn-success"/></form></li>');
		// });
		
		// $(document).on('submit', 'form#add_project_milestone', function(event)
		// {
			// event.preventDefault();
			// $.ajax(
			// {
				// type: 'POST',
				// url: '<?= base_url('projects/add_project_milestone'); ?>',
				// data: $('form#add_project_milestone').serialize(),
				// dataType: 'html',
				// success: function(data)
				// {
					// alert(data);
				// }
			// });
		// });
      });
    </script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  </body>
</html>