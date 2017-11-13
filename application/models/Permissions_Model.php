<?php

	class Permissions_Model extends CI_Model
	{
		public $account_id 			= 	null;
		public $account_group_id 	= 	null;
		
		public function __construct()
		{
			parent::__construct();
			$this->account_id = intval($this->session->userdata('account_id'));
			$this->account_group_id = intval($this->session->userdata('account_group_id'));
		}
		
		public function is_admin()
		{
			try
			{
				$query = $this->db->select('account_isadmin')->from('accounts')->where('account_id', $this->account_id)->get();
				
				if($query->num_rows() == 1)
				{
					$result = $query->row_array();
					
					if(intval($result['account_isadmin'])===1)
					{
						
						return true;
					}
					else
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
			catch(Exception $ex)
			{
			}
			
		}
		
		public function has_access($account_role_code) {
			if($this->check_role_permissions($this->account_group_id, $account_role_code)) {
				return true;
			} else {
				return false;
			}
		}
		
		public function check_role_permissions($account_group_id, $account_role_code) {
			try {
				$query = $this->db->query("SELECT account_permission_value FROM accounts_permissions AS t1 LEFT JOIN accounts_roles AS t2 ON t2.account_role_id = t1.account_role_id WHERE t1.account_group_id = '$account_group_id' AND t2.account_role_code = '$account_role_code'");
			} catch (Exception $ex) {
				return false;
			}
			
			if($query->num_rows() == 1) {
				$account_permission_value = $query->row_array();
				
				if(intval($account_permission_value['account_permission_value']) === 1) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
		
		public function get_permissions($account_id)
		{
			
		}
		
		public function get_roles_categories()
		{
			try {
				$query = $this->db->query("SELECT * FROM accounts_roles_categories");
				
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
	}
	
?>