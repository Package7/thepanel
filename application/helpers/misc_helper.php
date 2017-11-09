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
	
	function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
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
	
	function slugify($text)
	{
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  // trim
	  $text = trim($text, '-');

	  // remove duplicate -
	  $text = preg_replace('~-+~', '-', $text);

	  // lowercase
	  $text = strtolower($text);

	  if (empty($text)) {
		return 'n-a';
	  }

	  return $text;
	}
	
	function buildTree(array $arr, $parentId = 0) {
    $result = array();

	foreach($arr as $val) {
		$result[$val['account_role_category_id']][] = $val;
	}
	
	return $result;
	}
	
	function breadcrumbs($separator = ' » ', $home = 'Home', $trail = false) 
	{
		$path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
		$base_url = substr($_SERVER['SERVER_PROTOCOL'], 0, strpos($_SERVER['SERVER_PROTOCOL'], '/')) . '://' . $_SERVER['HTTP_HOST'] . '/';
		$breadcrumbs = array('<li><a href="' . $base_url . '">' . $home . '</a></li>');
		$path_parts = count($path);
		$tmp = array_keys($path);
		$last = end($tmp);
		$i = 0;
		$url = '';
		
		foreach($path as $key=>$value)
		{
			$i++;
			
			if($i==$path_parts)
			{
				array_push($breadcrumbs, '<li>' . ucfirst($value) . '</li>');
			}
			else
			{
				$url .= $path[$key] . '/';
				array_push($breadcrumbs, '<li><a href="' . base_url() . rtrim($url, '/') . '">' . ucfirst($value) . '</a></li>');
			}
		}
		return '<ol class="breadcrumb">' . implode('', $breadcrumbs) . '</ol>';
	}
	
?>