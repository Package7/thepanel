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
			$this->load->model('Companies_Model');
			$this->load->model('Projects_Model');
			$this->load->model('Teams_Model');
			$this->load->library('rabbitmq');
		}
		
		public function index()
		{
			// echo '<pre style="margin-top: 150px; height: 300px; border: 1px solid red;">';
			// $this->rabbitmq->push('hello_queue2', 'This is a live notification test', TRUE, array('type' => 'json'));
			
			$data['webpage_title'] = 'Dashboard';
			
			if($this->Permissions_Model->is_admin()) {
				if($this->Projects_Model->get_projects() === true) {
					$data['projects'] = $this->Projects_Model->results;
					
					// foreach($data['projects'] as $project) {
						// if($this->Projects_Model->get_project_tasks($project['project_id']) === true) {
							// array_
						// }
					// }
				}
				
				$this->load->template('dashboard/admin', $data);
			} else {
				$companies = $this->Companies_Model->get_companies($this->session->userdata('account_id'));
				$projects = $this->Projects_Model->get_projects($this->session->userdata('company')['company_id']);
				
				if($companies)
				{
					$data['companies'] = $this->Companies_Model->results;
					$data['projects'] = $projects;
					$data['accounts'] = array();
					$data['teams'] = array();
					
					if($this->Projects_Model->get_default_project($this->session->userdata('company')['company_id']))
					{
						$project = $this->Projects_Model->results;
						
						$data['project'] = $project;
						$data['tasks'] = $this->Projects_Model->get_tasks($project['project_id']);
					}
				
					if($this->Accounts_Model->get_accounts($this->session->userdata('company')['company_id']))
					{
						$data['accounts'] = $this->Accounts_Model->results;
					}
					
					if($this->Teams_Model->get_teams($this->session->userdata('company')['company_id']))
					{
						$data['teams'] = $this->Teams_Model->results;
					}
					
					$this->load->template('dashboard/client', $data);
				}
				else
				{
					$this->load->template('companies/add_company', $data);
				}
				
				
			}
		}
		
		public function add_company_process()
		{
			$this->form_validation->set_rules('company_name', 'Company name', 'required');
			
			if ($this->form_validation->run() === false)
			{	
				$response['status'] = 400;
				$response['errors'] = validation_errors();
			}
			else
			{
				$this->load->model('Stripe_Model');
				
				$data = array
				(
					'company_name'					=>	$this->input->post('company_name'),
					'company_registration_number'	=>	$this->input->post('company_registration_number'),
					'company_address'				=>	$this->input->post('company_address'),
					'company_city'					=>	$this->input->post('company_city'),
					'company_postcode'				=>	$this->input->post('company_postcode'),
					'company_created'				=>	get_current_datetime(),
					'account_id'					=>	$this->session->userdata('account_id'),
					'company_account_isowner' 		=>	1,
					'company_account_isdefault' 	=>	1,
					'project_name'					=>	$this->input->post('project_name'),
					'project_description'			=>	$this->input->post('project_description'),
					'project_created'				=>	get_current_datetime(),
					'project_isdefault'				=>	1
				);
				
				if($this->Stripe_Model->create_customer($data)==true)
				{
					$data['company_stripe_id'] = $this->Stripe_Model->stripe_response->id;
					
					if($this->Companies_Model->add_company($data)==true)
					{
						$this->Companies_Model->get_companies($data['account_id']);
						$session = $this->session->userdata();
						$session['companies'] = $this->Companies_Model->results;
						
						$this->load->model('Accounts_Model');
						
						if($this->Accounts_Model->get_default_company($data['account_id']))
						{
							$session['company'] = $this->Accounts_Model->results;
						}
						
						$this->session->set_userdata($session);
					
						$response['status'] = 302;
						$response['url'] = base_url();
					}
					else
					{
						$response['status'] = 400;
						$response['errors'] = $this->Companies_Model->errors;
					}
				}
			}
			
			header('Content-Type: application/json');
			echo json_encode($response);
		}
	}
	
?>