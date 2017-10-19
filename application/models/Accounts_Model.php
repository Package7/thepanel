<?php

	class Accounts_Model extends CI_Model
	{
		public $_LastAccountId 		= 	NULL;
		public $message				=	NULL;
		public $results 			= 	NULL;
		public $last_inserted_id	=	NULL;
		
		public function __construct()
		{
			parent::__construct();
		}
		
		public function get_accounts($company_id = null)
		{
			try
			{
				if($company_id == null)
				{
					$query = $this->db->query("SELECT * FROM accounts ORDER BY account_created DESC");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM companies_accounts AS t1 LEFT JOIN accounts AS t2 ON t2.account_id = t1.account_id WHERE t1.company_id = '$company_id' ORDER BY t2.account_created DESC");
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
			catch(Exception $ex)
			{
				$this->message = $ex->getMessage();
				return false;
			}
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
			try
			{
				if(is_numeric($data['company_id']))
				{
					$this->db->trans_begin();
					
					$this->db->insert('accounts', array
					(
						'account_group_id' 		=> 	$data['account_group_id'],
						'account_fname' 		=> 	$data['account_fname'],
						'account_lname' 		=> 	$data['account_lname'],
						'account_email' 		=> 	$data['account_email'],
						'account_email_code' 	=> 	$data['account_email_code'],
						'account_phone' 		=> 	$data['account_phone'],
						'account_phone_code' 	=> 	$data['account_phone_code'],
						'account_password' 		=> 	$data['account_password'],
						'account_avatar'		=>	$data['account_avatar'],
						'account_created' 		=> 	$data['account_created']
					));
					
					$this->last_inserted_id = $this->db->insert_id();
					
					$this->db->insert('companies_accounts', array
					(
						'company_id'				=>	$data['company_id'],
						'account_id'				=>	$this->last_inserted_id,
						'company_account_isdefault'	=>	1
					));
					
					if ($this->db->trans_status() === FALSE)
					{
						$this->db->trans_rollback();
						return false;
					}
					else
					{
						$this->db->trans_commit();
						return true;
					}
					echo 'aici1';
				}
				else
				{
					if($this->db->insert('accounts', array
					(
						'account_group_id' 		=> 	$data['account_group_id'],
						'account_fname' 		=> 	$data['account_fname'],
						'account_lname' 		=> 	$data['account_lname'],
						'account_email' 		=> 	$data['account_email'],
						'account_email_code' 	=> 	$data['account_email_code'],
						'account_phone' 		=> 	$data['account_phone'],
						'account_phone_code' 	=> 	$data['account_phone_code'],
						'account_password' 		=> 	$data['account_password'],
						'account_avatar'		=>	$data['account_avatar'],
						'account_created' 		=> 	$data['account_created']
					)) && $this->db->affected_rows()==1)
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
			catch(Exception $ex)
			{
				$this->errors = 'Generic error. Please contact support';
				$this->message = $ex->getMessage();
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
			$query = $this->db->select('account_id, account_group_id, account_fname, account_lname, account_email, account_phone, account_password, account_isadmin')->get_where('accounts', array('account_email' => $data['account_email']));
			 
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
		
		public function get_default_company_id($account_id)
		{
			try
			{
				$query = $this->db->query("SELECT company_id FROM companies_accounts WHERE account_id = '$account_id' AND company_account_isdefault = '1'");
				
				if($query->num_rows() == 1)
				{
					$result = $query->row_array();
					$this->results = $result['company_id'];
					return true;
				}
				else
				{
					return false;
				}
			}
			catch(Exception $ex)
			{
				$this->errors = $ex->getMessage();
				return false;
			}
		}
		
		public function get_default_company($account_id)
		{
			try
			{
				$query = $this->db->query("SELECT t1.company_id, t2.company_name, t2.company_registration_number, t2.company_stripe_id FROM companies_accounts AS t1 LEFT JOIN companies AS t2 ON t2.company_id=t1.company_id WHERE t1.account_id = '$account_id' AND t1.company_account_isdefault = '1'");
				
				if($query->num_rows() == 1)
				{
					$this->results = $query->row_array();
					return true;
				}
				else
				{
					return false;
				}
			}
			catch(Exception $ex)
			{
				$this->errors = $ex->getMessage();
				return false;
			}
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