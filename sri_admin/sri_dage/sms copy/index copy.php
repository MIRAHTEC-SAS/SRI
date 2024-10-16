<?php
require __DIR__ . '/vendor/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = 'AC7bff5efabe2de67bcbfd6f1a3692e526';
$token = '9d69d8010cbc54fb5805968e6cbe9a25';
$client = new Client($sid, $token);


$message = $client->message->create(
    // the number you'd like to send the message to
    '+15145741304',
    [
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+19034994599',
        // the body of the text message you'd like to send
        'body' => 'Sante Serigne Touba !'
    ]
    );

    if ($message){
        echo 'Message envoyé ! ';
    } else {
        'Nop !!';
    }
?>