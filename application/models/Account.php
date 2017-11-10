<?php

	class Account extends CI_Model {
		public $account_id			=	null;
		public $account_name 		=	null;
		public $account_fname 		= 	null;
		public $account_lname 		= 	null;
		public $account_email 		= 	null;
		public $account_phone 		= 	null;
		public $account_group 		= 	array();
		public $account_companies 	= 	array();
		public $account_projects	=	array();
		
		public function __construct() {
			$account_id = $this->session->userdata('account_id');
			
			if(isset($account_id) && is_numeric($account_id)) {
				$this->account_id = $account_id;
				$this->get_account();
			}
		}
		
		public function get_account() {
			$query = $this->db->select('account_id, account_group_id, account_fname, account_lname, account_email, account_phone')->get_where('accounts', array('account_id' => $this->account_id));
			
			if($query->num_rows() == 1) {
				$result = $query->row_array();
				$this->account_name 		= 	$result['account_fname'] . ' ' . $result['account_lname'];
				$this->account_fname 		= 	$result['account_fname'];
				$this->account_lname 		= 	$result['account_lname'];
				$this->account_email 		= 	$result['account_email'];
				$this->account_phone 		= 	$result['account_phone'];
				$this->account_group		=	$this->get_account_group($result['account_group_id']);
				$this->account_companies 	= 	$this->get_companies($result['account_id']);
				$this->account_projects 	= 	$this->get_projects($result['account_id']);
			}
		}
		
		public function get_account_group($account_group_id) {
			$query = $this->db->select('account_group_id, account_group_name')->get_where('accounts_groups', array('account_group_id' => $account_group_id));
			
			if($query->num_rows() == 1) {
				$result = $query->row_array();
				$account_group['id'] = $result['account_group_id'];
				$account_group['name'] = $result['account_group_name'];
				return $account_group;
			}
		}
		
		public function get_companies($account_id) {
			$query = $this->db->query("SELECT t2.company_name, t2.company_registration_number FROM companies_accounts AS t1 LEFT JOIN companies AS t2 ON t2.company_id = t1.company_id WHERE t1.account_id = '$account_id'");
			
			if($query->num_rows() != 0) {
				$results = $query->result_array();
				return $results;
			}
		}
		
		public function get_projects($account_id) {
			$query = $this->db->query("SELECT t2.project_name, t2.project_tasks_count, t2.project_files_count, t2.project_notes_count FROM projects_followers AS t1 LEFT JOIN projects AS t2 ON t2.project_id = t1.project_id WHERE t1.account_id = '$account_id'");
			
			if($query->num_rows() != 0) {
				$results = $query->result_array();
				return $results;
			}
		}
		
		public function debug() {
			print_r(get_object_vars($this));
		}
	}
	
?>