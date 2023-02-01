<?php
session_start();
include('config.php');
include('fpdf/fpdf.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
        <link href="<?php echo $design; ?>/admin2.css" rel="stylesheet" title="Style" />
        <title>Administration</title>
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
	$email= $_SESSION['email'];
?>
<div class="message">traitement en cours...<br />

<br /><br />


<?php 
	if(isset($_POST['idsupprime']))
	{
	$idsupprime=$_POST['idsupprime'];
	//on veut supprimer une table concours avec la variable idsupprime
	//donc on cherche le nom du concours en fonction de l'id concours
	$dnn = mysql_fetch_array(mysql_query('SELECT organisateur FROM concours WHERE id="'.$_POST['idsupprime'].'"'));
	$nomconcours['organisateur']=$dnn['organisateur'];
	$nom=$nomconcours['organisateur'];
	echo 'suppression de la base de ' .$nom. '';
		//ensuite on supprime la table du concours correspondant
		$req2=mysql_query("DROP TABLE IF EXISTS  $nom ");
			//et on enlève le nom du concours de la table des concours disponibles
			$req3=mysql_query("DELETE from club_organisateur WHERE id= '$idsupprime'");
			//et on revient à la page admin
	}
?>
<?php
	if(isset($_POST['idefface']))
	{
	$idefface=$_POST['idefface'];   //définition de la variable
	$dnn = mysql_fetch_array(mysql_query('SELECT organisateur FROM concours WHERE id="'.$_POST['idefface'].'"')); //on recherche le nom organisateur depuis la variable
	$nomconcours['organisateur']=$dnn['organisateur']; //on défini cette variable trouvée
	$nom=$nomconcours['organisateur'];//deux fois au cas où
	echo 'suppression de la base de ' .$nom. ''; //on affiche le nom à l'écran
	$req  = mysql_query("DELETE from concours WHERE id='$idefface'"); //et on efface le nom de la base concours
	//et on revient à la page admin
	}
	
?>	


<META HTTP-EQUIV="Refresh" CONTENT="2;URL=admin2.php">

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