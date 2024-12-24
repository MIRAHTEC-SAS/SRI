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
  'direction' => $service,
  'description' => $description,
  'date_declaration' => $date_reception,
  'etage' => $etage,
  'type_incident' => $type_incident,
  'date_saisie' => $date_saisie,
  'raisons' => $raisons,
  'concerne' => $concerne,
  'auteur' => $auteur
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
// var_dump($code_priorite);
// die();
// Notification pour les interventions normales
if ($code_priorite != '0' && $code_priorite != '1') {
  sendNotification($recipientsResp, $mail, '', 'content_mail_annul_resp.php', $link, 'Annulation d\'une  demande d\'intervention', $varResp, $extraVars);
  sendNotification($recipientsAdmin, $mail, '', 'content_mail_annul.php', $link, 'Annulation d\'une  demande d\'intervention', $varResp, $extraVars);
  sendNotification($recipientsGest, $mail, '', 'content_mail_annul.php', $link, 'Annulation d\'une  demande d\'intervention', $varGest, $extraVars);
} else {
  // Notification pour les interventions prioritaires
  sendNotification($recipientsResp, $mail, '', 'content_mail_annul_urgent_resp.php', $link, 'Annulation d\'une  demande d\'intervention prioritaire', $varResp, $extraVars);
  sendNotification($recipientsAdmin, $mail, '', 'content_mail_annul_urgent.php', $link, 'Annulation d\'une  demande d\'intervention prioritaire', $varResp, $extraVars);
  sendNotification($recipientsGest, $mail, '', 'content_mail_annul_urgent.php', $link, 'Annulation d\'une  demande d\'intervention prioritaire', $varGest, $extraVars);
}
