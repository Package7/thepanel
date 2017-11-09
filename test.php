<?php

	$array1 = array('1' => 1, '2' => 2);
	$array2 = array('2' => 2, '3' => 3, '4' => 4);
	
	echo '<pre>';
	print_r(array_diff_assoc($array2, $array1));
	echo '</pre>';
	
?>