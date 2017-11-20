<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Consulter les réponses de candidature</title>
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
			<a href="consulter.php">Consulter les offres</a>
			<a href="Candidat_profil.php">Modifier le profil</a>
			<a href="Candidat_postuler.php">Postuler à une offre</a>
			<a href="Candidat_resultat.php" class="active">Consulter les réponses</a>
			<a href="contact.php">Contacter les RH</a>

			<?php
				include('php/Connexion.class.php');
				session_start();
					$con = new Connexion;
				$bd = $con->init();
				if(isset($_SESSION['Login']) and trim($_SESSION['Login'])!="") {
					echo '<a href="Candidat_profil.php">'.$_SESSION['Nom'].' '.$_SESSION['Prenom'] .'</a><form class="form-group" action="index.php" method="post"><button class="btn btn-info btn-lg" type="submit" name="disconnected" value="True">Deconnexion</button></form>';
				}
			?>	
		</nav>
		<div class="row">
			<div class="col-3">
				<form class="search">
					<label for="recherche">Rechercher :</label>
					<input id="recherche" type="text" placeholder="Recherche">
					<button type="submit" class="btn-block">Rechercher</button>
					<label>Trier par:</label>
					<ul>
						<label>Nom<input type="radio" name="tri"></label>
						<label>Pertinence<input type="radio" name="tri"></label>
						<label>Date<input type="radio" name="tri"></label>
					</ul>
				</form>
			</div>
			<div class="col">
					<?php
						echo'<h2>Réponses de candidature</h2>

							<table class="table table-bordered">
								<thead class="jumbotron">
									<tr>
										<th>Nom du poste</th>
										<th>Nom de l\'entreprise</th>
										<th>Type d\'emploi</th>
										<th>Lieu du travail</th>
										<th>Description</th>
										<th>Etat</th>
									</tr>
								</thead>
								<tbody>';

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
								<td>En attente</td>
								</tr>';
						}
						echo'</tbody>
						</table>';
					?>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/jsperso.js" ></script>
	</body>

</html>
