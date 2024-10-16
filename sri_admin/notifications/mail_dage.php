<?php
//Create an instance; passing `true` enables exceptions

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
    $pieceJointe='../Signalements/44DC432/NOUYOO4.png';

    // //Attachments
    $mail->addAttachment($pieceJointe);         //Add attachments
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
?>