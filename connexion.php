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
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>Connexion</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="<?php echo $design; ?>/images/logo.png" alt="Espace Membre" /></a>
	    </div>
<?php
//Si un utilisateur est connecte, on le deconnecte
if(isset($_SESSION['nom']))
{
	//On le deconnecte en supprimant simplement les sessions nom et licence
	unset($_SESSION['nom'], $_SESSION['licence']);
?>
<div class="message">Vous &ecirc;tes d&eacute;connect&eacute;.<br />
<META HTTP-EQUIV="Refresh" CONTENT="3;URL=connexion.php"></div>
<?php
}
else
{
	$nom = '';
	//On verifie si le formulaire a ete envoye
	if(isset($_POST['licence'], $_POST['nom']))
	{
		//On echappe les variables pour pouvoir les mettre dans des requetes SQL
		if(get_magic_quotes_gpc())
		{
			$licence = stripslashes($_POST['licence']);
			$nom = stripslashes($_POST['nom']);
		}
		else
		{
			$licence = mysql_real_escape_string($_POST['licence']);
			$nom =mysql_real_escape_string( $_POST['nom']);
		}
		//On recupere le mot de passe de lutilisateur
		$req = mysql_query('select nom, prenom from users where licence="'.$licence.'"');
		$dn = mysql_fetch_array($req);
		//On le compare a celui quil a entre et on verifie si le membre existe
		if($dn['nom']==$nom and mysql_num_rows($req)>0)
		{
			//Si le mot de passe est bon, on ne vas pas afficher le formulaire
			$form = false;
			//On enregistre ses donnees dans la session
			$_SESSION['licence'] = $_POST['licence'];
			$_SESSION['nom'] = $dn['nom'];
			
			//on va chercher les autres infos de la personne et on les inclut dans la session
			$dnn = mysql_fetch_array(mysql_query('select prenom, email, categorie, type, photo from users where licence="'.$_POST['licence'].'"'));
			$_SESSION['prenom']= $dnn['prenom'];
			$_SESSION['email'] = $dnn['email'];
			$_SESSION['categorie'] =$dnn['categorie'];
			$_SESSION['type'] =$dnn['type'];
			$_SESSION['photo'] =$dnn['photo'];
			
?>
<div class="message"><?php echo 'vous &ecirc;tes connect&eacute;, '.$_SESSION['prenom'].':' ?> vous allez 	&ecirc;tre dirig&eacute; vers l'accueil.<br />
<META HTTP-EQUIV="Refresh" CONTENT="3;URL=index.php"></div>
<?php
		}
		else
		{
			//Sinon, on indique que la combinaison nest pas bonne
			$form = true;
			$message = 'La combinaison que vous avez entr&eacute; n\'est pas bonne.';
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
<fieldset>
	<legend><strong>Veuillez entrer vos identifiants pour vous connecter </strong></legend>
	<strong>
    <form action="connexion.php" method="post">
        <br />
        <div class="center">
            <label for="licence">Num&eacute;ro de licence</label><input type="text" name="licence" id="licence" onChange="javascript:this.value=this.value.toUpperCase();"/><br />
			<label for="nom">Votre nom </label><input type="text" name="nom" id="nom" onChange="javascript:this.value=this.value.toUpperCase();" /><br />
            <br />
            <input type="submit" value="Soumettre" />
		</div>
    </form>
</strong>	
</fieldset>	
</div>
<?php
	}
}
?>
		<div class="foot"><a href="http://www.arc-montfermeil.com"><strong>Retour l'accueil g&eacute;n&eacute;ral du site</strong></a></div>
	</body>
</html>