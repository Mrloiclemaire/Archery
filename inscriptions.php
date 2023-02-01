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


<div>
	<h3>
		<div class="menuaccueil">Menu <br />
		<div class="navmenu"><a href="index.php">Accueil Espace Personnel</a></div>
		</div>
	</h3>
</div>	
<div class="bouton1">
 <form method="post" action="">
 <label for="discipline">1)Choisissez un type de concours &agrave; afficher</label><br /><br /><select name="discipline" id="discipline">
	<option value="Tir en Salle">Tir en Salle</option>
	<option value="FEDERAL">FEDERAL</option>
	<option value="FITA">FITA</option>
	<option value="FIELD">FIELD</option>
	</select>
	<input type="submit" value="Afficher">
</form>
</div>
</div>	




<?php
//si le formulaire à été envoyé
if(isset($_POST['discipline']))
{
$discipline=$_POST['discipline'];
//on affiche le tableau filtré avec la discipline
?>
<form method="POST" action="inscriptions2.php" >
<div class="tableau">

2) cliquez sur le samedi OU le dimanche du concours OUVERT souhait&eacute;, celui-&ccedil;i est automatiquement s&eacute;lectionn&eacute;<br /> NOUVEAU: si le concours est ouvert cliquez sur le nom de l'organisateur pour afficher le mandat dans un nouvel onglet  
<table>
	<caption> Liste des Concours </caption>
    <tr bgcolor="#c8c8c8">
		<th class="colid">Concours N&#186;</th>
		<th class="colsamedi">Samedi</th>
		<th class="coldimanche" >Dimanche</th>
		<th class="coldatelim">Date Limite</th>
		<th class="colstatut">Statut</th>
    	<th class="colorganisateur">Organisateur</th>
    	<th class="coldiscipline">Discipline</th>
		
    </tr>
<?php
//On recupere les données des concours avec filtrage discipline
$req = mysql_query("SELECT id, samedi, dimanche, date_limite, statut, organisateur, affichage, discipline, lien FROM concours where discipline='$discipline' order by id *1"); 
while($dnn = mysql_fetch_array($req)) //execution de le requete pour afficher le tableau filtré
{
	//changement de couleur pour les mots ouvert ou ferme ou libre 
			$color="";
			if ($dnn['statut']=='OUVERT') 
			{
			$color='green';
			}
			if ($dnn['statut']=='FERME')  
			{
			$color='red';
			}
			if ($dnn['statut']=='LIBRE')
			{
			$color='blue';
			}
?>
<script type="text/javascript">
$(".jour").click(function(event){
    $(".id").attr("checked", false);
    $("input[name='samedi']").attr("checked", false);
	$("input[name='dimanche']").attr("checked", false);
    var $jour = $(this);
    $jour.attr("checked", true);
    $jour.parent().parent().find("td:first").find("input").attr("checked", true);
})
</script>
	<tr bgcolor="#e9e9e9">
		<td><input type="radio" class="id" name="id" value="<?php echo $dnn['id']; ?>" required><?php echo $dnn['id']; ?></td>	
		<td><input type="radio" class="jour" name="samedi" value="<?php echo $dnn['samedi']; ?>" /><?php echo $dnn['samedi']; ?></td>
		<td><input type="radio" class="jour" name="dimanche" value="<?php echo $dnn['dimanche']; ?>" /><?php echo $dnn['dimanche']; ?></td>
    	<td style="color:red"><?php echo $dnn['date_limite']; ?></td>
		<td style="color:<?php echo $color ?>"><?php echo $dnn['statut']; ?></td>
		<td class="casetableau"><a href="<?php echo $dnn['lien']; ?>" target="_blank"><?php echo $dnn['affichage']; ?></a></td>
    	<td style="color:blue"><?php echo $dnn['discipline']; ?></td>
    </tr>
<?php
}
?>
</table>
</div>
<div class="bouton">

3)  (pour les classiques) 
			<label for="trispot">trispot ?</label> <select name="trispot" id="trispot">
            <option value="non">non</option>
		    <option value="oui">oui</option>
            </select> 
			<br />
			<br />	
