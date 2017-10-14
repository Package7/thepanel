<?php
	use \DrewM\MailChimp\MailChimp;
	
	class Accounts extends CI_Controller
	{
		public $default_mailchimp_list = '6b72c053d5';
		public function __construct()
		{
			parent::__construct();
			
			$this->load->model('Accounts_Model');
		}
		
		public function index()
		{
			$data = array
			(
				'webpage_title'	=>	'Accounts',
				'accounts'	=>	$this->Accounts_Model->get_accounts()
			);
			
			$this->load->template('accounts/view_accounts', $data);
		}
		
		public function view_account($account_id)
		{
			$this->load->model('Permissions_Model'); 
			$account = $this->Accounts_Model->get_account($account_id);
			$permissions = $this->Permissions_Model->get_roles_categories();
			
			$data = array
			(
				'webpage_title' => 'Name',
				'account'	=>	$account,
				'permissions'	=>	$permissions
			);
			
			$this->load->template('accounts/view_account', $data);
		}
		
		
		
		public function login_page()
		{
			$this->form_validation->set_rules('login_email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('login_password', 'Password', 'required|callback_valid_account');
			
			if($this->form_validation->run() === FALSE)
			{
				$this->load->view('accounts/login');
			}
			else
			{
				redirect('/');
			}
		}
		
		public function valid_account()
		{
			$data = array
			(
				'account_email' => $this->input->post('login_email'),
				'account_password' => $this->input->post('login_password')
			);
			$result = $this->Accounts_Model->login_account($data);
			
			if($result==false)
			{
				$this->form_validation->set_message('valid_account', 'Invalid username or password');
				return false;
			}
			else
			{
				$session_array = array
				(
					'account_loggedin'	=>	true,
					'account_id' 		=>	$result->account_id,
					'account_parent' 	=>	$result->account_parent,
					'account_fname' 	=>	$result->account_fname,
					'account_lname' 	=>	$result->account_lname,
					'account_email' 	=>	$result->account_email,
					'account_phone' 	=>	$result->account_phone,
					'account_group_id'	=>	$result->account_group_id,
					'account_isadmin'	=>	$result->account_isadmin
				);
				
				$this->session->set_userdata($session_array);
				return true;
			}
		}
		
		public function register_page()
		{
			
			
			$this->form_validation->set_rules('account_name', 'Full name', 'required');
			$this->form_validation->set_rules('account_phone', 'Phone', 'required|is_unique[accounts.account_phone]|regex_match[/^[0-9]{11}$/]');
			$this->form_validation->set_rules('account_email', 'Email', 'required|valid_email|is_unique[accounts.account_email]');
			$this->form_validation->set_rules('account_password', 'Password', 'required');
			
			if ($this->form_validation->run() === FALSE)
			{	
				$this->load->view('accounts/register');
			}
			else
			{
				$account_name = explode(' ', $this->input->post('account_name'));
				
				if(count($account_name)==2)
				{
					$account_fname = $account_name[0];
					$account_lname	= $account_name[1];
				}
				else // multiple names
				{
					$account_fname = array();
					
					foreach($account_name as $name)
					{
						// remove last name
						if($name!=$account_name[count($account_name)-1])
						{
							array_push($account_fname, $name);
						}
					}
					
					$account_fname = implode(' ', $account_fname);
					$account_lname = $account_name[count($account_name)-1]; // Last chunk from the array will be the last name
				}
				
				$account_phone = $this->input->post('account_phone');
				$account_code = $this->Accounts_Model->generate_verification_code();
				
				$data = array
				(
					'account_group_id' 		=> 	get_setting('default_user_group_id'),
					'account_fname' 		=> 	$account_fname,
					'account_lname' 		=> 	$account_lname,
					'account_email' 		=> 	$this->input->post('account_email'),
					'account_email_code' 	=> 	$this->Accounts_Model->generate_verification_code(),
					'account_phone' 		=> 	$account_phone,
					'account_phone_code' 	=> 	$this->Accounts_Model->generate_verification_code(),
					'account_password' 		=> 	password_encrypt($this->input->post('account_password')),
					'account_avatar'		=>	$this->Accounts_Model->get_random_avatar(),
					'account_created' 		=> 	date('Y-m-d H:i:s')
				);
				
				if($this->Accounts_Model->register_account($data)==true)
				{
					// load email model
					$this->load->model('Emails_Model');
					$this->Emails_Model->send_activation_code($this->input->post('account_email'), $data['account_email_code']);
					
					$this->load->model('SMS_Model');
					$this->SMS_Model->send_sms($account_phone, $data['account_phone_code'] . ' is your MyPrintPanel.com account activation code');
					
					redirect('/activate');
				}
			}
		}
		
		public function activate_page()
		{
			$this->form_validation->set_rules('account_code', 'Activation code', 'required');
			
			if ($this->form_validation->run() === FALSE)
			{	
				$data['account_code'] = $this->uri->segment(2);
				$this->load->template('accounts/activate', $data);
			}
			else
			{
				if($this->Accounts_Model->activate_account($this->input->post('account_code')))
				{
					redirect('/login?activated=true');
				}
				else
				{
					redirect('/login?activated=false');
				}
			}
		}
		
		public function logout()
		{
			$session_array = array();
			$this->session->unset_userdata('loggedin', $session_array);
			session_destroy();
			redirect('/');
		}
		
		public function view()
		{
			$account_id = $this->session->userdata('account_id');
			
			$account = $this->Accounts_Model->get_account($account_id);
			
			$data = array
			(
				'webpage_title' => 'Account',
				'account' => $account
			);
			
			$this->load->template('accounts/view', $data);
		}
		
		public function activate()
		{
		}
		
		public function login()
		{
		}
		
		public function forgot_password()
		{
			$this->load->template('accounts/forgot_password');
		}
		
		public function edit_account()
		{
			echo 'edit account';
		}
	}
	
?>