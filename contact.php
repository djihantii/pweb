
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Contacter les RH</title>
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
			<a href="consulter.php" class="visiteur-candidat">Consulter les offres</a>
			<a href="Candidat_profil.php" class="candidat">Modifier le profil</a>
			<a href="Candidat_postuler.php" class="candidat">Postuler à une offre</a>
			<a href="Candidat_resultat.php" class="candidat">Consulter les réponses</a>
			<a href="Visiteur_inscrire.php" class="visiteur">S\inscrire sur le portail</a>
			<a href="contact.php" class="active visiteur-candidat">Contacter les RH</a>


			<?php
				include('php/Connexion.class.php');
				session_start();
				if(isset ($_POST['disconnected'])) {
					session_destroy();
					$_SESSION['Login'] = "";
				}
				$con = new Connexion;
				$bd = $con->init();
				if( isset ($_SESSION['Login']) and trim($_SESSION['Login'])!="") {
					echo '<a href="Candidat_profil.php">'.$_SESSION['Nom'].' '.$_SESSION['Prenom'] .'</a><form class="form-group" action="index.php" method="post"><button class="btn btn-info btn-lg" type="submit" name="disconnected" value="True">Deconnexion</button></form>';
				}
				else{
					if( isset ($_POST['LoginC']) and isset($_POST['PasswordC']) and trim($_POST['LoginC'])!="" and trim($_POST['PasswordC'])!="" ) {
						$requete = $bd->prepare('SELECT * FROM CANDIDATS WHERE LOGIN = :login');
						$requete->bindValue(':login',$_POST['LoginC']);
						$requete->execute();
						$res = $requete->fetch(PDO::FETCH_ASSOC);
						if($res) {

							if(sha1($_POST['PasswordC'])==$res['MOT_DE_PASSE'])
							{
								$_SESSION['Login'] = $_POST['LoginC'];
								$_SESSION['Nom'] = $res['NOM'];
								$_SESSION['Prenom'] = $res['PRENOM'];
								$_SESSION['connecte'] = true;
								$_SESSION['candidat'] = true;
								echo '<a href="Candidat_profil.php">'.$_SESSION['Nom'].' '.$_SESSION['Prenom'] .'</a><form class="form-disconnect" action="index.php" method="post">
								<button class="btn btn-info btn-lg" type="submit" name="disconnected" value="True">Deconnexion</button>
								</form>';
							}
							else
							{
								echo 'Echec de connexion';
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
					if( isset ($_POST['LoginA']) and isset($_POST['PasswordA']) and trim($_POST['LoginA'])!="" and trim($_POST['PasswordA'])!="" ) {
						$requete = $bd->prepare('SELECT * FROM RH WHERE LOGIN = :login');
						$requete->bindValue(':login',$_POST['LoginA']);
						$requete->execute();
						$res = $requete->fetch(PDO::FETCH_ASSOC);
						if($res) {

							if(sha1($_POST['PasswordA'])==$res['MOT_DE_PASSE'])
							{
								$_SESSION['Login'] = $_POST['LoginA'];
								$_SESSION['Nom'] = $res['NOM'];
								$_SESSION['Prenom'] = $res['PRENOM'];
								$_SESSION['connecte'] = true;
								$_SESSION['candidat'] = false;
								echo '<a href="Candidat_profil.php">'.$_SESSION['Nom'].' '.$_SESSION['Prenom'] .'</a><form class="form-disconnect" action="index.php" method="post">
								<button class="btn btn-info btn-lg" type="submit" name="disconnected" value="True">Deconnexion</button>
								</form>';
							}
							else
							{
								echo 'Echec de connexion';
							}
						}
					}
					else{
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
									<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
								</div>
							</div>

						</div>
					</div>';
					}
				}
			?>
		</nav>
		<form class="form-submit border rounded" action="contact.php">
			<div class="hidden alert"></div>
			<h2>Contacter les Ressources Humaines</h2>
			<div class="form-group has-feedback">
				<label for="nom">Nom: </label>	
				<input id="nom" class="form-control saisievide" type="text" placeholder="Nom">
			</div>
			<div class="form-group has-feedback">
				<label for="prenom">Prénom: </label>
				<input id="prenom" class="form-control saisievide" type="text" placeholder="Prénom">
			</div>
			<div class="form-group has-feedback">
				<label for="mail">E-mail:</label>
				<input id="mail" class="form-control saisievide" type="text" placeholder="E-mail">
			</div>
			<div class="form-group has-feedback">
				<label for="comment">Commentaire:</label>
				<textarea id="comment" class="form-control saisievide" placeholder="Commentaire"></textarea>
			</div>
			<button type="submit" class="envoyer btn-block">Envoyer</button>
		</form>
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/jsperso.js" ></script>
	</body>

</html>
