
<div class="modal-header">
	<button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
	<h3 class="modal-title"><?= $task['project_task_name']; ?></h3>
</div>
<div class="modal-body">
                    <div class="row">
						<div class="col-sm-6">
							<a id="group" data-title="Assign to" data-value="1" data-pk="1" data-type="select" href="#" class="editable editable-click">Admin</a>
						</div>
						<div class="col-sm-6" align="right">
							<div class="btn-toolbar">
								<div class="btn-group btn-space">
									<button type="button" class="btn btn-default">Edit task</button>
									<button id="delete_project_task" type="button" class="btn btn-default"><i class="icon mdi mdi-delete"></i></button>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
	<p><?= $task['project_task_description']; ?></p>

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
      	
		function form_submit() {
			$('form#add_project_task_comment').unbind().submit(function(event) {
				event.preventDefault();
				
				$.ajax(
				{
					type: 'POST',
					url: '<?= base_url('projects/add_project_task_comment/' . $task['project_task_id']); ?>',
					data: $(this).serialize(),
					success: function(data, status, xhr)
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