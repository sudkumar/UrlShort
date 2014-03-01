<head>
	<title>shortMe</title>
	<link type="text/css" rel="stylesheet" href="shortmyurl.css"/>
</head>
<body style="  text-align: center;">
<div class="wrapper">
<form action="shortmyurl.php" method="POST">
	<label for="long_url">Enter url here. <br></label>
	<input type="text" id="long_url" name="long_url" placeholder="www.google.com" value=""> &nbsp; &nbsp;
	<input type="submit" onclick="storeData()" id="submit" value="shortMe" />
</form>
	<script type="text/javascript">
		function storeData() {
				localStorage.setItem("x", document.getElementById("long_url").value);
		}
		if (localStorage.getItem("x")) {
			document.getElementById("long_url").value = localStorage.getItem("x");
			localStorage.removeItem("x");
		}
	</script>
<section >
<?php
require 'connect.php';
session_start();

	$myhost = $_SERVER["HTTP_HOST"];
	$script_name = $_SERVER['SCRIPT_NAME'];
	$script_array = explode('/',$script_name);
	$length = count($script_array)-1;
	$script_array[$length] = "";
	$script_name = implode('/', $script_array);		
if( isset($_POST["long_url"]) && !empty($_POST["long_url"])){
	$hostname = trim(htmlentities($_POST["long_url"]));	// for security reasons
	$protocol1 = 'http://';
	$protocol2 = 'https://';
	$new_hostname = str_ireplace($protocol1, "", $hostname);		//string replacement case insencetive
	$new_hostname = str_ireplace($protocol2, "",$new_hostname);	
			
	// query for id for the currrent url
	$query = "SELECT id FROM url WHERE urls =\"$new_hostname\"";
	$query_run = mysql_query($query);
		
		
	// url already present or not
	if(mysql_num_rows($query_run) != NULL) {
		$query_raw = mysql_fetch_assoc($query_run);
		$key = $query_raw["id"];
	}else {
		$hashed_hostname = md5($new_hostname);

		//making more options for ids to save
		$half1_hashed_hostname = substr($hashed_hostname, 0, strlen($hashed_hostname)/2);	
		$half2_hashed_hostname = substr($hashed_hostname, strlen($hashed_hostname)/2 + 1, strlen($hashed_hostname)); 
		$up_half2_hashed_hostname = strtoupper($half2_hashed_hostname);
		$hashed_hostname = implode("", array($half1_hashed_hostname, $up_half2_hashed_hostname) );
		$shuffled_hostname = str_shuffle($hashed_hostname);
	
		//take the id (key) and insert it into the database
		$key = substr($shuffled_hostname, 0, 5);
		$query = "INSERT INTO url VALUES (\"$key\", \"$new_hostname\")";
		mysql_query($query);
		
		// make file with current key name as user will be direct to it through url. 	
		$handle = fopen($key.".php", 'w'); 	
		
		// put the current in that file and also store that in session for next re-direction
		$string = "
		<?php
			session_start();
			\$_SESSION['code'] = \"{$key}\";
			header('Location: url_redig.php'); 
		?> ";	
		fwrite($handle,$string );
		fclose($handle);
	}	
	// give shorted url appending to your current directory at server
	echo '<span>Find your requested short url bellow</span> <br /><br />';
	echo '<span id="shorted">',$myhost,$script_name,$key,'.php</span><br />';

}	
?>
</section>
</div>
</body>