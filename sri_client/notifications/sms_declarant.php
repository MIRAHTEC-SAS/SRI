
<?php

//Message
// La demande d’intervention  « TEST », de type électricité, effectuée le mercredi 13 09 2023 à 13 H à la DTAI/étage/ pièce  a été affectée à M X (Intervenant) le  13 09 2023 à 12 H 
$messageDeclarant = "Bonjour $auteur,\nVotre signalement portant le numero #$numero_incident est bien pris en compte par nos services.\n Nous vous remercions de votre collaboration\n\nDAGE - MFB";

if (!empty($token)) {

    $receiverAddress = 'tel:' . $telephoneDeclarant;

    $osms->sendSMS($senderAddress, $receiverAddress, $messageDeclarant, $senderName);
} else {
    // echo 'error';
}

// echo 'done';

?>