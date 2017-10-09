<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Knowledge_Base extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
		}
		
		public function index()
		{
			$this->load->template('knowledge-base/index');
		}
		
		public function search()
		{
		}
		
		public function add_category()
		{
		}
		
		public function edit_category()
		{
		}
		
		public function delete_category()
		{
		}
		
		public function add_article()
		{
		}
		
		public function edit_article()
		{
		}
		
		public function delete_article()
		{
		}
	}
	
?>