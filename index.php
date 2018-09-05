<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(!file_exists("config/config.php")){
	header("location: admin/firstrun.php");
}
else	header("location: create_event.php");

?>
