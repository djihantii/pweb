<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Accueil</title>
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
			<a href="index.php" class="active">Accueil</a>

			<?php
				include('php/Nav.php');
			?>
		</nav>
		<h2>Accueil</h2>
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="js/jsperso.js" ></script>
		<script src="js/bootstrap.js"></script>
	</body>
</html>
