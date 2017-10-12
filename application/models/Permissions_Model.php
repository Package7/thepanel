<?php

	class Permissions_Model extends CI_Model
	{
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