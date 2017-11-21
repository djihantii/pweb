
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Faire inscrire un collègue</title>
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
			<a href="RH_inscrire_collegue.php" class="active">Inscrire un collègue</a>
			<a href="inscrire.php">Inscrire un candidat</a>
			<a href="RH_recherche_candidat.php">Rechercher les candidats</a>
			<a href="RH_resultat.php">Accepter / refuser un candidat sur un poste</a>
			<a href="RH_blacklister.php">Blacklister un candidat</a>
			<a href="RH_contact_candidat.php">Contacter un candidat</a>

			<?php
				include("nonpagephp/init.php");
				init_session();
				$bd = acces_bd();
				connectedbar("");
				if( isset($_POST['Login'])){
					$requete = $bd->prepare('INSERT INTO COMPTE VALUES (:Login,:Email,:Name,:surname,:gnr,:pwd,"N","F")');
					$requete->bindValue(':Login',$_POST['Login']);
					$requete->bindValue(':Name',$_POST['Nom']);
					$requete->bindValue(':surname',$_POST['Prenom']);
					$requete->bindValue(':Email',$_POST['Mail']);
					$requete->bindValue(':gnr',$_POST['genre']);
					$requete->bindValue(':pwd',$_POST['pwd']);
					$requete->execute();
				}?>
		</nav>
		<form class="form-submit border rounded" action="RH_inscrire_collegue.php" method="post">
			<div class="hidden alert"></div>
			<h2>Inscription d'un collègue RH</h2>
			<div class="form-group has-feedback">
				<label for="mail">Login:</label>
				<input id="mail" class="form-control saisievide" name="Login" type="text" placeholder="Login">
			</div>
			<div class="form-group has-feedback">
				<label for="nom">Nom: </label>	
				<input id="nom" class="form-control saisievide " name="Nom" type="text" placeholder="Nom">
			</div>
			<div class="form-group has-feedback">
				<label for="prenom">Prénom: </label>
				<input id="prenom" class="form-control saisievide" name="Prenom" type="text" placeholder="Prénom">
			</div>
			<div class="form-group has-feedback">
				<label for="mail">E-mail:</label>
				<input id="mail" class="form-control saisievide" name="Mail" type="text" placeholder="E-mail">
			</div>
			<label>Genre:</label>
			<label>M:
			<input type="radio" name="genre" value="M">
			F:
			<input type="radio" name="genre" value="F">
			</label>
			<div class="form-group has-feedback">
				<label for="pass">Mot de passe:</label>
				<input id="pass" class="form-control saisievide" name="pwd" type="password">
			</div>
			<div class="form-group has-feedback">
				<label for="pass2">Confirmer le mot de passe:</label>
				<input id="pass2" class="form-control saisievide" type="password">
			</div>
			<button type="submit" class="envoyer-pwd btn-block">Inscrire</button>
		</form>
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/jsperso.js" ></script>
	</body>

</html>