4) choisissez l'heure de votre d&eacute;part (conforme au mandat)  puis cliquez sur le bouton valider pour finaliser votre inscription.
<br />
		<label for="heure">heure choisie</label> <select name="heure" id="heure">
           <option value="08h00">08h00</option>
		   <option value="08h15">08h15</option>
           <option value="08h30">08h30</option>
           <option value="08h45">08h45</option>
		   <option value="09h00">09h00</option>
           <option value="09h15">09h15</option>
		   <option value="09h30">09h30</option>
           <option value="09h45">09h45</option>
		   <option value="10h00">10h00</option>
           <option value="10h15">10h15</option>
		   <option value="10h30">10h30</option>
           <option value="10h45">10h45</option>
		   <option value="11h00">11h00</option>
           <option value="11h15">11h15</option>
		   <option value="11h30">11h30</option>
		   <option value="11h45">11h45</option>
		   <option value="12h00">12h00</option>
           <option value="12h15">12h15</option>
		   <option value="12h30">12h30</option>
           <option value="12h45">12h45</option>
		   <option value="13h00">13h00</option>
           <option value="13h15">13h15</option>
		   <option value="13h30">13h30</option>
           <option value="13h45">13h45</option>
		   <option value="14h00">14h00</option>
           <option value="14h15">14h15</option>
		   <option value="14h30">14h30</option>
           <option value="14h45">14h45</option>
		   <option value="15h00">15h00</option>
           <option value="15h15">15h15</option>
		   <option value="15h30">15h30</option>
		   <option value="15h45">15h45</option>
		   <option value="16h00">16h00</option>
           <option value="16h15">16h15</option>
		   <option value="16h30">16h30</option>
           <option value="16h45">16h45</option>
		   <option value="17h00">17h00</option>
           <option value="17h15">17h15</option>
		   <option value="17h30">17h30</option>
           <option value="17h45">17h45</option>
		   <option value="18h00">18h00</option>
           <option value="18h15">18h15</option>
		   <option value="18h30">18h30</option>
           <option value="18h45">18h45</option>
		   <option value="19h00">19h00</option>
           <option value="19h15">19h15</option>
		   <option value="19h30">19h30</option>
        </select> 
	   	<input type="submit" value="INSCRIPTION" />
		
		
	
		
		

</div>
</form>
<?php
}
else
 {
 //sinon on affiche le tableau complet
 ?>
<form method="POST" action="inscriptions2.php" >
<div class="tableau">
2) cliquez sur le samedi OU le dimanche du concours OUVERT souhait&eacute;, celui-&ccedil;i est automatiquement s&eacute;lectionn&eacute;.<br /> NOUVEAU: si le concours est ouvert cliquez sur le nom de l'organisateur pour afficher le mandat dans un nouvel onglet 
<table>
	
	<caption> Liste des Concours </caption>
    <tr bgcolor="#c8c8c8">
		<th class="colid">Concours N&#186;</th>
		<th class="colsamedi">Samedi</th>
		<th class="coldimanche" >Dimanche</th>
		<th class="coldatelim">Date Limite</th>
		<th class="colstatut">Statut</th>
    	<th class="colorganisateur">Organisateur</th>
    	<th class="coldiscipline">Discipline</th>
    </tr>
