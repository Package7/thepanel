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
		
		public function create() {
			if($this->Permissions_Model->is_admin()) {
				$data = array();
					
				if($this->Accounts_Model->get_accounts()) {
					$data['accounts'] = $this->Accounts_Model->results;
				}
				
				$this->load->template('companies/create', $data);
			} else {
				redirect(base_url('companies'));
			}
		}
		
		public function create_company() {
			$this->load->template('companies/add_company');
		}
		
		public function create_company_process()
		{
			$this->form_validation->set_rules('company_name', 'Company name', 'required');
			
			if ($this->form_validation->run() === false)
			{	
				echo validation_errors();
			}
			else
			{
				$this->load->model('Stripe_Model'); /* Load the stripe model to create customer stripe id */
				
				$data = array
				(
					'company_name'					=>	$this->input->post('company_name'),
					'company_registration_number'	=>	$this->input->post('company_registration_number'),
					'company_address'				=>	$this->input->post('company_address'),
					'company_city'					=>	$this->input->post('company_city'),
					'company_postcode'				=>	$this->input->post('company_postcde'),
					'company_stripe_id'				=>	$data['company_stripe_id']
				);
			}
		}
		
		public function view_company($company_id)
		{
			if($this->Companies_Model->get_company($company_id) === true)
			{
				$data['company'] = $this->Companies_Model->result;
				$this->load->template('companies/view_company.php', $data);
			}
			else
			{
				show_404();
			}
		}
		
		public function update_company()
		{
			if($this->Companies_Model->update_company_column($this->input->post('name'), $this->input->post('value'), $this->input->post('pk')) === true)
			{
				$response['status'] = 200;
				$response['message'] = 'Successfully updated';
			}
			else
			{
				$response['status'] = 400;
				$response['errors'] = 'Companie could not be updated';
			}
			
			header('Content-type:application/json');
			echo json_encode($response);
		}
	}
	
?>