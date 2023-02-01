<?php
session_start();
include('config.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
        <link href="<?php echo $design; ?>/admin2.css" rel="stylesheet" title="Style" />
        <title>Administration</title>
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
	
<h2>
Espace Administration.</h2><br />

<br /><br />

<section>
<aside>
	<h3>
		<div class="menuaccueil">Menu<br />
		<div class="navmenu"><a href="index.php">Accueil Espace Personnel</a></div>
		</div>
	</h3>
</aside>
</section>	
<form method="POST" action="admin4.php" target="_blank" >
			<div class="tableau">
				<table>
				<caption> Concours disponibles </caption>
						<tr bgcolor="#b3b3b3">
						<th class="colid">num&eacute;ro</th>
						<th id="colorg">Organisateur</th>
						<th id="coldis">Discipline</th>
						<th id="coldate">Date MAXI</th>
						</tr>
						<?php 
						//on récupère le nom depuis la liste disponible dans la table club_organisateur
						
						$req = mysql_query('SELECT id,affichage, organisateur, discipline, date_limite FROM club_organisateur order by id *1');
						while($dnn = mysql_fetch_array($req))
						{
						?>
						<tr bgcolor="#d0d0d0">
						<td><input type="radio" name="idimprime" value="<?php echo $dnn['id']; ?>" id="idimprime" required /><?php echo $dnn['id']; ?></td>
						<td><?php echo $dnn['affichage']; ?></td>
						<td style="color:blue"><?php echo $dnn['discipline']; ?></td>
						<td style="color:red"><?php echo $dnn['date_limite']; ?></td>
						</tr>
						<?php
						}
						?>
				</table>
			</div>
		


	<div class="instructions">
		<span style="color:blue">1) Cocher un concours dans la liste ci-contre, entrer le prix de l'inscription ci-dessous. Ensuite cliquer sur imprimer pour générer un PDF</span> 
			<br />
			<label for="prixA">Prix Adultes S1/S2/S3 :</label><input type="text" name="prixA" value="" id="prixA" required /><br />
			<label for="prixJ">Prix Jeunes B/M/C/J :</label><input type="text" name="prixJ" value="" id="prixJ" required /><br />
			<input type="submit" value="Générer PDF" />
</form>
			<br />
			<br />
		<span style="color:blue">2) Date dépassée : enlever le concours de la liste !</span> <br />  
			<form method="POST" action="admin3.php">
			<label for="idefface">Concours N° :</label><input type="text" name="idefface" value="" id="idefface" />
			<input type="submit" value="Effacer" />
			</form>	
			<br />
			<br />
		<span style="color:blue">3) Une fois le concours termin&eacute; : le supprimer de la base de donn&eacute;es</span> <br />  
			<form method="POST" action="admin3.php">
			<label for="idsupprime">Concours N° :</label><input type="text" name="idsupprime" value="" id="idsupprime" />
			<input type="submit" value="Supprimer" /><br />
			</form>	
	</div>
	
	<div class="instructions2">
		<span style="color:blue"> 4) Mise à jour de la comptabilit&eacute;</span> <br />   
<?php
		if(isset($_FILES['fichier'], $_POST['envoyer']))
{
//on efface la table compta avant d'inscrire les données
$sql="TRUNCATE TABLE compta";
$result=mysql_query($sql);


$dossier = 'file/';
$fichier = basename($_FILES['fichier']['name']);
$taille_maxi = 100000;
$taille = filesize($_FILES['fichier']['tmp_name']);
$extensions = array('.csv', '.txt');
$extension = strrchr($_FILES['fichier']['name'], '.'); 
//Début des vérifications de sécurité...
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $erreur = 'Vous devez uploader un fichier de csv...';
}
if($taille>$taille_maxi)
{
     $erreur = 'Le fichier est trop gros...';
}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
     if(move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Upload effectué avec succès !';
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}
else
{
     echo $erreur;
}
}
	//Le chemin d'acces au fichier sur le serveur
$fichier = fopen("file/compta.csv", "r"); 

