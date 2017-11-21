
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Créer des offres</title>
        	<link rel="stylesheet" href="css/bootstrap.css" />
		<link rel="stylesheet" href="css/CSSpersonnalise.css" />
	</head>
	<body>
		<div class="header">
			<ul>
				<li><img src="css/logo.png" class="logo"></li>
				<li><h1>SearchEmploi</h1></li>
		
			</ul>
		</div>
		<nav class="menu">
			<a href="index.php">Accueil</a>
			<a href="RH_new_offre.php" class="active">Créer des offres</a>
			<a href="RH_inscrire_collegue.php">Inscrire un collègue</a>
			<a href="RH_recherche_candidat.php">Rechercher les candidats</a>
			<a href="RH_resultat.php">Accepter / refuser un candidat sur un poste</a>
			<a href="RH_blacklister.php">Blacklister un candidat</a>
			<a href="RH_contact_candidat.php">Contacter un candidat</a>
			<?php
				include("php/init.php");
				init_session();
				$bd = acces_bd();
				connectedbar("");
				if( isset($_POST['nomposte'])){
					$req = $bd->prepare('SELECT COUNT(NUM_OFFRE) AS Numb FROM OFFRES');
					$req->execute();
					$donnees = $req->fetch();
					$requete = $bd->prepare('INSERT INTO OFFRES VALUES (:Num,:Name,:loc,:empl,:dipl,:mission)');
					$requete->bindValue(':Num',$donnees['Numb']+1);
					$requete->bindValue(':Name',$_POST['nomposte']);
					$requete->bindValue(':loc',$_POST['Lieu']);
					$requete->bindValue(':empl',$_POST['emploi']);
					$requete->bindValue(':dipl',$_POST['diplome']);
					$requete->bindValue(':mission',$_POST['mission']);
					$requete->execute();
				}
			?>
		</nav>
		<form class="form-submit border rounded" action="RH_new_offre.php" method="post">
			<div class="hidden alert"></div>
			<h2>Création d'offre</h2>
			<div class="form-group has-feedback">
				<label for="nom">Nom du poste: </label>	
				<input id="nom" class="form-control saisievide" type="text" name="nomposte" placeholder="Nom du poste">
			</div>
			<div class="form-group has-feedback">
				<label for="lieu">Lieu du travail:</label>
				<input id="lieu" class="form-control saisievide" type="text" name="Lieu" placeholder="Lieu du travail">
			</div>
			<div class="form-group has-feedback">
				<label for="type">Type d'emploi:</label>
				<input id="type" class="form-control saisievide" type="text" name="emploi" placeholder="Type d'emploi">
			</div>
			<div class="form-group has-feedback">
				<label for="diplome">Diplômes requis:</label>
				<input id="diplome" class="form-control saisievide" type="text" name="diplome" placeholder="Diplôme">
			</div>
			<div class="form-group has-feedback">
				<label for="describe">Mission et Description:</label>
				<textarea id="describe" class="form-control saisievide" name="mission" placeholder="Description"></textarea>
			</div>
			<button type="submit" class="envoyer btn-block">Créer l'offre</button>
		</form>
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/jsperso.js" ></script>
	</body>

</html>
