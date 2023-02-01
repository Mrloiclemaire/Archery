<?php
session_start();
include('config.php')
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
        <link href="<?php echo $design; ?>/liste.css" rel="stylesheet" title="Style" />
        <title>validation inscription</title>
    </head>
    <body>
	<?php
//Si lutilisateur est connecte, on lui donne un lien pour modifier ses informations, pour se deconnecter
	if(isset($_SESSION['nom']))
	{
?>
 <?php
 //on confirme les variables de la session
	$licence= $_SESSION['licence'];
  	$nom= $_SESSION['nom'];
	$prenom= $_SESSION['prenom'];
	$categorie= $_SESSION['categorie'];
	$email= $_SESSION['email'];
	$type= $_SESSION['type'];
?> 
<?php
if(isset($_POST['samedi']) OR ($_POST['dimanche']))
			{
?>
<?php

  //on recupere les donnees que lutilisateur a insere du formulaire de la page précedente
			$id = htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8');
			$samedi = htmlentities($_POST['samedi'], ENT_QUOTES, 'UTF-8');
			$dimanche = htmlentities($_POST['dimanche'], ENT_QUOTES, 'UTF-8');
			$trispot = htmlentities($_POST['trispot'], ENT_QUOTES, 'UTF-8');
			$heure = htmlentities($_POST['heure'], ENT_QUOTES, 'UTF-8');
	//et on récupère l'organisateur depuis le numero du concours
			$dnn = mysql_fetch_array(mysql_query('select id, organisateur, affichage, discipline, date_limite from concours where id="'.$_POST['id'].'"'));
			$idconcours = htmlentities($dnn['id'], ENT_QUOTES, 'UTF-8');
			$affichage = htmlentities($dnn['affichage'], ENT_QUOTES, 'UTF-8');
			$organisateur = htmlentities($dnn['organisateur'], ENT_QUOTES, 'UTF-8');
			$discipline = htmlentities($dnn['discipline'], ENT_QUOTES, 'UTF-8');
			$datemax =  htmlentities($dnn['date_limite'], ENT_QUOTES, 'UTF-8');
?>
 
<?php
//On echappe les variables du formulaire pour pouvoir les mettre dans des requetes SQL
		if(get_magic_quotes_gpc())
		{
			$id = stripslashes($_POST['id']);
			$samedi = stripslashes($_POST['samedi']);
			$dimanche = stripslashes($_POST['dimanche']);
			$heure = stripslashes($_POST['heure']);
			$affichage = stripslashes($dnn['affichage']);
			$discipline = stripslashes($dnn['discipline']);
			$datemax = stripslashes($dnn['date_limite']);
			$trispot = stripslashes($_POST['trispot']);
		}
		else
		{
			$id = mysql_real_escape_string($_POST['id']);
			$samedi = mysql_real_escape_string($_POST['samedi']);
			$dimanche = mysql_real_escape_string($_POST['dimanche']);
			$heure = mysql_real_escape_string($_POST['heure']);
			$affichage = mysql_real_escape_string($dnn['affichage']);
			$discipline = mysql_real_escape_string($dnn['discipline']);
			$datemax = mysql_real_escape_string($dnn['date_limite']);
			$trispot = mysql_real_escape_string($_POST['trispot']);
		}
?>		
<?php
//on cree la table du concours
$sql_query="CREATE TABLE IF NOT EXISTS $organisateur
		( 
		id INT(11) auto_increment,
		idconcours varchar(4),
		affichage varchar(100),
		discipline varchar (50),
		samedi varchar(12),
		dimanche varchar(12),
		heure varchar(6),
		nom varchar(25),
		prenom varchar(25),
		licence varchar(7), 
		categorie varchar (5),
		type char (1),
		trispot char (3),
		PRIMARY KEY  (id)
		)
		ENGINE= MyISAM";   // Requête
    $result_query= mysql_query($sql_query)     // Exécution de la requête
 ?> 
 <?php 
	//on entre le nom de l'organisateur du concours créé dans la table club_organisateur
		$sql_query2="INSERT INTO club_organisateur(id, organisateur, affichage, discipline, date_limite)  values ('$id', '$organisateur', '$affichage', '$discipline', '$datemax')";
		$result_query2 = mysql_query ($sql_query2)   //execution de la requete
?>	
<?php
	//on entre les données concours et utilisateur dans la base de donnees qui vient detre creee
	$sql_query="INSERT INTO $organisateur(id,idconcours, affichage, discipline, samedi, dimanche, heure, nom, prenom, licence, categorie, type, trispot ) 
	values ('','$idconcours', '$affichage','$discipline', '$samedi', '$dimanche', '$heure', '$nom', '$prenom', '$licence', '$categorie', '$type', '$trispot' )";
    $result_query = mysql_query($sql_query)        //execution de la requete  
	//on entre les données dans la table inscrits
	//$sql="INSERT INTO tbl_inscrits(id, idconcours, organisateur, licence, nom, prenom, categorie, samedi, dimanche, heure, type ) 
	//values ('', '$idconcours', '$nomduclub', '$licence', '$nom', '$prenom', '$categorie', '$samedi', '$dimanche', '$heure', '$type' )";
	//$result = mysql_query($sql)
	
?>
<div class="message"><?php echo 'Merci de votre validation, '.$_SESSION['prenom'].':' ?> traitement en cours...<br />
<META HTTP-EQUIV="Refresh" CONTENT="2;URL=inscriptions.php"></div>
<?php
}
else
{
?>
<div class="message"><?php echo 'Merci, '.$_SESSION['prenom'].':' ?> vous n'avez pas du indiquer le jour...<br />
<META HTTP-EQUIV="Refresh" CONTENT="2;URL=inscriptions.php"></div>
<?php
}
?>
<?php
	}
	else
	{
	//Sinon, on lui donne un lien pour se connecter
?>
		<div class="message">Vous devez vous connecter</div>
		<META HTTP-EQUIV="Refresh" CONTENT="2;URL=connexion.php">
<?php
}
?>	
	</body>
</html>