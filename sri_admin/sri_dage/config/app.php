<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');

$severName='127.0.0.1';
$dBUsername='root';
$dBPassword='root';
//mdp BD PGAV ==> Pga@dtai2022
$dBName='sri';
$port='8889';
$con = new mysqli($severName,$dBUsername,$dBPassword,$dBName,$port);
if ($con->connect_error) {
    die("Pas de connection !!!" . $con->connect_error);
}

$appName="SRI";
date_default_timezone_set('Africa/Dakar');
$date_saisie = date("Y-m-d H:i:s");
$dateDuJour = date("Y-m-d");
$anneeEnCours = date('Y', strtotime($dateDuJour));

//date('d-m-Y',strtotime($dateN))


// Email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
// More headers
$from='sedif';
$headers .= 'From: <'.$from.'>' . "\r\n";
?>