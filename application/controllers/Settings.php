<?php

	class Settings extends CI_Controller 
	{
		public function general()
		{
			$data = array
			(
				'webpage_title' => 'General'
			);
			$this->load->template('settings/general', $data);
		}
		
	}
	
?>