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
	//On recupere organisateur de la table concours
	$req1 = mysql_query('SELECT discipline, organisateur FROM concours');
	while($idconcours= mysql_fetch_array($req1))
	{
?>

<?php 

$organis=$idconcours['organisateur'];
$discipli=$idconcours['discipline'];

?> 

<div class="tableau">
<table>
	<caption><strong> Liste des Inscrits pour le <?php echo ''.$discipli.''; ?> de <?php echo ''.$organis.''; ?></strong></caption>
    <tr>
		<th>num&eacute;ro</th>
		<th>samedi</th>
		<th>Dimanche</th>
		<th>Heure</th>
    	<th>Nom</th>
    	<th>Pr&eacute;nom</th>
		<th>Licence</th>
		<th>Cat&eacute;gorie</th>
		<th>tarif</th>
		
    </tr>
<?php
//on recupere les donnees des inscrits des tables correspondantes aux concours pour les afficher
$req2 = mysql_query('SELECT id, samedi, dimanche, heure, nom, prenom, licence,  categorie, tarif FROM ' .$organis );
while($dnn = mysql_fetch_array($req2) or die('Erreur SQL !<br><font size="2">'.$req2.'<br>'.mysql_error()));
{

?>
	<tr>
		<td><?php echo $dnn['id']; ?></td>	
		<td><?php echo $dnn['samedi']; ?></td>	
		<td><?php echo $dnn['dimanche']; ?></td>
    	<td><?php echo $dnn['heure']; ?></td>
    	<td><?php echo $dnn['nom']; ?></td>
		<td><?php echo $dnn['prenom']; ?></td>
		<td><?php echo $dnn['licence']; ?></td>
		<td><?php echo $dnn['categorie']; ?></td>
		<td><?php echo $dnn['tarif']; ?></td>
		
    </tr>
<?php
}}
?>
</table>
</div>
</body>
</html>