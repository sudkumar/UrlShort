<?php 
if(mysql_connect($server = "localhost", $username = "root", $password = "")) {			
		$short_db = "url_short";
		if(mysql_select_db($short_db)) {	
		}else {
			// create the database and also create that table 
			$query = "CREATE DATABASE $short_db ";	
			mysql_query($query);
			mysql_select_db($short_db);
			$new_query = "CREATE TABLE url(
				id varchar(5),
				urls varchar(100),
				PRIMARY KEY(id)	 				
			)";
			mysql_query($new_query);
		}
}else {
	echo mysql_error();
}