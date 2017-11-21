<?php
	function init_session(){
		session_start();
		if(isset($_POST['disconnected'])) {
			session_destroy();
			$_SESSION['Login'] = "";
		}
	}
	function acces_bd()
	{
		include('Connexion.class.php');
		$con = new Connexion;
		$bd = $con->init();
		return $bd;
	}
	function connectedbar($lien)
	{
		if(isset($_SESSION['Login']) and trim($_SESSION['Login'])!="") {
			echo '<a href="'.$lien.'">'.$_SESSION['Nom'].' '.$_SESSION['Prenom'] .'</a><form action="index.php" method="post"><button class="btn btn-info btn-lg" type="submit" name="disconnected" value="True">Deconnexion</button></form>';
		}
	}
?>