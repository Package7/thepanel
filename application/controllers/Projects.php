<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Projects extends CI_Controller
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
			
			$this->load->library('form_validation');
			$this->load->library('pagination');
			$this->load->model('Clients_Model');
			$this->load->model('Projects_Model');
		}
		
		public function index()
		{
			if($this->session->userdata('account_isadmin')==0 || $this->session->userdata('account_isadmin')==false)
			{
				$projects_data = $this->Projects_Model->get_projects($this->Projects_Model->get_client_id($this->session->userdata('account_id')));
			}
			else
			{
				$projects_data = $this->Projects_Model->get_projects();
			}
			
			$data = array
			(
				'webpage_title' => 'Available projects',
				'projects' => $projects_data,
				'clients' => $this->Clients_Model->get_clients()
			);
			
			$this->load->template('projects/view_projects', $data);
		}
		
		public function add_project()
		{
			$this->form_validation->set_rules('project_name', 'Name', 'required');
			$this->form_validation->set_rules('project_description', 'Description', 'required');
			
			if($this->form_validation->run() === FALSE)
			{
				echo validation_errors();
			}
			else
			{
				$data = array
				(
					'client_id' => $this->input->post('client_id'),
					'account_id' => $this->session->userdata('account_id'),
					'project_name' => $this->input->post('project_name'),
					'project_description' => $this->input->post('project_description'),
					'project_created' => date('Y-m-d H:i:s')
				);
				
				if($this->Projects_Model->add_project($data)==true)
				{
					$response = array
					(
						'status' => 200,
						'url' => base_url('projects/view/' . $this->Projects_Model->_LastId)
					);
					
					header('Content-Type: application/json');
					echo json_encode($response);
				}
				else
				{
					echo 'not ok';
				}
			}
		}
		
		public function view_project($project_id)
		{
			$project_data = $this->Projects_Model->get_project($project_id);
			$project_tasks_data = $this->Projects_Model->get_project_tasks($project_id);
			$project_notes_data = $this->Projects_Model->get_project_notes($project_id);
			
			$data = array
			(
				'webpage_title' => $project_data['project_name'],
				'project' => $project_data,
				'project_tasks' => $project_tasks_data,
				'project_notes' => $project_notes_data
			);
			
			$this->load->template('projects/view_project', $data);
		}
		
		public function add_project_milestone()
		{
			/*$data = array
			(
				'project_id'	=>	$this->input->post('project_id'),
				'account_id'	=>	$this->session->userdata('account_id'),
				'project_milestone_name'	=>	$this->input->post('project_milestone_name')
			);
			
			$this->Projects_Model->add_projects_milestones($data);*/
			
			print_r($_POST);
		}
		
		public function add_project_task()
		{
			$this->form_validation->set_rules('project_task_name', 'Name', 'required');
			$this->form_validation->set_rules('project_task_description', 'Description', 'required');
			
			if($this->form_validation->run() === FALSE)
			{
				echo validation_errors();
			}
			else
			{
				$data = array
				(
					'project_id'				=>	$this->input->post('project_id'),
					'account_id'				=>	$this->session->userdata('account_id'),
					'project_task_name' 		=> 	$this->input->post('project_task_name'),
					'project_task_description' 	=> 	$this->input->post('project_task_description'),
					'project_task_created'		=>	get_current_datetime()
				);
				
				if($this->Projects_Model->add_project_task($data)==true)
				{
					$response = array
					(
						'status' => 200,
						'url' => base_url('projects/view/' . $this->input->post('project_id'))
					);
					
					header('Content-Type: application/json');
					echo json_encode($response);
				}
				else
				{
					echo 'not ok';
				}
			}
		}
		
		public function delete_project($project_id)
		{
			$this->load->template('delete_project', $data);
		}
		
		public function view_project_task($project_id, $project_task_id)
		{
			$data = array
			(
				'task' => $this->Projects_Model->get_project_task($project_id, $project_task_id),
				'comments' => $this->Projects_Model->get_project_task_comments($project_task_id),
				'assignees' => $this->Projects_Model->get_available_assignees(),
				'statuses' => $this->Projects_Model->get_project_task_statuses()
			);
			
			$this->load->template('projects/view_project_task', $data);
		}
		
		public function add_project_note()
		{
			$this->form_validation->set_rules('project_note_title', 'Title', 'required');
			$this->form_validation->set_rules('project_note_content', 'Content', 'required');
			
			if($this->form_validation->run() === FALSE)
			{
				echo validation_errors();
			}
			else
			{
				$data = array
				(
					'project_id' 			=> 	$this->input->post('project_id'),
					'account_id' 			=> 	$this->session->userdata('account_id'),
					'project_note_title' 	=> 	$this->input->post('project_note_title'),
					'project_note_content'	=> 	$this->input->post('project_note_content'),
					'project_note_created'	=> 	get_current_datetime()
				);
				
				header('Content-Type: application/json');
				
				if($this->Projects_Model->add_project_note($data)===true)
				{
					$response = array
					(
						'status' => 200,
						'url' => base_url('projects/view/' . $this->input->post('project_id'))
					);
				}
				else
				{
					$response = array
					(
						'status' => 400,
						'error' => 'General error. Contact Tech Support.'
					);
				}
				
				echo json_encode($response);
			}
		}
		
		public function add_project_discussion()
		{
			$this->form_validation->set_rules('project_discussion_content', 'Content', 'required');
			
			if($this->form_validation->run() === FALSE)
			{
				echo validation_errors();
			}
			else
			{
				
				echo 'bine ba';
			}
		}
		
		public function add_project_task_comment($project_task_id)
		{
			$this->form_validation->set_rules('project_task_comment_content', 'Content', 'required');
			
			if($this->form_validation->run() === FALSE)
			{
				echo validation_errors();
			}
			else
			{
				$data = array
				(
					'project_task_id'	=> 	$project_task_id,
					'account_id' 		=> 	$this->session->userdata('account_id'),
					'project_task_comment_content'	=>	$this->input->post('project_task_comment_content'),
					'project_task_comment_created'	=>	get_current_datetime()
				);
				
				$this->Projects_Model->add_project_task_comment($data);
			}
			
		}
		
		/* TASKS */
		
		public function update_project_task($project_task_id)
		{
			$project_task_data = array
			(
				'assignee_id' => $this->input->post('assignee_id'),
				'project_task_status_id' => $this->input->post('project_task_status_id'),
				'project_task_completion' => $this->input->post('project_task_completion')
			);
			
			if($this->Projects_Model->update_project_task($project_task_data, $project_task_id)==true)
			{
				$response = array
				(
					'status' => 200
				);
			}
			else
			{
				$response = array
				(
					'status' => 400
				);
			}
					
			header('Content-Type: application/json');
			echo json_encode($response);
		}
	}
	
?>