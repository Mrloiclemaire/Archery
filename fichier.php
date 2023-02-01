<?php
session_start();
include('config.php');

?>
<html> 
<head> 
<title>Importer un fichier dans une bdd</title> 
</head> 
<body> 

<?php
	
	// Si le formulaire est envoyè
	if (isset($_FILES['fichier']))
	{	
				
				$sql = "LOAD DATA INFILE 'compta.csv'  INTO TABLE compta FIELDS TERMINATED BY ';'  ";
				$data=mysql_query($sql) or die (mysql_error());
				
			
	}
?>

<h2>Importer un fichier texte dans une bdd MySQL</h2> 
     Pour ajouter tes donn&eacute;es il suffit de remplir ce formulaire
		<form method="post" action="" enctype="multipart/form-data" >
      <tr>
       <td>Fichier :</td> 
       <td> <input type="file" name="fichier"> </td> 
      </tr>
         <tr>
        <td></td>  
       <td> <input type="submit" value="envoyer"> </td> 
      </tr>
       </form>

   
 
  
</body> 
</html>


