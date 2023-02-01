<?php
session_start();
include('config.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
        <link href="<?php echo $design; ?>/admin.css" rel="stylesheet" title="Style" />
        <title>Administration</title>
    </head>
    <body>
<?php
//Si lutilisateur est connecte, on lui donne un lien pour se deconnecter
if(isset($_SESSION['nom']))
{
?>
  
<?php
  //on joue avec les variables des sessions
	$licence= $_SESSION['licence'];
  	$nom= $_SESSION['nom'];
	$prenom= $_SESSION['prenom'];
	$categorie= $_SESSION['categorie'];
	$email= $_SESSION['email'];
?>
<h2><?php echo 'Bonjour, '.$prenom.'.'; ?><br />
Espace réservé à l'Administration.</h2><br />

<br /><br />


<section>
<aside>
	<h3>
		<div class="menuaccueil">Menu principal<br />
		<div class="navmenu"><a href="index.php">Accueil Espace Personnel</a></div>
		<div class="navmenu"><a href="connexion.php">D&eacute;connexion</a><br /></div>
		</div>
	</h3>
</aside>
</section>	

<?php

// Le mot de passe n'a pas été envoyé ou n'est pas bon
if (!isset($_POST['mot_de_passe']) OR $_POST['mot_de_passe'] != "Admin2693081")
{
	// Afficher le formulaire de saisie du mot de passe
?>
 <div>
		<form action="" method="post">
		La page d'Administration est protégée par un mot de passe, entrez ce mot de passe ci-dessous<br />	
			<input type="text" name="mot_de_passe" value="" id="mot_de_passe" required />
			<input type="submit" value="Valider" />
			
		</form>
</div>		
<?php		
}

// Le mot de passe a été envoyé et il est bon
else
{
?>
	<META HTTP-EQUIV="Refresh" CONTENT="0;URL=admin2.php"></div>	
<?php
}
?>

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