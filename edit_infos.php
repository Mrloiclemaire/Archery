<?php
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>Modifier ses informations personnelles</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="<?php echo $design; ?>/images/logo.png" alt="Espace Membre" /></a>
	    </div>
<?php
//On verifie si lutilisateur est connecte
if(isset($_SESSION['licence']))
{
	//On verifie si le formulaire a ete envoye
	if(isset($_POST['licence'], $_POST['nom'], $_POST['prenom'], $_POST['categorie'], $_POST['photo']))
	{
		//On enleve lechappement si get_magic_quotes_gpc est active
		if(get_magic_quotes_gpc())
		{
			$_POST['licence'] = stripslashes($_POST['licence']);
			$_POST['nom'] = stripslashes($_POST['nom']);
			$_POST['prenom'] = stripslashes($_POST['prenom']);
			$_POST['categorie'] = stripslashes($_POST['categorie']);
			$_POST['photo'] = stripslashes($_POST['photo']);
		}
		
					
				//On verifie si lemail est valide
				if(preg_match('#^(([ a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[ a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([ a-z0-9-_]+\.?)*[ a-z0-9-_]+)\.[ a-z]{2,}$#i',$_POST['email']))
				{
					//On echappe les variables pour pouvoir les mettre dans une requette SQL
					$licence = mysql_real_escape_string($_POST['licence']);
					$nom = mysql_real_escape_string($_POST['nom']);
					$prenom = mysql_real_escape_string($_POST['prenom']);
					$categorie = mysql_real_escape_string($_POST['categorie']);
					$photo = mysql_real_escape_string($_POST['photo']);
					
					
						//On modifie les informations de lutilisateur avec les nouvelles
						if(mysql_query('update users set licence="'.$licence.'", nom="'.$nom.'", prenom="'.$prenom.'", email="'.$email.'", categorie="'.$categorie.'", photo="'.$photo.'" where licence="'.mysql_real_escape_string($_SESSION['licence']).'"'))
						{
							//Si ca a fonctionne, on naffiche pas le formulaire
							$form = false;
							
?>
<div class="message">Vos informations ont bien &eacute;t&eacute; modifi&eacute;es.retour vers l'accueil<br />
<META HTTP-EQUIV="Refresh" CONTENT="3;URL=index.php"></div>
<?php
						}
						else
						{
							//Sinon on dit quil y a eu une erreur
							$form = true;
							$message = 'Une erreur est survenue lors des modifications.';
						}
					
				}
				else
				{
					//Sinon, on dit que lemail nest pas valide
					$form = true;
					$message = 'L\'email que vous avez entr&eacute; n\'est pas valide.';
				}
			
		
		
	}
	else
	{
		$form = true;
	}
	if($form)
	{
		//On affiche un message sil y a lieu
		if(isset($message))
		{
			echo '<strong>'.$message.'</strong>';
		}
		//Si le formulaire a deja ete envoye on recupere les donnees que lutilisateur avait deja insere
		if(isset($_POST['licence'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['categorie'], $_POST['photo']))
		{
			
			$licence = htmlentities($_POST['licence'], ENT_QUOTES, 'UTF-8');
			$nom = htmlentities($_POST['nom'], ENT_QUOTES, 'UTF-8');
			$prenom = htmlentities($_POST['prenom'], ENT_QUOTES, 'UTF-8');
			$categorie = htmlentities($_POST['categorie'], ENT_QUOTES, 'UTF-8');
			
		}
		else
		{
			//Sinon, on affiche les donnes a partir de la base de donnees
			
			$dnn = mysql_fetch_array(mysql_query('select licence, nom, prenom, email, categorie, photo from users where licence="'.$_SESSION['licence'].'"'));
			$licence = htmlentities($dnn['licence'], ENT_QUOTES, 'UTF-8');
			$nom = htmlentities($dnn['nom'], ENT_QUOTES, 'UTF-8');
			$prenom = htmlentities($dnn['prenom'], ENT_QUOTES, 'UTF-8');
			$categorie = htmlentities($dnn['categorie'], ENT_QUOTES, 'UTF-8');
			
		}
		//On affiche le formulaire
?>
<div class="content">
<fieldset>
<legend><strong>Vous pouvez modifier vos informations<strong></legend>
    <form action="edit_infos.php" method="post">
        <br />
		<strong> seule l'adresse Email est modifiable et le choix d'affichage de la photo<br /> 
        <div class="center">
            <label for="licence">Num&eacute;ro de licence</label><input type="text" name="licence" id="licence" readonly value="<?php echo $licence; ?>" /><br />
			<label for="nom">Nom </label><input type="text" name="nom" id="nom" readonly value="<?php echo $nom; ?>" /><br />
            <label for="prenom">pr&eacute;nom </label><input type="prenom" name="prenom" id="prenom" readonly value="<?php echo $prenom; ?>" /> <br />
            <label for="categorie">Cat&eacute;gorie</label><input type="text" name="categorie" id="categorie" readonly value="<?php echo $categorie; ?>" /><br />
		
		
			<br />
            <input type="submit" value="Envoyer" />
        </div>
		</strong>
    </form>
	
</fieldset>	
</div>
<?php
	}
}
else
{
?>
<div class="message">Pour acc&eacute;der &agrave; cette page, vous devez &ecirc;tre connect&eacute;.<br />
<META HTTP-EQUIV="Refresh" CONTENT="3;URL=connexion.php"></div>
<?php
}
?>
		<div class="foot"><a href="<?php echo $url_home; ?>">Retour &agrave; l'accueil</a></div>
	</body>
</html>