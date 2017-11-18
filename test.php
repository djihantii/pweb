<?php
	require_once('inscrire.html');
	require('php/Connexion.class.php');
	$con = new Connexion;
	try{
		$bd =new PDO($con::DNS, $con::USER, $con::PWD);
		$bd->query('SET NAMES '+ $con::CHARSET);
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
