<?php

	class Teams extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Teams_Model');
		}
		
		public function index()
		{
			$data = array
			(
				'webpage_title' => 'Teams',
				'style' => ' be-color-header be-color-header-warning',
				'members' => $this->Teams_Model->get_team($this->session->userdata('account_id'))
			);
			
			$this->load->template('teams/view_teams', $data);
		}
		
		public function add_member($account_id)
		{
			$this->load->model('Accounts_Model');
			$this->form_validation->set_rules('account_name', 'Full name', 'required');
			$this->form_validation->set_rules('account_phone', 'Phone', 'required|is_unique[accounts.account_phone]|regex_match[/^[0-9]{11}$/]');
			$this->form_validation->set_rules('account_email', 'Email', 'required|valid_email|is_unique[accounts.account_email]');
			$this->form_validation->set_rules('account_password', 'Password', 'required');
			
			if ($this->form_validation->run() === FALSE)
			{	
				echo validation_errors();
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
					'account_group_id' => get_setting('default_user_group_id'),
					'account_parent'	=>	$account_id,
					'account_fname' => $account_fname,
					'account_lname' => $account_lname,
					'account_email' => $this->input->post('account_email'),
					'account_phone' => $account_phone,
					'account_password' => password_encrypt($this->input->post('account_password')),
					'account_code'	=>	$account_code,
					'account_avatar'	=>	$this->Accounts_Model->get_random_avatar(),
					'account_created' => date('Y-m-d H:i:s')
				);
				
				if($this->Accounts_Model->register_account($data)==true)
				{
					$this->load->model('SMS_Model');
					$this->SMS_Model->send_sms($account_phone, 'Hello ' . $account_fname . '! Your email address to access The Panel @ Package7 is ' . $this->input->post('account_email') . ' with ' . $this->input->post('account_password') . ' as a password.');
					
					echo 'gata';
				}
				else
				{
					
				}
			}
			
		}
	}
	
?>