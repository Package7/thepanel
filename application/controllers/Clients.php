<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Clients extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Clients_Model'); 
			$this->load->model('Accounts_Model'); 
		}
		
		public function index()
		{
			if($this->Accounts_Model->get_permission($this->session->userdata('account_group_id'), 'view_clients')===true)
			{
				$data = array
				(
					'webpage_title' => 'Clients',
					'clients' => $this->Clients_Model->get_clients()
				);
				
				$this->load->template('clients/view_clients', $data);
			}
			else
			{
				redirect('/');
			}
		}
		
		public function add_clients()
		{
			$data = array
			(
				'webpage_title' => 'Add client'
			); 
			
			// account validation
			$this->form_validation->set_rules('account_name', 'Full name', 'required');
			$this->form_validation->set_rules('account_phone', 'Phone', 'required|is_unique[accounts.account_phone]|regex_match[/^[0-9]{11}$/]');
			$this->form_validation->set_rules('account_email', 'Email', 'required|valid_email|is_unique[accounts.account_email]');
			$this->form_validation->set_rules('account_password', 'Password', 'required');
			
			// company validation
			$this->form_validation->set_rules('client_company', 'Company name', 'required');
			$this->form_validation->set_rules('client_company_address', 'Company address', 'required');
			$this->form_validation->set_rules('client_company_city', 'Company city', 'required');
			$this->form_validation->set_rules('client_company_state', 'Company state', 'required');
			$this->form_validation->set_rules('client_company_postcode', 'Company postcode', 'required');
			
			if ($this->form_validation->run() === FALSE)
			{	
				$this->load->template('clients/add_clients', $data);
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
				
				$this->load->model('Accounts_Model'); // loading Accounts Model
				
				$account_phone = $this->input->post('account_phone');
				$account_code = $this->Accounts_Model->generate_verification_code();
				
				$data = array
				(
					'account_group_id' => get_setting('default_user_group_id'),
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
					// load email model
					// $this->load->model('Emails_Model');
					// $this->Emails_Model->send_activation_code($this->input->post('account_email'), $account_code);
					
					// $this->load->model('SMS_Model');
					// $this->SMS_Model->send_sms($account_phone, $account_code . ' is your ' . get_website_title() . ' account activation code');
					
					$data = array
					(
						'account_id'				=> 	$this->Accounts_Model->_LastAccountId,
						'client_company' 			=> 	$this->input->post('client_company'),
						'client_company_address' 	=> 	$this->input->post('client_company_address'),
						'client_company_city'		=> 	$this->input->post('client_company_city'),
						'client_company_postcode'	=>	$this->input->post('client_company_postcode')		
					);
					
					// register company for account
					$this->Clients_Model->add_client($data);
					
					redirect('/clients');
				}
			}
		}
	}
	
?>