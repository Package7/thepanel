<?php

	function get_website_title($title = '', $separator = ' | ')
	{
		$CI =& get_instance();
		$query = $CI->db->get_where('settings', array('setting_code' => 'website_title'));
		$result = $query->row();
		
		if($title=='')
		{
			return $result->setting_value;
		}
		else
		{
			return $title . $separator . $result->setting_value;
		}
	}
	
	function get_setting($setting_code)
	{
		$CI =& get_instance();
		$query = $CI->db->get_where('settings', array('setting_code' => $setting_code));
		$result = $query->row_array();
		return $result['setting_value'];
	}
	
?>