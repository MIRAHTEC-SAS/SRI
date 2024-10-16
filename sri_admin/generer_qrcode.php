<?php

include ('config/app.php');

include('phpqrcode/qrlib.php'); // On inclut la librairie au projet

$n=20;
function getRandomString($n) {
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomString = '';

for ($i = 0; $i <$n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
}

return $randomString;
}

$code_service=43120000;
$code_batiment=101;
$code_etage=205;
$priorite=1;
$url='https://sedif.sn/dtai/dage/app/interventions/sri_dage/signalement?token=';


$token=getRandomString(20);

$file_name='QR_CODE_'.$code_service.'_'.$code_batiment.'_'.$code_etage.'.png';
$lien=$url.$token.'&priorite='.$priorite;

$lien_image=$code_service.'_'.$code_batiment.'_'.$code_etage.'.png';

QRcode::png($lien, $file_name); // Creation du QR Code

// Enregistrement du Token !
$verifDoublon = mysqli_query($con, "SELECT * FROM qrcodes_etages where code_service='$code_service' AND code_batiment='$code_batiment' AND code_etage='$code_etage'");

if (mysqli_num_rows($verifDoublon ) > 0) 
{
    $sql = mysqli_query($con, "UPDATE qrcodes_etages SET lien='$lien_image' WHERE code_service='$code_service' AND code_batiment='$code_batiment' AND code_etage='$code_etage'");
}
else
{
    $sql = $con->query("INSERT INTO qrcodes_etages (code_service, code_batiment, code_etage, lien, date_creation) 
    VALUES ('$code_service', '$code_batiment', '$code_etage', '$lien_image', '$dateDuJour')"); 
}

// Persist metadata QR code 
$verifDoublon = mysqli_query($con, "SELECT * FROM detection_qrcode where code_service='$code_service' AND code_batiment='$code_batiment' AND code_etage='$code_etage'");

if (mysqli_num_rows($verifDoublon ) > 0) {
    $sql = mysqli_query($con, "UPDATE detection_qrcode SET token='$token' WHERE code_service='$code_service' AND code_batiment='$code_batiment' AND code_etage='$code_etage'");
}
else
{
    // echo $token.'</br>';
    // echo $code_service.'</br>';
    // echo $code_batiment.'</br>';
    // echo $code_etage.'</br>';
    // echo $nom_service.'</br>';
    // echo $sigle_service.'</br>';
    // echo $nom_batiment.'</br>';
    // echo $adresse_batiment.'</br>';
    // echo $nom_etage.'</br>';die;

    $insertToken = $con->query("INSERT INTO `detection_qrcode` (`token_qrcode`, `code_service`, `code_batiment`, `code_etage`, `priorite`) 
    VALUES ('$token', '$code_service', '$code_batiment', '$code_etage', '$priorite')"); 
}

// }

echo 'Done !!!';

?>