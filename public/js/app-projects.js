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
			window.location.href = url;
		});
		
		/* Task description WYSIWYG editor */
		
		$('button#edit_task').on('click', function(event)
		{
			$('p#project_task_description').hide();
			$('input#add_comment_form').show();
			$('div#comment-form').hide();
			project_task_description_editor();
		});
		
		function project_task_description_editor()
		{
			$('form#project_task_description').show();
			$('div#project_task_description').summernote(
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
			
			$('button#update_task').on('click', function(event)
			{
				event.preventDefault();
				
				$.ajax(
				{
					type: 'POST',
					url: form_url('projects', 'update_project_task_description'),
					data: $('form#project_task_description').serialize(),
					success: function(data)
					{
						alert(data);
					}
				});
			});
		}
		
		$('button#project_task_description_cancel').on('click', function(event) {
			event.preventDefault();
			$('form#project_task_description').hide();
			$('p#project_task_description').show();
		});
		
		$('input#add_comment_form').on('click', function(event) {
			event.preventDefault();
			$(this).hide();
			$('div#comment-form').show();
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