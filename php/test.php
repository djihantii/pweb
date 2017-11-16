<?php
echo
'<!doctype html>
<html>
<head>
<title> TITRE OBLIGATOIRE </title>
<meta charset="utf-8"/>
</head>
<body>
<p> Hello world </p>
</body>
</html>';
?>

<?php
if
(isset($_GET['nom'])
and
isset($_GET['prenom'])
and
isset($_GET['civilite'])
and
trim($_GET['nom'])!=''
and
trim($_GET['prenom'])!=''
and
trim($_GET['civilite'])!='') {
if
($_GET['civilite']=='h')
echo
'<p> Bienvenue Mr ';
else
echo
'<p> Bienvenue Mme ';
echo
$_GET['prenom'] . ' ' . $_GET['nom'] . ' </p>' . "
\n
";
}
else
echo
'<p> Problème lors de la saisie du formulaire </p>';
?>
