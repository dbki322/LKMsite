<?php
	session_start(); 
	$host = "localhost";
	$user = "o909001n_lkm";
	$password = "admin1";
	$db_name = "o909001n_lkm";
	$connect = mysql_connect($host, $user, $password, $db_name) or die(mysql_error());
	mysql_select_db($db_name, $connect) or die(mysql_error());
?>