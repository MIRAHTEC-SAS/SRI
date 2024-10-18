<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    // $email='leborofaye@gmail.com';
    // $utilisateur='Amet Sene';
    // $tempoPass='DTAI';
    

    // Contenu du mail
	include('content_mail_reinit_password.php');

    // $htmlversion=include('mail/mail.php');

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
    $mail->setFrom('contact@sedif.sn', 'DAGE - Ministere des Finances');
    $mail->addAddress($email, $utilisateur);     //Add a recipient
    // $mail->addAddress('ametsene21@gmail.com');               //Name is optional
    // $mail->addReplyTo('support@sedif.sn', 'Information');
    // $mail->addCC('ametsene0304@gmail.com');
    // $mail->addBCC('bcc@example.com');

    // //Attachments
    // $mail->addAttachment('../Fiche_emargement.pdf');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML();                                  //Set email format to HTML
    $mail->Subject = utf8_decode('Votre mot de passe est reinitialisé');
    $mail->Body    = $htmlversion;
    $mail->AltBody = $textversion;

    $mail->send();

	// echo 'done !';

	// $_SESSION['errorMsg']=false;
	// $_SESSION['successMsg']=true;
	// $_SESSION['message'] ="Les candidats sont notifiés avec succès par Email et par SMS ! ";
	// header("Location: ../notifications.php");
      

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
