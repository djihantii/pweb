<?php
	include('php/Connexion.class.php');
	session_start();

	echo '
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8">
			<title>Accueil</title>
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
				<a href="index.php" class="active">Accueil</a>
				<a href="consulter.php" class="visiteur-candidat">Consulter les offres</a>
				<a href="Candidat_profil.php" class="candidat">Modifier le profil</a>
				<a href="Candidat_postuler.php" class="candidat">Postuler à une offre</a>
				<a href="Candidat_resultat.php" class="candidat">Consulter les réponses</a>
				<a href="Visiteur_inscrire.php" class="visiteur">S\inscrire sur le portail</a>
				<a href="contact.php" class="visiteur-candidat">Contacter les RH</a>
				<a href="RH_new_offre.php" class="rh">Créer des offres</a>
				<a href="RH_inscrire_collegue.php" class="rh">Inscrire un collègue</a>
				<a href="RH_inscrire.php" class="rh">Inscrire un candidat</a>
				<a href="RH_recherche_candidat.php" class="rh">Rechercher les candidats</a>
				<a href="RH_resultat.php" class="rh">Accepter / refuser un candidat sur un poste</a>
				<a href="RH_blacklister.php" class="rh">Blacklister un candidat</a>
				<a href="RH_contact_candidat.php" class="rh">Contacter un candidat</a>
				';
				$con = new Connexion;
				$bd = $con->init();
				if( isset ($_POST['LoginC']) and isset($_POST['PasswordC']) and trim($_POST['LoginC'])!="" and trim($_POST['PasswordC'])!="" ) {
					$requete = $bd->prepare('SELECT LOGIN,MOT_DE_PASSE FROM CANDIDATS WHERE LOGIN = :login');
					$requete->bindValue(':login',$_POST['LoginC']);
					$requete->execute();
					$res = $requete->fetch(PDO::FETCH_ASSOC);
					if($res) {

						if(sha1($_POST['PasswordC'])==$res['MOT_DE_PASSE'])
						{
							echo '<p> Connexion réussie </p>';
							$_SESSION['LoginC'] = $_POST['LoginC'];
							$_SESSION['connecte'] = true;
						}
						else
						{
							echo '<p> Connexion Echec </p>';
						}
					}
				}
				else{
					echo'
						<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#ConCand">Connexion Candidat</button>

						<!-- connexion candidat -->
						<div class="modal fade" id="ConCand" role="dialog">
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
											<h2 class="form-signin-heading">Connexion Candidat</h2>
											<label for="inputLoginC">Login</label>
											<input type="text" id="inputLoginC" class="form-control" name="LoginC" placeholder="Login" required="" autofocus="">
											<label for="inputPasswordC">Mot de passe</label>
											<input type="password" id="inputPasswordC" class="form-control" name="PasswordC" placeholder="Mot de passe" required="">
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
						</div>
						<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#ConAdmin">Connexion RH</button>';
				}

				echo'<!-- Connexion RH -->
				<div class="modal fade" id="ConAdmin" role="dialog">
					<div class="modal-dialog">

						<!-- Classe Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Connexion RH</h4>
							</div>
							<div class="modal-body">

								<!-- Pour se connecter--> 

								<form class="form-signin" action="index.php" method="post">
									<h2 class="form-signin-heading">Se connecter</h2>
									<label for="inputLoginA">Login</label>
									<input type="text" id="inputLoginA" class="form-control" name="LoginA" placeholder="Login" required="" autofocus="">
									<label for="inputPasswordA">Mot de passe</label>
									<input type="password" id="inputPasswordA" class="form-control" name="PasswordA" placeholder="Mot de passe" required="">
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
				</div>
			</nav>
			<h2>Accueil</h2>
			<script src="https://code.jquery.com/jquery.min.js"></script>
			<script src="js/bootstrap.js"></script>
			<script src="js/jsperso.js" ></script>
		</body>

	</html>';
	if( isset ($_POST['LoginA']) and isset($_POST['PasswordA']) and trim($_POST['LoginA'])!="" and trim($_POST['PasswordA'])!="" ) {
		echo '<p> Connexion réussie </p>';
		$_SESSION['LoginA'] = $_POST['LoginA'];
		$_SESSION['PasswordA'] = $_POST['PasswordA'];
		$_SESSION['connecte'] = true;
	}