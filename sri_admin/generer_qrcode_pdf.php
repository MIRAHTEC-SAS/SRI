<?php
  include ('config/app.php');
// if (isset($_POST['createPdf'])) {

  
    $n=20;
    function getRandomString($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
}
  
    $token=getRandomString(20);
    $linkQrcode="verification.php?token=".$token;

    require('html_table.php');
    require('pdf_codabar.php');

    $code_service=43100000;
    $code_batiment=104;
    $code_etage=212;

    // nom du fichier final
    $nom_file = "qr_code_".$code_service."_".$code_batiment."_".$code_etage.".pdf";
    $nomFichier = "QR CODE ".$code_service;
    $typeDocument='QRCODE';

    // resultats_fc_banque_figes

   

class myPDF2  extends PDF {


}

$pdf = new myPDF2();


// $pdf=new PDF();
// $pdf->SetDrawColor(166, 172, 175);
$pdf->AddPage('L');
$pdf->SetMargins(10,20,10,2);
$pdf->SetTitle("",true);

$pdf->SetFont('Arial','',12,true);
// Nom et Prenom
$pdf->SetFont('Arial','B',12); $pdf->SetXY(95, 8 );
$pdf->Cell(288, 15, "No______________________________MFB/DTAI", 0, 0, 'C', );

$pdf->SetLineWidth(0.1); $pdf->Rect(192, 25, 95, 40, "D");

$pdf->SetFont('Arial','B',13); $pdf->SetXY(95, 8 );
$pdf->Cell(225, 45, "Avantages :", 0, 0, 'C', );

$pdf->SetFont('Arial','',12); $pdf->SetXY(95, 8 );
$pdf->Cell(300, 45, "Fonds Commun du MFB", 0, 0, 'C', );


$pdf->SetFont('Arial','B',13); $pdf->SetXY(95, 8 );
$pdf->Cell(222, 65, "Trimestre :", 0, 0, 'C', );

$pdf->SetFont('Arial','',12); $pdf->SetXY(95, 8 );
$pdf->Cell(290, 65, "4eme trimestre 2021", 0, 0, 'C', );

// $pdf->SetFont('Arial','B',13); $pdf->SetXY(95, 8 );
// $pdf->Cell(100, 45, "Avantages : Fonds Commun du MFB", 0, 0, 'C', );

$pdf->SetFont('Arial','B',13); $pdf->SetXY(95, 8 );
$pdf->Cell(220, 85, "Periode : ", 0, 0, 'C', );

$pdf->SetFont('Arial','',12); $pdf->SetXY(95, 8 );
$pdf->Cell(282, 85, "Octobre - Decembre", 0, 0, 'C', );


$pdf->SetFont('Arial','B',13); $pdf->SetXY(95, 8 );
$pdf->Cell(225, 105, "Document : ", 0, 0, 'C', );

$pdf->SetFont('Arial','',12); $pdf->SetXY(95, 8 );
$pdf->Cell(286, 105, "Etats par Service", 0, 0, 'C', );


// $pdf->SetDrawColor(166, 172, 175);
// $pdf->SetFont('Arial','',13); $pdf->SetXY(95, 8 );
// $pdf->Cell(30, 140, "Dakar, le _________________________", 0, 0, 'C', );

// $pdf->SetDrawColor(166, 172, 175);
// $pdf->SetFont('Arial','B',15); $pdf->SetXY(95, 8 );
// $pdf->Cell(30, 190, "A MADAME LE RECEVEUR GENERAL DU TRESOR", 0, 0, 'C', );






