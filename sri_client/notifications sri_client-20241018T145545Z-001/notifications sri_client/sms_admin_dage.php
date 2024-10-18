
<?php 

// destinataire
// $telephoneDage='+221771547103';
// Administrateur Dage
// $admin_dage='Abdou DIOP';
// Services
// $service='DTAI';
//Message
// $message = "Test from SRI CLIENT !!!\nCordialement\nDTAI";

$messageDageMain ="Bonjour $prenomNomAdmin,\nUne nouvelle demande d'intervention au service $service est en attente de traitement.\n\nDAGE - MFB";

    if (!empty($token)) {
                        
        $receiverAddress = 'tel:'.$telephoneAdmin;
    
        $osms->sendSMS($senderAddress, $receiverAddress, $messageDageMain, $senderName);

    } 
    else 
    {
        echo 'error';
    }

    // echo 'done';

?>