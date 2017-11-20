<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Consulter les offres d’emploi</title>
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
				include('php/Connexion.class.php');
				session_start();
				if(isset ($_POST['disconnected'])) {
					session_destroy();
					$_SESSION['Login'] = "";
				}
				$con = new Connexion;
				$bd = $con->init();
				if( isset ($_POST['Login']) and isset($_POST['Password']) and trim($_POST['Login'])!="" and trim($_POST['Password'])!="" ) {
						$requete = $bd->prepare('SELECT * FROM COMPTE WHERE LOGIN = :login');
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
									echo'<a href="consulter.php">Consulter les offres</a>
									<a href="Candidat_profil.php">Modifier le profil</a>
									<a href="Candidat_postuler.php">Postuler à une offre</a>
									<a href="Candidat_resultat.php">Consulter les réponses</a>
									<a href="contact.php>Contacter les RH</a>';
									echo '<a href="Candidat_profil.php">'.$_SESSION['Nom'].' '.$_SESSION['Prenom'] .'</a><form class="form-group" action="index.php" method="post"><button class="btn btn-info btn-lg" type="submit" name="disconnected" value="True">Deconnexion</button></form>';
								}
								else
								{
									$_SESSION['candidat'] = false;
									echo'
									<a href="RH_new_offre.html">Créer des offres</a>
									<a href="RH_inscrire_collegue.html">Inscrire un collègue</a>
									<a href="RH_inscrire.html">Inscrire un candidat</a>
									<a href="RH_recherche_candidat.html">Rechercher les candidats</a>
									<a href="RH_resultat.html">Accepter / refuser un candidat sur un poste</a>
									<a href="RH_blacklister.html">Blacklister un candidat</a>
									<a href="RH_contact_candidat.html">Contacter un candidat</a>';
									echo '<a>'.$_SESSION['Nom'].' '.$_SESSION['Prenom'] .'</a><form class="form-group" action="index.php" method="post"><button class="btn btn-info btn-lg" type="submit" name="disconnected" value="True">Deconnexion</button></form>';
								}
							}
							else
							{
								echo 'Echec de connexion';
							}
						}
					}
					else{
						if( isset ($_SESSION['Login']) and trim($_SESSION['Login'])!="" and isset($_SESSION['candidat'])) {
							if(($_SESSION['candidat']) == true){
							echo'<a href="consulter.php">Consulter les offres</a>
							<a href="Candidat_profil.php">Modifier le profil</a>
							<a href="Candidat_postuler.php">Postuler à une offre</a>
							<a href="Candidat_resultat.php">Consulter les réponses</a>
							<a href="contact.php>Contacter les RH</a>';
							echo '<a href="Candidat_profil.php">'.$_SESSION['Nom'].' '.$_SESSION['Prenom'] .'</a><form class="form-group" action="index.php" method="post"><button class="btn btn-info btn-lg" type="submit" name="disconnected" value="True">Deconnexion</button></form>';
							}
							else{ 
							echo'
							<a href="RH_new_offre.html">Créer des offres</a>
							<a href="RH_inscrire_collegue.html">Inscrire un collègue</a>
							<a href="RH_inscrire.html">Inscrire un candidat</a>
							<a href="RH_recherche_candidat.html">Rechercher les candidats</a>
							<a href="RH_resultat.html">Accepter / refuser un candidat sur un poste</a>
							<a href="RH_blacklister.html">Blacklister un candidat</a>
							<a href="RH_contact_candidat.html">Contacter un candidat</a>';
							echo '<a>'.$_SESSION['Nom'].' '.$_SESSION['Prenom'] .'</a><form class="form-group" action="index.php" method="post"><button class="btn btn-info btn-lg" type="submit" name="disconnected" value="True">Deconnexion</button></form>';
							}
						}
						else{
							echo'<a href="consulter.php">Consulter les offres</a>
							<a href="inscrire.php">S\'inscrire sur le portail</a>
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
				}
			?>
		</nav>
		<div class="row">
			<div class="col-3">
				<form class="search">
					<label for="recherche">Rechercher :</label>
					<input id="recherche" type="text" placeholder="Recherche">
					<button class="btn-block">Rechercher</button>
					<label>Trier par:</label>
					<ul>
						<label>Nom<input type="radio" name="tri"></label>
						<label>Pertinence<input type="radio" name="tri"></label>
						<label>Date<input type="radio" name="tri"></label>
					</ul>
				</form>
			</div>
			<div class="col">
				<h2>Consulter les offres</h2>
				<table class="table table-bordered">
					<thead class="jumbotron">
						<tr>
							<th>Nom du poste</th>
							<th>Nom de l\'entreprise</th>
							<th>Type d\'emploi</th>
							<th>Lieu du travail</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
					<?php

						$requete = $bd->prepare('SELECT * FROM OFFRES');
						$requete->execute();
						while ($tab = $requete->fetch(PDO::FETCH_ASSOC) )
						{
							echo'<tr><td>' . $tab['NOM_POSTE'] . '</td><td>' . $tab['LIEU_TRAVAIL'] .'</td><td>'. $tab['TYPE_EMPLOI'] .'</td><td>'. $tab['DIPLOME'] .'</td><td>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Consulter l\'offre</button>
								<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLongTitle">Description de l\'offre</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">'.$tab['MISSION'].'<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
												<button type="button" class="btn btn-primary">Postuler</button>
											</div>
										</div>
									</div>
								</div>
								</td>
								</tr>';
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/jsperso.js" ></script>
	</body>

</html>
