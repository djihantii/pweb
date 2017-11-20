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
			<a href="RH_recherche_candidat.php">Rechercher les candidats</a>
			<a href="RH_resultat.php" class="active">Accepter / refuser un candidat sur un poste</a>
			<a href="RH_blacklister.php">Blacklister un candidat</a>
			<a href="RH_contact_candidat.php">Contacter un candidat</a>';
			<?php
					include('php/Connexion.class.php');
					session_start();
					if(isset($_POST['disconnected'])) {
						session_destroy();
						$_SESSION['Login'] = "";
					}
					$con = new Connexion;
					$bd = $con->init();
					if(isset($_SESSION['Login']) and trim($_SESSION['Login'])!="") {
						echo '<a href="Candidat_profil.php">'.$_SESSION['Nom'].' '.$_SESSION['Prenom'] .'</a><form class="form-group" action="index.php" method="post"><button class="btn btn-info btn-lg" type="submit" name="disconnected" value="True">Deconnexion</button></form>';
					}
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
					<th>Resultat</th>
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
						echo'<tr><td>' . $tab['NOM'] . '</td><td>' . $tab['PRENOM'] .'</td><td>'. $tab['SEXE'] .'</td><td>'. $tab['EMAIL'] .'</td><td>
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