<?php
//On recupere les données des concours
$req = mysql_query("SELECT id, samedi, dimanche, date_limite, statut, organisateur, affichage, discipline, lien FROM concours  order by id *1"); 
while($dnn = mysql_fetch_array($req))
			{
			//changement de couleur pour les mots ouvert ou ferme
			$color="";
			if ($dnn['statut']=='OUVERT') 
			{
			$color='green';
			}
			if ($dnn['statut']=='FERME')  
			{
			$color='red';
			}
			if ($dnn['statut']=='LIBRE')
			{
			$color='blue';
			}
?>			
					<script type="text/javascript">
					$(".jour").click(function(event){
					$(".id").attr("checked", false);
					$("input[name='samedi']").attr("checked", false);
					$("input[name='dimanche']").attr("checked", false);
					var $jour = $(this);
					$jour.attr("checked", true);
					$jour.parent().parent().find("td:first").find("input").attr("checked", true);
					})
</script>
	<tr bgcolor="#e9e9e9">
		<td><input type="radio" class="id" name="id" value="<?php echo $dnn['id']; ?>" required><?php echo $dnn['id']; ?></td>	
		<td><input type="radio" class="jour" name="samedi" value="<?php echo $dnn['samedi']; ?>" /><?php echo $dnn['samedi']; ?></td>
		<td><input type="radio" class="jour" name="dimanche" value="<?php echo $dnn['dimanche']; ?>" /><?php echo $dnn['dimanche']; ?></td>
    	<td style="color:red"><?php echo $dnn['date_limite']; ?></td>
		<td style="color:<?php echo $color ?>"><?php echo $dnn['statut']; ?></td>
		<td class="casetableau"><a href="<?php echo $dnn['lien']; ?>" target="_blank"><?php echo $dnn['affichage']; ?></a></td>
    	<td style="color:blue"><?php echo $dnn['discipline']; ?></td>
    </tr>
<?php
}
?>
</table>
</div>
<div class="bouton">
3)  (pour les classiques) 
			<label for="trispot">trispot ?</label> <select name="trispot" id="trispot">
            <option value="non">non</option>
		    <option value="oui">oui</option>
            </select> 
			<br />
			<br />	
4) choisissez l'heure de votre d&eacute;part (conforme au mandat)  puis cliquez sur le bouton valider pour finaliser votre inscription.<br />
		<label for="heure">heure choisie</label> <select name="heure" id="heure">
           <option value="08h00">08h00</option>
		   <option value="08h15">08h15</option>
           <option value="08h30">08h30</option>
           <option value="08h45">08h45</option>
		   <option value="09h00">09h00</option>
           <option value="09h15">09h15</option>
		   <option value="09h30">09h30</option>
           <option value="09h45">09h45</option>
		   <option value="10h00">10h00</option>
           <option value="10h15">10h15</option>
		   <option value="10h30">10h30</option>
           <option value="10h45">10h45</option>
		   <option value="11h00">11h00</option>
           <option value="11h15">11h15</option>
		   <option value="11h30">11h30</option>
		   <option value="11h45">11h45</option>
		   <option value="12h00">12h00</option>
           <option value="12h15">12h15</option>
		   <option value="12h30">12h30</option>
           <option value="12h45">12h45</option>
		   <option value="13h00">13h00</option>
           <option value="13h15">13h15</option>
		   <option value="13h30">13h30</option>
           <option value="13h45">13h45</option>
		   <option value="14h00">14h00</option>
           <option value="14h15">14h15</option>
		   <option value="14h30">14h30</option>
           <option value="14h45">14h45</option>
		   <option value="15h00">15h00</option>
           <option value="15h15">15h15</option>
		   <option value="15h30">15h30</option>
		   <option value="15h45">15h45</option>
		   <option value="16h00">16h00</option>
           <option value="16h15">16h15</option>
		   <option value="16h30">16h30</option>
           <option value="16h45">16h45</option>
		   <option value="17h00">17h00</option>
           <option value="17h15">17h15</option>
		   <option value="17h30">17h30</option>
           <option value="17h45">17h45</option>
		   <option value="18h00">18h00</option>
           <option value="18h15">18h15</option>
		   <option value="18h30">18h30</option>
           <option value="18h45">18h45</option>
		   <option value="19h00">19h00</option>
           <option value="19h15">19h15</option>
		   <option value="19h30">19h30</option>
        </select> 
	   	<input type="submit" value="INSCRIPTION" />
		
</div>
</form>
<?php
}
?>
<?php
	}
	else
	{
	//lien pour user non loggué
?>
	<div class="message">
		<a href="connexion.php">Vous devez vous connecter</a>
		<META HTTP-EQUIV="Refresh" CONTENT="2;URL=connexion.php">
	</div>	
<?php
}
?>		
		
	</body>
</html>
