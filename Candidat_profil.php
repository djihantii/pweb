
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Inscrire un candidat</title>
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
			<a href="Candidat_profil.php" class="active">Modifier le profil</a>
			<a href="Candidat_postuler.php">Postuler à une offre</a>
			<a href="Candidat_resultat.php">Consulter les réponses</a>
			<a href="contact.php">Contacter les RH</a>
			<?php
				include('php/Connexion.class.php');
				session_start();
					$con = new Connexion;
				$bd = $con->init();
				if( isset ($_POST['Nom']) and trim($_POST['Nom'])!="") {
					$requete = $bd->prepare('UPDATE CANDIDATS SET NOM= :attr WHERE LOGIN = :login');
					$requete->bindValue(':login',$_SESSION['Login']);
					$requete->bindValue(':attr',$_POST['Nom']);
					$requete->execute();
					$_SESSION['Nom'] = $_POST['Nom'];
				}
				if( isset ($_POST['Prenom']) and trim($_POST['Prenom'])!="") {
					$requete = $bd->prepare('UPDATE CANDIDATS SET PRENOM= :attr WHERE LOGIN = :login');
					$requete->bindValue(':login',$_SESSION['Login']);
					$requete->bindValue(':attr',$_POST['Prenom']);
					$requete->execute();
					$_SESSION['Prenom'] = $_POST['Prenom'];
				}
				if( isset ($_POST['Email']) and trim($_POST['Email'])!="") {
					$requete = $bd->prepare('UPDATE CANDIDATS SET EMAIL= :attr WHERE LOGIN = :login');
					$requete->bindValue(':login',$_SESSION['Login']);
					$requete->bindValue(':attr',$_POST['Email']);
					$requete->execute();
				}
				if( isset ($_POST['genre']) and trim($_POST['genre'])!="") {
					$requete = $bd->prepare('UPDATE CANDIDATS SET SEXE= :attr WHERE LOGIN = :login');
					$requete->bindValue(':login',$_SESSION['Login']);
					$requete->bindValue(':attr',$_POST['genre']);
					$requete->execute();
				}
				if( isset ($_POST['pwd']) and trim($_POST['pwd'])!="" and isset ($_POST['pwd2']) and trim($_POST['pwd2'])!="") {
					$requete = $bd->prepare('UPDATE CANDIDATS SET MOTDEPASSE= :attr WHERE LOGIN = :login');
					$requete->bindValue(':login',$_SESSION['Login']);
					if($_POST['pwd'] == $_POST['pwd2'])
					{
						$requete->bindValue(':attr',sha1($_POST['pwd']));
						$requete->execute();
					}
					else{
						echo'<div class="alert">Erreur mot de passe</div>';
					}
				}
				if( isset ($_SESSION['Login']) and trim($_SESSION['Login'])!="") {
					echo '<a href="Candidat_profil.php">'.$_SESSION['Nom'].' '.$_SESSION['Prenom'] .'</a><form class="form-group" action="index.php" method="post"><button class="btn btn-info btn-lg" type="submit" name="disconnected" value="True">Deconnexion</button></form>';
				}
			?>		
		</nav>
		<form class="form-submit border rounded" action="Candidat_profil.php" method="post">
		<?php
			$requete = $bd->prepare('SELECT * FROM CANDIDATS WHERE LOGIN = :login');
			$requete->bindValue(':login',$_SESSION['Login']);
			$requete->execute();
			$res = $requete->fetch(PDO::FETCH_ASSOC);
			echo'
				<div class="hidden alert"></div>
				<h2>Modifier le profil</h2>
				<div class="form-group has-feedback">	
					<label for="nom">Nom:'.$res['NOM'].'</label>
					<input id="nom" class="form-control" type="text" name="Nom" placeholder="Nom">
				</div>
				<div class="form-group has-feedback">
					<label for="prenom">Prénom: '.$res['PRENOM'].'</label>
					<input id="prenom" class="form-control" type="text" name="Prenom" placeholder="Prénom">
				</div>
				<div class="form-group has-feedback">
					<label for="mail">E-mail: '.$res['EMAIL'].'</label>
					<input id="mail" class="form-control" type="text" name="Email" placeholder="E-mail">
				</div>
				<label>Genre: '.$res['SEXE'].'</label>
				<label>M:
				<input type="radio" name="genre" value="M">
				F:
				<input type="radio" name="genre" value="F">
				</label>
				<div class="form-group has-feedback">
					<label for="pass">Mot de passe:</label>
					<input id="pass" class="form-control" name="name="pwd" type="password">
				</div>
				<div class="form-group has-feedback">
					<label for="pass2">Confirmer le mot de passe:</label>
					<input id="pass2" class="form-control" name="pwd2" type="password">
				</div>
				<button type="submit" class="envoyer btn-block">Modifier</button>
			';
			?>
			</form>
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>

</html>
