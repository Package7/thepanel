
		<link rel="stylesheet" type="text/css" href="<?= base_url('public/lib/summernote/summernote.css'); ?>"/>
		<div class="modal-header">
	<button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
	<h3 class="modal-title"><?= $task['project_task_name']; ?></h3>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-sm-12">
			<p><?= $task['project_task_description']; ?></p>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<form id="update_project_task">
				<div id="update_project_task_console"></div>
				<ul class="list-inline" style="padding: 5px; background: #eeeeee;">
					<li>
						<strong>Assigned</strong>
						<div>
							<select name="assignee_id" id="assignee_id" class="form-control input-xs">
								<option value="NULL">-- Not assigned --</option>
								<?= get_default_value($assignees, $task['assignee_id'], 'account_id', 'account_fname'); ?>
							</select>
						</div>
					</li>
					<li>
						<strong>Status</strong>
						<div>
							<select name="project_task_status_id" class="form-control input-xs">
								<option value="NULL">-- Not updated --</option>
								<?= get_default_value($statuses, $task['project_task_status_id'], 'project_task_status_id', 'project_task_status_name'); ?>
							</select>
						</div>
					</li>
					<li>
						<strong>Completed</strong>
						<div>
							<input name="project_task_completion" type="number" id="project_task_completion" class="form-control input-xs" maxlength="3" min="0" max="100" value="<?= $task['project_task_completion']; ?>"/>
						</div>
					</li>
					<li>
						<button id="update_project_task" class="btn btn-primary">Update</button>
					</li>
				</ul>
			</form>
		</div>
	</div>
	<h4 title="Comments"><strong>Comments</strong></h4>
	<hr/>
	<div class="add_project_task_comment_console"></div>
	<form id="add_project_task_comment">
	<div class="col-sm-2">
		<img src="<?= get_avatar($this->session->userdata('account_id')); ?>" style="height: 35px;" class="img-circle" alt="Avatar">
	</div>
	<div class="col-sm-10">
		<div id="project_task_comment_content"></div>
		<p style="margin-top: 5px;">
			<button id="project_task_add_comment" class="btn btn-primary">
				<span class="icon mdi mdi-comment"></span> 
				Comment
			</button>
		</p>
	</div>
	<div class="clearfix"></div>
	</form>
<div class="clearfix" style="clear:both;"></div>
<hr/>
<br/>
<ul id="projects_tasks_comments" class="projects_tasks_comments" style="list-style-type: none; margin: 0; padding: 0;">
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
<?= base_url(); ?>
</div>
	
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
</script>