$pdf->SetFont('Arial','B',13); $pdf->SetXY(40, 22 );
$pdf->Cell( 1, 45, "REPUBLIQUE DU SENEGAL", 0, 0, 'C', );
$pdf->SetFont('Arial','',8); $pdf->SetXY(40, 22 );
$pdf->Cell( 1, 54, "Un Peuple - Un But - Une Foi", 0, 0, 'C', );
$pdf->SetFont('Arial','B',8); $pdf->SetXY(40, 22 );
$pdf->Cell( 1, 64, "---------------", 0, 0, 'C', );
$pdf->SetFont('Arial','',9); $pdf->SetXY(40, 22 );
$pdf->Cell( 1, 74, "MINISTERE DES FINANCES ET", 0, 0, 'C', );
$pdf->SetFont('Arial','',10); $pdf->SetXY(40, 22 );
$pdf->Cell( 1, 84, "DU BUDGET", 0, 0, 'C', );


$pdf->Image('imgf.jpeg', 19, 10, 38, 30);


// $pdf->SetDrawColor(46, 64, 83);
$pdf->SetFont('Arial','',11);
// $pdf->SetLineWidth(0.1); $pdf->Rect(10, 83, 190, 22, "D");

// Titre
// $pdf->SetFont('Arial','B',20); $pdf->SetXY(81, 45 );
// $pdf->Cell( 58, 8, " $doc ", 0, 0, 'C', );

// Annee
// $pdf->SetFont('Arial','',15); $pdf->SetXY(40, 54 );
// $pdf->Cell( 15, 8,"Annee scolaire : ", 0, 0, 'R', );
// $pdf->SetFont('Arial','B',15); $pdf->SetXY(65, 54 );
// $pdf->Cell( 15, 8,$anneeScolaire, 0, 0, 'R', );

// classe
// $pdf->SetFont('Arial','',15); $pdf->SetXY(135, 54 );
// $pdf->Cell(70, 8, " Classe : ", 0, 0, 'L', );
// $pdf->SetFont('Arial','B',15);$pdf->SetXY(159, 54 );
// $pdf->Cell(70, 8,$nomClasse, 0, 0, 'L', );




//  $pdf->SetLineWidth(0.1); $pdf->Rect(10, 91, 190, 22, "D");

$pdf->SetXY( 10, 93 );
// $pdf->WriteHTML($html);
// $pdf->headerTable();

require_once('qrcode/qrcode.class.php');

// $pdf->SetXY( 153, 240);
$qrcode = new QRcode($linkQrcode, 'H'); // error level : L, M, Q, H
// $qrcode->displayPNG();

$qrcode->displayFPDF($pdf, 23, 245,35);


// $pdf->SetDrawColor(208, 211, 212);
$pdf->SetAutoPageBreak(false,5);
$pdf->Line(9,288,201,288);
$pdf->SetFont('Arial','',9);$pdf->SetXY(90, 292); 
$pdf->Cell(107, 1, "Ce document est confidentiel...", 0, 0, 'L');


// $pdf->Output();
// $pdf->Output("I", $nom_file);

// $nomRep = $codeFc;

// // $typeDoc='Etats_directions';

// // $typeDocument='Liste_eleves';

// if (is_dir("Etats/FC/".$nomRep)) {
// 	$pdf->Output("F", "Etats/FC/".$nomRep."/".$nom_file,true);
// }

// else
// {
// 	mkdir("Etats/FC/".$nomRep);
// 	$pdf->Output("F", "Etats/FC/".$nomRep."/".$nom_file,true);
    
// }

// $verifDoublon = mysqli_query($con, "SELECT * FROM etats where codeFc='$codeFc' AND typeDoc='$typeDoc'");


// if (mysqli_num_rows($verifDoublon ) > 0) {
//     $sql = mysqli_query($con, "UPDATE etats SET link='$nom_file', date_saisie='$dateDuJour' WHERE codeFc='$codeFc' AND typeDoc='$typeDoc'");
// }
// else
// {
// $sql = $con->query("INSERT INTO etats (codeFc, typeDoc, link, date_saisie) 
// VALUES ('$codeFc','$typeDoc','$nom_file','$dateDuJour')"); 
// }

$pdf->Output("I", $nom_file);

// }

?>