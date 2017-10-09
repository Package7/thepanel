<?php

	class Accounts_Model extends CI_Model
	{
		public $_LastAccountId = NULL;
		
		public function __construct()
		{
			parent::__construct();
		}
		
		public function get_account($account_id)
		{
			$query = $this->db->select('*')->get_where('accounts', array('account_id' => $account_id));
			
			if($query && $query->num_rows()==1)
			{
				return $query->row_array();
			}
			else
			{
				return 'Generic error';
			}
		}
		
		public function register_account($data)
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
		
		public function activate_account($account_code)
		{
			$query = $this->db->select('account_code')->where('account_code', $account_code)->get('accounts');
			if($query->num_rows()==1)
			{
				
				if($this->db->where('account_code', $account_code)->update('accounts', array('account_phone_verified' => 1)) && $this->db->affected_rows()==1)
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
		
		public function login_account($data)
		{
			$query = $this->db->select('account_id, account_group_id, account_parent, account_fname, account_lname, account_email, account_phone, account_password, account_isadmin')->get_where('accounts', array('account_email' => $data['account_email']));
			 
			if($query->num_rows()==1)
			{
				$result = $query->row();
				
				if(password_verify($data['account_password'], $result->account_password))
				{
					return $result;
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
		
		public function get_permission($account_group_id, $account_role_code)
		{
			try
			{
				$query = $this->db->query("SELECT account_permission_value FROM accounts_permissions WHERE account_group_id='$account_group_id' AND account_role_id=(SELECT account_role_id FROM accounts_roles WHERE account_role_code='$account_role_code')");
				
				if($query->num_rows() == 1)
				{
					$result = $query->row_array();
					
					if(intval($result['account_permission_value'])===0)
					{
						return false;
					}
					else
					{
						return true;
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

		public function get_random_avatar()
		{
			$avatars = array ('avatar1.png', 'avatar2.png', 'avatar3.png', 'avatar4.png', 'avatar5.png', 'avatar6.png');
			return $avatars[rand(0,count($avatars)-1)];
		}
		
		/*
		* Author: George Dobre
		* Contact: +44 7841 582 659 <george@package7.com>
		* Description: This function generates a 5 char long alphanumeric code
		* that is sent to the user to validate phone number and/or email
		* address.
		* Last modified by: George Dobre
		*/
		
		function crypto_rand_secure($min, $max)
		{
			$range = $max - $min;
			if ($range < 1) return $min; // not so random...
			$log = ceil(log($range, 2));
			$bytes = (int) ($log / 8) + 1; // length in bytes
			$bits = (int) $log + 1; // length in bits
			$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
			do 
			{
				$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
				$rnd = $rnd & $filter; // discard irrelevant bits
			} while ($rnd > $range);
			
			return $min + $rnd;
		}

		function getToken($length)
		{
			$token = "";
			$codeAlphabet = "ABCDEFGHJKLMNPQRSTUVWXYZ"; // removed I and O's for confussion I = 1; O = 0;
			$codeAlphabet.= "0123456789";
			$max = strlen($codeAlphabet); // edited

			for ($i=0; $i < $length; $i++) {
				$token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
			}

			return $token;
		}
		
		public function generate_verification_code()
		{
			return strtoupper($this->getToken(5));
		}
	}