<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	
	/*
	| This model contains the following methods:
	|
	| 1. Projects
	| 	1.1. get_projects() - gets all the projects from the db and returns them as an array
	| 	1.2. get_project($project_id) - gets single project by id from db and returns an array
	|	1.3.
	|
	| 2. Projects tasks
	|	2.1. get_tasks
	|	2.2. get_task
	|
	| 4. Projects notes
	| 4.1. get_project_notes($project_id) - gets all project notes by id
	| 4.2. get_project_note
	| 4.3. add_project_note
	|
	| 5. Projects team
	|	5.1. get_team()
	|
	| 6. Followers
	|
	|*/

	class Projects_Model extends CI_Model
	{
		public $_LastId = NULL;
		public $results = null;
		public $message;
		public $error;
		public $last_file_id = NULL;
		
		public function __construct()
		{
			parent::__construct();
		}
		
		
		/* 
		* @return bool
		* @author George Dobre
		*/
		
		public function add_project($data)
		{
			try 
			{
				$query = $this->db->insert('projects', $data);
				
				// check if any row was affected by the insert as there is 
				// no process of finding out if the insert took place or not
				// @george
				
				if($this->db->affected_rows() == 0)
				{
					return false;
				}
				else
				{
					$this->_LastId = $this->db->insert_id();
					return true;
				}
			}
			catch(Exception $ex)
			{
				throw new Exception($ex->getMessage());
			}
		}
		
		public function update_project($data, $id = NULL)
		{
			try 
			{
				if($id==NULL)
				{
				}
				else
				{
					$query = $this->db->where('project_id', $id)->update('projects', $data);
				}
				
				if($this->db->affected_rows() == 0)
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			catch(Exception $ex)
			{
				throw new Exception($ex->getMessage());
			}
		}
		
		public function delete_project($project_id)
		{
		}
		
		public function get_projects($company_id = null)
		{
			try
			{
				if($company_id === null)
				{
					$query = $this->db->select('*')->from('projects')->get();
				}
				else
				{
					$query = $this->db->select('*')->get_where('projects', array('company_id' => $company_id));
				}
				
				if($query->num_rows() == 0)
				{
					return false;
				}
				else
				{
					$this->results = $query->result_array();
					return true;
				}
			}
			catch(Exception $ex)
			{
				$this->errors = Exception($ex->getMessage());
				return false;
			}
		}
		
		public function get_project($project_id)
		{
			try
			{
				$query = $this->db->get_where('projects', array('project_id' => $project_id))->row_array();
				return $query;
			}
			catch(Exception $ex)
			{
				throw new Exception($ex->getMessage());
			}
		}
		
		public function get_default_project($company_id)
		{
			try 
			{
				$query = $this->db->query("SELECT company_id, project_id, project_name FROM projects WHERE company_id = '$company_id' AND project_isdefault = '1'");
				
				if($query->num_rows() == 1)
				{
					$this->results = $query->row_array();
					return true;
				}
				else
				{
					return false;
				}
			}
			catch(Exception $ex)
			{
				$this->message = $ex->getMessage();
				return false;
			}
		}
		
		public function get_projects_milestones($project_id)
		{
		}
		
		public function add_projects_milestones($data)
		{
			try 
			{
				$query = $this->db->insert('projects_milestones', $data);
				
				// check if any row was affected by the insert as there is 
				// no process of finding out if the insert took place or not
				// @george
				
				if($this->db->affected_rows() == 0)
				{
					return false;
				}
				else
				{
					$this->_LastId = $this->db->insert_id();
					return true;
				}
			}
			catch(Exception $ex)
			{
				throw new Exception($ex->getMessage());
			}
		}
		
		/*
		| 2.1. get_tasks
		*/
		
		public function get_tasks($project_id)
		{
			try
			{
				$query = $this->db->select('*')->get_where('projects_tasks', array('project_id' => $project_id))->result_array();
				return $query;
			}
			catch(Exception $ex)
			{
				throw new Exception($ex->getMessage());
				return false;
			}
		}
		
		/*
		| 2.2. get_task
		*/
		
		public function get_task()
		{
		}
		
		public function add_project_task($data)
		{
			$data2 =  array 
			(
				'project_id'				=>	$data['project_id'],
				'account_id'				=>	$data['account_id'],
				'project_task_name' 		=> 	$data['project_task_name'],
				'project_task_description' 	=> 	$data['project_task_description'],
				'project_task_created'		=>	$data['project_task_created']
			);
			
			$this->db->trans_begin();
			$this->db->insert('projects_tasks', $data2);
			$this->_LastId = $this->db->insert_id();
			
			if($data['project_task_subscribers'] !== NULL)
			{
				foreach($data['project_task_subscribers'] as $subscriber) {
					$sub_data = array(
						'project_id'		=>	$data['project_id'],
						'project_task_id'	=>	$this->_LastId,
						'account_id'	=>	$subscriber
					);
					
					$this->db->insert('projects_tasks_subscribers', $sub_data);
				}
			}
			
					
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}
			else
			{
				$this->db->trans_commit();
				return true;
			}
			
		}
		
		public function update_task_subscribers($task_id, $data) {
			// $query = $this->db->query("SELECT 
		}
		
		
		
		public function update_project_task($data, $id = NULL)
		{
			try 
			{
				if($id==NULL)
				{
				}
				else
				{
					$query = $this->db->where('project_task_id', $id)->update('projects_tasks', $data);
				}
				
				if($this->db->affected_rows() == 0)
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			catch(Exception $ex)
			{
				throw new Exception($ex->getMessage());
			}
		}
		
		public function get_project_tasks($project_id)
		{
			try {
				$query = $this->db->query("SELECT * FROM projects_tasks AS t1 LEFT JOIN accounts AS t2 ON t2.account_id=t1.assignee_id LEFT JOIN projects_tasks_statuses AS t3 ON t3.project_task_status_id = t1.project_task_status_id WHERE project_id='$project_id' ORDER BY project_task_position ASC")->result_array();
			} catch(Exception $e) {
			}
			
			return $query;
		}
		
		public function get_project_task($project_id, $project_task_id)
		{
			try 
			{
				$query = $this->db->select('*')->from('projects_tasks')->where('project_id', $project_id)->where('project_task_id', $project_task_id)->get();
			
				if($query->num_rows()==1)
				{
					return $query->row_array();
				}
				else
				{
					return false;
				}
			}
			catch(Exception $e)
			{
			}
		}
		
		public function delete_project_task($project_task_id)
		{
			$query = $this->db->query("DELETE FROM projects_tasks WHERE project_task_id = '$project_task_id'");
			return TRUE;
		}
		
		public function get_project_task_statuses()
		{
			try 
			{
				$query = $this->db->select('*')->from('projects_tasks_statuses')->get();
			
				if($query->num_rows()==0)
				{
					return false;
				}
				else
				{
					return $query->result_array();
				}
			}
			catch(Exception $e)
			{
			}
		}
		
		public function add_project_task_comment($data)
		{
			try
			{
				$query = $this->db->insert('projects_tasks_comments', $data);
				
				if($this->db->affected_rows() == 0)
				{
					return false;
				}
				else
				{
					$this->_LastId = $this->db->insert_id();
					return true;
				}
			}
			catch(Exception $ex)
			{
				throw new Exception($ex->getMessage());
			}
		}
		
		public function get_project_task_comments($project_task_id)
		{
			try
			{
				$query = $this->db->query("SELECT *, DATE_FORMAT(project_task_comment_created, '%d/%m/%Y at %H:%i') AS project_task_comment_created FROM projects_tasks_comments AS t1 LEFT JOIN projects_tasks AS t2 ON t2.project_task_id=t1.project_task_id LEFT JOIN accounts AS t3 ON t3.account_id=t1.account_id WHERE t1.project_task_id='$project_task_id' ORDER BY project_task_comment_created DESC");
				
				if($query->num_rows()==0)
				{
					return false;
				}
				else
				{
					$results = $query->result_array();
					$new_results = array();
					
					$i = 0;
					foreach($results as $result)
					{
						$project_task_comment_id = $result['project_task_comment_id'];
						$files = $this->db->query("SELECT * FROM projects_files WHERE project_task_comment_id = '$project_task_comment_id'");
						
						if($query->num_rows() != 0)
						{
							$new_results[$i]['account_id'] = $result['account_id'];
							$new_results[$i]['project_task_comment_content'] = $result['project_task_comment_content'];
							$new_results[$i]['account_fname'] = $result['account_fname'];
							$new_results[$i]['account_lname'] = $result['account_lname'];
							$new_results[$i]['project_task_comment_created'] = $result['project_task_comment_created'];
							$new_results[$i]['project_task_comment_id'] = $result['project_task_comment_id'];
							$new_results[$i]['files'] = $files->result_array();
							
							foreach($files->result_array() as $file=>$value)
							{
								$new_results[$i]['files'][$file]['project_file_id'] = $value['project_file_id'];
								$new_results[$i]['files'][$file]['project_id'] = $value['project_id'];
								$new_results[$i]['files'][$file]['project_task_id'] = $value['project_task_id'];
								$new_results[$i]['files'][$file]['project_task_comment_id'] = $value['project_task_comment_id'];
								$new_results[$i]['files'][$file]['project_file_name'] = $value['project_file_name'];
								$new_results[$i]['files'][$file]['project_file_size'] = number_format($value['project_file_size']/10000000, 2);
								$new_results[$i]['files'][$file]['project_file_type'] = $value['project_file_type'];
								$new_results[$i]['files'][$file]['project_file_type_icon'] = $this->get_file_type_icon($value['project_file_type']);
							}
							
							$i++;
						}
					}
					
					return $new_results;
				}
			}
			catch(Exception $ex)
			{
				throw new Exception($ex->getMessage());
			}
		}
		
		/*
		| 4.1. get_project_notes
		*/
		
		public function get_project_notes($project_id)
		{
			try {
				$query = $this->db->query("SELECT *, DATE_FORMAT(project_note_created, '%d/%m/%Y at %H:%i') AS project_note_created FROM projects_notes AS t1 LEFT JOIN accounts AS t2 ON t2.account_id=t1.account_id WHERE t1.project_id='$project_id'");
				
				if($query->num_rows()==0)
				{
					return false;
				}
				else
				{
					return $query->result_array();
				}
			}
			catch(Exception $e)
			{
			}
		}
		
		/*
		| 4.2. get_project_note
		*/
		
		public function get_project_note($project_note_id)
		{
		}
		
		/*
		| 4.3. add_project_note
		*/
		
		public function add_project_note($data)
		{
			try 
			{
				$query = $this->db->insert('projects_notes', $data);
				
				if($this->db->affected_rows() == 0)
				{
					return false;
				}
				else
				{
					$this->_LastId = $this->db->insert_id();
					return true;
				}
			}
			catch(Exception $ex)
			{
				throw new Exception($ex->getMessage());
			}
		}
		
		public function sort_projects_tasks($project_task_position, $project_task_id)
		{
			$query = $this->db->where('project_task_id', $project_task_id)->update('projects_tasks', array('project_task_position' => $project_task_position));
			
			if($this->db->affected_rows() == 0)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		
		public function get_assignee($project_task_id)
		{
			try {
				$query = $this->db->query("SELECT assignee_id FROM projects_tasks AS t1 LEFT JOIN accounts AS t2 ON t2.account_id=t1.assignee_id WHERE t1.project_task_id = '$project_task_id'");
				
				if($query->num_rows()==1)
				{
					$this->result = $query->row_array()['assignee_id'];
					return true;
				}
				else
				{
					return false;
				}
			}
			catch(Exception $e)
			{
			}
		}
		
		public function get_available_assignees()
		{
			try
			{
				$query = $this->db->query("SELECT * FROM accounts WHERE account_group_id = 2");
				
				if($query->num_rows() == 0)
				{
					return false;
				}
				else
				{
					return $query->result_array();
				}
			}
			catch(Exception $ex)
			{
				return false;
			}
		}
		
		public function get_project_task_due_date($project_task_id) {
			$query = $this->db->select('project_task_due_date')->get_where('projects_tasks', array('project_task_id' => $project_task_id));
			
			if($query->num_rows() == 1) {
				$this->result = $query->row_array()['project_task_due_date'];
				return true;
			} else {
				return false;
			}
		}
		
		/*
		| 5.1. get_team()
		*/
		
		public function get_team($project_id)
		{
			try
			{
				$client_id = $this->get_project($project_id)['client_id'];
				echo '<pre style="margin-top:100px;">';
				print_r($client_id);
				echo '</pre>';
			}
			catch(Exception $ex)
			{
			}
		}
		
		public function add_follower($data)
		{
			try 
			{
				if(!isset($data['project_follower_email_notifications']))
				{
					$data['project_follower_email_notifications'] = 0;
				}
				
				if(!isset($data['project_follower_text_notifications']))
				{
					$data['project_follower_text_notifications'] = 0;
				}
				
				$query = $this->db->insert('projects_followers', $data);
				
				if($this->db->affected_rows() == 0)
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			catch(Exception $ex)
			{
				throw new Exception($ex->getMessage());
			}
		}
		
		public function get_available_followers($company_id = null, $project_id = null)
		{
			$available_followers = array();
			
			$query = $this->db->query("SELECT account_id, account_fname, account_lname FROM accounts WHERE account_isadmin = '1' AND account_id NOT IN (SELECT account_id FROM projects_followers WHERE project_id = '$project_id')");
			
			if($this->Permissions_Model->is_admin())
			{
				if($query->num_rows() > 0)
				{
					$available_followers['admins'] = $query->result_array();
				}
			}
			
			$query = $this->db->query("SELECT t1.account_id, t2.account_fname, t2.account_lname FROM companies_accounts AS t1 LEFT JOIN accounts AS t2 ON t2.account_id = t1.account_id WHERE t1.company_id = '$company_id' AND t1.account_id NOT IN (SELECT account_id FROM projects_followers WHERE project_id = '$project_id')");
			
			if($query->num_rows() > 0)
			{
				$available_followers['members'] = $query->result_array();
			}
			
			// $query = $this->db->query("SELECT t1.team_id, t1.team_name FROM teams AS t1 WHERE t1.company_id = '$company_id'");
			
			// if($query->num_rows() > 0)
			// {
				// $available_followers['teams'] = $query->result_array();
			// }
			
			return $available_followers;
		}
		
		/*
		| Getting followers for current selected project
		*/
		
		public function get_followers($project_id)
		{
			$query = $this->db->query("SELECT t1.project_follower_email_notifications, t1.project_follower_text_notifications, t2.account_id, t2.account_fname, t2.account_lname FROM projects_followers AS t1 LEFT JOIN accounts AS t2 ON t2.account_id = t1.account_id WHERE t1.project_id = '$project_id'");
			
			if($query->num_rows() == 0)
			{
				return FALSE;
			}
			else
			{
				$this->results = $query->result_array();
				return TRUE;
			}
		}
		
		/*****
		/* Get an array of all the people that have been added as subscribers
		/* to a particular task in a project
		/*
		/* 	@author: George
		/* 	@return: onSuccess { array }
		/*				onError { (bool) false }
		*****/
		
		public function get_task_subscribers($task_id) {
			$query = $this->db->query("SELECT t1.account_id, t2.account_fname, t2.account_lname, t2.account_avatar FROM projects_tasks_subscribers AS t1 LEFT JOIN accounts AS t2 ON t2.account_id = t1.account_id WHERE t1.project_task_id = '$task_id'");
			
			if($query->num_rows() != 0) {
				return $query->result_array();
			} else {
				return false;
			}
		}
		
		
		public function get_file_type_icon($file_type)
		{
			$query = $this->db->query("SELECT project_file_type_icon FROM projects_files_types WHERE project_file_type_name = '$file_type'");
			
			if($query->num_rows() == 1)
			{
				$result = $query->row_array();
				return $result['project_file_type_icon'];
			}
			else
			{
				return 'fa-file';
			}
		}
		public function create_project_file($data)
		{
			$this->db->insert('projects_files', $data);
			
			if($this->db->affected_rows() > 0)
			{
				return TRUE;
			}
			else
			{
				echo $this->db->error();
				return FALSE;
			}
		}
		
		public function update_project_file($data)
		{
		}
		
		public function get_files($project_id)
		{
			$query = $this->db->query("SELECT project_file_id, project_file_name, project_file_size, project_file_type FROM projects_files WHERE project_id = '$project_id'");
			$this->results = $query->result_array();
			return TRUE;
		}
	}
	
?>