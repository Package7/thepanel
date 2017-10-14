<?php

	class Permissions_Model extends CI_Model
	{
		public $account_id = null;
		
		public function __construct()
		{
			parent::__construct();
			$this->account_id = intval($this->session->userdata('account_id'));
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
		
		public function check_permissions($account_id, $permissions)
		{
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