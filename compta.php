<?php
session_start()
?>
<?php
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <link href="<?php echo $design; ?>/compta.css" rel="stylesheet" title="Style" />
        <title>Comptabilité</title>
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
<h2>Espace Comptabilit&eacute;,<br /><?php echo 'vous êtes connecté en tant que, '.$prenom.''; ?>.<br />
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
<div class="tableau">
<table>
	<caption> Comptabilit&eacute; Simplifi&eacute;e (demander les d&eacute;tails au responsable comp&eacute;titions)</caption>
    <tr>
		<th class="colnom">nom</th>
		<th class="colprenom">prenom</th>
    	<th class="colsomme">somme due</th>
    </tr>
<?php
//On recupere les données des concours
 $sql_query = mysql_query('select nom, prenom, somme_due from compta ');
 while ($dnn = mysql_fetch_array($sql_query)) 		
  
			{
			if(intval($dnn['somme_due'])>0)
			{
			$color='green';
			}
			else
			{
			$color='red';
			}
?>
	<tr>
		<td><?php echo $dnn['nom']; ?></td>
		<td><?php echo $dnn['prenom']; ?></td>
		<td style="color:<?php echo$color ?>"><?php echo $dnn['somme_due']; ?></td>
    </tr>
<?php
}
?>
</table>
</div>
		
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