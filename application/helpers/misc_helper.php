<?php

	function is_verified($value)
	{
		if($value==0)
		{
			return '<i class="icon mdi mdi-block"></i>';
		}
		else
		{
			return '<i class="icon mdi mdi-badge-check" style="color:green"></i>';
		}
	}
	
?>