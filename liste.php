<?php
session_start();
include('config.php')
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
        <link href="<?php echo $design; ?>/liste.css" rel="stylesheet" title="Style" />
        <title>liste des inscrits</title>
    </head>
    <body>
<?php

  //on recupere les donnees que lutilisateur a insere du formulaire de la page précedente
			$id = htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8');
			$samedi = htmlentities($_POST['samedi'], ENT_QUOTES, 'UTF-8');
			$dimanche = htmlentities($_POST['dimanche'], ENT_QUOTES, 'UTF-8');
			$heure = htmlentities($_POST['heure'], ENT_QUOTES, 'UTF-8');
			//et on récupère l'organisateur depuis le numero du concours
			$dnn = mysql_fetch_array(mysql_query('select id, organisateur, discipline from concours where id="'.$_POST['id'].'"'));
			$organisateur = htmlentities($dnn['organisateur'], ENT_QUOTES, 'UTF-8');
			$discipline = htmlentities($dnn['discipline'], ENT_QUOTES, 'UTF-8');
?>

 <?php
 //on confirme les variables de la session
	$licence= $_SESSION['licence'];
  	$nom= $_SESSION['nom'];
	$prenom= $_SESSION['prenom'];
	$categorie= $_SESSION['categorie'];
	$email= $_SESSION['email'];
?>       
<?php
//On echappe les variables du formulaire pour pouvoir les mettre dans des requetes SQL
		if(get_magic_quotes_gpc())
		{
			$id = stripslashes($_POST['id']);
			$samedi = stripslashes($_POST['samedi']);
			$dimanche = stripslashes($_POST['dimanche']);
			$heure = stripslashes($_POST['heure']);
		}
		else
		{
			$id = mysql_real_escape_string($_POST['id']);
			$samedi = mysql_real_escape_string($_POST['samedi']);
			$dimanche = mysql_real_escape_string($_POST['dimanche']);
			$heure = mysql_real_escape_string($_POST['heure']);
		}
?>	

<?php
//Si lutilisateur est connecte, on lui donne un lien pour modifier ses informations, pour se deconnecter
	if(isset($_SESSION['nom']))
	{
?>
	

<h2>Gestion Sportive, liste des inscrits aux concours<br /><?php echo 'vous êtes connecté en tant que, '.$prenom.''; ?>.<br />
</h2><br />
<br /><br />
	<h3>
		<div class="menuaccueil">Menu <br />
		<div class="navmenu"><a href="index.php">Accueil Espace Personnel</a></div>
		</div>

	</h3>

<div class="tableau">

<?php
	//On recupere organisateur de la table concours
	$req1 = mysql_query('SELECT id, organisateur, affichage, discipline FROM club_organisateur order by id *1 ');
	while($idconcours = mysql_fetch_array($req1))
	{
?>
<?php 
$id=$idconcours['id'];
$organis=$idconcours['organisateur'];
$affiche=$idconcours['affichage'];
$discipli=$idconcours['discipline'];



?> 


<table>
	<caption>Liste des Inscrits pour le <?php echo ''.$discipli.''; ?> de <?php echo $affiche; ?></caption>
    <tr>
		<th class="colid">N°</th>
		<th class="collicence">licence</th>
		<th class="colnom">Nom</th>
		<th class="colprenom">Pr&eacute;nom</th>
    	<th class="colcat">cat&eacute;gorie</th>
    	<th class="colsam">Samedi</th>
		<th class="coldim">Dimanche</th>
		<th class="colheure">heure</th>
		<th class="coltrispot">trispot</th>
		
	</tr>
<?php
//on recupere les donnees des inscrits des tables correspondantes aux concours pour les afficher
$req2 = mysql_query("SELECT id, samedi, dimanche, heure, nom, prenom, licence, categorie,trispot FROM $organis  ");
//on cherche les donnees des tables et on les affiche
		while($dnn = mysql_fetch_array($req2))
		{
?>
		<tr>
			<td style="text-align:center"><?php echo $id; ?></td>
			<td style="text-align:center"><?php echo $dnn['licence']; ?></td>
			<td style="text-align:center"><?php echo $dnn['nom']; ?></td>
			<td style="text-align:center"><?php echo $dnn['prenom']; ?></td>
			<td style="text-align:center"><?php echo $dnn['categorie']; ?></td>
			<td style="text-align:center;color:red"><?php echo $dnn['samedi']; ?></td>
			<td style="text-align:center;color:red"><?php echo $dnn['dimanche']; ?></td>
			<td style="text-align:center;color:green"><?php echo $dnn['heure']; ?></td>
			<td style="text-align:center;color:blue"><?php echo $dnn['trispot']; ?></td>
		</tr>
<?php
		}
?>
<br /> 
<?php
		}
?>

</table>
<br />
</div>

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