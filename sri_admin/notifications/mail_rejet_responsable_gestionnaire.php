<?php
include('../mailerNotif.php');
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
$etage = $con->query("SELECT nom_etage FROM etages WHERE code_etage = $code_etage")->fetch_assoc()['nom_etage'];
$type_incident = $con->query("SELECT type_incident FROM type_incidents WHERE code_incident = $code_incident")->fetch_assoc()['type_incident'];
$extraVars = [
  'piece' => $piece,
  'service' => $service,
  'description' => $description,
  'etage' => $etage,
  'type_incident' => $type_incident,
  'description' => $description,
  'raisons' => $raisons
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
// var_dump($recipientsGest, $recipientsResp);
// die();

$link = [$link]; // URL ou chemin de la pièce jointe
sendNotification($recipientsResp, $mail, '', 'content_mail_rejet.php', $link, 'Rejet d\'une  déclaration d\'incident', $varResp, $extraVars);
sendNotification($recipientsGest, $mail, '', 'content_mail_rejet.php', $link, 'Rejet d\'une  déclaration d\'incident', $varGest, $extraVars);
