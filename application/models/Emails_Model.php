<?php

	class Emails_Model extends CI_Model
	{
		private $Mandrill_ApiKey = '9GsiyTScJIMKu2CeBpELmg';
		private $Mailchimp_ApiKey = '';
		private $Mandrill = NULL;
		
		public function __construct()
		{
			parent::__construct();
			$this->Mandrill = new Mandrill($this->Mandrill_ApiKey);
		}
		
		public function send_template($to, $merge_vars = array())
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
				'headers' => array('Reply-To' => 'office@myprintpanel.com'),
			);
		}
		
		public function send_activation_code($email, $code)
		{
			$mandrill = new Mandrill('9GsiyTScJIMKu2CeBpELmg');
			 $template_content = array(
        array(
            'name' => 'example name',
            'content' => 'example content'
        )
    );
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
				'headers' => array('Reply-To' => 'office@myprintpanel.com'),
				'merge_vars' => array
				(
					array(
						'rcpt' => $email,
						'vars' => array(
							array(
								'name' => 'MC_ACTIVATION_CODE',
								'content' => $code
							),
							array
							(
								'name' => 'MC_ACTIVATION_URL',
								'content' => 'https://myprintpanel.com/activate/' . $code
							)
						)
					)
				)
			);
			
			$async = false;
			$ip_pool = 'Main Pool';
			$result = $mandrill->messages->sendTemplate('myprintpanel-com-activate-email', $template_content, $message, $async, $ip_pool);
			// return print_r($result);
		}
	}
	
?>