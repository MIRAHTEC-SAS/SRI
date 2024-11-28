<?php
// // Pour les mails....
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// //Create an instance; passing `true` enables exceptions
// //Load Composer's autoloader
require 'notifications/vendor_mail/autoload.php';
// Envoi des notifications
$mail = new PHPMailer(true);
function sendNotification($recipients, $mail, $smsFile, $mailContentFile, $links, $subject, $variableMapping = [], $extraVars = [])
{
  // Définir les noms de variables par défaut
  $defaultMapping = [
    'telephone' => 'telephone',
    'email' => 'email',
    'prenomNom' => 'prenomNom'
  ];
  // Fusionner avec le mapping personnalisé
  $variableMapping = array_merge($defaultMapping, $variableMapping);

  // Inclure les variables supplémentaires
  extract($extraVars);

  foreach ($recipients as $recipient) {
    // Utiliser les noms de variables dynamiques
    ${$variableMapping['telephone']} = $recipient['telephone'];
    ${$variableMapping['email']} = $recipient['email'];
    ${$variableMapping['prenomNom']} = $recipient['prenomNom'];

    // Envoi du SMS
    if (file_exists($smsFile)) {
      include($smsFile);
    }

    // Contenu du mail
    if (file_exists($mailContentFile)) {
      include($mailContentFile);
    }

    // Configuration et envoi du mail
    try {
      $textversion = "This is the text version";

      $mail->isSMTP();
      $mail->SMTPAuth = true;
      $mail->Host = 'mail.sedif.sn';
      $mail->Username = 'contact@sedif.sn';
      $mail->Password = 'Sedif@2022';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port = 465;

      $mail->setFrom('contact@sedif.sn', 'MFB/DAGE');
      $mail->addAddress(${$variableMapping['email']}, 'Utilisateur');
      if (isset($links)) {
        foreach ($links as $link) {
          $mail->addAttachment($link);
        }
      }
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body = $htmlversion;
      $mail->AltBody = $textversion;

      $mail->send();
    } catch (Exception $e) {
      echo "Erreur lors de l'envoi : {$mail->ErrorInfo}";
    }
  }
}
