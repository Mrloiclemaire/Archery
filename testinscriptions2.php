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

  //on recupere les donnees que lutilisateur a insere du formulaire de la page précedente
			$id = htmlentities($_POST['id']['$id'], ENT_QUOTES, 'UTF-8');
			$samedi = htmlentities($_POST['samedi']['$id'], ENT_QUOTES, 'UTF-8');
			$dimanche = htmlentities($_POST['dimanche']['$id'], ENT_QUOTES, 'UTF-8');
			$heure = htmlentities($_POST['heure'], ENT_QUOTES, 'UTF-8');
			//et on récupère l'organisateur depuis le numero du concours
			$dnn = mysql_fetch_array(mysql_query('select id, organisateur, discipline from concours where id="'.$_POST['id'].'"'));
			$organisateur = htmlentities($dnn['organisateur'], ENT_QUOTES, 'UTF-8');
			$discipline = htmlentities($dnn['discipline'], ENT_QUOTES, 'UTF-8');
		
			echo 'concours'.$id.'';
			echo 'samedi'.$samedi.'';
			echo 'dimanche'.$dimanche.'';
			echo 'organisateur'.$organisateur.'';
			echo 'discipline'.$discipline.'';
			echo 'heure'.$heure.'';
			echo 'licence'.$licence.'';
			echo 'email'.$email.'';
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