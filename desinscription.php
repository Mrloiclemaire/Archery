<?php
session_start();
include('config.php')
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
        <link href="<?php echo $design; ?>/desinscription.css" rel="stylesheet" title="Style" />
        <title>désisnscription concours</title>
		<!-- Modernizr -->
		<script src="js/modernizr.js"></script>
		<script src="js/webforms2-p.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    </head>
    <body>
	<?php
//Si lutilisateur est connecte, on lui donne un lien pour se deconnecter
	if(isset($_SESSION['nom']))
		{
?>

	<h3>
		<div class="menuaccueil">Menu <br />
		<div class="navmenu"><a href="index.php">Accueil Espace Personnel</a></div>
		<div class="navmenu"><a href="connexion.php">D&eacute;connexion</a><br /></div>
		</div>
	</h3>

		<?php
		//on confirme les variable de la session
		$licence= $_SESSION['licence'];
		$nom= $_SESSION['nom'];
		$prenom= $_SESSION['prenom'];
		$categorie= $_SESSION['categorie'];
		$email= $_SESSION['email'];
?>
<h2>Gestion Sportive, désinscription à  un concours<br /><?php echo 'vous êtes connecté en tant que, '.$prenom.''; ?>.<br />
</h2><br />


<form method="POST" action="desinscription2.php" >
<div class="tableau">
<div style="color:red">Si votre Nom n'appara&icirc;t pas dans un des concours de la liste ci-dessous c'est que vous n'y &ecirc;tes pas inscrit !</div> 
<?php
	//

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
		<th class="colid" style="text-align:center">Concours</th>
		<th class="coldep" style="text-align:center">D&eacute;part</th>
		<th class="colsam">Samedi</th>
		<th class="coldim">Dimanche</th>
		<th class="colcat"style="text-align:center">Cat&eacute;gorie</th>
		<th class="colnom">Nom</th>
		<th class="colprenom">Pr&eacute;nom</th>
    </tr>
<?php
//on recupere les donnees des inscrits des tables correspondantes aux concours pour les afficher
$req2 = mysql_query("SELECT id, samedi, dimanche, heure, nom, prenom,licence, categorie, type FROM $organis WHERE licence='$licence' ");
//on cherche les donnees des tables et on les affiche
		while($dnn = mysql_fetch_array($req2))
		{
		
?>

		<tr>
			<td><input type="radio" class="idconcours" name="idconcours" value="<?php echo $id; ?>" required /><?php echo $id; ?></td>	
			<td style="color:red"><input type="radio" class="id" name="id" value="<?php echo $dnn['id']; ?>" required /><?php echo $dnn['heure']; ?></td>
			<td style="color:red"><?php echo $dnn['samedi']; ?></td>	
			<td style="color:red"><?php echo $dnn['dimanche']; ?></td>
			<td style="color:blue"><?php echo $dnn['categorie']; ?></td>
			<td style="color:blue"><?php echo $dnn['nom']; ?></td>
			<td style="color:blue"><?php echo $dnn['prenom']; ?></td>
		</tr>
		<script type="text/javascript">
				$(".id").click(function(event){
				$(".idconcours").attr("checked", false);
				$("input[name='id']").attr("checked", false);
				var $jour = $(this);
				$jour.attr("checked", true);
				$jour.parent().parent().find("td:first").find("input").attr("checked", true);})
		</script>
		
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
<div class="instructions2">
Choisissez un concours où vous êtes inscrit puis sélectionner le départ que vous souhaitez annuler.
<div class="bouton">
	
		<label for="licence">licence :</label><input type="text" name="" id="" readonly value="<?php echo $licence; ?>" /><br />
		<label for="nom">Nom :</label><input type="text" name="" id="" readonly value="<?php echo $nom; ?>" /><br /><br />
		
		<input type="submit" value="DESINSCRIPTION" />
</div>
</div>

</form>



	
<?php
	}
	else
	{
	//Sinon, on lui donne un lien pour se connecter
?>
		<div class="message">Vous devez vous connecter</div>
		<META HTTP-EQUIV="Refresh" CONTENT="2;URL=connexion.php">
	<div>	
<?php
}
?>	
	</body>
	</html>