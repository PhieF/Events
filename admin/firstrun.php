<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../base.php'); 

if(!file_exists("../config/config.php") 
and !empty($_POST['mysqlserver']) 
and !empty($_POST['database']) 
and !empty($_POST['databasepswd']) 
and !empty($_POST['databaseuser']) 
and !empty($_POST['tableprefix']) 
and !empty($_POST['username']) 
and !empty($_POST['password'])){
	
	$conn = new mysqli($_POST['mysqlserver'], $_POST['databaseuser'], $_POST['databasepswd'], $_POST['database']);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	// create table
	$sql = "CREATE TABLE ".mysqli_real_escape_string($conn,$_POST['tableprefix'])."event (
		id INT(12) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		title VARCHAR(2083) NOT NULL,
		description TEXT NOT NULL,
		country VARCHAR(2083) NOT NULL,
		city VARCHAR(2083) NOT NULL,
		address VARCHAR(2083) NOT NULL,
		banner VARCHAR(2083) NOT NULL,
		hash_ip VARCHAR(2083) NOT NULL,
		date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	} else {
		die("Error creating table: " . $conn->error);
	}
	
	$sql = "CREATE FULLTEXT INDEX ".mysqli_real_escape_string($conn,$_POST['tableprefix'])."fulltext
		ON ".mysqli_real_escape_string($conn,$_POST['tableprefix'])."event (title, description)";
	if ($conn->query($sql) === TRUE) {
	} else {
		die("Error creating table: " . $conn->error);
	}
	
	// create table
	$sql = "CREATE TABLE ".mysqli_real_escape_string($conn,$_POST['tableprefix'])."attending (
		id INT(12) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		event_id INT(12) UNSIGNED,
		name VARCHAR(2083),
		hash_ip VARCHAR(2083) NOT NULL,
		date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		FOREIGN KEY (event_id)
		REFERENCES ".mysqli_real_escape_string($conn,$_POST['tableprefix'])."event(id)
		ON DELETE CASCADE
	)";

	if ($conn->query($sql) === TRUE) {
	} else {
		die("Error creating table: " . $conn->error);
	}
	
	$config='<?php
		$CONFIG = array (
		\'mysql_server\' =>\''.$_POST['mysqlserver'].'\',
		\'database\' =>\''.$_POST['database'].'\',
		\'database_user\' =>\''.$_POST['databaseuser'].'\',
		\'database_pswd\' =>\''.$_POST['databasepswd'].'\',
		\'table_prefix\' =>\''.mysqli_real_escape_string($conn,$_POST['tableprefix']).'\',
		\'username\' =>\''.$_POST['username'].'\',
		\'password\' =>\''.md5($_POST['password']).'\',
		)
?>';
	$conn->close();
	$fp = fopen('../config/config.php', 'w');
			fwrite($fp, $config);
			fclose($fp);
			header("location: ../");
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, height=device-height,initial-scale=1.0">
		<title>Gif me</title>
		<script src="js/masonry.pkgd.min.js"></script>
		<style>
		body{
			background:grey;
		}
		</style>
	</head>
<body>
	<h2>Config</h2>
	<form action="" method="post">
	mysql server  <br /><input type="text" name="mysqlserver" value="localhost"/> <br /><br />

	database <br /><input type="text" name="database" /> <br /><br />
	database username <br /><input type="text" name="databaseuser" /> <br /><br />
	database password <br /><input type="password" name="databasepswd" /> <br /><br />

	table prefix <br /><input type="text" name="tableprefix"/> <br /><br />
	admin username 	<br /><input type="text" name="username" /> <br /><br />
	admin password <br /><input type="password" name="password" /> <br /><br />
<input type="submit" /> 
	</form>

</body>
</html>

