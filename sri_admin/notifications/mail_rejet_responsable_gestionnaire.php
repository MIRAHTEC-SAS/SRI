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
sendNotification($recipientsResp, $mail, 'content_mail_rejet.php', $link, utf8_decode('Rejet d\'une  déclaration d\'incident'), $extraVars);
sendNotification($recipientsGest, $mail, 'content_mail_rejet.php', $link, utf8_decode('Rejet d\'une  déclaration d\'incident'), $extraVars);
