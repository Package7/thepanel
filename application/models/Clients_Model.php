<?php

	class Clients_Model extends CI_Model
	{
		
		public function get_clients()
		{
			try {
				$query = $this->db->select('*')->from('clients')->get()->result_array();
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