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
	
	function is_numeric_null($value)
	{
		if($value==null || $value == false || strtolower($value) == 'null' || strtolower($value) == 'false')
		{
			return 0;
		}
		else
		{
			return $value;
		}
	}
	
	function get_default_value($items, $default, $value, $option)
	{
		$options = '';
		
		foreach($items as $item)
		{
			$options .= '<option value="' . $item[$value] . '"';
			
			if($item[$value]==$default)
			{
				$options .= ' selected="selected"';
			}
			
			$options .= '>' . $item[$option] . '</option>';
		}
		
		return $options;
	}
	
	function buildTree(array $arr, $parentId = 0) {
    $result = array();

	foreach($arr as $val) {
		$result[$val['account_role_category_id']][] = $val;
	}
	
	return $result;
	}
	
?>