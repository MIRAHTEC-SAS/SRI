
<?php 

$service='DTAI';
//Message

$messageGestionnaire = "Bonjour $prenomNomGest,\nUne nouvelle demande d'intervention au service $service est en attente de traitement.\n\nDAGE - MFB";

    if (!empty($token)) {
                        
        $receiverAddress = 'tel:'.$telephoneGest;
    
        $osms->sendSMS($senderAddress, $receiverAddress, $messageGestionnaire, $senderName);

    } 
    else 
    {
        echo 'error';
    }

    // echo 'done';

?>