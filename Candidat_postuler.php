<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8">
			<title>Postuler à une offre</title>
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
				<a href="Candidat_postuler.php" class="active">Postuler à une offre</a>
				<a href="Candidat_resultat.php">Consulter les réponses</a>
				<a href="contact.php">Contacter les RH</a>
				<?php
				include("php/init.php");
				init_session();
				$bd = acces_bd();
				connectedbar("Candidat_profil.php");
				?>
			</nav>
			<div class="row">
				<div class="col-3">
					<form class="search" action="consulter.php" method="post">
						<label for="recherche">Rechercher :</label>
						<input id="recherche" type="text" name="recherche" placeholder="Recherche">
						<button type="submit" class="btn-block">Rechercher</button>
						';
										
						<?php
							if(isset($_POST['recherche']) and trim($_POST['recherche'])!=""){
									echo '<p class="small"> Recherche du mot-clé: '.$_POST['recherche'].'<p>';
							}
						?>
					</form>
				</div>
			</div>
			<div class="col">
				<h2>Postuler</h2>

				<table class="table table-bordered">
					<thead class="jumbotron">
						<tr>
							<th>Nom du poste</th>
							<th>Nom de l'entreprise</th>
							<th>Type d'emploi</th>
							<th>Lieu du travail</th>
							<th>Description</th>
							<th>Postuler</th>
						</tr>
					</thead>
					<tbody>';
					<?php
						if(isset($_POST['postuler']) and trim($_POST['postuler'])!="" ){
							$requete = $bd->prepare("INSERT INTO POSTULER VALUES (:log,:Num,'N')");
							$requete->bindValue(':log',$_SESSION['Login']);
							$requete->bindValue(':Num',$_POST['postuler']);
							$requete->execute();
						}
						if(isset($_POST['recherche']) and trim($_POST['recherche'])!="" ){
							$requete = $bd->prepare("SELECT * FROM OFFRES WHERE NUM_OFFRE LIKE '%:attr%' OR LIEU_TRAVAIL LIKE '%:attr%' OR TYPE_EMPLOI LIKE '%:attr%' OR DIPLOME LIKE '%:attr%'");
							$requete->bindValue(':attr',$_POST['recherche']);
							$requete->bindValue(':log',$_SESSION['Login']);
						}
						else
						{
							$requete = $bd->prepare('SELECT * FROM OFFRES');
							$requete->bindValue(':log',$_SESSION['Login']);
						}
						$requete->execute();
						while ($tab = $requete->fetch(PDO::FETCH_ASSOC) )
						{
							echo'					
								<tr><td>' . $tab['NOM_POSTE'] . '</td><td>' . $tab['LIEU_TRAVAIL'] .'</td><td>'. $tab['TYPE_EMPLOI'] .'</td><td>'. $tab['DIPLOME'] .'</td><td>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Description</button>
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
								<td><form action="Candidat_postuler.php" method="post"><button type="submit" class="btn btn-success" name="postuler" value="'.$tab['NUM_OFFRE'].'">Postuler</button></form></td>
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
