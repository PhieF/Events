<?php
	require_once('event_db_helper.php'); 
	if(!empty($_POST['title'])){
		echo  $_POST['date'];
		$db = new EVENTDBHelper();
		$id = $db -> addToDb($_POST['title'],  $_POST['description'], "uploads/test-banner.jpg", $_POST['date'], $_POST['country'], $_POST['city'], $_POST['address']);
		header("location: event.php?id=".$id);
	}


?>
<html>
	<head>
		
		<link rel="stylesheet" href="datetimepicker/jquery.simple-dtpicker.css" />
	</head>
	
	<body>
		<script src="jquery-3.3.1.min.js"></script>
		<script src="datetimepicker/jquery.simple-dtpicker.js"></script>

		<style>
			body{
				height:100%;
			}
			#event{
				box-shadow: 0px 0px 5px grey;
				margin:auto;
				max-width:1000px;
				min-height:100%;
				padding:10px;
			}
			#banner{
				background:url(<?php echo $event['banner']; ?>);
				max-height:400px;
				height:100%;
				width:100%;
			}
			#event-header{
				margin-top:10px;
			}
			#date{
				float:left;
				text-align:center;
			}
			#title{
				text-align:center;
			}
			#day{
				font-size:28px;
			}
			#location{
				padding-top: 20px;
				border-bottom: solid 1px;
				padding-bottom: 20px;
			}
			#description{
				width:100%;
				min-height:300px;
				padding:10px;
			}
			#banner::after {
				padding-left:15px;
			}
			#event-sub-banner{
				padding-left:15px;
				padding-right:15px;
			}
		</style>
		<div  id="event">
			<h1>New Event</h1>
		<form action="" method="post" enctype="multipart/form-data">
			<input type="text" placeholder="Event title" name="title" /> <br />
			<input type="text" placeholder="Country" name="country" /> <br />
			<input type="text" placeholder="City" name="city" /> <br />
			<input type="text" placeholder="Address" name="address" /> <br />
			<input type="text" placeholder="date" id="dateuser" name="date"  onchange="updatedate()" />
			<input type="hidden"  id="date" name="dater"  />

			<textarea placeholder="Enter description  &#x0a;&#x0a;*italic* &#x0a;**bold**" name="description" id="description"></textarea> <br />
			Select a banner to upload:
			<input type="file" name="banner" ><br />
			<input type="submit" value="Submit" name="submit" />
		</form>
		</div>
		<script>
			var globhandler = undefined;
		$('#dateuser').appendDtpicker({
			"onShow": function(handler){
				globhandler = handler;
			},
			"onHide": function(handler){
			}
		});
		function updatedate(){
			if(globhandler == undefined)
			return;
						$("#date").val(globhandler.getDate().getTime());
						globhandler.hide();

		}
		</script>
		
	</body>
	
</html>
