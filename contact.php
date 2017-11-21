
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Contacter les RH</title>
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
				include("php/init.php");
				init_session();
				$bd = acces_bd();
				if( isset($_POST['Nom'])){
						$req = $bd->prepare('SELECT COUNT(NUM_CONTACT) AS Numb FROM CONTACTS');
						$req->execute();
						$donnees = $req->fetch();
						$requete = $bd->prepare('INSERT INTO CONTACTS VALUES (:Num,:Name,:Surname,:Email,:Comment)');
						$requete->bindValue(':Num',$donnees['Numb']+1);
						$requete->bindValue(':Name',$_POST['Nom']);
						$requete->bindValue(':Surname',$_POST['Prenom']);
						$requete->bindValue(':Email',$_POST['Email']);
						$requete->bindValue(':Comment',$_POST['Commentaire']);
						$requete->execute();
				}

				if( isset ($_SESSION['Login']) and trim($_SESSION['Login'])!="" and isset($_SESSION['candidat'])) {
					if(($_SESSION['candidat']) == true){
					echo'<a href="consulter.php">Consulter les offres</a>
					<a href="Candidat_profil.php">Modifier le profil</a>
					<a href="Candidat_postuler.php">Postuler à une offre</a>
					<a href="Candidat_resultat.php">Consulter les réponses</a>
					<a href="contact.php" class="active">Contacter les RH</a>';
					connectedbar("Candidat_profil.php");
					}
					else{ 
					echo'
					<a href="RH_new_offre.php">Créer des offres</a>
					<a href="RH_inscrire_collegue.php">Inscrire un collègue</a>
					<a href="RH_recherche_candidat.php">Rechercher les candidats</a>
					<a href="RH_resultat.php">Accepter / refuser un candidat sur un poste</a>
					<a href="RH_blacklister.php">Blacklister un candidat</a>
					<a href="RH_contact_candidat.php">Contacter un candidat</a>';
					connectedbar("");
					}
				}
				else{
					echo'<a href="consulter.php">Consulter les offres</a>
					<a href="inscrire.php">S\'inscrire sur le portail</a>
					<a href="contact.php" class="active">Contacter les RH</a>
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
			?>
		</nav>
		<form class="form-submit border rounded" action="contact.php" method="post">
			<div class="hidden alert"></div>
			<h2>Contacter les Ressources Humaines</h2>
			<div class="form-group has-feedback">
				<label for="nom">Nom: </label>	
				<input id="nom" class="form-control saisievide" type="text" name="Nom" placeholder="Nom">
			</div>
			<div class="form-group has-feedback">
				<label for="prenom">Prénom: </label>
				<input id="prenom" class="form-control saisievide" type="text" name="Prenom" placeholder="Prénom">
			</div>
			<div class="form-group has-feedback">
				<label for="mail">E-mail:</label>
				<input id="mail" class="form-control saisievide" type="text" name="Email" placeholder="E-mail">
			</div>
			<div class="form-group has-feedback">
				<label for="comment">Commentaire:</label>
				<textarea id="comment" class="form-control saisievide" name="Commentaire" placeholder="Commentaire"></textarea>
			</div>
			<button type="submit" class="envoyer btn-block">Envoyer</button>
		</form>
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/jsperso.js" ></script>
	</body>

</html>
