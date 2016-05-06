<?php

	require_once("database.class.php");
	$dbhost ="localhost";
	$user="root";
	$database="cafetteApp";
	$password="root";
		$db = new Mysqlidb(
		$dbhost,
		$user, 
		$password,
		$database
	);
?>
