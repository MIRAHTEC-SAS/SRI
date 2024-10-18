
<?php 

//Message
// La demande d’intervention  « TEST », de type électricité, effectuée le mercredi 13 09 2023 à 13 H à la DTAI/étage/ pièce  a été affectée à M X (Intervenant) le  13 09 2023 à 12 H 
$messagePrestataire = "Bonjour $prestataire,\nUne demande d'intervention au service $service vous est effectée. Vous retrouverez les details par email.\n\nDAGE - MFB";

    if (!empty($token)) {
                        
        $receiverAddress = 'tel:'.$telephone_prestataire;
    
        $osms->sendSMS($senderAddress, $receiverAddress, $messagePrestataire, $senderName);

    } 
    else 
    {
        echo 'error';
    }

    // echo 'done';

?>