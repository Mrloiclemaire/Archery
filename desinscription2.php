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
 if(!empty($_POST['id']) && !empty($_POST['idconcours']))
			{
?>
<?php
			//on recupere les donnees que lutilisateur a insere du formulaire de la page précedente
			$id = htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8');
			$idconcours = htmlentities($_POST['idconcours'], ENT_QUOTES, 'UTF-8');
			//et on récupère l'organisateur depuis le numero du concours
			$dnn=mysql_fetch_array(mysql_query("select organisateur from club_organisateur where id='$idconcours'"));
			$organisateur=htmlentities($dnn['organisateur'], ENT_QUOTES, 'UTF-8');
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
			$organisateur= stripslashes($dnn['organisateur']);
		}
		else
		{
			$id = mysql_real_escape_string($_POST['id']);
			$organisateur = mysql_real_escape_string($dnn['organisateur']);
			
		}
?>		

<?php
	//on supprime les données de participation
	$sql_query="DELETE FROM $organisateur WHERE id ='$id' ";
    $result_query = mysql_query($sql_query)        //execution de la requete  
?>
<?php
	//verifier le nombre de ligne d'une table
	$req = mysql_query("SELECT COUNT(licence) FROM $organisateur ");
	$num = mysql_result($req,0);
			if(intval($num['licence'])==0) // si le nombre de lignes est égal à 0
			{
			$req2=mysql_query("DROP TABLE IF EXISTS $organisateur");//alors on supprime la table
			$req3=mysql_query("DELETE FROM club_organisateur WHERE organisateur= '$organisateur' "); //et on enleve le nom de la table club_organisateurs
			}		
	
?>	
<div class="message"><?php echo 'Merci  '.$_SESSION['prenom'].' :' ?> suppression en cours...<br />
<META HTTP-EQUIV="Refresh" CONTENT="2;URL=desinscription.php">
</div>	
<?php
//Si lutilisateur est connecte, on lui donne un lien pour modifier ses informations, pour se deconnecter
	if(isset($_SESSION['nom']))
	{
	}
	else
	{
	//Sinon, on lui donne un lien pour se connecter
?>
	<h2>
		<a href="connexion.php">Se connecter</a>
	</h2>	
<?php
	}
?>
<?php
}
else
{
?>
<div class="message"><?php echo 'Merci  '.$_SESSION['prenom'].' :' ?>  Mais vous n'avez pas envoyé de données à effacer !<br />
<META HTTP-EQUIV="Refresh" CONTENT="2;URL=desinscription.php">
</div>
<?php
}
?>
	</body>
</html>