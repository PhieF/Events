<?php
$event = array();
$event['ID'] = 0;
$event['title'] = "Marche pour le Climat";
$event['date'] = 1536357605;
$event['location'] = array();
$event['country'] = "FR";
$event['city'] = "Paris";
$event['address'] = "Place de l'Hôtel de Ville";
$event['description'] = "[MAJ DU 5 SEPT]

\"Est-ce que j'ai une société structurée qui descend dans la rue pour défendre la biodiversité [...], est-ce que j'ai une union nationale sur un enjeu qui concerne l'avenir de l'humanité et de nos propres enfants ?\"

Nicolas Hulot, France Inter, mardi 28 août 2018.

L'appel est lancé ! Face aux lobbies et à un modèle économique détruisant la nature, réunissons-nous pour montrer que la réponse est OUI !

Rassemblons-nous sur le parvis de l’Hôtel de Ville de Paris le 8 septembre à partir de 14h pour une chorégraphie géante suivie par une marche vers la Place de la République, et pour montrer que seul le peuple peut remettre la lutte contre le dérèglement climatique au centre des priorités de nos dirigeant.e.s !

(Une autorisation est en cours d'obtention auprès de la préfecture de police de Paris.)

Nous y sommes prêt.e.s. Et vous ?

Venez avec vos slogans, vos pancartes… Vous pourrez également participer à un atelier géant pour dessiner vos banderoles sur place.

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Les autres marches pour le Climat en France :
Amiens : https://www.facebook.com/events/256128855107333/
Avignon : https://www.facebook.com/events/534882843601613/
Bordeaux : https://www.facebook.com/events/281734615764384/
Caen : https://www.facebook.com/events/2079182365730999/
Chamonix : https://www.facebook.com/events/1902536963388996
Clermont : https://www.facebook.com/events/624481937946033/
Grenoble : https://www.facebook.com/events/2194936327498260/
Lille : https://www.facebook.com/events/1703566959769913/
Lyon : https://www.facebook.com/events/245639469488496/
Marseille : https://www.facebook.com/events/1904789239587932/
Metz : https://www.facebook.com/events/333878883852346/
Montpellier : https://www.facebook.com/events/2142385592669501/
Nantes : https://www.facebook.com/events/845895368867592/
Orléans : https://www.facebook.com/events/523325278081042/
Paris : https://www.facebook.com/events/1911533922247320/
Rennes :
https://www.facebook.com/events/313910046037437/
Rouen
https://www.facebook.com/events/1101422703371673/
Strasbourg : https://www.facebook.com/events/2006922556229716/
Toulouse :
https://www.facebook.com/events/966124940238479/

Dans les pays francophones :
Bruxelles : https://www.facebook.com/events/2022045681379575/
Genève : https://www.facebook.com/marcheclimatGE/ (le 13 octobre)
Montreal : https://www.facebook.com/events/2081227705462521/


Partout dans le monde, des associations et des citoyens organisent des marches ou des rassemblements pour le climat que vous pouvez inscrire et retrouver sur https://riseforclimate.org/

Ils soutiennent cette mobilisation :
350 France, Attac France (Officiel), Notre affaire à tous, CRID, BLOOM, SOL, WARN, Planète Altruiste, Partager C'est Sympa, One Voice, Oxfam France, La Nef - Finance éthique, Greenpeace France, France Nature Environnement, Fondation France Libertés, ActionAid France - Peuples Solidaires, L214 Ethique et Animaux, Ritimo, ATD Quart Monde France, CARE France, Collectif Cptgonesse, Les Amis de la Terre France, Reforest'Action, Fondation pour la Nature et l'Homme, AlterTour, AYYA, Réseau-Cétacés, CCFD-Terre Solidaire, Pacte Finance Climat, ASPAS - Association pour la protection des animaux sauvages, Tour Alternatiba, ANV Action non-violente COP21, Fédération Artisans du Monde, Ingénieurs sans frontières (ISF), Ca Commence Par Moi, Ciné-Jardins, Surfrider Foundation Europe, Education Ethique Animale, Association française contre l'heure d'été double - ACHED, Réseau Action Climat, NatureRights, Coordination Eau Ile-de-France, LPO France, Alofa Tuvalu, Humanité et Biodiversité, Générations Cobayes, Agir Pour l'Environnement...

Toutes les associations ou organisations qui soutiennent cette marche peuvent la rejoindre ! Écrivez-nous ! Nous mettrons la liste à jour le plus souvent possible.

Pétition \"Non, Monsieur Hulot, vous n’êtes pas seul !\" :
https://www.change.org/p/nicolas-hulot-non-monsieur-hulot-vous-n-%C3%AAtes-pas-seul

N’HÉSITEZ PAS À PARTAGER, PLUS NOUS SERONS NOMBREUX PLUS NOUS AURONS DU POIDS !";
$event['image'] = "";
$event['banner'] = "uploads/test-banner.jpg";

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
