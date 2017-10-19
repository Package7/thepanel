var App = (function () 
{
	'use strict';
	App.companies = function(base_url)
	{
		var site_url = function(controller, method) {
			return base_url + controller + '/' + method;
		};
		
		$('tr#company_link').click(function(event)
		{
			alert('test');
			if (event.target.type == "checkbox") 
			{
				event.stopPropagation();
			} 
			else
			{
				window.location = $(this).data('href');
			}
		});
		
		$('form#add_company').submit(function(event)
		{
			event.preventDefault();
			
			$.ajax(
			{
				type: 'POST',
				url: site_url('homepage', 'add_company_process'),
				data: $(this).serialize(),
				success: function(data)
				{
					try {
					var response = $.parseJSON(JSON.stringify(data));
				
					  if(response.status==302)
					  {
						  window.location.replace(response.url);
					  }
					  else
					  {
						$('div#add_company_console').html('<div class="alert alert-danger"><strong>Please correct the following errors</strong>: ' + response.errors + '</div>');
					  }
					} catch(e) {
					}
					
				}
			});
		});
		
		$('button#add_company').on('click', function(event)
		{
			event.preventDefault();
			$('form#add_company').submit();
		});
	};
	return App;
})(App || {});