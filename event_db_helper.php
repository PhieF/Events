<?php

require_once('config/config.php'); 

class EVENTDBHelper { 
	function addToDb($title, $description, $banner, $date, $country, $city, $address){
		$error="";
		global $CONFIG;
		$conn = new mysqli($CONFIG["mysql_server"], $CONFIG["database_user"], $CONFIG['database_pswd'], $CONFIG["database"]);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$description = mysqli_real_escape_string($conn,$description);
		$title = mysqli_real_escape_string($conn,$title);
		$banner = mysqli_real_escape_string($conn,$banner);
		$date = mysqli_real_escape_string($conn,$date);
		$country = mysqli_real_escape_string($conn,$country);
		$city = mysqli_real_escape_string($conn,$city);
		$address = mysqli_real_escape_string($conn,$address);
		$hash_ip = substr(md5($_SERVER['REMOTE_ADDR']),0,5);

		$sql = "INSERT INTO ".$CONFIG["table_prefix"]."event (title, description, banner, date, country, city, address, hash_ip)
		VALUES ('$title', '$description', '$banner', '$date', '$country', '$city', '$address', '$hash_ip')";

		if ($conn->query($sql) !== TRUE) {
			$lastid= "Error: " . $sql . "<br>" . $conn->error;
		} else $lastid = $conn->insert_id;
		
		/*$sql = "INSERT INTO ".$CONFIG["table_prefix"]."solution (solution,vdr_id, hash_ip)
		VALUES ('$solution',$conn->insert_id, '$hash_ip')";
if ($conn->query($sql) !== TRUE) {
			$error= "Error: " . $sql . "<br>" . $conn->error;
		}*/
		$conn->close();
		return $lastid;
	}
	function addAttending($id, $name){
		$error="";
		global $CONFIG;
		$conn = new mysqli($CONFIG["mysql_server"], $CONFIG["database_user"], $CONFIG['database_pswd'], $CONFIG["database"]);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$id = mysqli_real_escape_string($conn,$id);
		$name = mysqli_real_escape_string($conn,$name);
		$hash_ip = substr(md5($_SERVER['REMOTE_ADDR']),0,5);
		$sql = "SELECT count(name) as count FROM ".$CONFIG["table_prefix"]."attending WHERE event_id='$id' AND hash_ip='$hash_ip'"; 
		$result = $conn->query($sql);
		if($result->fetch_assoc()['count']>0)
			return "Can't come twice :(";
		$sql = "INSERT INTO ".$CONFIG["table_prefix"]."attending (name, event_id, hash_ip)
		VALUES ('$name', '$id', '$hash_ip')";

		if ($conn->query($sql) !== TRUE) {
			$lastid= "Error: " . $sql . "<br>" . $conn->error;
		} else $lastid = $conn->insert_id;
		
		/*$sql = "INSERT INTO ".$CONFIG["table_prefix"]."solution (solution,vdr_id, hash_ip)
		VALUES ('$solution',$conn->insert_id, '$hash_ip')";
if ($conn->query($sql) !== TRUE) {
			$error= "Error: " . $sql . "<br>" . $conn->error;
		}*/
		$conn->close();
		return $lastid;
	}
	
	
	function getLast($start){
		return $this->get($start,40);
		
	}
	
	function get($start, $limit){
		global $CONFIG;

		$conn = new mysqli($CONFIG["mysql_server"], $CONFIG["database_user"], $CONFIG['database_pswd'], $CONFIG["database"]);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = "SELECT id,cw,message, date FROM ".$CONFIG["table_prefix"]."event ORDER BY id DESC"; 
		if($start != null){
			$start = mysqli_real_escape_string($conn,$start);
			if(!is_int($start))
				$start = 0;
			$limit = mysqli_real_escape_string($conn,$limit);
			if(!is_int($limit))
				$limit = $start + 40;
			$sql .= " limit ".$start.",".$limit;
		}
		
		
		$result = $conn->query($sql);
		$return = array();
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				
				$resultSolution = $conn->query("SELECT id,solution, date FROM ".$CONFIG["table_prefix"]."solution WHERE vdr_id = '".$row['id']."' ORDER BY id");
				$row['solution'] = array();
				if ($resultSolution->num_rows > 0) {
					while($rowSolution = $resultSolution->fetch_assoc()) {
						array_push($row['solution'],$rowSolution);
					}
				}
				array_push($return,$row);
			}
		}
		return $return;
		
	}
	
	function getEvent($id){
		global $CONFIG;

		$conn = new mysqli($CONFIG["mysql_server"], $CONFIG["database_user"], $CONFIG['database_pswd'], $CONFIG["database"]);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$id = mysqli_real_escape_string($conn,$id);

		$sql = "SELECT * FROM ".$CONFIG["table_prefix"]."event WHERE id='$id'"; 

		$result = $conn->query($sql);
		$return = "";
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$sql = "SELECT count(id) as count FROM ".$CONFIG["table_prefix"]."attending WHERE event_id='$id'"; 
				$result2 = $conn->query($sql);
				$row['attending'] = $result2->fetch_assoc()['count'];
				return $row;
				
			}
		}
		return $return;
	}
	
}

?>
