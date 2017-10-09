<?php

	class Orders extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
		}
		
		public function index()
		{
			$this->load->template('orders/view', array('webpage_title' => 'Orders'));
		}	
	}
	
?>