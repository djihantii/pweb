
<?php
	require_once('inscrire.html');
	include('php/Connexion.class.php');
	$con = new Connexion;
	$bd = $con->init();
	if( isset($_POST['Login'])){
		$requete = $bd->prepare('INSERT INTO COMPTE VALUES (:Login,:Email,:Name,:surname,:gnr,:pwd,"Y","F")');
		$requete->bindValue(':Login',$_POST['Login']);
		$requete->bindValue(':Name',$_POST['Nom']);
		$requete->bindValue(':surname',$_POST['Prenom']);
		$requete->bindValue(':Email',$_POST['Mail']);
		$requete->bindValue(':gnr',$_POST['genre']);
		$requete->bindValue(':pwd',$_POST['pwd']);
		$requete->execute();
	}
?>