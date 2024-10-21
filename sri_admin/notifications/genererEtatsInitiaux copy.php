<?php
session_start();
include('../config/app.php');
if (isset($_GET['codeFc'])) {

    $codeFc = $_GET['codeFc'];
    $codeDirection = $_GET['dir'];

    //   $codeFc='FC-MFB-2022-1';
    // $codeDirection=43100000;


    $n = 20;
    function getRandomString($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    $token = getRandomString(20);
    $linkQrcode = "verification?token=" . $token;

    require('../html_table.php');
    require('../pdf_codabar.php');

    $reqSigle = mysqli_query($con, "SELECT * FROM directions where codeDirection='$codeDirection'");

    while ($row = mysqli_fetch_array($reqSigle)) {
        $sigleDirection = $row['sigle'];
    }

    $anneeScolaire = '2021-2022';
    $doc = "Liste d'appel";
    $id_classe = 6;
    $col = 'simple';
    $typeDoc = 'Etats_initiaux';
    // $style='c';
    $nomClasse = 'vvvv';
    $codeFc = 'FC-MFB-2022-1';

    $reqNomClasse = mysqli_query($con, "SELECT nomClasse FROM classes WHERE idClasse='$id_classe'");

    // while ($row = mysqli_fetch_array($reqNomClasse)) {
    //     $nomClasse=$row['nomClasse'];
    // }

    // nom du fichier final
    // nom du fichier final
    $nom_file = $typeDoc . "_" . $codeFc . "_" . $codeDirection . ".pdf";
    $nomFichier = "Etats Initiaux " . $codeFc . " " . $sigleDirection;
    $typeDocument = 'Etats_initiaux';
    // resultats_fc_banque_figes

    $reqBanque = mysqli_query($con, "SELECT * FROM resultats_fc_banque");

    while ($row = mysqli_fetch_array($reqBanque)) {
        $codeFc = $row['codeFc'];
        $codeBanque = $row['codeBanque'];
        $montant = $row['montant'];
        $date = $row['date_saisie'];

        $sql = mysqli_query($con, "INSERT INTO resultats_fc_banque_figes (codeFc,codeBanque,montant,token,date_saisie) 
        VALUES ('$codeFc','$codeBanque','$montant','$token','$date')");
    }



    class myPDF  extends PDF
    {

        function headerTable()
        {

            $this->SetFont('Arial', 'B', 8, true);
            $this->SetFillColor(244, 244, 244);
            $this->Cell(10, 10, 'No', 1, 0, 'C', true);
            $this->Cell(20, 10, 'MATRICULE', 1, 0, 'C', true);
            $this->Cell(50, 10, 'PRENOM', 1, 0, 'C', true);
            $this->Cell(25, 10, 'NOM', 1, 0, 'C', true);
            $this->Cell(35, 10, 'PROFESSION', 1, 0, 'C', true);
            $this->Cell(15, 10, 'PARTS', 1, 0, 'C', true);
            $this->Cell(20, 10, 'PRESENCE', 1, 0, 'C', true);
            $this->Cell(15, 10, 'NOTE', 1, 0, 'C', true);




            $this->Ln();
        }

        function viewTable($con, $codeFc, $codeDirection)
        {
            $montantTotal = 0;
            $this->SetFont('Arial', '', 10);

            $getDirections = mysqli_query($con, "SELECT 
        fc_initialisation_directions.codeDirection,
        directions.libelle as libelleDirection,
        directions_generales.libelle as libelleDirectionG
        FROM fc_initialisation_directions
        INNER JOIN directions 
        ON directions.codeDirection=fc_initialisation_directions.codeDirection 
        INNER JOIN directions_generales 
        ON directions.codeDirectionGenerale=directions_generales.codeDirectionGenerale 
        WHERE fc_initialisation_directions.codeFc='$codeFc' and fc_initialisation_directions.codeDirection='$codeDirection'");


            while ($row = mysqli_fetch_array($getDirections)) {
                $direction = $row['codeDirection'];
                $libelleDirection = $row['libelleDirection'];
                $libelleDirectionG = $row['libelleDirectionG'];
            }
            $reqAgents = mysqli_query(
                $con,
                "SELECT 
        agents.matricule,
        agents.prenom,
        agents.nom,
        agents.hierarchie,
        fc_initialisation_directions.codeFc,
        fc_initialisation_directions.codeDirection,
        fc_initialisation_directions.nb_part,
        corps.libelle as profession
        FROM fc_initialisation_directions inner join agents on agents.matricule=fc_initialisation_directions.matricule INNER JOIN corps ON corps.codeCorps=agents.codeCorps
        WHERE fc_initialisation_directions.codeFc='$codeFc' and fc_initialisation_directions.codeDirection='$direction' and fc_initialisation_directions.statut='Actif'"
            );

            $x = 1;
            // $this->headerTable();
            // $this->SetLineWidth(0.1); $this->Rect(10, 83, 277, 10, "D");
            $this->SetFont('Arial', '', 9);

            $x = 1;
            while ($row = mysqli_fetch_array($reqAgents)) {

                $this->SetFillColor(247, 249, 249);
                $this->Cell(10, 6, ' ' . $x, 1, 0, 'C', true);
                $this->Cell(20, 6, ' ' . $row['matricule'], 1, 0, 'L', true);
                $this->Cell(50, 6, ' ' . $row['prenom'], 1, 0, 'L', true);
                $this->Cell(25, 6, ' ' . $row['nom'], 1, 0, 'L', true);
                $this->Cell(35, 6, ' ' . $row['profession'], 1, 0, 'L', true);
                $this->Cell(15, 6, ' ' . $row['nb_part'], 1, 0, 'C', true);
                $this->Cell(20, 6, ' ', 1, 0, 'L', true);
                $this->Cell(15, 6, ' ', 1, 0, 'L', true);
                $x = $x + 1;
                $this->Ln();
            }
        }
    }
    $getDirections = mysqli_query($con, "SELECT 
        fc_initialisation_directions.codeDirection,
        directions.libelle as libelleDirection,
        directions_generales.libelle as libelleDirectionG
        FROM fc_initialisation_directions
        INNER JOIN directions 
        ON directions.codeDirection=fc_initialisation_directions.codeDirection 
        INNER JOIN directions_generales 
        ON directions.codeDirectionGenerale=directions_generales.codeDirectionGenerale 
        WHERE fc_initialisation_directions.codeFc='$codeFc' and fc_initialisation_directions.codeDirection='$codeDirection'");


    while ($row = mysqli_fetch_array($getDirections)) {
        $direction = $row['codeDirection'];
        $libelleDirection = $row['libelleDirection'];
        $libelleDirectionG = $row['libelleDirectionG'];
    }

    $pdf = new myPDF();


    // $pdf=new PDF();
    // $pdf->SetDrawColor(166, 172, 175);
    $pdf->AddPage();
    $pdf->SetMargins(10, 10, 10, 2);
    $pdf->SetTitle("Etats Initiaux ", true);

    $pdf->SetFont('Arial', '', 12, true);
    // // Nom et Prenom
    // $pdf->SetFont('Arial','B',12); $pdf->SetXY(95, 8 );
    // $pdf->Cell(115, 15, "No______________________________MFB/DTAI", 0, 0, 'C', );

    $pdf->SetLineWidth(0.1);
    $pdf->Rect(110, 10, 90, 34, "D");

    $pdf->SetFont('Arial', '', 13);
    $pdf->SetXY(95, 8);
    $pdf->Cell(58, 15, "Avantages :", 0, 0, 'C',);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetXY(95, 8);
    $pdf->Cell(133, 15, "Fonds Commun du MFB", 0, 0, 'C',);


    $pdf->SetFont('Arial', '', 13);
    $pdf->SetXY(95, 8);
    $pdf->Cell(55, 30, "Trimestre :", 0, 0, 'C',);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetXY(95, 8);
    $pdf->Cell(115, 30, "1er trimestre 2022", 0, 0, 'C',);

    // $pdf->SetFont('Arial','B',13); $pdf->SetXY(95, 8 );
    // $pdf->Cell(100, 45, "Avantages : Fonds Commun du MFB", 0, 0, 'C', );

    $pdf->SetFont('Arial', '', 13);
    $pdf->SetXY(95, 8);
    $pdf->Cell(54, 45, "Periode : ", 0, 0, 'C',);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetXY(95, 8);
    $pdf->Cell(103, 45, "Janvier - Mars", 0, 0, 'C',);


    $pdf->SetFont('Arial', '', 13);
    $pdf->SetXY(95, 8);
    $pdf->Cell(59, 60, "Document : ", 0, 0, 'C',);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetXY(95, 8);
    $pdf->Cell(111, 60, "Etats Initiaux", 0, 0, 'C',);

    $m = date("m", strtotime($dateDuJour));
    $d = date("d", strtotime($dateDuJour));
    $y = date("Y", strtotime($dateDuJour));



    switch ($m) {
        case '01':
            $mois = 'Janvier';
            break;
        case '02':
            $mois = 'Fevrier';
            break;
        case '03':
            $mois = 'Mars';
            break;
        case '04':
            $mois = 'Avril';
            break;
        case '05':
            $mois = 'Mai';
            break;
        case '06':
            $mois = 'Juin';
            break;
        case '07':
            $mois = 'Juillet';
            break;
        case '08':
            $mois = 'Août';
            break;
        case '09':
            $mois = 'Septembre';
            break;
        case '10':
            $mois = 'Octobre';
            break;
        case '11':
            $mois = 'Novembre';
            break;
        case '12':
            $mois = 'Décembre';
            break;
    }

    $pdf->SetDrawColor(166, 172, 175);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetXY(95, 8);
    $pdf->Cell(26, 145, "Dakar, le " . $d . " " . $mois . " " . $y, 0, 0, 'C',);

    $pdf->SetDrawColor(166, 172, 175);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetXY(70, 2);
    $pdf->Cell(65, 190, "SERVICE : " . $libelleDirection . " (" . $libelleDirectionG . ")", 0, 0, 'C',);
    // $pdf->Cell(45, 200, " (".$libelleDirectionG.")", 0, 0, 'C', );



    $pdf->SetFont('Arial', 'B', 13);
    $pdf->SetXY(40, 30);
    $pdf->Cell(1, 45, "REPUBLIQUE DU SENEGAL", 0, 0, 'C');
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetXY(40, 30);
    $pdf->Cell(1, 54, "Un Peuple - Un But - Une Foi", 0, 0, 'C');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetXY(40, 30);
    $pdf->Cell(1, 64, "---------------", 0, 0, 'C');
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetXY(40, 30);
    $pdf->Cell(1, 74, "MINISTERE DES FINANCES ET", 0, 0, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(40, 30);
    $pdf->Cell(1, 84, "DU BUDGET", 0, 0, 'C');


    $pdf->Image('../assets/img/symbole.png', 19, 10, 42, 40);


    // $pdf->SetDrawColor(46, 64, 83);
    $pdf->SetFont('Arial', '', 11);
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




    $pdf->SetLineWidth(0.1);
    $pdf->Rect(10, 91, 190, 22, "D");

    $pdf->SetXY(10, 102);
    // $pdf->WriteHTML($html);
    $pdf->headerTable();
    $pdf->viewTable($con, $codeFc, $codeDirection);



    require_once('../qrcode/qrcode.class.php');

    // $pdf->SetXY( 153, 240);
    $qrcode = new QRcode($linkQrcode, 'H'); // error level : L, M, Q, H
    // $qrcode->displayPNG();

    $qrcode->displayFPDF($pdf, 23, 245, 35);


    // $pdf->SetDrawColor(208, 211, 212);
    $pdf->SetAutoPageBreak(false, 5);
    $pdf->Line(9, 288, 201, 288);
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetXY(90, 292);
    $pdf->Cell(107, 1, "Ce document est confidentiel.", 0, 0, 'L');


    // $pdf->Output();
    // $pdf->Output("I", $nom_file);

    $nomRep = $codeFc;

    // $typeDocument='Liste_eleves';

    if (is_dir("../Etats/FC/" . $nomRep)) {
        $pdf->Output("F", "../Etats/FC/" . $nomRep . "/" . $nom_file, true);
    } else {
        mkdir("../Etats/FC/" . $nomRep);
        $pdf->Output("F", "../Etats/FC/" . $nomRep . "/" . $nom_file, true);
    }


    $link = "../Etats/FC/" . $nomRep . "/" . $nom_file;

    // Saisie du nom du fichier dans la base 

    $verifDoublon = mysqli_query($con, "SELECT * FROM etats_initiaux where codeFc='$codeFc' AND codeDirection='$codeDirection' and nomFichier='$nomFichier'");


    if (mysqli_num_rows($verifDoublon) > 0) {
        $sql = $con->query("UPDATE etats_initiaux SET link='$link', date_saisie='$dateDuJour' WHERE codeFc='$codeFc' and codeDirection='$codeDirection' and nomFichier='$nomFichier' ");
    } else {
        $sql = $con->query("INSERT INTO etats_initiaux (`codeFc`, `codeDirection`, `nomFichier`, `link`, `date_saisie`) 
        VALUES ('$codeFc','$codeDirection','$nomFichier', '$link','$dateDuJour')");
    }

    // Initialisation de la table des directions et suppression coté DRH

    $infosEncours = $con->query("SELECT 
    codeFc,
    codeDirection,
    statut,
    commentaire,
    nb_part,
    matricule,
    codeMinistere
    FROM fc_initialisation_directions
    WHERE codeDirection='$codeDirection' AND codeFc='$codeFc'");

    while ($row = mysqli_fetch_array($infosEncours)) {
        $codeFc = $row['codeFc'];
        $matricule = $row['matricule'];
        $codeDirection = $row['codeDirection'];
        $codeMinistere = $row['codeMinistere'];
        $statut = $row['statut'];
        $commentaire = $row['commentaire'];
        $nb_part = $row['nb_part'];


        $sql = $con->query("INSERT INTO fc_initialisation_directions_encours (codeFc, matricule,nb_part,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
        VALUES ('$codeFc','$matricule','$nb_part','$codeDirection','$codeMinistere','$statut','$commentaire','$dateDuJour')");


        $sql = $con->query("INSERT INTO fc_initialisation_directions_encours_ref (codeFc, matricule,nb_part,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
        VALUES ('$codeFc','$matricule','$nb_part','$codeDirection','$codeMinistere','$statut','$commentaire','$dateDuJour')");

        $sql = $con->query("INSERT INTO fc_initialisation_directions_archive_drh (codeFc, matricule,nb_part,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
        VALUES ('$codeFc','$matricule','$nb_part','$codeDirection','$codeMinistere','$statut','$commentaire','$dateDuJour')");
    }

    // On supprime de la table drh

    $sql = $con->query("DELETE FROM fc_initialisation_directions where codeFc='$codeFc' and codeDirection='$codeDirection'");

    $sql = $con->query("UPDATE fonds_commun SET statut='Initialise' WHERE codeFc='$codeFc'");

    include('smsdtai2.php');

    $_SESSION['errorMsg'] = false;
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = "Etats Initiaux generés et envoyés avec succès au service! ";
    header("Location: ../envoi_etats_initiaux?fc=$codeFc");

    // $pdf->Output("I", $nom_file);


}
