<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="<?php echo base_url('public/img'); ?>/logo-fav.png">
		<title><?= get_website_title($project['project_name']); ?></title>
		<?= global_load_styles(); ?>
		<link rel="stylesheet" type="text/css" href="<?= base_url('public/lib/summernote/summernote.css'); ?>"/>
	 <link rel="stylesheet" type="text/css" href="<?= base_url('public/vendor/jquery-file-upload/css/jquery.fileupload.css'); ?>"/>
	</head>
	<body>
    <div class="be-wrapper">
		<?php echo $header; ?>
		<?php echo $sidebar; ?>
		<div class="be-content">
			<div class="main-content container-fluid">
				<div class="row">
					<div class="col-sm-8">
					  <div class="panel panel-default panel-table">
						
						<div class="panel-heading">
							<?= $project['project_name']; ?>
							<div class="tools dropdown">
								<a href="#" id="add_project_task" data-toggle="modal" data-target="#add_task_modal" class="btn btn-primary">
									<span class="mdi mdi-plus-square"></span> 
									Task
								</a> 
							</div>
						</div>
						<div class="tab-container">
							<ul class="nav nav-tabs nav-tabs-primary">
								<li class="active"><a href="#tasks" data-toggle="tab"><i class="icon mdi mdi-assignment"></i> Tasks</a></li>
								<li><a href="#project_files" data-toggle="tab"><i class="icon mdi mdi-download"></i> Files</a></li>
								<li><a href="#project_notes" data-toggle="tab"><i class="icon mdi mdi-file-text"></i> Notes</a></li>
							</ul>
							<div class="tab-content">
								<div id="tasks" class="tab-pane active cont" style="margin: -20px;">
									<div class="panel-body">
										<table class="table table-striped">
											<thead>
												<th>&nbsp;</th>
												<th>Name</th>
												<th>Status</th>
												<th>Assigned</th>
											</thead>
											<tbody id="projects_tasks">
											<?php
											
											if(count($project_tasks) == 0)
											{
												echo '
												<tr>
													<td colspan="4" align="center">No records</td>
												</tr>';
											}
											else
											{
												foreach($project_tasks as $project_task)
												{
													echo '
													<tr id="view_project_task" data-task-id="project_task_' . $project_task['project_task_id'] . '" data-toggle="modal" data-target="#view_project_task_modal" class="clickable-table-row"  href="' . base_url('projects/view_project_task/' . $project_task['project_id'] . '/' . $project_task['project_task_id']) . '">
														<td width="1"><span class="mdi mdi-more-vert" style="cursor: move;"></span></td>
														<td>' . $project_task['project_task_name'] . '</td>
														<td class="milestone">
															<span class="completed">' . is_numeric_null($project_task['project_task_completion']) . '%</span>';
															
															if($project_task['project_task_status_name']==null) {
																echo '<span class="version">Not available</span>';
															} else {
																echo '<span class="version"><strong>' . $project_task['project_task_status_name'] . '</strong></span>';
															}
															
															echo '
															<div class="progress">
																<div style="width: ' . is_numeric_null($project_task['project_task_completion']) . '%" class="progress-bar progress-bar-primary"></div>
															</div>
													  </td>
														<td align="center" width="1"><img src="' . get_avatar($project_task['assignee_id']) . '" class="img-circle" style="height: 35px;" title="' . $project_task['account_fname'] . ' ' . $project_task['account_lname'] . '"></td>
													</tr>';
												}
											}

											?>
											</tbody>
										</table>
									</div>
								</div>
								<div id="project_files" class="tab-pane cont">
									<h3 title="Files">
										Files 
										<a href="#" data-toggle="modal" data-target="#add_project_file_modal" class="btn btn-success btn-xs">
											<span class="mdi mdi-plus"></span> 
											New file
										</a>
									</h3>
									<?php
										
										if(count($project_files) == 0)
										{
											echo '
											<div class="empty_page">
												<div class="empty_page_image"></div>
												<div class="empty_page_content">There aren\'t any files in this project at the moment.<br/>When someone uploads a file or attaches it to a task, note, discussion, or comment - it\'ll show up here.</div>
											</div>';
										}
										else										
										{
											echo '';
											echo '<div class="row">';
											foreach($project_files as $file)
											{
												echo '
												<div class="col-sm-3">
													<div class="file_container" style="border: 1px solid #DDD; width: 100%; height: 100%; background: #EEE; margin-bottom: 25px;">
													<div style="font-size: 48px;" align="center">';
														
														switch($file['project_file_type'])
														{
															case 'image/png':
																echo '<i class="mdi mdi-image"></i>';
															break;
															case 'image/jpg':
																echo '<i class="mdi mdi-image"></i>';
															break;
															case 'image/gif':
																echo '<i class="mdi mdi-image"></i>';
															break;
															case 'application/pdf':
																echo '<i class="mdi mdi-collection-pdf"></i>';
															break;
														}
														
													echo '
													</div>
													<div class="file_title" style="background: #DDD; padding: 10px; overflow: hidden; vertical-align: middle;">
													' . substr($file['project_file_name'], 0, 15) . '...
													<div class="pull-right"><a href="' . base_url('public/uploads/' . $project['project_id'] . '/' . $file['project_file_name']) . '" class="btn btn-default btn-xs"><i class="mdi mdi-download" style="font-size: 18px;"></i></a></div>
													<div class="clearfix"></div>
													</div>
													</div>
												</div>';
											}
											echo '</div>';
										}
										
									?>
								</div>
							<div id="project_notes" class="tab-pane">
								<h3 title="Notes">Notes <a href="#" data-toggle="modal" data-target="#add_project_note_modal" class="btn btn-success btn-xs"><span class="mdi mdi-plus"></span> New note</a></h3>
								
								<?php
								
									if($project['project_notes_count']===0 || $project['project_notes_count']===NULL || $project['project_notes_count']==='0')
									{
										echo '
										<div class="empty_page">
											<div class="empty_page_image"></div>
											<div class="empty_page_content">Nobody has written anything yet.<br>Use notes for collaborative writing and group your ideas into collections.</div>
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
					  <div class="panel panel-default">
						<div class="panel-heading">Team</div>
						<div class="panel-body">
							<?php
							
								if(count($project_followers) == 0)
								{
									echo 'No followers';
								}
								else
								{
									echo '<ul class="dd-list">';
									foreach($project_followers as $project_follower)
									{
										echo '
										<li class="dd-item"><img src="' . get_avatar($project_follower['account_id']) . '" style="height: 35px; margin-right: 15px" class="img-circle"/>' . $project_follower['account_fname'] . ' ' . $project_follower['account_lname'];
											
											if($project_follower['project_follower_email_notifications'] == 1)
											{
												echo '<i class="icon mdi mdi-alarm-check" style="font-size: 18px; margin-left: 15px;"></i>';
											}
											else
											{
												echo '<i class="icon mdi mdi-block" style="font-size: 18px;"></i>';
											}
											
											
											
											if($project_follower['project_follower_text_notifications'] == 1)
											{
												echo '<i class="icon mdi mdi-alarm-check" style="font-size: 18px; margin-left: 15px;"></i>';
											}
											else
											{
												echo '<i class="icon mdi mdi-block" style="font-size: 18px; margin-left: 15px;"></i>';
											}
											echo '</li>';
									}
									echo '</ul>';
								}
								
							?>
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
            <h3 class="modal-title">Add task to <strong><?= $project['project_name']; ?></strong></h3>
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
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<?php
						
							echo '<fieldset><legend>Clients</legend>';
							foreach($subscribers['clients'] as $subscriber)
							{
								echo '<div><input type="checkbox" name="project_task_subscribers[]" id="subscriber" value="' . $subscriber['account_id'] . '"';
								
								if($subscriber['account_id'] == $this->session->userdata('account_id'))
								{
									echo ' checked="checked"';
								}
								
								echo '/> 
								' . $subscriber['account_fname'] . ' ' . $subscriber['account_lname'] . '</div>';
							}
							echo '</fieldset>';
							
						?>
						
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<?php
						
							echo '<fieldset><legend>Admins</legend>';
							foreach($subscribers['admins'] as $subscriber)
							{
								echo '<div><input type="checkbox" name="project_task_subscribers[]" id="subscriber" value="' . $subscriber['account_id'] . '"';
								
								if($subscriber['account_id'] == $this->session->userdata('account_id'))
								{
									echo ' checked="checked"';
								}
								
								echo '/>
								' . $subscriber['account_fname'] . ' ' . $subscriber['account_lname'] . '</div>';
							}
							echo '</fieldset>';
							
						?>
					</div>
				</div>
				<div class="clearfix" style="clear: both;"></div>
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
	<!-- Add project modal start
	<div id="view_project_task_modal" tabindex="-1" role="dialog" class="modal fade right colored-header colored-header-primary" style="margin: 0; padding-left: 0px;">
      <div class="modal-dialog modal-lg" style="margin: 0; width: 100%; height: 100%; text-align: right;">
        <div class="modal-content" style="text-align: left; margin: 0; min-height: 100%; height: auto; max-width: 65%;width: 65%; display: inline-block;">
        </div>
      </div>
    </div>
	<!-- Add project modal end   -->
	
	<!-- Add project file modal start -->
	<div id="add_project_file_modal" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-success">
		<div class="modal-dialog custom-width">
			<div class="modal-content">
				<form id="add_project_file">
					<input type="hidden" name="project_id" id="project_id" value="<?= $project['project_id']; ?>"/>
					<div class="modal-header">
						<button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
						<h3 class="modal-title">Add file to <strong><?= $project['project_name']; ?></strong></h3>
					</div>
					<div class="modal-body" align="center">
					<div class="row">
											<div class="col-sm-12">
												<div id="dropzone" class="fade well">Drop files here</div>
											</div></div>
						<div id="loading" align="center" style="display: none;">
							<img src="http://bestanimations.com/Science/Gears/loadinggears/loading-gears-animation-13-3.gif">
						</div>
						<div id="add_project_note_console"></div>
						<span class="btn btn-success fileinput-button">
						<i class="glyphicon glyphicon-plus"></i>
						<span>Select files...</span>
						<!-- The file input field used as target for the file upload widget -->
						<input id="fileupload" type="file" name="files[]" multiple>
						</span>
						<br>
						<br>
						<!-- The global progress bar -->
						<div id="progress" class="progress">
						<div class="progress-bar progress-bar-success"></div>
						</div>
						<!-- The container for the uploaded files -->
						<div id="files" class="files"></div>
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
				<h3 class="modal-title">Add note to <strong><?= $project['project_name']; ?></strong></h3>
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
				<button type="button" id="add_project_note" class="btn btn-success">Save</button>
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
    <script src="<?= base_url('public/js/app-projects.js'); ?>" type="text/javascript"></script>
	
    <script src="<?= base_url('public/vendor/jquery-file-upload/js/vendor/jquery.ui.widget.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('public/vendor/jquery-file-upload/js/jquery.iframe-transport.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('public/vendor/jquery-file-upload/js/jquery.fileupload.js'); ?>" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
		
      	App.textEditors();
		App.projects('<?= base_url(); ?>');
	
		
		
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
		
		$('#view_project_task_modal').on('hidden.bs.modal', function () {
				window.location.reload();
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
      });
    </script>
		<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '<?= base_url('projects/add_project_file/' . $project['project_id']); ?>';
	
	function update_db(name, size, type)
	{
		$.ajax(
		{
			type: 'POST',
			url: '<?= base_url('projects/create_project_file/' . $project['project_id']); ?>',
			data: { file_name: name, file_size: size, file_type: type }
		});
	}
	
	var file_counter = 0;
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
				update_db(file.name, file.size, file.type);
				// $('div#files').prepend('<input type="text" name="file[' + file_counter + '][\'name\']" value="' + file.name + '"/>');
				// $('div#files').prepend('<input type="text" name="file[' + file_counter + '][\'size\']" value="' + file.size + '"/>');
				// $('div#files').prepend('<input type="text" name="file[' + file_counter + '][\'type\']" value="' + file.type + '"/>');
				// file_counter++;
                // $('<p/>').text(file.name).appendTo('#files');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).bind('fileuploadchunkdone', function(e,data) { console.log(e); console.log('---');console.log(data);}).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled').bind('fileuploadstart', function (e) { $('div#loading').show(); }).bind('fileuploadstop', function (e) { $('div#loading').hide(); });
});
</script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  </body>
</html>