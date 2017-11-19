<?php
	include('php/Connexion.class.php');
	
	echo '
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
				<a href="consulter.php" class="active visiteur-candidat">Consulter les offres</a>
				<a href="Candidat_profil.php" class="candidat">Modifier le profil</a>
				<a href="Candidat_postuler.php" class="candidat">Postuler à une offre</a>
				<a href="Candidat_resultat.php" class="candidat">Consulter les réponses</a>
				<a href="Visiteur_inscrire.php" class="visiteur">S\inscrire sur le portail</a>
				<a href="contact.php class="visiteur-candidat">Contacter les RH</a>

				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Se connecter</button>

				<!-- Classe Modal -->
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">

						<!-- Classe Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Connexion</h4>
							</div>
							<div class="modal-body">

								<!-- Pour se connecter--> 

								<form class="form-signin">
									<h2 class="form-signin-heading">Se connecter</h2>
									<label for="inputEmail">Login</label>
									<input type="text" id="inputEmail" class="form-control" placeholder="Login" required="" autofocus="">
									<label for="inputPassword">Mot de passe</label>
									<input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required="">
									<div class="checkbox">
					  					<label>
											<input type="checkbox" value="remember-me">Me souvenir
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
				</div>
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
						<tbody>';

		$con = new Connexion;
		$bd = $con->init();
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


		echo '</tbody>
					</table>
				</div>
			</div>
			<script src="https://code.jquery.com/jquery.min.js"></script>
			<script src="js/bootstrap.js"></script>
			<script src="js/jsperso.js" ></script>
		</body>

	</html>';
?>