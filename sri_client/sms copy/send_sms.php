<?php 
 
// Update the path below to your autoload.php, 
// see https://getcomposer.org/doc/01-basic-usage.md 
require_once '/path/to/vendor/autoload.php'; 
 
use Twilio\Rest\Client; 
 
$sid    = "AC7bff5efabe2de67bcbfd6f1a3692e526"; 
$token  = "[AuthToken]"; 
$twilio = new Client($sid, $token); 
 
$message = $twilio->messages 
                  ->create("+15145741304", // to 
                           array(  
                               "messagingServiceSid" => "MG64af9dd0bf1193bfaa0350b721d19fe7",      
                               "body" => "Test SMS From SEDIF !!" 
                           ) 
                  ); 
 
print($message->sid);