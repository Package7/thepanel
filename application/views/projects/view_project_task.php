
<div class="modal-header">
	<button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
	<h3 class="modal-title"><?= $task['project_task_name']; ?></h3>
</div>
<div class="modal-body">
                    <div class="row">
						<div class="col-sm-8">
							<p><?= $task['project_task_description']; ?></p>
						</div>
						<div class="col-sm-4">
							<form id="update_project_task">
							<div id="update_project_task_console"></div>
							<ul class="list-group">
							<li class="list-group-item">
								<strong>Assigned</strong>
								<div>
									<select name="assignee_id" id="assignee_id" class="form-control input-xs">
										<option value="NULL">-- Not assigned --</option>
										<?= get_default_value($assignees, $task['assignee_id'], 'account_id', 'account_fname'); ?>
									</select>
								</div>
							</li>
							<li class="list-group-item">
								Status
								<div>
									<select name="project_task_status_id" class="form-control input-xs">
										<option value="NULL">-- Not updated --</option>
										<?= get_default_value($statuses, $task['project_task_status_id'], 'project_task_status_id', 'project_task_status_name'); ?>
									</select>
								</div>
							</li>
							<li class="list-group-item">
								Completed
								<div>
									<input name="project_task_completion" type="number" id="project_task_completion" class="form-control input-xs" maxlength="3" min="0" max="100" value="<?= $task['project_task_completion']; ?>">
								</div>
							</li>
						</ul>
						<p>
							<button id="update_project_task" class="btn btn-primary">Update</button>
						</p>
						</div>
						<div class="clearfix"></div>
					</div>

	<h4 title="Comments"><strong>Comments</strong></h4>
	<hr/>
	<div class="add_project_task_comment_console"></div>
	<form id="add_project_task_comment">
		<div class="col-sm-2">
			<img src="<?= get_avatar($this->session->userdata('account_id')); ?>" style="height: 35px;" class="img-circle" alt="Avatar">
		</div>
		<div class="col-sm-8">
			<input name="project_task_comment_content" class="form-control"/>
		</div>
		<!--<span class="btn btn-success fileinput-button">
			<i class="glyphicon glyphicon-plus"></i>
			<span>Select files...</span>
			<input id="fileupload" type="file" name="files[]" multiple>
		</span>
    <br>
    <br>
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    <div id="files" class="files"></div>-->
			</form>
			<div class="clearfix" style="clear:both;"></div>
			<hr/>
			<br/>
			<ul class="projects_tasks_comments" style="list-style-type: none; margin: 0; padding: 0;">
				<?php
			
				// echo '<pre>';
				// print_r($comments);
				// echo '</pre>';
				
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
									</div>
									<div class="col-sm-10">
										<div style="border-radius: 5px; background: #eeeeee; padding: 15px;">' . $comment['project_task_comment_content'] . '</div>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="comment-info" align="right"><small>' . $comment['account_fname'] . ' ' . $comment['account_lname'] . ' &bull; ' . $comment['project_task_comment_created'] . '</small></div>
						</li>
						';
					}
				}
				else
				{
					echo 'No comments at the moment';
				}
				
				?>
			</ul>
          </div>
          <div class="modal-footer">
           
          </div>

		  
		<script type="text/javascript" src="<?= base_url('public/vendor/jquery-file-upload/js/vendor/jquery.ui.widget.js'); ?>"></script>
		<script type="text/javascript" src="<?= base_url('public/vendor/jquery-file-upload/js/jquery.iframe-transport.js'); ?>"></script>
		<script type="text/javascript" src="<?= base_url('public/vendor/jquery-file-upload/js/jquery.fileupload.js'); ?>"></script>
		<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : 'server/php/';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
<script type="text/javascript">
$(document).ready(function()
{
      	//initialize the javascript
      	App.init();
		
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
      	
		function form_submit() {
			$('form#add_project_task_comment').unbind().submit(function(event) {
				event.preventDefault();
				
				$.ajax(
				{
					type: 'POST',
					url: '<?= base_url('projects/add_project_task_comment/' . $task['project_task_id']); ?>',
					data: $(this).serialize(),
					success: function(data)
					{
						window.location.reload();
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
								$('div#add_project_task_comment_console').html(data);
							}
						} catch(e) 
						{
						}
					}
				});
			});
		}
		
		$(document).keypress(function(e) {
			
			if(e.which == 13) {
				form_submit();
			}
		});
});
</script>