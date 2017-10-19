<?php

	class Teams_Model extends CI_Model
	{
		public $message;
		public $error;
		public $results;
		public $last_inserted_id;
		
		public function __construct()
		{
			parent::__construct();
		}
		
		public function create_team($data)
		{
			try
			{
				$this->db->trans_begin();
				
				$this->db->insert('teams', array
				(
					'company_id'	=>	$data['company_id'],
					'account_id'	=>	$data['account_id'],
					'team_name'		=>	$data['team_name'],
					'team_created'	=>	$data['team_created']
				));
				
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
			catch(Exception $ex)
			{
				$this->message = 'Generic error';
				$this->error = $ex->getMessage();
				return false;
			}
		}
		
		public function get_teams($company_id = null)
		{
			try
			{
				if($company_id == null)
				{
				}
				else
				{
					$query = $this->db->query("SELECT * FROM teams WHERE company_id = '$company_id' ORDER BY team_created DESC");
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
				return false;
			}
		}
	}
	
?>