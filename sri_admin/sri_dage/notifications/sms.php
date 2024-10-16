<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

// A Twilio number you own with SMS capabilities
// $twilio_number = "+19034994599";

// $client = new Client($account_sid, $auth_token);
// $message = $client->messages->create(
//     // Where to send a text message (your cell phone?)
//     '+15145741304',
//     array(
//         'from' => $twilio_number,
//         'body' => 'Test SEDIF ! '
//     )
// );
// if ($message) {
//     echo 'SMS Envoyé avec succes !!';
// }
// else {
//     echo 'something happen !';
// }

if (isset($_POST['envoyerMessage'])) {
    

        // Your Account SID and Auth Token from twilio.com/console
        $account_sid = 'AC7bff5efabe2de67bcbfd6f1a3692e526';
        $auth_token = '9d69d8010cbc54fb5805968e6cbe9a25';
        $client = new Client($account_sid, $auth_token);
        $twilio_number = "+19034994599";

        
        $destinataire=$_POST['numero'];
        $destinataire2='+15145741304';

        $contenu=$_POST['message'];
        
        $message = $client->messages->create($destinataire, array( 'from' => $twilio_number, 'body' => $contenu ));
        $message2 = $client->messages->create($destinataire2, array( 'from' => $twilio_number, 'body' => $contenu ));

        if ($message) {
            $_SESSION['errorMsg']=false;
            $_SESSION['successMsg']=true;
            $_SESSION['message'] ="Le message est envoyé avec succès ! ";
            header("Location: ../envoi_sms.php");
        }
        else {
            $_SESSION['errorMsg']=true;
            $_SESSION['successMsg']=false;
            $_SESSION['message'] ="Le message n'a pas pu etre envoyé ! ";
            header("Location: ../envoi_sms.php");
        }


}
