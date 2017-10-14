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
		public $last_inserted_id = null;
		
		public function __construct()
		{
			parent::__construct();
		}
		
		public function get_companies($account_id = null)
		{
			if($account_id === null)
			{
				$query = $this->db->query("SELECT company_name, company_address, company_city, company_postcode FROM companies ORDER BY company_created DESC");
			}
			else
			{
				$query = $this->db->query("SELECT t2.company_name, t2.company_address, t2.company_city, t2.company_postcode FROM companies_accounts AS t1 LEFT JOIN companies AS t2 ON t2.company_id=t1.company_id WHERE t1.account_id = '$account_id' ORDER BY company_created DESC");
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
		
		/*
		| @return bool
		*/
		
		public function add_company($data)
		{
			if($this->db->insert('companies', $data) && $this->db->affected_rows()==1)
			{
				$this->last_inserted_id = $this->db->insert_id();
				return true;
			}
			else
			{
				return false;
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
	}
	
?>