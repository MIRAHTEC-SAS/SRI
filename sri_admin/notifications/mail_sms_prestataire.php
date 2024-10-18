<?php
include('../config/app.php');

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

$token = $response['access_token'];
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

// $intervenant_interne=$row['prenom'].' '.$row['nom'];
// $telephone_intervenant=$row['telephone'];
// $email_intervenant=$row['email'];

// $intervenant_interne='Pathe SENE';
// $telephone_intervenant='+221771547103';
// $email_intervenant='leborofaye@gmail.com';
// $service='DTAI';
// $description='desssscccccc';
// $localisation='Loccccccc';
// $adresse='Adresssssse';
// $contact='Contactttt';
// $numero_incident='12345';
// $type_incident='Electricite';


try {
    // Envoi du SMS
    include('sms_prestataire.php');

    // contenu du mail...
    include('content_mail_affectation_prestataire.php');

    // GOO MAIL DAGE
    $textversion = "This is the text version";
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.sedif.sn';                        //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'contact@sedif.sn';                     //SMTP username
    $mail->Password   = 'Sedif@2022';                           //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    // $utilisateur=$prenom.' '.$nom;
    $utilisateur = 'DAGE MFB';
    $mail->setFrom('contact@sedif.sn', 'MFB/DAGE');
    $mail->addAddress($email_prestataire, $prestataire);     //Add a recipient
    // $pieceJointe='Signalements/no_image.png';

    // //Attachments
    // $mail->addAttachment($pieceJointe);         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    // Envoi Mail DAGE
    $mail->isHTML();                                  //Set email format to HTML
    $mail->Subject = utf8_decode('[SRI_DAGE] - Nouvelle demande d\'intervention !');
    $mail->Body    = $htmlversion;
    $mail->AltBody = $textversion;
    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// echo "done !";
