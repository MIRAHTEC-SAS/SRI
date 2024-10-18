
<?php 
require __DIR__ . '/vendor_orange/autoload.php';
require 'vendor_orange/ismaeltoe/osms/src/Osms.php';
use \Osms\Osms;

$config = array(
    'clientId' => 'MlXHORnGGOOtBa97gz07TYRN5PH7qWRA',
    'clientSecret' => 'o2iL5kgRuKYmwEdS'
);

$osms = new Osms ($config);

// retrieve an access token
$response = $osms->getTokenFromConsumerKey();

$token = $response['access_token'];
$senderAddress = 'tel:+221771752617';
$senderName = 'DTAI';

// destinataire
$destinataire='+221771547103';
//Message
$message = "TEST CONCLUANT !\nCordialement\nDTAI";

if (!empty($token)) {
                        
    $receiverAddress = 'tel:'.$destinataire;

    $osms->sendSMS($senderAddress, $receiverAddress, $message, $senderName);

    echo 'Message envoyé avec succés !';

} 
else 
{
    echo 'error';
}

?>
