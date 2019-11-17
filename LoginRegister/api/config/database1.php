<?php

	 $c = 'error'; 
     $mysql_host = 'localhost';
	 $mysql_user = 'root';
	 $mysql_pass = '';
	 $mysql_db = 'cafedb';
	 
     $conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db) or die($c);
	 
     echo 'connected';
 
?>