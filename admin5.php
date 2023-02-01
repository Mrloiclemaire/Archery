<?php
session_start();
include('config.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
        <link href="<?php echo $design; ?>/admin5.css" rel="stylesheet" title="Style" />
        <title>Gestion des membres</title>
    </head>	
    <body>
<?php
//Si lutilisateur est connecte, pour se deconnecter
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
<?php
//le 1er formulaire pour la suppression d'un membre
if(!empty($_POST['idefface']))
$idefface=$_POST['idefface'];
{
$req=mysql_query("DELETE from users WHERE id= '$idefface'");
}
?>

<?php
//2ème formulaire pour mettre à jour une catégorie
if(!empty ($_POST['idupdate']) AND ($_POST['idcat']))
$update=$_POST['idupdate'];
$cat=$_POST['idcat'];
{
$req2=mysql_query('update users set categorie="'.$cat.'" WHERE id="'.$update.'"');
}
?>
<?php
//3ème formulaire pour creer un compte membre
if(!empty($_POST['idnum'])AND ($_POST['idnom']) AND ($_POST['idprenom']) AND ($_POST['idlicence']) AND ($_POST['idcategorie']) AND ($_POST['idtype']))
$idnum=$_POST['idnum'];
$idnom=$_POST['idnom'];
$idprenom=$_POST['idprenom'];
$idlicence=$_POST['idlicence'];
$idcategorie=$_POST['idcategorie'];
$idtype=$_POST['idtype'];
{
$req3=mysql_query("INSERT INTO users (id, nom, prenom, licence, categorie, type)  values ('$idnum','$idnom', '$idprenom', '$idlicence', '$idcategorie', '$idtype')");
}

?>

<?php
//suppression de la ligne 0 de la table users
$req3=mysql_query("DELETE from users WHERE id=0");
?>


<h2>
Gestion membres.</h2><br />

<br /><br />

<div class="tableau">
				<table>
				<caption> Liste des Utilisateurs </caption>
						<tr bgcolor="#b3b3b3">
						<th id="colid">num&eacute;ro</th>
						<th id="colnom">Nom</th>
						<th id="colprenom">Pr&eacute;nom</th>
						<th id="collicence">Licence</th>
						<th id="colcategorie">cat&eacute;gorie</th>
						<th id="coltype">type</th>
						</tr>
						<?php 
						//on récupère le nom depuis la liste disponible dans la table club_organisateur
						
						$req = mysql_query('SELECT id, nom, prenom, licence, categorie, type FROM users order by id *1');
						while($dnn = mysql_fetch_array($req))
						{
						?>
						<tr bgcolor="#d0d0d0">
						<td><?php echo $dnn['id']; ?></td>
						<td><?php echo $dnn['nom']; ?></td>
						<td><?php echo $dnn['prenom']; ?></td>
						<td><?php echo $dnn['licence']; ?></td>
						<td><?php echo $dnn['categorie']; ?></td>
						<td><?php echo $dnn['type']; ?></td>
						
						</tr>
						<?php
						}
						?>
				</table>
			</div>
			<br />
	<div class="instructions">	
		<span style="color:blue">1) supprimer un membre de la liste</span> <br />  
			<form method="POST" action="admin5.php">
			<label for="idefface">Membre N° :</label><input type="text" name="idefface" value="" id="idefface" />
			<input type="submit" value="Effacer" />
			</form>	
			<br />
			<br />
		<span style="color:blue">2) Mettre à jour une cat&eacute;gorie</span> <br />
		<form method="POST" action="admin5.php">
			<label for="idupdate">Membre N° :</label><input type="text" name="idupdate" value="" id="idupdate" />
			<label for="idcat">Cat&eacute;gorie :</label> <select name="idcat" id="idcat">
           <option value="U11">U-11</option>
		   <option value="U13">U-13</option>
           <option value="U15">U-15</option>
           <option value="U18">U-18</option>
		   <option value="U21">U-21</option>
           <option value="S1FCL">S1FCL</option>
		   <option value="S2FCL">S2FCL</option>
           <option value="S3FCL">S3FCL</option>
		   <option value="S1HCL">S1HCL</option>
		   <option value="S2HCL">S2HCL</option>
		   <option value="S3HCL">S3HCL</option>
		   <option value="S1FCO">S1FCO</option>
		   <option value="S2FCO">S2FCO</option>
		   <option value="S3FCO">S3FCO</option>
           <option value="S1HCO">S1HCO</option>
		   <option value="S2HCO">S2HCO</option>
           <option value="S3HCO">S3HCO</option>
		   <option value="S3HBB">S1HBB</option>
		   <option value="S3HBB">S2HBB</option>
		   <option value="S3HBB">S3HBB</option>
		   <option value="S1FBB">S1FBB</option>
		   <option value="S2FBB">S2FBB</option>
		   <option value="S3FBB">S3FBB</option>
		   </select>
		   <input type="submit" value="Mettre à jour" />
			</form>	
			<br/>
			<br/>
		<span style="color:blue">3) Cr&eacute;er un membre</span> <br />
		<form method="POST" action="admin5.php">
		<label for="idnum">Num&eacute;ro:</label><input type="text" name="idnum" value="" id="idnum" />
		<label for="idnom">Nom:</label><input type="text" name="idnom" value="" id="idnom" onChange="javascript:this.value=this.value.toUpperCase()" />
		<label for="idprenom">Pr&eacute;nom:</label><input type="text" name="idprenom" value="" id="idprenom" onChange="javascript:this.value=this.value.toUpperCase()"/>
		<label for="idlicence">Licence:</label><input type="text" name="idlicence" value="" id="idlicence" onChange="javascript:this.value=this.value.toUpperCase()"/>
		<label for="idcategorie">Cat&eacute;gorie :</label> <select name="idcategorie" id="idcategorie">
			<option value="U11">U-11</option>
		    <option value="U13">U-13</option>
            <option value="U15">U-15</option>
            <option value="U18">U-18</option>
		    <option value="U21">U-21</option>
			<option value="S1FCL">S1FCL</option>
			<option value="S2FCL">S2FCL</option>
			<option value="S3FCL">S3FCL</option>
			<option value="S1HCL">S1HCL</option>
			<option value="S2HCL">S2HCL</option>
			<option value="S3HCL">S3HCL</option>
			<option value="S1FCO">S1FCO</option>
			<option value="S2FCO">S2FCO</option>
			<option value="S3FCO">S3FCO</option>
			<option value="S1HCO">S1HCO</option>
			<option value="S2HCO">S2HCO</option>
			<option value="S3HCO">S3HCO</option>
			<option value="S1HCO">S1HCO</option>
		   <option value="S2HCO">S2HCO</option>
           <option value="S3HCO">S3HCO</option>
		   <option value="S3HBB">S1HBB</option>
		   <option value="S3HBB">S2HBB</option>
		   <option value="S3HBB">S3HBB</option>
		   <option value="S1FBB">S1FBB</option>
		   <option value="S2FBB">S2FBB</option>
		   <option value="S3FBB">S3FBB</option>
			</select>
	   <label for="idtype">Type :</label> <select name="idtype" id="idtype">
           <option value="A">Adulte</option>
		   <option value="J">Jeune</option>
		   </select>
		   <input type="submit" value="Creer" />
		   </form>
		
		
			
		
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