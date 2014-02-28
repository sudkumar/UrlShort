<head>
	<title>shortMe</title>
	<link type="text/css" rel="stylesheet" href="shortmyurl.css"/>
</head>
<body style="  text-align: center;">
<div class="wrapper">
<form action="shortmyurl.php" method="POST">
	<label for="long_url">Enter url here. <br></label>
	<input type="text" id="long_url" name="long_url" placeholder="http://www.google.com" value=""> &nbsp; &nbsp;
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
	$hostname = htmlentities($_POST["long_url"]);
	$_SESSION['input_hostname'] = $hostname;	
	$hashed_hostname = md5($hostname);
	
	$key = substr($hashed_hostname, 0, 5);
	
	
	$query = "SELECT id FROM url WHERE urls =\"$hostname\"";
	$query_run = mysql_query($query);
		
	if(mysql_num_rows($query_run) != NULL) {
		
	}else {
		$query = "INSERT INTO url VALUES (\"$key\", \"$hostname\")";
		mysql_query($query);
			
	$handle = fopen($key.".php", 'w'); 
		
	$string = "
	<?php
		session_start();
		\$_SESSION['code'] = \"{$key}\";
		header('Location: url_redig.php'); 
	?> ";	
	fwrite($handle,$string );
	fclose($handle);
	}	
	echo '<span>Find your requested short url bellow</span> <br /><br />';
	echo '<span id="shorted">',$myhost,$script_name,$key,'.php</span><br />';

}	
?>
</section>
</div>
</body>