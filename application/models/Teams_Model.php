<?php

	class Teams_Model extends CI_Model
	{
		public $_LastAccountId = null;
		
		public function __construct()
		{
			parent::__construct();
		}
		
		public function get_team($account_id)
		{
			$query = $this->db->select('*')->get_where('accounts', array('account_parent' => $account_id));
			
			if($query->num_rows()==0)
			{
				return false;
			}
			else
			{
				return $query->result_array();
			}
		}
		
		public function add_member($data)
		{
			if($this->db->insert('accounts', $data) && $this->db->affected_rows()==1)
			{
				$this->_LastAccountId = $this->db->insert_id();
				return true;
			}
			else
			{
				return false;
			}
		}
	}