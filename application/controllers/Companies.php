<?php

	class Companies extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Permissions_Model');
			$this->load->model('Companies_Model');
		}
		
		public function index()
		{
			if($this->Permissions_Model->is_admin())
			{
				if($this->Companies_Model->get_companies())
				{
					$companies = $this->Companies_Model->results;
				}
				else
				{
					$companies = null;
				}
			}
			else
			{
				if($this->Companies_Model->get_companies($this->session->userdata('account_id')))
				{
					$companies = $this->Companies_Model->results;
				}
				else
				{
					$companies = null;
				}
			}
			
			$data['webpage_title'] = 'Companies';
			$data['companies'] = $companies;
			
			$this->load->template('companies/view_companies', $data);
		}
	}
	
?>