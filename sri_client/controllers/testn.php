<?php
 include ('../config/app.php');
session_start();

date_default_timezone_set('Africa/Dakar');
$date_saisie = date("Y-m-d H:i:s");
$dateDuJour = date("Y-m-d");
$matricule='123';
$hierarchie='W';
$nb_part=5;

  
$codeFc='12345';
$codeMinistere=6544;
$codeDirection='123';


$sql= mysqli_query($con, "INSERT INTO fc_en_cours_notation (codeFc,codeDirection,codeMinistere,matricule, hierarchie,nb_part,date_saisie)
VALUES ('$codeFc', '$codeDirection', '$codeMinistere', '$matricule', '$hierarchie', '$nb_part', '$dateDuJour')");

echo 'done';
?>