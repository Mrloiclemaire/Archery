<?php
session_start();
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
        <link href="<?php echo $design; ?>/index.css" rel="stylesheet" title="Style" />
        <title>Accueil Espace membre</title>
    </head>
    <body>
<?php
//Si lutilisateur est connecte, on lui donne un lien pour modifier ses informations, pour se deconnecter
if(isset($_SESSION['nom']))
{
?>
   	
<?php
  //on joue avec les variables des sessions
	$licence= $_SESSION['licence'];
  	$nom= $_SESSION['nom'];
	$prenom= $_SESSION['prenom'];
	$categorie= $_SESSION['categorie'];
	$type= $_SESSION['type'];
?>
<?php
	//on va chercher la donnée pour affichage photo et mail
	$dnn=mysql_fetch_array(mysql_query("select email, photo from users where licence='$licence'"));
			$photo=htmlentities($dnn['photo'], ENT_QUOTES, 'UTF-8');
			$email=htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8');
?>
<h2><?php echo 'Bonjour, '.$prenom.'.'; ?><br />
Bienvenue dans votre espace personnel.</h2><br />
<br /><br />

<?php if ($photo == 'oui') // si la valeur est oui  
{
?>
<div class="article">
<p class="image"> 
	<img src="default/trombi/<?php echo $licence ?>.jpg" alt="photo" />
	</p>
	<h3>Votre fiche d'identit&eacute;:</h3><br />
	<?php echo 'Licence:&nbsp&nbsp&nbsp&nbsp&nbsp<b>'.$licence.'</b>'; ?><br />
	<?php echo 'Nom:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>' .$nom.'</b>'; ?><br />
	<?php echo 'Pr&eacute;nom:&nbsp&nbsp&nbsp&nbsp&nbsp<b>'.$prenom.'</b>' ?><br />
	<?php echo 'Cat&eacute;gorie:&nbsp&nbsp&nbsp&nbsp&nbsp<b>'.$categorie.'</b>' ?><br />
		<div class="navmenu"><a href="edit_infos.php"><b>Modifier mes informations personnelles</b></a></div>
		<br />
	<b>Cet espace personnalis&eacute; vous permet de g&eacute;rer en quelques clics 
	vos inscriptions aux comp&eacute;titions. <br />cliquez sur inscriptions puis sur le nom de l'organisateur d'un concours OUVERT pour afficher le mandat.<br /><br />
	
	STATUT des concours<br />
		<a style="color:#00f800">OUVERT</a>: inscriptions possibles<br />
		<a style="color:red">FERME</a>: mandat non disponible<br />
		<a style="color:#9191ff">LIBRE</a>: date limite d&eacute;pass&eacute;e inscriptions &agrave; g&eacute;rer par vous-m&ecirc;me<br />
	</b>
	</div>
<?php
}
else
{
?>
<div class="article">
<p class="image"> 
	<h3>Votre fiche d'identit&eacute;:</h3><br />
	<?php echo 'Licence:&nbsp&nbsp&nbsp&nbsp&nbsp<b>'.$licence.'</b>'; ?><br />
	<?php echo 'Nom:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>' .$nom.'</b>'; ?><br />
	<?php echo 'Pr&eacute;nom:&nbsp&nbsp&nbsp&nbsp&nbsp<b>'.$prenom.'</b>' ?><br />
	<?php echo 'Cat&eacute;gorie:&nbsp&nbsp&nbsp&nbsp&nbsp<b>'.$categorie.'</b>' ?><br />
			<div class="navmenu"><a href="edit_infos.php"><b>Modifier mes informations personnelles</b></a></div>
		<br />
	<b>Cet espace personnalis&eacute; vous permet de g&eacute;rer en quelques clics 
	vos inscriptions aux comp&eacute;titions. <br />cliquez sur inscriptions puis sur le nom de l'organisateur d'un concours OUVERT pour afficher le mandat.<br /><br />
	
	STATUT des concours<br />
		<a style="color:#00f800">OUVERT</a>: inscriptions possibles<br />
		<a style="color:red">FERME</a>: mandat non disponible<br />
		<a style="color:#9191ff">LIBRE</a>: date limite d&eacute;pass&eacute;e inscriptions &agrave; g&eacute;rer par vous-m&ecirc;me<br />
	</b>
</div>
<?php
}
?>
<aside>
	<h3>
		<div class="menuaccueil">Menu principal<br />
		<div class="navmenu"><a href="liste.php">Liste des inscrits aux concours</a></div>
		<div class="navmenu"><a href="inscriptions.php">Incriptions aux concours</a></div>
		<div class="navmenu"><a href="desinscription.php">D&eacute;sinscriptions </a></div>
		<div class="navmenu"><a href="compta.php">Comptabilit&eacute; </a></div>
		<div class="navmenu"><a href="archives.php">Comptes rendus de r&eacute;union de Bureau et AG</a></div>
		<div class="navmenu"><a href="admin.php">Espace r&eacute;serv&eacute; Administrateur</a></div>
		<div class="navmenu"><a href="http://www.arc-montfermeil.com/documents_pdf/espace_membre1.pdf" target="_blank">Mode d'emploi du site(pdf 3Mo)</a></div>
		<div class="navmenu"><a href="connexion.php">D&eacute;connexion</a><br />
		</div>
	</h3>
		
</aside>





	
<?php
}
else
{
//Sinon, on lui donne un lien pour se connecter
?>
	<div class="message">Vous devez vous connecter.<br />
<META HTTP-EQUIV="Refresh" CONTENT="3;URL=connexion.php"></div>	
<?php
}
?>	

		
	</body>
</html>