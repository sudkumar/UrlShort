<?php
session_start();
require 'connect.php';	
	
	// take the session id from directed page
	$last_id = $_SESSION['code'];

	unset($_SESSION['code']);

	// find url from the databaes for corresponding key and re-direct the user
	$query = "SELECT urls FROM url WHERE id =\"$last_id\"";
	$query_run = mysql_query($query);
	$row = mysql_fetch_assoc($query_run);
	$direct = $row['urls'];
	header('Location:http://'.$direct );
 	
 	
 	
?>	