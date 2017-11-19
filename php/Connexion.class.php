<?php
class Connexion {
	const DNS = 'mysql:host=localhost;dbname=pweb';
	const USER = 'marvin';
	const PWD = 'marvin';
	//const USER = 'root';
	//const PWD = '';
	const CHARSET = 'utf8';
	public function init()
	{
		try{
			$bd =new PDO($this::DNS, $this::USER, $this::PWD);
			$bd->query('SET NAMES '.$this::CHARSET);
			$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) {
			//Si une erreur se produit on affiche le message d'erreur
			die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'<p>');
		}
		return $bd;
	}
}
?>
