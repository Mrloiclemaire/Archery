<?php
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>Inscription</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="<?php echo $design; ?>/images/logo.png" alt="Espace Membre" /></a>
	    </div>
<?php
//On verifie que le formulaire a ete envoye
if(isset($_POST['nom'], $_POST['prenom'], $_POST['licence'], $_POST['email'], $_POST['categorie']) and $_POST['licence']!='')
{
	//On enleve lechappement si get_magic_quotes_gpc est active
	if(get_magic_quotes_gpc())
	{
		$_POST['licence'] = stripslashes($_POST['licence']);
		$_POST['nom'] = stripslashes($_POST['nom']);
		$_POST['prenom'] = stripslashes($_POST['prenom']);
		$_POST['email'] = stripslashes($_POST['email']);
		$_POST['categorie'] = stripslashes($_POST['categorie']);
	}
		
		
			//On verifie si lemail est valide
			if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
			{
				//On echappe les variables pour pouvoir les mettre dans une requette SQL
				$licence = mysql_real_escape_string($_POST['licence']);
				$nom = mysql_real_escape_string($_POST['nom']);
				$prenom = mysql_real_escape_string($_POST['prenom']);
				$email = mysql_real_escape_string($_POST['email']);
				$categorie = mysql_real_escape_string($_POST['categorie']);
				
				//On verifie sil ny a pas deja un utilisateur inscrit avec le pseudo choisis
				$dn = mysql_num_rows(mysql_query('select id from users where licence="'.$licence.'"'));
				if($dn==0)
				{
					//On recupere le nombre dutilisateurs pour donner un identifiant a lutilisateur actuel
					$dn2 = mysql_num_rows(mysql_query('select id from users'));
					$id = $dn2+1;
					
					//On enregistre les informations dans la base de donnee
					if(mysql_query('insert into users(id, licence, nom, prenom, email, categorie) values ('.$id.', "'.$licence.'", "'.$nom.'", "'.$prenom.'", "'.$email.'", "'.$categorie.'")'))
					{
						//Si ca a fonctionne, on naffiche pas le formulaire
						$form = false;
?>
<div class="message">Vous avez bien &eacute;t&eacute; inscrit. Vous pouvez dor&eacute;navant vous connecter.<br />
<a href="connexion.php">Se connecter</a></div>
<?php
					}
					else
					{
						//Sinon on dit quil y a eu une erreur
						$form = true;
						$message = 'Une erreur est survenue lors de l\'inscription.';
					}
				}
				else
				{
					//Sinon, on dit que le pseudo voulu est deja pris
					$form = true;
					$message = 'le num&eacute;ro de licence est d&eacute;j&agrave; utilis&eacute;.';
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
		echo '<div class="message">'.$message.'</div>';
	}
	//On affiche le formulaire
?>
<div class="content">
    <form action="sign_up.php" method="post">
        Veuillez remplir ce formulaire pour vous inscrire:<br />
        <div class="center">
            <label for="licence">Num&eacute;ro de licence<span class="small"> Ex: 612485G</span></label><input type="text" name="licence" value="<?php if(isset($_POST['licence'])){echo htmlentities($_POST['licence'], ENT_QUOTES, 'UTF-8');} ?>" required /><br />
            <label for="prenom">Votre nom</label><input type=text" name="nom" required/><br />
			<label for="licence">Votre pr&eacute;nom</label><input type="text" name="prenom" required/><br />
            <label for="email">Votre email</label><input type="text" name="email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');} ?>" required/><br />
			<label for="categorie">Cat&eacute;gorie     </label>
				<select name="categorie" id="categorie"><br />	
					<option value="PHCL">PHCL</option>
					<option value="BHCL">BHCL</option>
					<option value="MHCL">MHCL</option>
					<option value="CHCL">CHCL</option>
					<option value="JHCL">JHCL</option>
					<option value="SHCL">SHCL</option>
					<option value="VHCL">VHCL</option>
					<option value="SVHCL">SVHCL</option>
					<option value="PFCL">PFCL</option>
					<option value="BFCL">BFCL</option>
					<option value="MFCL">MFCL</option>
					<option value="CFCL">CFCL</option>
					<option value="JFCL">JFCL</option>
					<option value="SFCL">SFCL</option>
					<option value="VFCL">VFCL</option>
					<option value="SVFCL">SVFCL</option>
					<option value="CHCO">CHCL</option>
					<option value="JHCO">JHCO</option>
					<option value="SHCO">SHCO</option>
					<option value="VHCO">VHCO</option>
					<option value="SVHCO">SVHCO</option>
					<option value="CFCO">CFCO</option>
					<option value="JFCO">JFCO</option>
					<option value="SFCO">SFCO</option>
					<option value="VFCO">VFCO</option>
					<option value="SVFCO">SVFCO</option>
					</select>
					<br />
					<br />
				</select>	
            <input type="submit" value="Soumettre" />
		</div>
    </form>
</div>
<?php
}
?>
		<div class="foot"><a href="<?php echo $url_home; ?>">Retour &agrave; l'accueil</a> 
	</body>
</html>