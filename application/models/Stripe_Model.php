<?php

	class Stripe_Model extends CI_Model
	{
		public $stripe_instance		=	null;
		public $stripe_secret_key 	= 	null;
		public $stripe_public_key 	= 	null;
		public $stripe_response		=	null;
		
		public function __construct()
		{
			parent::__construct();
			
			$stripe_secret_key = get_setting('stripe_secret_key');
			$stripe_public_key = get_setting('stripe_public_key');
			
			if($stripe_secret_key!=false)
			{
				$this->stripe_secret_key = $stripe_secret_key;
			}
			else
			{
				exit('Stripe secret key error');
			}
			
			if($stripe_public_key)
			{
				$this->stripe_public_key = $stripe_public_key;
			}
			else
			{
				exit('Stripe public key error');
			} 
			
			$this->stripe_instance = \Stripe\Stripe::setApiKey($this->stripe_secret_key);
		}
		
		public function create_customer($data)
		{
			try
			{
				$customer = \Stripe\Customer::create(array
				(
					'email' 		=> 	$this->session->userdata('account_email'),
					'description'	=>	'The Panel account for ' . $data['company_name'],
					'metadata'		=>	array
					(
						'company_registration_number' => $data['company_registration_number']
					),
					'shipping'		=>	array
					(
						'address'	=>	array
						(
							'line1'			=> 	$data['company_address'],
							'city'			=>	$data['company_city'],
							'postal_code'	=>	$data['company_postcode']
						),
						'name'		=>	$data['company_name']
					)
				));
				
				$this->stripe_response = $customer;
				
				return true;
			}
			catch(Exception $ex)
			{
				$this->stripe_response = $ex->getMessage();
				return false;
			}
		}
		
		public function get_customer($stripe_id)
		{
			try
			{
				$customer = \Stripe\Customer::retrieve($stripe_id);
				$this->stripe_response = $customer;
				return true;
			}
			catch(Exception $ex)
			{
				$this->stripe_response = $ex->getMessage();
				return false;
			}
		}
	}