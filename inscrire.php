
<?php
	include("php/init.php");
	init_session();
	$bd = acces_bd();
	if( isset($_POST['Login'])){
		$requete = $bd->prepare('INSERT INTO COMPTE VALUES (:Login,:Email,:Name,:surname,:gnr,:pwd,"Y","F")');
		$requete->bindValue(':Login',$_POST['Login']);
		$requete->bindValue(':Name',$_POST['Nom']);
		$requete->bindValue(':surname',$_POST['Prenom']);
		$requete->bindValue(':Email',$_POST['Mail']);
		$requete->bindValue(':gnr',$_POST['genre']);
		$requete->bindValue(':pwd',$_POST['pwd']);
		$requete->execute();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>S’inscrire sur le portail en tant que candidat potentiel</title>
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
			<?php
				if( isset($_SESSION['Login']) and trim($_SESSION['Login'])!="" and isset($_SESSION['candidat'])) {
					if(($_SESSION['candidat']) == false){
						echo'
						<a href="RH_new_offre.php">Créer des offres</a>
						<a href="RH_inscrire_collegue.php">Inscrire un collègue</a>
						<a href="inscrire.php">Inscrire un candidat</a>
						<a href="RH_recherche_candidat.php">Rechercher les candidats</a>
						<a href="RH_resultat.php">Accepter / refuser un candidat sur un poste</a>
						<a href="RH_blacklister.php">Blacklister un candidat</a>';
						connectedbar("");
					}
				}
				else{
					echo'<a href="consulter.php" class="active">Consulter les offres</a>
					<a href="inscrire.php" class="active">S\'inscrire sur le portail</a>
					<a href="contact.php"">Contacter les RH</a>
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#Con">Connexion</button>

					<!-- connexion candidat -->
					<div class="modal fade" id="Con" role="dialog">
						<div class="modal-dialog">

							<!-- Classe Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Connexion</h4>
								</div>
								<div class="modal-body">

									<!-- Pour se connecter--> 

									<form class="form-signin" action="index.php" method="post">
										<h2 class="form-signin-heading">Connexion</h2>
										<label for="inputLoginC">Login</label>
										<input type="text" id="inputLogin" class="form-control" name="Login" placeholder="Login" required="" autofocus="">
										<label for="inputPassword">Mot de passe</label>
										<input type="password" id="inputPassword" class="form-control" name="Password" placeholder="Mot de passe" required="">
										<div class="checkbox">
						  					<label>
												<input type="checkbox" value="remember-me">Se souvenir
						  					</label>
										</div>
										<button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
				  		 			</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default connected" data-dismiss="modal">Fermer</button>
								</div>
							</div>

						</div>
					</div>';
				}
			?>
		</nav>
		<form class="form-submit border rounded" action="inscrire.php" method="post">
			<div class="hidden alert"></div>
			<h2>Inscription</h2>
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
