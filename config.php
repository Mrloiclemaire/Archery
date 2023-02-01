<?php
//On demarre les sessions
session_start();

/******************************************************
----------------Configuration Obligatoire--------------
Veuillez modifier les variables ci-dessous pour que l'
espace membre puisse fonctionner correctement.
******************************************************/

//On se connecte a la base de donnee
mysql_connect ('rdbms.strato.de', 'U1190624', 'tiralarcUSM');//connexion au serveur
	mysql_select_db ( 'DB1190624'); // connexion base de données

//Email du webmaster
$mail_webmaster = 'brulem@free.fr';

//Adresse du dossier de la top site
$url_root = 'http://www.arc-montfermeil.com';

/******************************************************
----------------Configuration Optionnelle---------------
******************************************************/

//Nom du fichier de laccueil
$url_home = 'index.php';

//Nom du design
$design = 'default';
?>