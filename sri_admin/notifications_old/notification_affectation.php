
<?php
// session_start();
// include('../config/app.php');

require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor2/autoload.php';

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC7bff5efabe2de67bcbfd6f1a3692e526';
$auth_token = '9d69d8010cbc54fb5805968e6cbe9a25';
$client = new Client($account_sid, $auth_token);

// $description='Panne d\'electricite batiment B';
// $service='DTAI';
// $categorie='Electricite';

$messageDageMain = "Bonjour,\nVous avez reçu une demande d'intervention au service $service.\nLes details vous sont envoyés par mail.\n\nDAGE - MFB";
// Description: $description\n
// Service: $service\n
// Categorie: $categorie\n

// $telephone='+15145741304';

$client->messages->create(
    $telephone,
    array(
        // "from" => "CFJ",
        "messagingServiceSid" => 'MGf3c9896cbe7d180452fade5013466a98',
        'body' => $messageDageMain
    )
);

// Enovoi du MAIL
$mail = new PHPMailer(true);
try {
    include('content_mail_affectation.php');

    // GOO MAIL DAGE
    $textversion = "This is the text version";
    // $textversion='<p>TEst</p>';
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.sedif.sn';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'contact@sedif.sn';                     //SMTP username
    $mail->Password   = 'Sedif@2022';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    // $utilisateur=$prenom.' '.$nom;
    $utilisateur = 'DAGE MFB';
    $mail->setFrom('contact@sedif.sn', 'MFB/DAGE');
    $mail->addAddress($email, $utilisateur);     //Add a recipient
    // $pieceJointe=$photo;
    $link = '../sri_dage/notifications/' . $photo;
    // //Attachments
    $mail->addAttachment($link);         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    // Envoi Mail DAGE
    $mail->isHTML();                                  //Set email format to HTML
    $mail->Subject = 'Demande d\'intervention';
    $mail->Body    = $htmlversion;
    $mail->AltBody = $textversion;
    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// echo 'done !';
