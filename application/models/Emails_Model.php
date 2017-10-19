<?php

	class Emails_Model extends CI_Model
	{
		private $Mandrill_ApiKey = '9GsiyTScJIMKu2CeBpELmg';
		private $Mailchimp_ApiKey = '';
		private $Mandrill = NULL;
		
		public function __construct()
		{
			parent::__construct();
			$this->Mandrill_ApiKey = get_setting('mandrill_api_key');
			$this->Mandrill = new Mandrill($this->Mandrill_ApiKey);
		}
		
		public function send_template2($to, $merge_vars = array())
		{
			$message = array
			(
				'html' => '<p>Example HTML content</p>',
				'text' => 'Example text content',
				'subject' => 'example subject',
				'from_email' => 'office@myprintpanel.com',
				'from_name' => 'MyPrintPanel',
				'to' => array
				(
					array
					(
						'email' => $email,
						'name' => 'George Dobre',
						'type' => 'to'
					)
				),
				'headers' => array('Reply-To' => 'no-reply@thepanel.package7.com'),
			);
		}
		
		public function send_activation_code($data)
		{
			$template_content = array
			(
				array
				(
					'name' => 'example name',
					'content' => 'example content'
				)
			);
			
			$message = array
			(
				'subject' => 'Email address activation code',
				'from_email' => 'no-reply@thepanel.package7.com',
				'from_name' => 'Package7',
				'to' => array
				(
					array
					(
						'email' => $data['account_email'],
						'name' => $data['account_fname'] . ' ' . $data['account_lname'],
						'type' => 'to'
					)
				),
				'headers' => array('Reply-To' => 'no-reply@thepanel.package7.com'),
				'merge_vars' => array
				(
					array(
						'rcpt' => $data['account_email'],
						'vars' => array
						(
							array
							(
								'name' => 'ACCOUNT_FNAME',
								'content' => $data['account_fname']
							),
							array
							(
								'name' => 'EMAIL_ACTIVATION_CODE',
								'content' => $data['account_email_code']
							),
							array
							(
								'name' => 'EMAIL_ACTIVATION_CODE_URL',
								'content' => '//thepanel.package7.com/activate/' . $data['account_email_code']
							)
						)
					)
				)
			);
			
			$async = false;
			$ip_pool = 'Main Pool';
			$result = $this->Mandrill->messages->sendTemplate('package7-email-activation-code', $template_content, $message, $async, $ip_pool);
			// return print_r($result);
		}
		
		public function send_notification($data)
		{
			$template_content = array
			(
				array
				(
					'name' => 'example name',
					'content' => 'example content'
				)
			);
			
			$message = array
			(
				'subject' => 'Welcome to The Panel by Package7',
				'from_email' => 'no-reply@thepanel.package7.com',
				'from_name' => 'Package7',
				'to' => array
				(
					array
					(
						'email' => $data['account_email'],
						'name' => $data['account_fname'] . ' ' . $data['account_lname'],
						'type' => 'to'
					)
				),
				'headers' => array('Reply-To' => 'no-reply@thepanel.package7.com'),
				'merge_vars' => array
				(
					array(
						'rcpt' => $data['account_email'],
						'vars' => array
						(
							array
							(
								'name' => 'THE_PANEL_USERNAME',
								'content' => $data['account_email']
							),
							array
							(
								'name' => 'THE_PANEL_PASSWORD',
								'content' => $data['account_password']
							)
						)
					)
				)
			);
			
			$async = false;
			$ip_pool = 'Main Pool';
			$result = $this->Mandrill->messages->sendTemplate('package7-new-account-credentials', $template_content, $message, $async, $ip_pool);
			// return print_r($result);
		}
	}
	
?>