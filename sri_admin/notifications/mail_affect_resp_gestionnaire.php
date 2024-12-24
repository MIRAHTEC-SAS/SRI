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
$recipientsAdmin = [];

// contacts dage 
$reqInfosAdminDage = $con->query("SELECT * FROM contacts_dage");

while ($row = mysqli_fetch_array($reqInfosAdminDage)) {
  $recipientsAdmin[] = [
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
$extraVars = [
  'piece' => $piece,
  'service' => $sigle,
  'description' => $description,
  'date_declaration' => $date_reception,
  'etage' => $etage,
  'type_incident' => $type_incident,
  'concerne' => $concerne,
  'date_saisie' => $date_saisie,
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
sendNotification($recipientsResp, $mail, '', 'content_mail_affect_resp.php', $link, 'Affectation d\'une  déclaration d\'incident', $varResp, $extraVars);
sendNotification($recipientsAdmin, $mail, '', 'content_mail_affect.php', $link, 'Affectation d\'une  déclaration d\'incident', $varResp, $extraVars);
sendNotification($recipientsGest, $mail, '', 'content_mail_affect.php', $link, 'Affectation d\'une  déclaration d\'incident', $varGest, $extraVars);
