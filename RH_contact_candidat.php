
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Contacter un candidat</title>
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
			<a href="RH_new_offre.php">Créer des offres</a>
			<a href="RH_inscrire_collegue.php">Inscrire un collègue</a>
			<a href="RH_recherche_candidat.php">Rechercher les candidats</a>
			<a href="RH_resultat.php">Accepter / refuser un candidat sur un poste</a>
			<a href="RH_blacklister.php">Blacklister un candidat</a>
			<a href="RH_contact_candidat.php" class="active">Contacter un candidat</a>

			<?php
				include('php/Connexion.class.php');
				session_start();
				if(isset($_POST['disconnected'])) {
					session_destroy();
					$_SESSION['Login'] = "";
				}
				$con = new Connexion;
				$bd = $con->init();
				if(isset($_SESSION['Login']) and trim($_SESSION['Login'])!="") {
					echo '<a href="Candidat_profil.php">'.$_SESSION['Nom'].' '.$_SESSION['Prenom'] .'</a><form class="form-group" action="index.php" method="post"><button class="btn btn-info btn-lg" type="submit" name="disconnected" value="True">Deconnexion</button></form>';
				}
				if( isset($_POST['Nom'])){
						$req = $bd->prepare('SELECT COUNT(NUM_CONTACT) AS Numb FROM CONTACTS');
						$req->execute();
						$donnees = $req->fetch();
						$requete = $bd->prepare('INSERT INTO CONTACTS VALUES (:Num,:Name,:Surname,:Email,:Comment)');
						$requete->bindValue(':Num',$donnees['Numb']+1);
						$requete->bindValue(':Name',$_POST['Nom']);
						$requete->bindValue(':Surname',$_POST['Prenom']);
						$requete->bindValue(':Email',$_POST['Email']);
						$requete->bindValue(':Comment',$_POST['Commentaire']);
						$requete->execute();
				}?>
		</nav>
		<form class="form-submit border rounded" action="contact.php" method="post">
			<div class="hidden alert"></div>
			<h2>Contacter les Ressources Humaines</h2>
			<div class="form-group has-feedback">
				<label for="nom">Nom: </label>	
				<input id="nom" class="form-control saisievide" type="text" name="Nom" placeholder="Nom">
			</div>
			<div class="form-group has-feedback">
				<label for="prenom">Prénom: </label>
				<input id="prenom" class="form-control saisievide" type="text" name="Prenom" placeholder="Prénom">
			</div>
			<div class="form-group has-feedback">
				<label for="mail">E-mail:</label>
				<input id="mail" class="form-control saisievide" type="text" name="Email" placeholder="E-mail">
			</div>
			<div class="form-group has-feedback">
				<label for="comment">Commentaire:</label>
				<textarea id="comment" class="form-control saisievide" name="Commentaire" placeholder="Commentaire"></textarea>
			</div>
			<button type="submit" class="envoyer btn-block">Envoyer</button>
		</form>
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/jsperso.js" ></script>
	</body>

</html>
