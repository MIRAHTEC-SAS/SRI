<?php
include('../mailerNotif.php');

// Pour les SMS
require __DIR__ . '/vendor_orange/autoload.php';
require 'vendor_orange/ismaeltoe/osms/src/Osms.php';

use \Osms\Osms;

$config = array(
    'clientId' => 'MlXHORnGGOOtBa97gz07TYRN5PH7qWRA',
    'clientSecret' => 'o2iL5kgRuKYmwEdS'
);

$osms = new Osms($config);

// retrieve an access token
$response = $osms->getTokenFromConsumerKey();
if (isset($response['access_token'])) {
    $token = $response['access_token'];
} else {
    // Gérer le cas où l'access_token n'est pas défini
    $token = "";
    // Par exemple : redirection vers une page d'erreur ou autre action
}
$senderAddress = 'tel:+221771752617';
$senderName = 'DTAI';
// Récupération des destinataires pour les deux groupes
$recipientsAdmin = [];
$reqInfosAdminDage = $con->query("SELECT * FROM contacts_dage");
while ($row = mysqli_fetch_array($reqInfosAdminDage)) {
    $recipientsAdmin[] = [
        'telephone' => $row['telephone'],
        'email' => $row['email'],
        'prenomNom' => $row['prenom'] . ' ' . $row['nom']
    ];
}
$varAdmin = [
    'telephone' => 'telephoneAdmin',
    'email' => 'emailAdmin',
    'prenomNom' => 'prenomNomAdmin'
];
$varResp = [
    'telephone' => 'telephoneResp',
    'email' => 'emailResp',
    'prenomNom' => 'prenomNomAdmin'
];
$varGest = [
    'telephone' => 'telephoneGest',
    'email' => 'emailGest',
    'prenomNom' => 'prenomNomGest'
];

$recipientsResp = [];
$reqInfosRespDage = $con->query("SELECT * FROM `responsables_incidents` 
    INNER JOIN responsables_dage ON responsables_dage.matricule = responsables_incidents.matricule_responsable 
    INNER JOIN users ON responsables_dage.email = users.email
    WHERE users.statut = 1 AND responsables_incidents.code_incident = '$code_incident'");
while ($row = mysqli_fetch_array($reqInfosRespDage)) {
    $recipientsResp[] = [
        'telephone' => $row['telephone'],
        'email' => $row['email'],
        'prenomNom' => $row['prenom'] . ' ' . $row['nom']
    ];
}

$recipientsGest = [];
// Responsables de domaines  
$reqInfosGest = $con->query("SELECT * FROM `gestionnaires_services` INNER JOIN      gestionnaires ON gestionnaires.matricule_gestionnaire=gestionnaires_services.matricule_gestionnaire INNER JOIN users ON gestionnaires.email=users.email
 WHERE users.statut=1 AND gestionnaires_services.code_service='$code_service'");

while ($row = mysqli_fetch_array($reqInfosGest)) {
    $recipientsGest[] = [
        'telephone' => $row['telephone'],
        'email' => $row['email'],
        'prenomNom' => $row['prenom'] . ' ' . $row['nom']
    ];
}
// Informations supplémentaires
$piece = $con->query("SELECT nom_piece FROM pieces WHERE code_piece = $code_piece")->fetch_assoc()['nom_piece'];
$service = $con->query("SELECT sigle FROM services WHERE code_service = $code_service")->fetch_assoc()['sigle'];
$direction = $con->query("SELECT libelle FROM services WHERE code_service = $code_service")->fetch_assoc()['libelle'];
$etage = $con->query("SELECT nom_etage FROM etages WHERE code_etage = $code_etage")->fetch_assoc()['nom_etage'];
$extraVars = [
    'piece' => $piece,
    'service' => $service,
    'direction' => $direction,
    'etage' => $etage,
    'auteur' => $auteur,
    'type_incident' => $type_incident,
    'date_saisie' => $date_saisie,
    'description' => $description,
    'localisation' => $localisation
];
$link = [$link]; // URL ou chemin de la pièce jointe
if ($priorite != 'Haute') {
    sendNotification($recipientsAdmin, $mail, 'sms_admin_dage.php', 'content_mail_dage.php', $link, 'Nouvelle déclaration d\'incident', $varAdmin, $extraVars);
    sendNotification($recipientsResp, $mail, 'sms_responsable_dage.php', 'content_mail_dage.php', $link, 'Nouvelle déclaration d\'incident', $varResp, $extraVars);
    sendNotification($recipientsGest, $mail, 'sms_gestionnaire.php', 'content_mail_gestionnaire.php', $link, 'Nouvelle déclaration d\'incident', $varGest, $extraVars);
} else {
    sendNotification($recipientsAdmin, $mail, 'sms_admin_dage.php', 'content_mail_prioritaire.php', $link, 'Nouvelle déclaration d\'incident', $varAdmin, $extraVars);
    sendNotification($recipientsResp, $mail, 'sms_responsable_dage.php', 'content_mail_prioritaire.php', $link, 'Nouvelle déclaration d\'incident', $varResp, $extraVars);
    sendNotification($recipientsGest, $mail, 'sms_gestionnaire.php', 'content_mail_prioritaire.php', $link, 'Nouvelle déclaration d\'incident', $varGest, $extraVars);
}
