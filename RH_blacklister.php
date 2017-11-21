
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Blacklister un candidat</title>
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
			<a href="inscrire.php">Inscrire un candidat</a>
			<a href="RH_recherche_candidat.php">Rechercher les candidats</a>
			<a href="RH_resultat.php">Accepter / refuser un candidat sur un poste</a>
			<a href="RH_blacklister.php" class="active">Blacklister un candidat</a>
			<a href="RH_contact_candidat.php">Contacter un candidat</a>
			<?php
					include("nonpagephp/init.php");
					init_session();
					$bd = acces_bd();
					connectedbar("");
					if(isset($_POST['Nom']) and trim($_POST['Nom'])!="" and isset($_POST['Prenom']) and trim($_POST['Prenom'])!="" and isset($_POST['Email']) and trim($_POST['Email'])!="") {
						$requete = $bd->prepare('UPDATE COMPTE SET BLACKLIST = "T" WHERE NOM = :name AND PRENOM = :prenom AND EMAIL = :email');
						$requete->bindValue(':name',$_POST['Nom']);
						$requete->bindValue(':prenom',$_POST['Prenom']);
						$requete->bindValue(':email',$_POST['Email']);
						$requete->execute();
					}
			?>
		</nav>
		<form class="form-submit border rounded" action="RH_blacklister.php" method="post">
			<div class="hidden alert"></div>
			<h2>Blacklister un candidat</h2>
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
			<button type="submit" class="envoyer btn-block">Bloquer le compte</button>
		</form>
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/jsperso.js" ></script>
	</body>

</html>
