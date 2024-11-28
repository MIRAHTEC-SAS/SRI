<?php
// session_start();

header('Content-Type: text/html; charset=UTF-8');

$severName = '127.0.0.1';
$dBUsername = 'root';
$dBPassword = '';
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

$roleUser = $_SESSION['role'];

function formatDateTime($datetime)
{
    $timestamp = strtotime($datetime);
    // Mapping des jours de la semaine
    $jours = [
        'Monday' => 'Lundi',
        'Tuesday' => 'Mardi',
        'Wednesday' => 'Mercredi',
        'Thursday' => 'Jeudi',
        'Friday' => 'Vendredi',
        'Saturday' => 'Samedi',
        'Sunday' => 'Dimanche'
    ];

    // Mapping des mois de l'année
    $mois = [
        '01' => 'Janvier',
        '02' => 'Février',
        '03' => 'Mars',
        '04' => 'Avril',
        '05' => 'Mai',
        '06' => 'Juin',
        '07' => 'Juillet',
        '08' => 'Août',
        '09' => 'Septembre',
        '10' => 'Octobre',
        '11' => 'Novembre',
        '12' => 'Décembre'
    ];

    $day = date('l', $timestamp); // Jour en anglais
    $dayNumber = date('d', $timestamp); // Numéro du jour
    $month = date('m', $timestamp); // Mois en numéro
    $year = date('Y', $timestamp); // Année
    $hour = date('H', $timestamp); // Heure
    // $minute = date('i', $timestamp); // Minute

    // Conversion en français
    $dayFrench = $jours[$day];
    $monthFrench = $mois[$month];

    // return " $dayFrench $dayNumber $monthFrench $year à $hour H $minute min";
    return " $dayFrench $dayNumber $monthFrench $year à $hour H";
}
