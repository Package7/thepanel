<?php

	function get_file_icon($file_type)
	{
		switch($file_type)
		{
			case 'image/jpg':
			case 'image/jpeg':
			case 'image/gif':
			case 'image/png':
				echo '<i class="mdi mdi-image-alt"></i>';
			break;
			case 'application/pdf':
				echo '<i class="mdi mdi-collection-pdf"></i>';
			break;
		}
	}
	
?>