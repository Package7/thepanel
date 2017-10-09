<?php

	class Clients_Model extends CI_Model
	{
		
		public function get_clients()
		{
			try {
				$query = $this->db->query("SELECT *, COUNT(t2.project_id) AS projects_count, COUNT(t3.account_id) AS accounts_count FROM clients AS t1 LEFT JOIN projects AS t2 ON t2.client_id=t1.client_id LEFT JOIN accounts AS t3 ON t3.client_id=t1.client_id");
				$query = $query->result_array();
				return $query;
			} catch(Exception $ex) {
			}
		}
		
		public function add_client($data)
		{
			if($this->db->insert('clients', $data) && $this->db->affected_rows()==1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		public function get_client($client_id)
		{
			try
			{
				$query = $this->db->query("SELECT * FROM clients WHERE client_id='$client_id'");
				
				if($query->num_rows() == 1)
				{
					return $query->row_array();
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
		
		public function get_team($client_id)
		{
			try
			{
				$query = $this->db->query("SELECT account_id, account_fname, account_lname, account_avatar FROM accounts WHERE client_id='$client_id'");
				
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
			}
		}
	}
	
?>