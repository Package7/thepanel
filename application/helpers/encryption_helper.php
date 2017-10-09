<?php

	function password_encrypt($password)
	{
		$algorithm 	= 	PASSWORD_BCRYPT;
		$options 	= 	['cost' => 12];
		return password_hash($password, $algorithm, $options);
	}
	
?>