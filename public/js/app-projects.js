var App = (function () 
{
	'use strict';
	App.projects = function(base_url)
	{
		function form_url(controller, method)
		{
			return base_url + controller + '/' + method;
		}
		
		/* Sort task list */
		$('tbody#projects_tasks').sortable(
		{
			axis: 'y',
			update: function(event, ui)
			{
				$.ajax(
				{
					type: 'POST',
					url: form_url('projects', 'sort_project_tasks'),
					data: $(this).sortable('serialize', { attribute: 'data-task-id' }),
					success: function(data)
					{
						$('#debug').html(data);
					}
				});
			}
		});
		
		/* Open task in modal */
		
		$('tr#view_project_task').click(function(event)
		{
			event.preventDefault();
			var url = $(this).attr('href');
			$('div#view_project_task_modal .modal-content').html('');
			$('div#view_project_task_modal .modal-content').load(url);
		});
		
		/* Task comment WYSIWYG editor */
		
		$('div#project_task_comment_content').summernote(
		{
			toolbar: 
			[
				['style', ['bold', 'italic', 'underline', 'clear']],
				['font', ['strikethrough', 'superscript', 'subscript']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']]
			],
			height: 150
		});
	};
	return App;
})(App || {});