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
			
			$this->load->model('Permissions_Model');
			$this->load->model('Accounts_Model');
			$this->load->model('Companies_Model');
			$this->load->model('Projects_Model');
		}
		
		public function index()
		{
			
			$data['webpage_title'] = 'Dashboard';
			$data['projects'] = array();
			
			if($this->Permissions_Model->is_admin())
			{
				$projects = $this->Projects_Model->get_projects();
			}
			else
			{
				$projects = $this->Projects_Model->get_projects($this->session->userdata('company')['company_id']);
			}
			
			if($projects)
			{
				$data['projects'] = $this->Projects_Model->results;
			}
			
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
					// if($this->Clients_Model->get_accounts($data['client_id'])===true)
					// {
						// $accounts = $this->Clients_Model->result;
						
						// foreach($accounts as $follower)
						// {
							// $follower_data = array
							// (
								// 'project_id'	=>	$this->Projects_Model->_LastId,
								// 'account_id'	=>	$follower['account_id'],
								// 'project_follower_email_notifications'	=>	1,
								// 'project_follower_text_notifications'	=>	0
							// );
							
							// $this->Projects_Model->add_follower($follower_data);
						// }
					// }
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
			$available_followers_data = $this->Projects_Model->get_available_followers($project_data['company_id'], $project_id);
			
			$data = array
			(
				'webpage_title' => 'Projects',
				'project' => $project_data,
				'project_tasks' => $project_tasks_data,
				'project_notes' => $project_notes_data,
				'available_followers' => $available_followers_data
			);
			
			if($this->Projects_Model->get_files($project_id) === TRUE)
			{
				$data['project_files'] = $this->Projects_Model->results;
			}
			else
			{
				$data['project_files'] = array();
			}
			
			if($this->Projects_Model->get_followers($project_id) === TRUE)
			{
				$data['project_followers'] = $this->Projects_Model->results;
			}
			else
			{
				$data['project_followers'] = array();
			}
			
			
			if($this->Companies_Model->get_default_company($this->session->userdata('account_id')))
			{
				$data['subscribers'] = $this->Accounts_Model->get_available_accounts($this->Companies_Model->result);
			}
			
			$this->load->template('projects/view_project', $data);
		}
		
		public function add_project_follower()
		{
			if($this->input->post('account_id') == 0)
			{
				$response['status'] = 400;
				$response['errors'] = 'Please select an entity';
			}
			else
			{
				$data = array
				(
					'project_id'	=>	$this->input->post('project_id'),
					'account_id'	=>	$this->input->post('account_id')
				);
				
				if($this->Projects_Model->add_follower($data) === TRUE)
				{					
					$response['status'] = 200;
					$response['url'] 	= 'refresh';
				}
				else
				{
					$response['status'] = 400;
					$response['errors'] = 'Generic error. Please contact support.';
				}
			}
			
			header('Content-Type: application/json');
			echo json_encode($response);
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
				
				if(isset($_POST['project_task_subscribers']))
				{
					$data['project_task_subscribers'] = $this->input->post('project_task_subscribers');
				}
				
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
				'webpage_title' => 'Task',
				'task' => $this->Projects_Model->get_project_task($project_id, $project_task_id),
				'comments' => $this->Projects_Model->get_project_task_comments($project_task_id),
				'assignees' => $this->Projects_Model->get_available_assignees(),
				'statuses' => $this->Projects_Model->get_project_task_statuses(),
				
			);
			
			$data['project_task_name'] = $data['task']['project_task_name'];
			
			if($this->Projects_Model->get_assignee($project_task_id) === true) {
				$project_task_assignee = $this->Projects_Model->result;
				
				if($project_task_assignee != null && $this->Accounts_Model->get_account($project_task_assignee) == true) {
					$assignee = $this->Accounts_Model->result;
					
					$data['project_task_assignee'] = $assignee['account_fname'] . ' ' . $assignee['account_lname'];
				} else {
					$data['project_task_assignee'] = 'No assignee';
				}
			} else {
				$data['project_task_assignee'] = '';
			}
			
			if($this->Projects_Model->get_project_task_due_date($project_task_id) === true) {
				if($this->Projects_Model->result == null) {
					$data['project_task_due_date'] = 'No due date';
				} else {
					$data['project_task_due_date'] = date('d/m/Y', strtotime($this->Projects_Model->result));
				}
			} else {
				$data['project_task_due_date'] = 'No assignee';
			}
			
			
			$subscribers = $this->Projects_Model->get_task_subscribers($project_task_id);
			
			if($subscribers !== FALSE) {
				$data['subscribers'] = $subscribers;
			} else {
				$data['subscribers'] = array();
			}
			
			
			if($this->Companies_Model->get_default_company($this->session->userdata('account_id')))
			{
				$data['available_subscribers'] = $this->Accounts_Model->get_available_accounts($this->Companies_Model->result);
			} else {
				$data['available_subscribers'] = array();
			}
			
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
		
		public function summernote_validate($param)
		{
			if($param=='<p><br></p>')
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		
		public function add_project_task_comment($project_task_id)
		{
			$this->form_validation->set_message('summernote_validate','Please enter a comment');
			$this->form_validation->set_rules('project_task_comment_content', 'Content', 'required|callback_summernote_validate');
			
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
				
				// print_r($this->input->post('file'));
				
				if($this->Projects_Model->add_project_task_comment($data))
				{
					$project_task_comment_id = $this->Projects_Model->_LastId;
					
					$update_db = true;
					
					foreach($this->input->post('file') as $file)
					{
						$file = array
						(
							'project_id' => $file['project_id'],
							'project_task_id' => $file['project_task_id'],
							'project_task_comment_id' => $project_task_comment_id,
							'project_file_type' => $file['file_type'],
							'project_file_size' => $file['file_size'],
							'project_file_name' => $file['file_name']
						);
						
						if($this->Projects_Model->create_project_file($file) == TRUE)
						{
							$update_db = true;
						}
						else
						{
							$update_db = false;
						}
					}
				}
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
		
		public function update_project_task_description()
		{
			echo 'description update';
		}
		
		public function add_project_file($project_id)
		{
			$project_folder = APPPATH . '../public/uploads/' . $project_id;
			
			if(!file_exists($project_folder))
			{
				mkdir($project_folder, 0775, true);
			}
			
			$options = [
			 'script_url' => site_url('projects/add_project_file'),
			 'upload_dir' => $project_folder . '/',
			 'upload_url' => site_url('public/uploads/' . $project_id . '/')
			 ];
			 
			$this->load->library('UploadHandler', $options);
		}
		
		public function create_project_file($project_id)
		{
			if(is_numeric($project_id))
			{
				$data = array
				(
					'project_id'		=>	$project_id,
					'project_file_name'	=>	$this->input->post('file_name'),
					'project_file_size'	=>	$this->input->post('file_size'),
					'project_file_type'	=>	$this->input->post('file_type')
				);
				
				if($this->input->post('task_upload') == 1)
				{
					$data['project_task_id'] = $this->input->post('project_task_id');
				}
				
				$this->Projects_Model->create_project_file($data);
			}
		}
		
		public function sort_project_tasks()
		{
			$i = 1;
			
			foreach($this->input->post('project_task') as $position => $project_task_id)
			{
				$this->Projects_Model->sort_projects_tasks($i, $project_task_id);
				$i++;
			}
		}
		
		public function delete_project_task()
		{
			if($this->Permissions_Model->is_admin())
			{
				$this->Projects_Model->delete_project_task($this->input->post('project_task_id'));
			}
		}
		
		/* SUBSCRIBERS */
		
		public function update_task_subscribers() {
			echo '<pre>';
			print_r($_POST);
			echo '</pre>';
		}
	}
	
?>