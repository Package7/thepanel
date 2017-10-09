var App = (function () 
{
	'use strict';
	App.textEditors = function()
	{
		$('div#project_note_content').summernote(
		{
			toolbar: 
			[
				['style', ['bold', 'italic', 'underline', 'clear']],
				['font', ['strikethrough', 'superscript', 'subscript']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['height', ['height']]
			],
			height: 250
		});
	};
	return App;
})(App || {});