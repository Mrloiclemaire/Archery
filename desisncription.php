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
		<h3>
		<div class="menuaccueil">Menu <br />
		<div class="navmenu"><a href="index.php">Accueil Espace Personnel</a></div>
		<div class="navmenu"><a href="liste.php">Liste incrits</a></div>
		<div class="navmenu"><a href="connexion.php">D&eacute;connexion</a><br /></div>
		</div>
	</h3>
<?php
//Si lutilisateur est connecte, on lui donne un lien pour se deconnecter
	if(isset($_SESSION['nom']))
		{
?>
		<?php
		//on confirme les variable de la session
		$licence= $_SESSION['licence'];
		$nom= $_SESSION['nom'];
		$prenom= $_SESSION['prenom'];
		$categorie= $_SESSION['categorie'];
		$email= $_SESSION['email'];
?>
<?php
			// on va chercher les tables concours et on spécifie la variable associée

			$sql_query= mysql_query ('SELECT organisateur from club_organisateur')
			while ($result_query = mysql_fetch_array($sql_query))
			{
 
?>

<form class="form" action="" method="post">
        <br />
        <div class="center">
            <label for="nom">Nom </label><input type="text" name="nom" id="nom" readonly value="<?php echo $nom; ?>" /><br />
			<label for="concours">Concours</label><select name="concours">
											<option value="<?php echo $sql_query;?>" /> <?php echo $sql_query ?></option>
											</select>
			
            <input type="submit" value="Soumettre" />
		</div>
    </form>


<?php
}
?>
	
<?php
//Si lutilisateur est connecte, on lui donne un lien pour se deconnecter
if(isset($_SESSION['nom']))
{
?>


<?php
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
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	</body>
	</head>