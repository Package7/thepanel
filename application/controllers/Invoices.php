<?php

	class Invoices extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
		}
		
		public function index()
		{
			$this->load->template('invoices/view_invoices', array('webpage_title' => 'Invoices'));
		}	
	}
	
?>