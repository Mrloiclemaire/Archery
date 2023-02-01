<?php
session_start();
include('config.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		
        <link href="<?php echo $design; ?>/inscriptions.css" rel="stylesheet" title="Style" />
        <title>Inscriptions</title>
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
<?php
  //on joue avec les variables des sessions
	$licence= $_SESSION['licence'];
  	$nom= $_SESSION['nom'];
	$prenom= $_SESSION['prenom'];
	$categorie= $_SESSION['categorie'];
	$email= $_SESSION['email'];
?>

<h2>Gestion Sportive, inscriptions aux concours<br /><?php echo 'vous &ecirc;tes connect&eacute; en tant que, '.$prenom.''; ?>.<br />
</h2>
<div>
	<h3>
		<div class="menuaccueil">Menu <br />
		<div class="navmenu"><a href="index.php">Accueil Espace Personnel</a></div>
		<div class="navmenu"><a href="connexion.php">D&eacute;connexion</a><br /></div>
		</div>
	</h3>
</div>	


<form method="POST" action="testinscriptions2.php" >
<div class="tableau">

2) choisissez un concours dans la liste ci-dessous puis s&eacute;lectionnez le samedi OU le dimanche 
<table>
	<caption> Liste des Concours </caption>
    <tr>
		<th class="colid">Concours N&#186;</th>
		<th class="colsamedi">Samedi</th>
		<th class="coldimanche" >Dimanche</th>
		<th>Heure</th>
		<th class="coldatelim">Date Limite</th>
    	<th class="colorganisateur">Organisateur</th>
    	<th class="coldiscipline">Discipline</th>
		
    </tr>
<?php
//On recupere les données des concours avec filtrage discipline
$req = mysql_query("SELECT id, samedi, dimanche, date_limite, organisateur, affichage, discipline FROM concours"); 
while($dnn = mysql_fetch_array($req)) //execution de le requete pour afficher le tableau filtré
{
?>
	<tr>
				<td><input type="checkbox" class="id" name="id[<?php echo $dnn['id'];?>]" value="<?php echo $dnn['id']; ?>" /><?php echo $dnn['id']; ?></td>	
		<td><input type="radio" name="jour[<?php echo $dnn['id'];?>]" value="<?php echo $dnn['samedi']; ?>" /><?php echo $dnn['samedi']; ?></td>
		<td><input type="radio" name="jour[<?php echo $dnn['id'];?>]" value="<?php echo $dnn['dimanche']; ?>" /><?php echo $dnn['dimanche']; ?></td>
		<td><select name="heure[<?php echo $dnn['id'];?>]" id="heure">
           <option value="08h00">08h00</option>
           <option value="08h30">08h30</option>
           <option value="09h00">09h00</option>
           <option value="09h30">09h30</option>
           <option value="10h00">10h00</option>
           <option value="10h30">10h30</option>
           <option value="11h00">11h00</option>
           <option value="11h30">11h30</option>
		   <option value="12h00">12h00</option>
           <option value="12h30">12h30</option>
           <option value="13h00">13h00</option>
           <option value="13h30">13h30</option>
           <option value="14h00">14h00</option>
           <option value="14h30">14h30</option>
           <option value="15h00">15h00</option>
           <option value="15h30">15h30</option>
		   <option value="16h00">16h00</option>
           <option value="16h30">16h30</option>
           <option value="17h00">17h00</option>
           <option value="17h30">17h30</option>
           <option value="18h00">18h00</option>
           <option value="18h30">18h30</option>
           <option value="19h00">19h00</option>
           <option value="19h30">19h30</option>
        </select> 												</td>
    	<td style="color:red"><?php echo $dnn['date_limite']; ?></td>
		<td><?php echo $dnn['affichage']; ?></td>
    	<td style="color:blue"><?php echo $dnn['discipline']; ?></td>
    </tr>

<?php
}
?>
</table>
</div>
<div class="bouton">
3) choisissez l'heure de votre d&eacute;part  puis cliquez sur le bouton valider pour finaliser votre inscription.<br /><br />

	   	<input type="submit" value="valider" />
</div>
</form>

<?php
	}
	else
	{
	//Sinon, on lui donne un lien pour se connecter
?>
	<div class="message">
		<a href="connexion.php">Vous devez vous connecter</a>
		<META HTTP-EQUIV="Refresh" CONTENT="2;URL=connexion.php">
	<div>	
<?php
}
?>		
		
	</body>
</html>