<?php

	function get_current_datetime()
	{
		return date('Y-m-d H:i:s');
	}
	
	function get_avatar($account_id)
	{
		if($account_id==NULL || $account_id=='NULL' || $account_id==false)
		{
					return base_url('public/img/not_assigned.png');
		}
		else
		{
			$CI =& get_instance();
		
			try
			{
				$query = $CI->db->select('account_avatar')->get_where('accounts', array('account_id' => $account_id));
				
				if($query->num_rows() === 1)
				{
					$result = $query->row_array();
					return base_url('public/img/profiles/avatars/' . $result['account_avatar']);
				}
			}
			catch(Exception $ex)
			{
			}
		}
	}
	
	function get_current_account_id()
	{
		return $this->session->userdata('account_id');
	}

	function global_load_styles()
	{
		$link = '';
		
		$styles = array
		(
			'perfect-scrollbar'			=>	'lib/perfect-scrollbar/css/perfect-scrollbar.min',
			'iconic-font'	=>	'lib/material-design-icons/css/material-design-iconic-font.min',
			'jquery-gritter' => 'lib/jquery.gritter/css/jquery.gritter',
			'customer-portal'		=>	'css/style',
			'bootstrap-editable'	=>	'lib/x-editable/bootstrap3-editable/css/bootstrap-editable',
			'typeahead' => 'lib/x-editable/inputs-ext/typeaheadjs/lib/typeahead.js-bootstrap',
			'select2' => 'lib/select2/css/select2.min'
		);
		
		foreach($styles as $file=>$path)
		{
			$link .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'public/' . $path . '.css"/>';
		}
		
		return $link;
	}
	
	function frontend_load_styles()
	{
		$link = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous"/>';
		
		$styles = array
		(
			'stack-interface'			=>	'css/stack-interface',
			'theme'			=>	'css/theme',
			'custom'			=>	'css/custom',
			'socicon'			=>	'css/socicon',
			'flickity'			=>	'css/flickity',
			'flickity'			=>	'css/iconsmind'
		);
		
		foreach($styles as $file=>$path)
		{
			$link .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'public/' . $path . '.css"/>';
		}
		
		return $link;
	}
	
	function frontend_load_scripts()
	{
		$script = '';
		
		$scripts = array
		(
			'flickity'			=>	'js/flickity.pkgd.min',
			'scripts'			=>	'js/scripts'
		);
		
		foreach($scripts as $file=>$path)
		{
			$script .= '<script type="text/javascript" src="' . base_url() . 'public/' . $path . '.js"></script>';
		}
		
		return $script;
	}
	
	function global_load_scripts()
	{
		$script = '';
		
		$scripts = array
		(
			'jquery'				=>	'lib/jquery/jquery.min',
			'perfect-scrollbar'		=>	'lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min',
			'myprintpanel'			=>	'js/main',
			'bootstrap'				=>	'lib/bootstrap/dist/js/bootstrap.min',
			'parsley'				=>	'lib/parsley/parsley.min',
			'bootstrap-editable'	=>	'lib/x-editable/bootstrap3-editable/js/bootstrap-editable.min',
			'typeaheadjs'			=>	'lib/x-editable/inputs-ext/typeaheadjs/typeaheadjs',
			'xtypehead'				=>	'lib/x-editable/inputs-ext/typeaheadjs/lib/typeahead',
			'moment'				=>	'lib/moment.js/min/moment.min',
			'select2'				=>	'lib/select2/js/select2.min',
			'select2-full'			=>	'lib/select2/js/select2.full.min',
			'form-editable'			=>	'js/app-form-editable',
			'sockjs'				=>	'js/sock',
			'stomp'					=>	'js/stomp',
			'jquery-gritter'		=>	'lib/jquery.gritter/js/jquery.gritter'
		);
		
		foreach($scripts as $file=>$path)
		{
			$script .= '<script type="text/javascript" src="' . base_url() . 'public/' . $path . '.js"></script>';
		}
		
		return $script;
	}
	
?>
