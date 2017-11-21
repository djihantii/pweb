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
				include("php/init.php");
				init_session();
				$bd = acces_bd();
				connectedbar("Candidat_profil.php");
			?>	
		</nav>
		<h2>Réponses de candidature</h2>

		<table class="table table-bordered">
			<thead class="jumbotron">
				<tr>
					<th>Nom du poste</th>
					<th>Nom de l'entreprise</th>
					<th>Type d'emploi</th>
					<th>Lieu du travail</th>
					<th>Description</th>
					<th>Etat</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$requete = $bd->prepare('SELECT * FROM OFFRES NATURAL JOIN POSTULER WHERE LOGIN=:log');
					$requete->bindValue(':log',$_SESSION['Login']);
					$requete->execute();
					while ($tab = $requete->fetch(PDO::FETCH_ASSOC) )
					{
						echo'
						<tr>
							<td>'.$tab['NOM_POSTE'].'</td>
							<td>'.$tab['LIEU_TRAVAIL'].'</td>
							<td>'.$tab['TYPE_EMPLOI'].'</td>
							<td>'.$tab['DIPLOME'].'</td>
							<td>
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
										</div>
									</div>
								</div>
							</div>
							</td>
							<td>';
						if($tab['ACCEPTER'] == 'N')
						{
							echo 'En attente';
						}
						if($tab['ACCEPTER'] == 'T')
						{
							echo 'Candidature accepté';
						}
						if($tab['ACCEPTER'] == 'F')
						{
							echo 'Candidature refusé';
						}
						echo '</td>
						</tr>';
					}
				?>
			</tbody>
		</table>
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/jsperso.js" ></script>
	</body>

</html>
