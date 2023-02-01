<?php
require('fpdf/mysql_table.php');
require ('config.php');
if(isset($_POST['idimprime'], $_POST['prixA'], $_POST['prixJ']))
	{
	$prixA = $_POST['prixA'];
	$prixJ = $_POST['prixJ'];
	$dnn = mysql_fetch_array(mysql_query('SELECT organisateur, affichage, discipline FROM club_organisateur WHERE id="'.$_POST['idimprime'].'"'));
	$affichage = $dnn['affichage'];
	$discipline = $dnn['discipline'];
	$nom = $dnn['organisateur'];
	$req = mysql_query("SELECT COUNT(licence) FROM $nom ");
	$num = mysql_result($req,0);
	$req2 = mysql_query("SELECT COUNT(type) FROM $nom WHERE type= 'A'"); //comptage des adultes
	$num2 = mysql_result($req2,0); 										 //resultat des adultes
	$req3 = mysql_query("SELECT COUNT(type) FROM $nom WHERE type= 'J'"); //comptage des jeunes
	$num3 = mysql_result($req3,0);										 //resultat des jeunes
	$num4=$prixA*$num2; //total tarif adultes
	$num5=$prixJ*$num3; //total tarif jeunes
	$somme=$num4+$num5; //cheque global
	
class PDF extends PDF_MySQL_Table
{
function Header()
{
    //Titre
	// Logo
    $this->Image('fpdf/Logomac.png',10,6,30);date('d/m/Y');
	$this->SetFont('Arial','',18);
	$this->Cell(0,6,'Montfermeil Arc Club',0,1,'R');
	$this->Cell(0,6,'www.arc-montfermeil.com',0,1,'R');
	$this->Cell(0,6,date('d/m/Y'),0,1,'R');
	//saut de lignes
	$this->Ln(40);
	global $affichage;
	global $discipline;
	//Police Arial normal 18
    $this->SetFont('Arial','',18);
	//Titre
	$this->Cell(0,6,utf8_decode('Inscriptions à votre concours'),0,1,'C');
	//saut de ligne
	$this->Ln(5);
	$this->Cell(0,6,$discipline,0,1,'C');
	$this->Ln(5);
	$this->SetTextColor(255,0,0);
	$this->Cell(0,6,$affichage,0,1,'C');
	//saut de lignes
	$this->Ln(10);
	$this->SetFont('');
    //Imprime l'en-tête du tableau si nécessaire
    parent::Header();
}

}

$pdf=new PDF();
$pdf->AddPage();
//Second tableau : définit 7 colonnes

$pdf->SetFont('Times','B',12);
$pdf->AddCol('licence',20,'Licence','C');
$pdf->AddCol('nom',45,'Nom', 'L');
$pdf->AddCol('prenom',25,utf8_decode('Prénom'),'L');
$pdf->AddCol('categorie',15,utf8_decode('Cat.'),'C');
$pdf->AddCol('trispot',15,utf8_decode('Trispot'),'C');
$pdf->AddCol('samedi',21,'Samedi','C');
$pdf->AddCol('dimanche',21,'Dimanche','C');
$pdf->AddCol('heure',15,utf8_decode('Départ'),'C');


$prop=array('HeaderColor'=>array(255,150,100),
            'color1'=>array(210,245,255),
            'color2'=>array(255,255,210),
            'padding'=>2);
$pdf->Table("SELECT licence, nom, prenom, categorie, trispot, samedi, dimanche, heure FROM $nom order by nom");

// Début en police normale
global $num; //nombre d'archers inscrits
global $prixA; //prix place Adulte
global $prixJ; //prix place Jeune
global $num2; //nombre Adultes
global $num3; //nombre Jeunes
global $somme; //chèque global
// French notation
$nombre_format_francais = number_format($number, 2, ',', ' ');
$pdf->SetFont('Arial','',12);
$pdf->SetXY(15,215);
$pdf->Write(5,utf8_decode('Informations éventuelles:'));
define('€',chr(128)); 
$pdf->SetXY(15,220);
$pdf->Write(5,utf8_decode('Merci de trouver ci-joint le règlement par chèque d\'un montant total de ') );
$pdf->Write(5,$somme);
$pdf->Write(5,' ');
$pdf->Write(5,chr(128));
$pdf->SetXY(15,225);
$pdf->Write(5,utf8_decode('correspondant à l\'inscription de ') );
$pdf->Write (5,$num2);
$pdf->Write(5,utf8_decode(' Adulte(s) à ') );
$pdf->Write(5,$prixA);
$pdf->Write(5,chr(128));
$pdf->Write(5,' et ');
$pdf->Write(5,$num3);
$pdf->Write(5,utf8_decode(' Jeune(s) à '));
$pdf->Write(5,$prixJ);
$pdf->Write(5,chr(128));
$pdf->SetXY(15,235);
$pdf->Write(5,utf8_decode('Club: Montfermeil Arc Club. Affilié FFTA sous le N° 08933233'));
$pdf->SetXY(15, 240);
$pdf->Write(5,utf8_decode('Responsable des compétitions: Martial Jeanney.'));
$pdf->SetXY(15,245);
$pdf->Write(5,utf8_decode('Adresse mail: martial.jyl@free.fr'));
$pdf->SetXY(15,250);
$pdf->Write(5,utf8_decode('Téléphone: 06.86.78.14.99'));
$pdf->SetXY(15,255);
$pdf->Write(5,utf8_decode('Adresse postale du Club : '));
$pdf->SetXY(15,260);
$pdf->SetTextColor(190,0,0);
$pdf->Write(5,utf8_decode('Montfermeil Arc Club, 111 avenue Daniel Perdrigé, 93370 Montfermeil '));
$pdf->SetFont('Arial','',7);
$pdf->SetXY(15,270);
$pdf->SetTextColor(255,150,150);
$pdf->Write(5,utf8_decode('Document créé automatiquement depuis le gestionnaire d\'inscriptions aux compétitions en ligne développé par Bruno Lemaire pour Montfermeil Arc Club 2012-2017'));


// Lien en bleu souligné
$pdf->SetTextColor(0,0,255);
$pdf->SetFont('','U');
$pdf->Write(5,'');
$pdf->Output();

	}
?>