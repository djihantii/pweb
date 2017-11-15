<?php
	require_once('inscrire.html');
	require_once('php/Connexion.class.php');
	$con = new Connexion;
	try{
		$bd =new PDO($con::DNS, $con::USER, $con::PWD);
		//$bd =new PDO('mysql:host=localhost;dbname=pweb;charset=utf8', 'root', '');
	}
	catch(PDOException $e) {
		// On termine le script en affichant le code de l'erreur et le message
		//die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'<p>');
	}
	$bd->query('SOURCE sql/createtables.sql');
	$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
