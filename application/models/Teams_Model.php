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
					$query = $this->db->query("SELECT t1.team_id, t1.company_id, t1.account_id, t1.team_name, t2.company_name, t3.account_fname, t3.account_lname FROM teams AS t1 LEFT JOIN companies AS t2 ON t2.company_id = t1.company_id LEFT JOIN accounts AS t3 ON t3.account_id = t1.account_id WHERE t1.company_id = '$company_id'");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM teams AS t1 LEFT JOIN companies AS t2 ON t2.company_id = t1.company_id WHERE t1.company_id = '$company_id' ORDER BY t1.team_created DESC");
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