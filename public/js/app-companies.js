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
			if (event.target.type == "checkbox") 
			{
				event.stopPropagation();
			} 
			else
			{
				window.location = $(this).data('href');
			}
		});
		
		$.validate({
			form : 'form#create_company'
		});
		
		$('button#create_company').on('click', function(event)
		{
			event.preventDefault();
			$('form#create_company').submit();
		});
		
		$('form#create_company').on('submit', function(event)
		{
			event.preventDefault();
			
			$.ajax(
			{
				type: 'POST',
				url: site_url('homepage', 'add_company_process'),
				data: $('form#create_company').serialize(),
				success: function(data)
				{
					if(data.status==302) {
						window.location.replace(data.url);
					} else {
						$('div#create_company_console').html(data);
					}
				}
			});
		});
		
		// $.fn.editable.defaults.mode = 'popup';     
		
		// $('#company_name').editable({
			// type: 'text',
			// url: 'http://thepanel.package7.com/companies/update_company', 
			// placement: 'bottom',
			// title: 'select status',
			// ajaxOptions: { dataType: 'json' }
		// });
		
		// $('#company_registration_number').editable({
			// type: 'text',
			// url: 'http://thepanel.package7.com/companies/update_company', 
			// placement: 'bottom',
			// title: 'select status',
			// ajaxOptions: { dataType: 'json' }
		// });
		
		// $('#company_address').editable({
			// type: 'text',
			// url: 'http://thepanel.package7.com/companies/update_company', 
			// placement: 'bottom',
			// title: 'select status',
			// ajaxOptions: { dataType: 'json' }
		// });
		
		// $('#company_city').editable({
			// type: 'text',
			// url: 'http://thepanel.package7.com/companies/update_company', 
			// placement: 'bottom',
			// title: 'select status',
			// ajaxOptions: { dataType: 'json' }
		// });
		
		// $('#company_postcode').editable({
			// type: 'text',
			// url: 'http://thepanel.package7.com/companies/update_company', 
			// placement: 'bottom',
			// title: 'select status',
			// ajaxOptions: { dataType: 'json' }
		// });
	};
	return App;
})(App || {});