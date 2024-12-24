<?php
// include('../config/app.php');
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


// Pour les mails....
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Create an instance; passing `true` enables exceptions
//Load Composer's autoloader
require 'vendor_mail/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$telephonesAdmin = [];
$emailsAdmin = [];
$prenomsNomsAdmin = [];

// contacts dage 
$reqInfosAdminDage = $con->query("SELECT * FROM contacts_dage");

while ($row = mysqli_fetch_array($reqInfosAdminDage)) {
    $telephonesAdmin[] = $row['telephone'];
    $emailsAdmin[] = $row['email'];
    $prenomsNomsAdmin[] = $row['prenom'] . ' ' . $row['nom'];
}

// contacts dage urgent
$reqInfosAdminDageUrgent = $con->query("SELECT * FROM contacts_dage_urgent");

while ($row = mysqli_fetch_array($reqInfosAdminDageUrgent)) {
    $telephonesAdmin[] = $row['telephone'];
    $emailsAdmin[] = $row['email'];
    $prenomsNomsAdmin[] = $row['prenom'] . ' ' . $row['nom'];
}

try {

    for ($i = 0; $i < count($telephonesAdmin); $i++) {
        $telephoneAdmin = $telephonesAdmin[$i];
        $emailAdmin = $emailsAdmin[$i];
        $prenomNomAdmin = $prenomsNomsAdmin[$i];


        include('content_mail_dage.php');

        // GOO MAIL DAGE
        $textversion = "This is the text version";
        $mail->isSMTP();
        $mail->Host       = 'mail.sedif.sn';                        //Set the SMTP server to send through
        //Send using SMTP
        $mail->SMTPAuth   = true;
        //Enable SMTP authentication
        $mail->Username   = 'contact@sedif.sn';                     //SMTP username
        $mail->Password   = 'Sedif@2022';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;
        $mail->CharSet = 'UTF-8';
        $utilisateur = 'DAGE MFB';
        $mail->setFrom('contact@sedif.sn', 'MFB/DAGE');
        $mail->addAddress($emailAdmin, $utilisateur);     //Add a recipient
        $pieceJointe = 'Signalements/no_image.png';

        // //Attachments
        $mail->addAttachment($pieceJointe);         //Add 

        // Envoi Mail DAGE
        $mail->isHTML();                                  //Set email format to HTML
        $mail->Subject = utf8_decode('Nouvelle déclaration d\'incident');
        $mail->Body    = $htmlversion;
        $mail->AltBody = $textversion;
        $mail->send();
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// *********************** RESPONSABLE DAGE
$mailResp = new PHPMailer(true);

$telephonesResp = [];
$emailsResp = [];
$prenomsNomsResp = [];
// $code_incident='201';

// Responsables de domaines  
$reqInfosRespDage = $con->query("SELECT * FROM `responsables_incidents` inner JOIN responsables_dage ON responsables_dage.matricule=responsables_incidents.matricule_responsable INNER JOIN users ON responsables_dage.email=users.email
 WHERE users.statut=1 AND responsables_incidents.code_incident='$code_incident'");

while ($row = mysqli_fetch_array($reqInfosRespDage)) {
    $telephonesResp[] = $row['telephone'];
    $emailsResp[] = $row['email'];
    $prenomsNomsResp[] = $row['prenom'] . ' ' . $row['nom'];
}

try {

    for ($i = 0; $i < count($telephonesResp); $i++) {
        $telephoneResp = $telephonesResp[$i];
        $emailResp = $emailsResp[$i];
        $prenomNomResp = $prenomsNomsResp[$i];

        // Envoi du SMS
        include('sms_responsable_dage.php');

        // contenu du mail...
        include('content_mail_responsable_dage.php');

        // GOO MAIL DAGE
        $textversion = "This is the text version";
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   //Enable verbose debug output
        $mailResp->isSMTP();                                            //Send using SMTP
        $mailResp->Host       = 'mail.sedif.sn';                        //Set the SMTP server to send through
        $mailResp->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mailResp->Username   = 'contact@sedif.sn';                     //SMTP username
        $mailResp->Password   = 'Sedif@2022';                           //SMTP password
        $mailResp->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mailResp->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = 'UTF-8';
        //Recipients
        // $utilisateur=$prenom.' '.$nom;
        $utilisateur = 'DAGE MFB';
        $mailResp->setFrom('contact@sedif.sn', 'MFB/DAGE');
        $mailResp->addAddress($emailResp, $utilisateur);     //Add a recipient
        $pieceJointe = 'Signalements/no_image.png';

        // //Attachments
        $mailResp->addAttachment($pieceJointe);         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        // Envoi Mail DAGE
        $mailResp->isHTML();                                  //Set email format to HTML
        $mailResp->Subject = utf8_decode('Nouvelle déclaration d\'incident');
        $mailResp->Body    = $htmlversion;
        $mailResp->AltBody = $textversion;
        $mailResp->send();
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mailResp->ErrorInfo}";
}

// *********************** GESTIONNAIRE

$mailGest = new PHPMailer(true);

$telephonesGest = [];
$emailsGest = [];
$prenomsNomsGest = [];
// $code_service='43100000';

// Responsables de domaines  
$reqInfosGest = $con->query("SELECT * FROM `gestionnaires_services` INNER JOIN      gestionnaires ON gestionnaires.matricule_gestionnaire=gestionnaires_services.matricule_gestionnaire INNER JOIN users ON gestionnaires.email=users.email
 WHERE users.statut=1 AND gestionnaires_services.code_service='$code_service'");

while ($row = mysqli_fetch_array($reqInfosGest)) {
    $telephonesGest[] = $row['telephone'];
    $emailsGest[] = $row['email'];
    $prenomsNomsGest[] = $row['prenom'] . ' ' . $row['nom'];
}

try {

    for ($i = 0; $i < count($telephonesGest); $i++) {
        $telephoneGest = $telephonesGest[$i];
        $emailGest = $emailsGest[$i];
        $prenomNomGest = $prenomsNomsGest[$i];

        // Envoi du SMS
        include('sms_gestionnaire.php');

        // contenu du mail...
        include('content_mail_gestionnaire.php');

        // GOO MAIL DAGE
        $textversion = "This is the text version";
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   //Enable verbose debug output
        $mailGest->isSMTP();                                            //Send using SMTP
        $mailGest->Host       = 'mail.sedif.sn';                        //Set the SMTP server to send through
        $mailGest->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mailGest->Username   = 'contact@sedif.sn';                     //SMTP username
        $mailGest->Password   = 'Sedif@2022';                           //SMTP password
        $mailGest->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mailGest->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = 'UTF-8';
        //Recipients
        // $utilisateur=$prenom.' '.$nom;
        $utilisateur = 'DAGE MFB';
        $mailGest->setFrom('contact@sedif.sn', 'MFB/DAGE');
        $mailGest->addAddress($emailGest, $utilisateur);     //Add a recipient
        $pieceJointe = 'Signalements/no_image.png';

        // //Attachments
        $mailGest->addAttachment($pieceJointe);         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        // Envoi Mail DAGE
        $mailGest->isHTML();                                  //Set email format to HTML
        $mailGest->Subject = 'Nouvelle déclaration d\'incident';
        $mailGest->Body    = $htmlversion;
        $mailGest->AltBody = $textversion;
        $mailGest->send();
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mailGest->ErrorInfo}";
}
