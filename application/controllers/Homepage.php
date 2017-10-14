<?php

	class Homepage extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			if ( ! $this->session->userdata('account_loggedin'))
			{ 
				$allowed = array(
					'some_method_in_this_controller',
					'other_method_in_this_controller',
				);
				if ( ! in_array($this->router->fetch_method(), $allowed))
				{
					redirect('login');
				}
			}
			$this->load->model('Accounts_Model');
			$this->load->model('Permissions_Model');
		}
		
		public function index()
		{
			$data['webpage_title'] = 'Dashboard';
			
			$this->load->model('Companies_Model');
			
			if($this->Permissions_Model->is_admin())
			{
				$this->load->template('dashboard/admin', $data);
			}
			else
			{
				$companies = $this->Companies_Model->get_companies($this->session->userdata('account_id'));
				
				if($companies)
				{
					$this->load->template('dashboard/client', $data);
				}
				else
				{
					$this->load->template('companies/add_company', $data);
				}
				
				// echo '<pre style="margin-top: 100px;">';
				// var_dump($companies);
				// echo '</pre>';
			}
		}
		
		public function add_company_process($data)
		{
			$this->form_validation->set_rules('company_name', 'Company name', 'required');
			$this->form_validation->set_rules('company_address', 'Address', 'required');
			$this->form_validation->set_rules('company_city', 'City', 'required');
			$this->form_validation->set_rules('company_postcode', 'Postcode', 'required');
			
			if ($this->form_validation->run() === false)
			{	
				echo 'eroare';
			}
			else
			{
				echo 'nu eroare';
			}
		}
	}
	
?>