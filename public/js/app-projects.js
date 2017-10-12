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
	};
	return App;
})(App || {});