//tant qu'on est pas a la fin du fichier :
while (!feof($fichier)) 
{ 
// On recupere toute la ligne
$uneLigne = fgets($fichier, 1024);
//On met dans un tableau les differentes valeurs trouvés (ici séparées par un ';') 
$tableauValeurs = explode(';', $uneLigne); 
// On  crée la requete pour inserer les donner (ici il y a 4 champs donc de [0] a [3])
$sql="REPLACE INTO compta VALUES ('".$tableauValeurs[0]."', '".$tableauValeurs[1]."', '".$tableauValeurs[2]."', '".$tableauValeurs[3]."')"; 
$req=mysql_query($sql); 
// la ligne est finie donc on passe a la ligne suivante (boucle)
}
{
//suppression de la ligne 0 de la table compta
$req3=mysql_query("DELETE from compta WHERE id=0");
}
?>	
		<form method="POST" action="" enctype="multipart/form-data">
			<label for="fichier">Fichier Compta:</label><input type="file" name="fichier" value="" id="fichier" /><br /> 
			<input type="submit" value="Envoyer Fichier 1" name="envoyer" id="envoyer" /> <br /><br /> 
		</form>	
		
		
		
			<span style="color:blue">5)Mise à jour de la liste des concours</span> <br /> 
<?php
//on met ici à jour la table des concours
			
		if(isset($_FILES2['fichier'], $_POST2['envoyer']))
		{
		//on efface la table compta avant d'inscrire les données
		$sql2="TRUNCATE TABLE concours";
		$result2=mysql_query($sql2);

		$dossier2 = 'file/';
		$fichier2 = basename($_FILES2['fichier']['name']);
		$taille_maxi2 = 100000;
		$taille2 = filesize($_FILES2['fichier']['tmp_name']);
		$extensions2 = array('.csv', '.txt');
		$extension2 = strrchr($_FILES2['fichier']['name'], '.'); 
		//Début des vérifications de sécurité...
		if(!in_array($extension2, $extensions2)) //Si l'extension n'est pas dans le tableau
		{
		$erreur2 = 'Vous devez uploader un fichier de csv...';
		}
		if($taille2>$taille_maxi2)
		{
		$erreur2 = 'Le fichier est trop gros...';
		}
		if(!isset($erreur2)) //S'il n'y a pas d'erreur, on upload
		{
		//On formate le nom du fichier ici...
		$fichier2 = strtr($fichier2, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		$fichier2 = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier2);
		if(move_uploaded_file($_FILES2['fichier']['tmp_name'], $dossier2 . $fichier2)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
		{
        echo 'Upload effectué avec succès !';
		}
		else //Sinon (la fonction renvoie FALSE).
		{
        echo 'Echec de l\'upload !';
		}
		}
		else
		{
		echo $erreur2;
		}
		}
		//Le chemin d'acces au fichier sur le serveur
		$fichier2 = fopen("file/concours.csv", "r"); 

		//tant qu'on est pas a la fin du fichier :
		while (!feof($fichier2)) 
		{ 
		// On recupere toute la ligne
		$uneLigne2 = fgets($fichier2, 1024);
		//On met dans un tableau les differentes valeurs trouvés (ici séparées par un ';') 
		$tableauValeurs2 = explode(';', $uneLigne2); 
		// On  crée la requete pour inserer les donner (ici il y a 8 champs donc de [0] a [8])
		$sql2="REPLACE INTO concours VALUES ('".$tableauValeurs2[0]."', '".$tableauValeurs2[1]."', '".$tableauValeurs2[2]."', '".$tableauValeurs2[3]."', '".$tableauValeurs2[4]."', '".$tableauValeurs2[5]."', '".$tableauValeurs2[6]."', '".$tableauValeurs2[7]."', '".$tableauValeurs2[8]."')"; 
		$req2=mysql_query($sql2); 
		// la ligne est finie donc on passe a la ligne suivante (boucle)
		}
		{
		//suppression de la ligne 0 de la table concours
		$req3=mysql_query("DELETE from concours WHERE id=0");
		}
		?>	
		<form method="POST" action="" enctype="multipart/form-data">
			<label for="fichier">Fichier concours:</label><input type="file" name="fichier" value="" id="fichier" /><br /> 
			<input type="submit" value="Envoyer Fichier 2" name="envoyer" id="envoyer" /><br /><br />
		</form>	
		
		<span style="color:blue">6) Gestion des membres</span> <br /> 
		
		<form method="POST" action="admin5.php" target="_blank">
			<label for="membres"> Gestion des comptes:</label>
			<input type="submit" value="page des membres" name="membres" id="membres" />
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