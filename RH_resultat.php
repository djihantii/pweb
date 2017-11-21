<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>Accepter / refuser un candidat sur un poste</title>
		<link rel="stylesheet" href="css/bootstrap.css" />
		<link rel="stylesheet" href="">
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
			<a href="RH_resultat.php" class="active">Accepter / refuser un candidat sur un poste</a>
			<a href="RH_blacklister.php">Blacklister un candidat</a>
			<a href="RH_contact_candidat.php">Contacter un candidat</a>
			<?php
				include("nonpagephp/init.php");
				init_session();
				$bd = acces_bd();
				connectedbar("");
			?>
		</nav>

		<h2 class="center">Accepter ou refuser le candidat sur un poste</h2>
		<table class="table table-bordered">
			<thead class="jumbotron">
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Genre</th>
					<th>E-mail</th>
					<th>Nom du poste</th>
					<th>Nom de l'entreprise</th>
					<th>Description</th>
					<th>Resultat</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(isset($_POST['recherche']) and trim($_POST['recherche'])!="" ){
						$requete = $bd->prepare("SELECT * FROM COMPTE NATURAL JOIN POSTULER NATURAL LEFT JOIN OFFRES WHERE CANDIDAT = 'Y' AND NOM LIKE '%:attr%' OR PRENOM LIKE '%:attr%' OR EMAIL LIKE '%:attr%' OR SEXE LIKE '%:attr%'");
						$requete->bindValue(':attr',$_POST['recherche']);
					}
					else
					{
						$requete = $bd->prepare('SELECT * FROM COMPTE NATURAL JOIN POSTULER NATURAL LEFT JOIN OFFRES WHERE CANDIDAT = "Y"');
					}
					$requete->execute();
					while ($tab = $requete->fetch(PDO::FETCH_ASSOC) )
					{
						echo'<tr>
							<td>'.htmlspecialchars($tab['NOM'],ENT_QUOTES).'</td>
							<td>'.htmlspecialchars($tab['PRENOM'],ENT_QUOTES).'</td>
							<td>'.$tab['SEXE'].'</td>
							<td>'.htmlspecialchars($tab['EMAIL'],ENT_QUOTES).'</td>
							<td>'.htmlspecialchars($tab['NOM_POSTE'],ENT_QUOTES).'</td>
							<td>'.htmlspecialchars($tab['LIEU_TRAVAIL'],ENT_QUOTES).'</td>
							<td>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Consulter</button>
								<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLongTitle">Description de l\'offre</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body"><p> Lieu de Travail : '.htmlspecialchars($tab['LIEU_TRAVAIL'],ENT_QUOTES).'</p>
												<p> Type d\'emploi : '.htmlspecialchars($tab['TYPE_EMPLOI'],ENT_QUOTES).'</p>
												<p> Diplôme'.htmlspecialchars($tab['DIPLOME'],ENT_QUOTES).'</p><p> Mission: '.$tab['MISSION'].'</p>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
												</div>
											</div>
										</div>
									</div>
								</td>
								<td class="resultat">
									<button type="button" class="btn btn-success">Accepter</button>
									<button type="button" class="btn btn-warning">Refuser</button>
								</td>
							</tr>';
					}
				?>
			</tbody>
		</table>
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/jsperso.js"></script>
	</body>

</html>
