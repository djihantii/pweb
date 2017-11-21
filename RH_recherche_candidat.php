
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Rechercher les candidats par domaines d’expertise, années d’expérience</title>
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
			<a href="RH_new_offre.php">Créer des offres</a>
			<a href="RH_inscrire_collegue.php">Inscrire un collègue</a>
			<a href="RH_recherche_candidat.php"  class="active">Rechercher les candidats</a>
			<a href="RH_resultat.php"">Accepter / refuser un candidat sur un poste</a>
			<a href="RH_blacklister.php">Blacklister un candidat</a>
			<a href="RH_contact_candidat.php">Contacter un candidat</a>';
			<?php
				include("php/init.php");
				init_session();
				$bd = acces_bd();
				connectedbar("");
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
			<div class="col">
				<br>
				<h2>Recherche</h2>
				<br>
				<table class="table table-bordered">
					<thead class="jumbotron">
						<tr>
							<th>Nom</th>
							<th>Prénom</th>
							<th>Genre</th>
							<th>E-mail</th>
							<th>Consulter</th>
						</tr>
					</thead>
					<tbody>
					<?php
						if(isset($_POST['recherche']) and trim($_POST['recherche'])!="" ){
							$requete = $bd->prepare("SELECT * FROM COMPTE AND NOM LIKE '%:attr%' OR PRENOM LIKE '%:attr%' OR EMAIL LIKE '%:attr%' OR SEXE LIKE '%:attr%'");
							$requete->bindValue(':attr',$_POST['recherche']);
						}
						else
						{
							$requete = $bd->prepare('SELECT * FROM COMPTE WHERE CANDIDAT = "Y"');
						}
						$requete->execute();
						while ($tab = $requete->fetch(PDO::FETCH_ASSOC) )
						{
							echo'<tr>
									<td>' . $tab['NOM'] . '</td>
									<td>' . $tab['PRENOM'] .'</td>
									<td>'. $tab['SEXE'] .'</td>
									<td>'. $tab['EMAIL'] .'</td>
									<td>
											<button type="button" class="btn btn-primary">Proposition</button>
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