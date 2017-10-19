<?php

	class Teams extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Teams_Model');
			$this->load->model('Accounts_Model');
		}
		
		public function index()
		{
			$data['webpage_title'] = 'Teams';
			
			if($this->Teams_Model->get_teams($this->session->userdata('company')['company_id']))
			{
				$data['teams'] = $this->Teams_Model->results;
			}
			
			$this->load->template('teams/view_teams', $data);
		}
		
		public function add_team()
		{
			$this->form_validation->set_rules('team_name', 'Team name', 'required');
				
			if ($this->form_validation->run() === FALSE)
			{	
				$response['status'] = 400;
				$response['errors'] = validation_errors();
			}
			else
			{
				$data = array
				(
					'company_id'	=>	$this->input->post('company_id'),
					'account_id'	=>	$this->input->post('account_id'),
					'team_name'		=>	$this->input->post('team_name'),
					'team_created'	=>	get_current_datetime()
				);
				
				if($this->Teams_Model->create_team($data) === true)
				{
					$response['status'] = 	200;
					$response['url']	=	'refresh';
				}
				else
				{
					$response['status'] = 	400;
					$response['errors']	=	'<p>General error. Please contact support.</p>';
				}
			}
			
			header('Content-Type: application/json');
			echo json_encode($response);
		}
		
		public function add_member($account_id)
		{
			
		}
	}
	
?>