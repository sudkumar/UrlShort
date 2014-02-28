<?php
session_start();
require 'connect.php';	

	$last_id = $_SESSION['code'];

	unset($_SESSION['code']);

	$query = "SELECT urls FROM url WHERE id =\"$last_id\"";
	$query_run = mysql_query($query);
	$row = mysql_fetch_assoc($query_run);
	$direct = $row['urls'];
	header('Location:'.$direct );
 	
 	
 	
?>	