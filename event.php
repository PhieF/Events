<?php


require_once('event_db_helper.php'); 
if(!empty($_GET['id'])){
	$db = new EVENTDBHelper();
	if(!empty($_GET['coming'])){
		echo $db->addAttending($_GET['id'],"");
	}
	$event = $db->getEvent($_GET['id']);
	
}

?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, height=device-height,initial-scale=1.0">
		<title><?php echo $event['title']; ?></title>
		 
	</head>
	<body>
		<style>
			#event{
				box-shadow: 0px 0px 5px grey;
				margin:auto;
				max-width:1000px;
			}
			#banner{
				background:url(<?php echo $event['banner']; ?>);
				max-height:400px;
				background-size: contain;
				height:100%;
				width:100%;
			}
			@media screen and (max-width: 600px){
				#banner{
				max-height:200px;
			}
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
			#attending{
				padding-top: 20px;
			}
			#description{
				margin-top:15px;
			}
			#banner::after {
				padding-left:15px;
			}
			#going{
				float:right;
			}
			#event-sub-banner{
				padding-left:15px;
				padding-right:15px;
			}
		</style>
		<div id="event">
		<div id="banner">
		</div>
		<div id="event-sub-banner">
		<div id="event-header">
			<div id="date">
				<span id="day">
					<?php echo date("d",strtotime($event['date'])); ?>
				</span><br />
				<span id="month"><?php echo date("M",strtotime($event['date'])); ?></span>
				<span id="at">at <?php echo date("H",strtotime($event['date'])); ?>:<?php echo date("m",strtotime($event['date'])); ?></span>
			</div>
			<h2 id="title">
				<?php echo $event['title']; ?>
			</h2>
		</div>
		<div id="attending">
			<?php echo $event['attending']." people are going"; ?>
		</div>
		<a  href="?id=<?php echo $_GET['id']; ?>&coming=true" id="going">I'm coming !</a>
		<div id="location">
		<?php echo $event['address'].", ".$event['city'].", ".$event['country']; ?>
		</div>
		
		<div id="description">
			<?php echo nl2br($event['description']); ?>
		</div>
		</div>
		</div>
	</body>

</html>
