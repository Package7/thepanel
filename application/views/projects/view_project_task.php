<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="<?php echo base_url('public/img'); ?>/logo-fav.png">
		<title><?= get_website_title($task['project_task_name']); ?></title>
		<?= global_load_styles(); ?>
		<link rel="stylesheet" type="text/css" href="<?= base_url('public/lib/summernote/summernote.css'); ?>"/>
		<link rel="stylesheet" type="text/css" href="<?= base_url('public/vendor/jquery-file-upload/css/jquery.fileupload.css'); ?>"/>
	</head>
	<body>
	<div class="be-wrapper">
		<?php echo $header; ?>
		<?php echo $sidebar; ?>
		<div class="be-content">
			<div class="page-head">
				<h2 class="page-head-title"><?= $task['project_task_name']; ?></h2>
				<?php echo breadcrumbs(); ?>
			</div>
			<div class="main-content container-fluid">
				<div class="row">
					<div class="col-sm-8">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<?= $task['project_task_name']; ?>
							<?php if($this->Permissions_Model->is_admin()): ?>
							<div class="tools">
								<div class="btn-group btn-space">
									<button id="edit_task" type="button" class="btn btn-default"><i class="icon mdi mdi-edit"></i></button>
									<button id="delete_task" data-task-id="<?= $task['project_task_id']; ?>" data-project-id="<?= $task['project_id']; ?>" type="button" class="btn btn-default"><i class="icon mdi mdi-delete"></i></button>
								</div>
							</div>
							<?php endif; ?>
						</div>
					<div class="panel-body">
					<div class="row">
					<div class="col-sm-12">
					<p id="project_task_description"><?= $task['project_task_description']; ?></p>
					<div class="project-task-info">
						<ul class="list-inline">
							<li><i class="mdi mdi-account"></i> {project_task_assignee}</li>
							<li><i class="mdi mdi-time"></i> {project_task_due_date}</li>
						</ul>
					</div>
					<?php if($this->Permissions_Model->is_admin()): ?>
					<form id="project_task_description" style="display: none;">
						<div id="project_task_description" style="display: none;"><?= $task['project_task_description']; ?></div>
						<br/>
						<p align="right">
							<button id="project_task_description_cancel" class="btn btn-default">Cancel</button>
							<button id="project_task_description_update" class="btn btn-primary">Update</button>
						</p>
					</form>
					<?php endif; ?>
					</div>
					</div>
					<h4 title="Comments"><strong>Comments</strong></h4>
					<hr/>
					<div class="add_project_task_comment_console"></div>
					<form id="add_project_task_comment">
					<div class="col-sm-2" align="center">
					<img src="<?= get_avatar($this->session->userdata('account_id')); ?>" style="height: 35px;" class="img-circle" alt="Avatar">
					</div>
					<div class="col-sm-10">
					<input type="text" id="add_comment_form" class="form-control input-xs" placeholder="Write comment"/>
					<div id="comment-form" style="display: none;">
						<div id="project_task_comment_content"></div>
						<p style="margin-top: 5px;">
						<button id="project_task_add_comment" class="btn btn-primary">
						<span class="icon mdi mdi-comment"></span> 
						Comment
						</button>
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
						</p>
					</div>
					</div>
					<div class="clearfix"></div>
					</form>
					<div class="clearfix" style="clear:both;"></div>
					<hr/>
					<br/>
					
					<!-- Comments start -->
					<ul id="projects_tasks_comments" class="projects_tasks_comments" style="list-style-type: none; margin: 0; padding: 0;">
						<?php

							if($comments!=false)
							{
							foreach($comments as $comment)
							{
							echo '
							<li style="margin-bottom: 25px;">
							<div class="comment">
							<div class="row">
							<div class="col-sm-2" align="center">
							<img src="' . get_avatar($comment['account_id']) . '" style="height: 35px;" class="img-circle" alt="Avatar">
							<br/>
								<div style="font-weight: bold;">' . $comment['account_fname'] . ' ' . $comment['account_lname'] . '</div>
							</div>
							<div class="col-sm-10">
							<div style="border-radius: 5px; background: #eeeeee; padding: 15px;">' . $comment['project_task_comment_content'] . '</div>';
							if(count($comment['files']!=0))
							{
								$i = 0;
								
								foreach($comment['files'] as $file)
								{
									echo '
									<div class="file-attachement">
									<div class="row">
									<div class="col-sm-2" align="center"><i class="fa ' . $file['project_file_type_icon'] . '" fa-2x></i></div>
									<div class="col-sm-6">' . substr($file['project_file_name'], 0,10) . '...' . '</div>
									<div class="col-sm-2">' . $file['project_file_size'] . ' MB</div>
									<div class="col-sm-2"><a href="' . base_url('download.php?url=' . base_url('public/uploads/' . $task['project_id'] . '/' . $file['project_file_name'])) . '" class="btn btn-xs btn-primary"><i class="mdi mdi-download"></i> Download</a></div>
									</div>
									</div>';
									if(count($comment['files'])==$i)
									{
									echo '<div class="clearfix" style="clear: both;"></div>';
									}
								}
							}
							echo '
							</div>
							</div>
							<div class="clearfix"></div>
							</div>
							<div class="comment-info" align="right"><small>' . $comment['project_task_comment_created'] . '</small></div>
							</li>
							';
							}
							}
							else
							{
							echo '<div id="no-comments">No comments at the moment</div>';
							}

						?>
					</ul>
					<!-- Comments end   -->
					</div>
					</div>
					</div>
					<div class="col-sm-4">
						<?php if($this->Permissions_Model->is_admin()): ?>
						<div class="panel panel-border-color panel-border-color-primary">
							<div class="panel-heading">Actions</div>
							<div class="panel-body">
								<form id="update_project_task">
									<div id="update_project_task_console"></div>
											<strong>Assigned</strong>
											<div>
												<select name="assignee_id" id="assignee_id" class="form-control input-xs">
													<option value="NULL">-- Not assigned --</option>
													<?= get_default_value($assignees, $task['assignee_id'], 'account_id', 'account_fname'); ?>
												</select>
											</div>
											<strong>Due date</strong>
											<div>
											<div data-min-view="2" data-date-format="yyyy-mm-dd" class="input-group date datetimepicker">
                          <input size="16" type="text" value="" class="form-control"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
                        </div>
											</div>
										<strong>Status</strong>
											<div>
												<select name="project_task_status_id" class="form-control input-xs">
													<option value="NULL">-- Not updated --</option>
													<?= get_default_value($statuses, $task['project_task_status_id'], 'project_task_status_id', 'project_task_status_name'); ?>
												</select>
											</div>
											<strong>Completed</strong>
											<div>
												<input name="project_task_completion" type="number" id="project_task_completion" class="form-control input-xs" maxlength="3" min="0" max="100" value="<?= $task['project_task_completion']; ?>"/>
											</div>
									<p>
										<button id="update_project_task" class="btn btn-primary">Update</button>
									</p>
								</form>
							</div>
						</div>
						<?php endif; ?>
						<div class="panel panel-flat">
							<div class="panel-heading">
								Subscribers
								<!-- <div class="tools">
									<a href="#" data-toggle="modal" data-target="#add_subscriber_modal" class="btn btn-default btn-xs"><i class="mdi mdi-plus-circle"></i> Choose</a>
								</div> -->
							</div>
							<div class="panel-body">
								<?php if(isset($subscribers)): ?>
								<?php foreach($subscribers as $subscriber): ?>
								<table class="table-borderless">
									<tr>
										<td width="1"><img src="<?= get_avatar($subscriber['account_id']); ?>" class="img-circle" style="height: 45px; padding: 5px;"/></td>
										<td>
											<?= $subscriber['account_fname'] . ' ' . $subscriber['account_lname']; ?>
										</td>
									</tr>
								</table>
								<?php endforeach; ?>
								<?php else: ?>
									<div class="alert alert-warning">No available subscribers</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
    <?= global_load_scripts(); ?>
	
    <script src="<?= base_url('public/lib/summernote/summernote.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('public/lib/summernote/summernote-ext-beagle.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('public/lib/bootstrap-markdown/js/bootstrap-markdown.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('public/lib/markdown-js/markdown.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('public/js/app-form-wysiwyg.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('public/js/app-projects.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('public/lib/datetimepicker/js/bootstrap-datetimepicker.min.js'); ?>" type="text/javascript"></script>
	
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	
    <script src="<?= base_url('public/vendor/jquery-file-upload/js/vendor/jquery.ui.widget.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('public/vendor/jquery-file-upload/js/jquery.iframe-transport.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('public/vendor/jquery-file-upload/js/jquery.fileupload.js'); ?>" type="text/javascript"></script>
	<script type="text/javascript">
	$(document).ready(function()
	{
	//initialize the javascript
	App.init();
	App.projects('<?= base_url(); ?>');

	$('button#update_project_task').click(function(event)
	{
	event.preventDefault();
	$.ajax(
	{
	type: 'POST',
	url: '<?= base_url('projects/update_project_task/' . $task['project_task_id']); ?>',
	data: $('form#update_project_task').serialize(),
	dataType: 'json',
	success: function(data)
	{
	try 
	{
	var response = $.parseJSON(JSON.stringify(data));
	console.log(response);

	if(response.status==200)
	{

	$('div#update_project_task_console').html('<div role="alert" class="alert alert-success alert-dismissible"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-check"></span><strong>Updated!</strong></div>');
	}
	else
	{
	$('div#update_project_task_console').html(data);
	}
	} catch(e) 
	{
	}
	}
	});
	});

	function comment_submit() 
	{
		$('form#add_project_task_comment').unbind().submit(function(event) 
		{
		event.preventDefault();
			
		var form_data = $(this).serializeArray();
		form_data.push({name: 'project_task_comment_content', value: $('div#project_task_comment_content').summernote('code')});
		
			var comment_content = $('div#project_task_comment_content').summernote('code');
			
			var comment = '<li style="margin-bottom: 25px;"><div class="comment"><div class="row"><div class="col-sm-2" align="center"><img src="<?= get_avatar($this->session->userdata('account_id')); ?>" style="height: 35px;" class="img-circle" alt="Avatar"></div><div class="col-sm-10"><div style="border-radius: 5px; background: #eeeeee; padding: 15px;">' + comment_content + '</div></div></div><div class="clearfix"></div></div><div class="comment-info" align="right"><small><?= $this->session->userdata('account_fname') . ' ' . $this->session->userdata('account_lname'); ?> &bull; <?= date('d/m/Y \a\t H:i'); ?></small></div></li>';
			
			$('#view_project_task_modal').animate(
			{
				scrollTop: $("#projects_tasks_comments").offset().top-50
			}, 2000);
			
			
		$.ajax(
		{
		type: 'POST',
		url: '<?= base_url('projects/add_project_task_comment/' . $task['project_task_id']); ?>',
		data: form_data,
		success: function(data)
		{
			/* update comment section */
			$('ul#projects_tasks_comments').prepend(comment);
			$('div#project_task_comment_content').summernote('code', '');
			try 
			{
				var response = $.parseJSON(JSON.stringify(data));
				console.log(response);

				if(response.status==200)
				{
					$('div#no-comments').hide();
				}
				else
				{
					$('div#add_project_task_comment_console').html(data);
				}
			} catch(e) 
			{
			}
		}
		});
		});
	}
	
	$('button#project_task_add_comment').click(function()
	{
		comment_submit();
	});

	$(document).keypress(function(e) {

	if(e.which == 13) {
	comment_submit();
	}
	});
	});
	
	$('button#delete_task').on('click', function(event)
	{
		event.preventDefault();
		var task_id = $(this).data('task-id');
		var project_id = $(this).data('project-id');
		
		$.ajax(
		{
			type: 'POST',
			url: '<?= base_url('projects/delete_project_task'); ?>',
			data: { project_task_id: task_id },
			success: function(data)
			{
				window.location.replace('<?= base_url('projects/view/'); ?>' + project_id);
			}
		});
	});
	
	$(".datetimepicker").datetimepicker({
    	autoclose: true,
    	componentIcon: '.mdi.mdi-calendar',
    	navIcons:{
    		rightIcon: 'mdi mdi-chevron-right',
    		leftIcon: 'mdi mdi-chevron-left'
    	}
    });
	
	$('button#update_task_subscribers').on('click', function(event) {
		event.preventDefault();
		$.ajax ({
			type	: 	'POST',
			url		: 	'<?= base_url('projects/update_task_subscribers'); ?>',
			data	: 	$('form#update_task_subscribers').serialize(),
			success	:	function(data) {
				$('div#update_task_subscribers_console').html(data);
			}
		});
	});
