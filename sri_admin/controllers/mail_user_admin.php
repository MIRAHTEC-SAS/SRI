<?php
require_once "../mailerNotif.php";
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
// Recuperer l'utilisateur qui a l'id $user_id


$recipientsUser[] = [
  'telephone' => "",
  'email' => $email,
  'prenomNom' => $prenom . ' ' . $nom
];

$varUser = [
  'telephone' => 'telephoneUser',
  'email' => 'emailUser',
  'prenomNom' => 'prenomNomUser'
];
$extraVars = [
  'prenomNomUser' => $prenom . ' ' . $nom,
  'emailUser' => $email
];


// Notifier l'admin
sendNotification($recipientsAdmin, $mail, '', 'content_mail_admin.php', [], 'Creation d\'un utilisateur', $varAdmin, $extraVars);
// Notifier l'utilisateur concerné 
sendNotification($recipientsUser, $mail, '', 'content_mail_user.php', [], 'Creation d\'un utilisateur', $varUser, $extraVars);
