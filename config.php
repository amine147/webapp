<?php

	require_once("database.class.php");
	$dbhost ="localhost";
	$user="root";
	$database="cafetteApp";
	$password="";
		$db = new Mysqlidb(
		$dbhost, 
		$user, 
		$password, 
		$database
	);
?>