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
		}
		
		public function index()
		{
			$data = array('user' => $_SESSION, 'webpage_title' => 'Dashboard');
			
			if($this->session->userdata('isadmin')==0)
			{
				$this->load->model('Clients_Model');
				$this->load->model('Projects_Model');
				$projects_data = $this->Projects_Model->get_projects($this->Projects_Model->get_client_id($this->session->userdata('account_id')));
			
			
			$data = array
			(
				'webpage_title' => 'Dashboard',
				'projects' => $projects_data,
				'clients' => $this->Clients_Model->get_clients()
			);
			
				$this->load->template('projects/view_projects', $data);
			}
			else
			{
				$this->load->template('homepage', $data);
			}
		}
	}
	
?>