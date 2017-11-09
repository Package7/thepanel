<?php

	class Assets extends CI_Controller
	{
		public function index()
		{
			$data['get_website_title'] = 'Assets';
			$this->load->template('assets/view_assets', $data);
		}
	}
	
?>