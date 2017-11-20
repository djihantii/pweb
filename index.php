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
					if( isset ($_POST['Login']) and isset($_POST['Password']) and trim($_POST['Login'])!="" and trim($_POST['Password'])!="" ) {
						$requete = $bd->prepare('SELECT * FROM CANDIDATS WHERE LOGIN = :login');
						$requete->bindValue(':login',$_POST['Login']);
						$requete->execute();
						$res = $requete->fetch(PDO::FETCH_ASSOC);
						if($res) {

							if(sha1($_POST['Password'])==$res['MOT_DE_PASSE'])
							{
								$_SESSION['Login'] = $_POST['Login'];
								$_SESSION['Nom'] = $res['NOM'];
								$_SESSION['Prenom'] = $res['PRENOM'];
								$_SESSION['connecte'] = true;
								if($res['CANDIDAT'] == 'Y')
								{
									$_SESSION['candidat'] = true;
								}
								else
								{
									$_SESSION['candidat'] = false;
								}
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
							</div>
							<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#ConAdmin">Connexion RH</button>';
					}
				}
			?>
		</nav>
		<h2>Accueil</h2>
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="js/jsperso.js" ></script>
		<?php 
			if( isset ($_SESSION['Login']) and trim($_SESSION['Login'])!="" and isset ($_SESSION['candidat'])) {
				if($_SESSION['candidat']==true)
				{
					echo '<script type="text/javascript" src="js/jsperso.js">menu_candidat()</script>';
				}
			}
			if( isset ($_SESSION['Login']) and trim($_SESSION['Login'])!="" and isset ($_SESSION['candidat']) and $_SESSION['candidat']==false) {
				echo '<script type="text/javascript" src="js/jsperso.js"></script>';
			}
		?>
		<script src="js/bootstrap.js"></script>
	</body>
</html>
