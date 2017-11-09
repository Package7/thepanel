<?php
$file = $_GET['url']; 

header("Content-Description: File Transfer"); 
header("Content-Type: application/octet-stream"); 
header("Content-Disposition: attachment; filename='" . basename($file) . "'"); 

readfile ($file);
exit(); 
?>