</script>
<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
	
	$('#progress').hide();
    // Change this to the location of your server-side upload handler:
    var url = '<?= base_url('projects/add_project_file/' . $task['project_id']); ?>';
	
	var file_counter = 0;
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
				$('div#files').prepend('<input type="hidden" name="file[' + file_counter + '][file_name]" value="' + file.name + '"/>');
				$('div#files').prepend('<input type="hidden" name="file[' + file_counter + '][file_size]" value="' + file.size + '"/>');
				$('div#files').prepend('<input type="hidden" name="file[' + file_counter + '][file_type]" value="' + file.type + '"/>');
				$('div#files').prepend('<input type="hidden" name="file[' + file_counter + '][project_task_id]" value="<?= $task['project_task_id']; ?>"/>');
				$('div#files').prepend('<input type="hidden" name="file[' + file_counter + '][project_id]" value="<?= $task['project_id']; ?>"/>');
				file_counter++;
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
        .parent().addClass($.support.fileInput ? undefined : 'disabled').bind('fileuploadstart', function (e) { $('button#project_task_add_comment').attr('disabled', 'disabled'); $('#progress').show(); $('div#loading').show(); }).bind('fileuploadstop', function (e) { $('div#loading').hide(); $('button#project_task_add_comment').removeAttr('disabled'); });
});
</script>
</body>
</html>