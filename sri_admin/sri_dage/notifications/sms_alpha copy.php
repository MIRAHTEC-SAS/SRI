<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC7bff5efabe2de67bcbfd6f1a3692e526';
$auth_token = '9d69d8010cbc54fb5805968e6cbe9a25';
$client = new Client($account_sid, $auth_token);


$numero1='+221771752617';
$numero2='+221770771258';
$numero3='+221781776133';
$numero4='+221774111051';

$destinataires =[$numero1,$numero2,$numero3,$numero4];

for ($i=0;$i<count($destinataires);$i++) {
    $message = $client->messages->create($destinataires[$i],
    array(
        "from" => "CFJ",
        "messagingServiceSid" => 'MGf3c9896cbe7d180452fade5013466a98',
        'body' => 'Test Messagerie SEDIF ! '
    )
);
}


if ($message) {
    echo 'SMS Envoyé avec succes !!';
}
else {
    echo 'something happen !';
}