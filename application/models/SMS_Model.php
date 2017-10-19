<?php

	use Textmagic\Services\TextmagicRestClient;
	
	class SMS_Model extends CI_Model
	{
		private $TextMagic_Instance;
		private $TextMagic_Username = 'georgedobre';
		private $TextMagic_ApiKey = 'C5KvSLPIFte3MX9kYR4y1nH0fzu0nK';
		
		public function __construct()
		{
			parent::__construct();
			$this->TextMagic_Instance = new TextmagicRestClient($this->TextMagic_Username, $this->TextMagic_ApiKey);
		}
		
		public function send_sms($phone = '07841582659', $message)
		{ 
			if(substr($phone, 0, 1)=='0')
			{
				$phone = ltrim($phone, '0');
				$phone = '+44' . $phone;
			}
			
			$result = '';
			
			try 
			{
				$result = $this->TextMagic_Instance->messages->create(
					array(
						'from' => 'Package7',
						'text' => $message,
						'phones' => implode(', ', array($phone))
					)
				);
			}
			catch (\Exception $e) {
				if ($e instanceof RestException) {
					print '[ERROR] ' . $e->getMessage() . "\n";
					foreach ($e->getErrors() as $key => $value) {
						print '[' . $key . '] ' . implode(',', $value) . "\n";
					}
				} else {
					print '[ERROR] ' . $e->getMessage() . "\n";
				}
				return;
			}
			// echo $result['id'];
		}
	}
	
?>