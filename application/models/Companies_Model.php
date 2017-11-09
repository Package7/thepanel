<?php

	/*
	| Module name: Companies
	|
	|	1. get_companies()
	|	2. get_company() - get single company info based on company_id
	|
	*/
	
	class Companies_Model extends CI_Model
	{
		public $results = array();
		public $result = array(); 
		public $errors;
		public $last_inserted_id = null;
		
		public function __construct()
		{
			parent::__construct();
		}
		
		public function get_companies($account_id = null)
		{
			if($account_id === null)
			{
				$query = $this->db->query("SELECT company_id, company_name, company_registration_number, company_address, company_city, company_postcode, company_projects_count, company_teams_count, company_accounts_count FROM companies ORDER BY company_created DESC");
			}
			else
			{
				$query = $this->db->query("SELECT t1.company_account_isdefault, t2.company_id, t2.company_name, t2.company_registration_number, t2.company_address, t2.company_city, t2.company_postcode, t2.company_stripe_id, IFNULL(t2.company_projects_count, 0) AS company_projects_count, t2.company_teams_count, t2.company_accounts_count FROM companies_accounts AS t1 LEFT JOIN companies AS t2 ON t2.company_id=t1.company_id WHERE t1.account_id = '$account_id' ORDER BY company_created DESC");
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
		
		public function get_company($company_id = null)
		{
			$query = $this->db->query("SELECT company_id, company_name, company_slug, company_registration_number, company_address, company_city, company_postcode, company_stripe_id, company_projects_count, company_teams_count, company_accounts_count, company_created FROM companies WHERE company_id = '$company_id'");
			
			if($query->num_rows() == 1)
			{
				$this->result = $query->row_array();
				return true;
			}
			else
			{
				return false;
			}
		}
		
		/*
		| Transaction query
		| If all the MySQL transactions are successfull then (boolean) true is returned.
		| @return bool
		*/
		
		public function add_company($data)
		{
			$this->db->trans_begin();
			
			$this->db->insert('companies', array
			(
				'company_name'					=>	$data['company_name'],
				'company_slug'					=>	slugify($data['company_name']),
				'company_registration_number' 	=> 	$data['company_registration_number'],
				'company_address'				=>	$data['company_address'],
				'company_city' 					=> 	$data['company_city'],
				'company_postcode' 				=> 	$data['company_postcode'],
				'company_stripe_id' 			=> 	$data['company_stripe_id'],
				'company_created' 				=> 	$data['company_created']
			));
			
			$this->last_inserted_id = $this->db->insert_id();
			
			$this->db->insert('companies_accounts', array
			(
				'company_id' 					=> 	$this->last_inserted_id, 
				'account_id' 					=> 	$data['account_id'],
				'company_account_isowner'		=>	$data['company_account_isowner'],
				'company_account_isdefault' 	=> 	$data['company_account_isdefault']
			));
			
			$this->db->insert('projects', array
			(
				'company_id'			=>	$this->last_inserted_id,
				'project_name'			=>	$data['project_name'],
				'project_description'	=>	$data['project_description'],
				'project_created'		=>	$data['project_created'],
				'project_isdefault'		=>	$data['project_isdefault']
			));
			
			$this->db->insert('projects_followers', array
			(
				'project_id'							=>	$this->db->insert_id(),
				'account_id'							=>	$data['account_id'],
				'project_follower_email_notifications'	=>	1,
				'project_follower_text_notifications'	=>	1
			));
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				$this->errors = $this->db->error();
				return false;
			}
			else
			{
				$this->db->trans_commit();
				return true;
			}
		}
		
		public function update_company($company_id, $data)
		{
			$query = $this->db->where('company_id', $company_id)->update('companies', $data);
			
			if($query && $this->db->affected_rows()==1)
			{
				$this->last_inserted_id = $this->db->insert_id();
				return true;
			}
			else
			{
				return false;
			}
		}
		
		public function update_company_column($column, $value, $company_id)
		{
			$this->db->where('company_id', $company_id)->update('companies', array($column => $value));
		}
		
		public function create_company($data)
		{
			$this->db->trans_begin();
			
			$this->db->insert('companies', array
			(
				'company_name'	=>	$data['company_name'],
				'company_registration_number'	=>	$data['company_registration_number'],
				'company_address'				=>	$data['company_address'],
				'company_city'					=>	$data['company_city'],
				'company_postcode'				=>	$data['company_postcde'],
				'company_stripe_id'				=>	$data['company_stripe_id']
			));
			
			$this->db->insert('companies_accounts', array
			(
				'company_id' 				=> 	$this->db->insert_id(),
				'account_id'				=>	$data['account_id'],
				'company_account_isowner'	=>	$data['company_account_isowner'],
				'company_account_isdefault'	=>	$data['company_account_isdefault']
			));
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return FALSE;
			}
			else
			{
				$this->db->trans_commit();
				return TRUE;
			}
		}
		
		public function get_default_company($account_id)
		{
			$query = $this->db->select('company_id')->get_where('companies_accounts', array
			(
				'account_id' 				=> 	$account_id,
				'company_account_isdefault'	=>	1
			));
			
			if($query->num_rows() == 1)
			{
				$this->result = $query->row_array()['company_id'];
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}
	
?>