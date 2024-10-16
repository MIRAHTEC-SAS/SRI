
<?php

// $service='DTAI';

//Message
$messageDageResp = "Bonjour $prenomNomResp,\nL'incident ci-dessous est declaré au service $service.\nDescription: $description \nLocalisation: $localisation \n\nDAGE - MFB";

if (!empty($token)) {

    $receiverAddress = 'tel:' . $telephoneResp;

    $osms->sendSMS($senderAddress, $receiverAddress, $messageDageResp, $senderName);
} else {
    // echo 'error';
}

?>