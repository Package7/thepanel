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
	}
	
?>