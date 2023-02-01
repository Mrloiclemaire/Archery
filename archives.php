<?php
session_start();
include('config.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
        <link href="<?php echo $design; ?>/archives.css" rel="stylesheet" title="Style" />
        <title>Archives</title>
    </head>
    <body>
<?php
//Si lutilisateur est connecte, on lui donne un lien pour modifier ses informations, pour se deconnecter
if(isset($_SESSION['nom']))
{
?>    	   	
<?php
  //Si le formulaire a deja ete envoye on recupere les donnees que lutilisateur avait deja insere
		if(isset($_POST['licence'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['categorie']))
		{
			
			$licence = htmlentities($_POST['licence'], ENT_QUOTES, 'UTF-8');
			$nom = htmlentities($_POST['nom'], ENT_QUOTES, 'UTF-8');
			$prenom = htmlentities($_POST['prenom'], ENT_QUOTES, 'UTF-8');
			$email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
			$categorie = htmlentities($_POST['categorie'], ENT_QUOTES, 'UTF-8');
		}
		else
		{
			//Sinon, on affiche les donnes a partir de la base de donnees
			
			$dnn = mysql_fetch_array(mysql_query('select licence, nom, prenom, email, categorie from users where licence="'.$_SESSION['licence'].'"'));
			$licence = htmlentities($dnn['licence'], ENT_QUOTES, 'UTF-8');
			$nom = htmlentities($dnn['nom'], ENT_QUOTES, 'UTF-8');
			$prenom = htmlentities($dnn['prenom'], ENT_QUOTES, 'UTF-8');
			$email = htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8');
			$categorie = htmlentities($dnn['categorie'], ENT_QUOTES, 'UTF-8');
		}
?>
<h2>Comptes rendus de Réunions de Bureau, Assemblées générales,<br /><?php echo 'vous êtes connecté en tant que, '.$prenom.''; ?>.<br />
</h2><br />
<br /><br />
<aside>
	<h3>
		<div class="menuaccueil">Menu <br />
		<div class="navmenu"><a href="index.php">Retour l'accueil Espace Personnel</a></div>
		<div class="navmenu"><a href="connexion.php">D&eacute;connexion</a><br /></div>
		</div>
	</h3>
</aside>
<div class="archives"><a href="http://www.arc-montfermeil.com/documents_pdf/archives/CR291122.pdf" target="_blank">CR réunion bureau 29/11/22</a></div>
<div class="archives"><a href="http://www.arc-montfermeil.com/documents_pdf/archives/CR111022.pdf" target="_blank">CR réunion bureau 11/10/22</a></div>
<div class="archives"><a href="http://www.arc-montfermeil.com/documents_pdf/archives/CR020922.pdf" target="_blank">CR réunion bureau 02/09/22</a></div>
<div class="archives"><a href="http://www.arc-montfermeil.com/documents_pdf/archives/CR070622.pdf" target="_blank">CR réunion bureau 07/06/22</a></div>
<div class="archives"><a href="http://www.arc-montfermeil.com/documents_pdf/archives/CR090322.pdf" target="_blank">CR réunion bureau 09/03/22</a></div>
<div class="archives"><a href="http://www.arc-montfermeil.com/documents_pdf/archives/AG2022.pdf" target="_blank">CR AG 2022</a></div>
<div class="archives"><a href="http://www.arc-montfermeil.com/documents_pdf/archives/2021.zip" target="_blank">CR réunion de bureau 2021 (dossier complet .zip) </a></div>
<div class="archives"><a href="http://www.arc-montfermeil.com/documents_pdf/archives/2020.zip" target="_blank">CR réunion de bureau 2020 (dossier complet .zip) </a></div>
<div class="archives"><a href="http://www.arc-montfermeil.com/documents_pdf/archives/2019.zip" target="_blank">CR réunion de bureau 2019 (dossier complet .zip) </a></div>
<div class="archives"><a href="http://www.arc-montfermeil.com/documents_pdf/archives/2018.zip" target="_blank">CR réunion de bureau 2018 (dossier complet .zip) </a></div>

	



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