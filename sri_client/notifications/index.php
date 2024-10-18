<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC7bff5efabe2de67bcbfd6f1a3692e526';
$auth_token = '9d69d8010cbc54fb5805968e6cbe9a25';

// {
//     "meta": {
//         "page": 0,
//         "page_size": 50,
//         "first_page_url": "https://messaging.twilio.com/v1/Services/MG6002f2cc7634c0277ecc114a40b4b22e/AlphaSenders?__referrer=runtime&ServiceSid=MG6002f2cc7634c0277ecc114a40b4b22e&PageSize=50&Page=0",
//         "previous_page_url": null,
//         "url": "https://messaging.twilio.com/v1/Services/MG6002f2cc7634c0277ecc114a40b4b22e/AlphaSenders?__referrer=runtime&ServiceSid=MG6002f2cc7634c0277ecc114a40b4b22e&PageSize=50&Page=0",
//         "next_page_url": null,
//         "key": "alpha_senders"
//     },
//     "alpha_senders": [
//         {
//             "date_updated": "2022-03-19T17:54:41Z",
//             "alpha_sender": "CFJ",
//             "capabilities": [
//                 "SMS"
//             ],
//             "account_sid": "AC7bff5efabe2de67bcbfd6f1a3692e526",
//             "url": "https://messaging.twilio.com/v1/Services/MG6002f2cc7634c0277ecc114a40b4b22e/AlphaSenders/AIa8fb438260357696fb951866fafdd0ff",
//             "sid": "AIa8fb438260357696fb951866fafdd0ff",
//             "date_created": "2022-03-19T17:54:41Z",
//             "service_sid": "MG6002f2cc7634c0277ecc114a40b4b22e"
//         }
//     ]
// }
// $alphaSender='CFJ';
// alpha_senders": "https://messaging.twilio.com/v1/Services/MGf3c9896cbe7d180452fade5013466a98/AlphaSenders"

$client = new Client($account_sid, $auth_token);
$message = $client->messages->create(
    // Where to send a text message (your cell phone?)
    '+15145741304',
    array(
        "messagingServiceSid" => 'MG6002f2cc7634c0277ecc114a40b4b22e',
        'body' => 'Test SEDIF 333 ! '
    )
);
if ($message) {
    echo 'SMS Envoyé avec succes !!';
}
else {
    echo 'something happen !';
}