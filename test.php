<?php
	require_once('inscrire.html');
	require('php/Connexion.class.php');
	$con = new Connexion;
	try{
		$base = "BDE11404058" ;
		$ide= "E11404058";
		$password= "2407004604C";
		//$connection = mysql_connect('10.11.10.13', $ide, $password) ;
		//$bd = mysql_connect('10.11.10.13', $con::USER, $con::PWD) ;
		$bd =new PDO($con::DNS, $con::USER, $con::PWD);
		//$bd =new PDO('mysql:host=marseille;dbname=pweb;charset=utf8', 'INFO2_1', 'INFO2_1');
		//$bd->query('SET NAMES '+ $con::CHARSET);
		$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$requete = $bd->prepare('SELECT * FROM OFFRES');
		$requete->execute();
		$tab = $requete->fetch(PDO::FETCH_ASSOC);
		echo'<p> Nom : ' . $tab['NOM_POSTE '] . ' et Lieu : ' . $tab['LIEU_TRAVAIL'] .'</p>';
	}
	catch(PDOException $e) {
		//On termine le script en affichant le code de l'erreur et le message
		die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'<p>');
	}
?>
