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
			<a href="index.html">Accueil</a>
			<a href="RH_new_offre.html">Créer des offres</a>
			<a href="RH_inscrire_collegue.html">Inscrire un collègue</a>
			<a href="RH_inscrire.html">Inscrire un candidat</a>
			<a href="RH_recherche_candidat.html">Rechercher les candidats</a>
			<a href="RH_resultat.html" class="active">Accepter / refuser un candidat sur un poste</a>
			<a href="RH_blacklister.html">Blacklister un candidat</a>
			<a href="RH_contact_candidat.html">Contacter un candidat</a>

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
				<tr>
					<td>YE</td>
					<td>Quentin</td>
					<td>M</td>
					<td><a href=#>ye_quentin@yahoo.fr</a></td>
					<td class="resultat">
						<button type="button" class="btn btn-success">Accepter</button>
						<button type="button" class="btn btn-warning">Refuser</button>
					</td>
				</tr>
				<tr>
					<td>Shal</td>
					<td>Malcolm</td>
					<td>M</td>
					<td><a href=#>ye_quentin@yahoo.fr</a></td>
					<td class="resultat">
						<button type="button" class="btn btn-success">Accepter</button>
						<button type="button" class="btn btn-warning">Refuser</button>
					</td>
				</tr>
				<tr>
					<td>Nim</td>
					<td>Mu</td>
					<td>F</td>
					<td><a href=#>ye_quentin@yahoo.fr</a></td>
					<td class="resultat">
						<button type="button" class="btn btn-success">Accepter</button>
						<button type="button" class="btn btn-warning">Refuser</button>
					</td>
				</tr>
			</tbody>
		</table>
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/jsperso.js"></script>
	</body>

</html>
