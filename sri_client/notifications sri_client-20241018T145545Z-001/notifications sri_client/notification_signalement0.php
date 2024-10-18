
<?php
// session_start();
include('../config/app.php');

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

	// $numero_incident='44DC432';
	$type_intervention='Informatique';
	// $description='Les climatisations de l\'étage 2 ne fonctionnent plus';
	// $service='DTAI';
    // Infos localisation

	// $localisation='Immeuble Moussa';
	// $adresse='5, Rue Lamine GUEYE BP2300 Dakar';
	// $contact='338904478';
	// Envoi du SMS

    // $message ="Bonjour $prenom $nom,\nVous êtes convoqué(e) au $nomConcours, le $dateConcours de $debut à $fin au centre $nomCentre .\nLes epreuves se dérouleront dans la salle $nomSalle et votre table porte le numéro $numero_table. \nVous recevez la convocation sur votre adresse courriel $email.\n\nCordialement \nCentre Formation Judiciaire";

            
    // Persistance SMS
    // $sql = $con->query("INSERT INTO historique_sms (`destinataire`, `numero`, `message`, `date_saisie`) VALUES ('$new_user', '$telephone', '$message', '$date_saisie')");
    // // INSERT INTO `historique_sms` (`id`, `destinataire`, `numero`, `message`, `date_saisie`) VALUES (NULL, '1', '1', '1', '2022-06-01 01:04:35');
	
	// Envoi du SMS DAGE (Principal)

	// $telephoneDage='+15145741304';
	// $emailDage='leborofaye@gmail.com'; 
    // $messageDageMain ="Bonjour,\nUne nouvelle demande d'intervention au service $service est en attente de traitement.\n\nDAGE - MFB";
    
    $messageDageMain ="Bonjour,\nUne nouvelle demande d'intervention au service $service est en attente de traitement.\n\nDAGE - MFB";

    $client->messages->create($telephoneDage,
        array(
            // "from" => "CFJ",
            "messagingServiceSid" => 'MGf3c9896cbe7d180452fade5013466a98',
            'body' => $messageDageMain
            )
    );

	// Envoi du SMS DAGE (Responsable Type incident)

	// $telephoneResponsable='+15145741304';
	// $emailResponsable='ametsene21@gmail.com'; 
	// $responsable='Moussa NDIAYE';
    // $messageDageResponsable ="Bonjour $responsable,\nUne nouvelle demande d'intervention au service $service est en attente de traitement.\n\nDAGE - MFB";
    
    for ($i=0;$i<count($telephonesResponsables);$i++) {
        
        $telephoneResponsable=$telephonesResponsables[$i];
        $responsable=$responsables[$i];

        $messageDageResponsable ="Bonjour $responsable,\nUne nouvelle demande d'intervention au service $service est en attente de traitement.\n\nDAGE - MFB";

        $client->messages->create($telephoneResponsable,
        array(
            // "from" => "CFJ",
            "messagingServiceSid" => 'MGf3c9896cbe7d180452fade5013466a98',
            'body' => $messageDageResponsable
            )
        );
    }

	// Envoi du SMS Gestionnaire

	// $telephoneGestionnaire='+15145741304';
	// $emailGestionnaire='ametsene0304@gmail.com'; 
	// $gestionnaire='Awa DIOP';
    // $messageGestionnaire ="Bonjour $gestionnaire,\nUn incident provenant de votre service et porte la reference $numero_incident est declaré.\n\nConnectez-vous pour suivre la prise en charge.\n\nDAGE - MFB";

    for ($i=0;$i<count($telephonesGestionnaires);$i++) {
        
        $telephoneGestionnaire=$telephonesGestionnaires[$i];
        $gestionnaire=$gestionnaires[$i];

        $messageGestionnaire ="Bonjour $gestionnaire,\nUn incident provenant de votre service et porte la reference $numero_incident est declaré.\n\nConnectez-vous pour suivre la prise en charge.\n\nDAGE - MFB";
        
        $client->messages->create($telephoneGestionnaire,
        array(
            // "from" => "CFJ",
            "messagingServiceSid" => 'MGf3c9896cbe7d180452fade5013466a98',
            'body' => $messageGestionnaire
            )
        );
    }



// Mail DAGE
    //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


try {
	include('content_mail_dage.php');

// GOO MAIL DAGE
    $textversion="This is the text version";
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
	$utilisateur='DAGE MFB';
    $mail->setFrom('contact@sedif.sn', 'MFB/DAGE');
    $mail->addAddress($emailDage, $utilisateur);     //Add a recipient
    // $pieceJointe='../Signalements/44DC432/NOUYOO4.png';

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

// Notification Responsable
$mailResp = new PHPMailer(true);
for ($i=0;$i<count($emailsResponsables);$i++) {

    $emailResponsable=$emailsResponsables[$i];
    $responsable=$responsables[$i];
    
    try {
        include('content_mail_responsable.php');

        $textversion="This is the text version";
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mailResp->isSMTP();                                            //Send using SMTP
        $mailResp->Host       = 'mail.sedif.sn';                     //Set the SMTP server to send through
        $mailResp->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mailResp->Username   = 'contact@sedif.sn';                     //SMTP username
        $mailResp->Password   = 'Sedif@2022';                               //SMTP password
        $mailResp->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mailResp->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        // $utilisateur=$prenom.' '.$nom;
        $utilisateur='DAGE MFB';
        $mailResp->setFrom('contact@sedif.sn', 'MFB/DAGE');
        // $pieceJointe='../Signalements/44DC432/NOUYOO4.png';

        // //Attachments
        $mailResp->addAttachment($link);         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        // Envoi Mail Responsable
        $mailResp->addAddress($emailResponsable, $utilisateur);
        $mailResp->Subject = 'Demande d\'intervention ( ' .$type_intervention.' )';
        $mailResp->Body    = $contentMailResponsable;
        $mailResp->AltBody = $textversion;
        $mailResp->send();

        // Notification Gestionnaire

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mailResp->ErrorInfo}";
    }
}

// Notification Gestionnaire

$mailGest = new PHPMailer(true);

for ($i=0;$i<count($emailsGestionnaires);$i++) {

    $emailGestionnaire=$emailsGestionnaires[$i];
    $gestionnaire=$gestionnaires[$i];

    try {
        include('content_mail_gestionnaire.php');

        $textversion="This is the text version";
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mailGest->isSMTP();                                            //Send using SMTP
        $mailGest->Host       = 'mail.sedif.sn';                     //Set the SMTP server to send through
        $mailGest->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mailGest->Username   = 'contact@sedif.sn';                     //SMTP username
        $mailGest->Password   = 'Sedif@2022';                               //SMTP password
        $mailGest->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mailGest->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        // $utilisateur=$prenom.' '.$nom;
        $utilisateur='DAGE MFB';
        $mailGest->setFrom('contact@sedif.sn', 'MFB/DAGE');
        // $pieceJointe='../Signalements/44DC432/NOUYOO4.png';

        // //Attachments
        $mailGest->addAttachment($link);         //Add attachments    //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        // Envoi Mail Gestionnaire
        $mailGest->addAddress($emailGestionnaire, $utilisateur);
        $mailGest->Subject = 'Declaration incident ( ' .$type_intervention.' )';
        $mailGest->Body    = $contentMailGestionnaire;
        $mailGest->AltBody = $textversion;
        $mailGest->send();


    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mailGest->ErrorInfo}";
    }
}
// echo 'done !';



