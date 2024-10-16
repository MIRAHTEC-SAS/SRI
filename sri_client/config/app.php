<?php
// session_start();
header('Content-Type: text/html; charset=UTF-8');

$severName = 'localhost';
$dBUsername = 'root';
$dBPassword = '';
// $dBUsername='dtai_sri';
// $dBPassword='sri@dtai2022';
//mdp BD PGAV ==> Pga@dtai2022
$dBName = 'sri';
$port = '3306';
$con = new mysqli($severName, $dBUsername, $dBPassword, $dBName, $port);
if ($con->connect_error) {
    die("Pas de connection !!!" . $con->connect_error);
}

$appName = "SRI";
date_default_timezone_set('Africa/Dakar');
$date_saisie = date("Y-m-d H:i:s");
$dateDuJour = date("Y-m-d");
$anneeEnCours = date('Y', strtotime($dateDuJour));

//date('d-m-Y',strtotime($dateN))


// Email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
// More headers
$from = 'sedif';
$headers .= 'From: <' . $from . '>' . "\r\n";

// $n = 50;
// function getRandomString($n)
// {
//     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $randomString = '';

//     for ($i = 0; $i < $n; $i++) {
//         $index = rand(0, strlen($characters) - 1);
//         $randomString .= $characters[$index];
//     }

//     return $randomString;
// }
