<?php

include('app.config.php');

include('phpqrcode/qrlib.php'); //On inclut la librairie au projet

$n=20;
function getRandomString($n) {
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomString = '';

for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
}

return $randomString;
}


$getMatricule = mysqli_query($con, "SELECT matricule, nom_classe FROM `eleves23` INNER JOIN classes ON classes.idClasse=eleves23.idClasse WHERE anneeScolaire='2022-2023'");

while ($row = mysqli_fetch_array($getMatricule)) {

$token=getRandomString(20);
$matricule=$row['matricule'];
$classe=$row['nom_classe'];

// Enregistrement du Token !
$verifDoublon = mysqli_query($con, "SELECT * FROM token_badges where matricule='$matricule'");

if (mysqli_num_rows($verifDoublon ) > 0) {
    $sql = mysqli_query($con, "UPDATE token_badges SET token='$token' where matricule='$matricule'");
}
else
{
$sql = $con->query("INSERT INTO token_badges (matricule, token) 
VALUES ('$matricule','$token')"); 
}

$file_name=$classe.'_'.$matricule.'.png';
$lien='https://copak.sn/copak-gestion/operationnel/verification?token='.$token.'&matricule='.$matricule;

QRcode::png($lien, $file_name); // Creation du QR Code

}

echo 'DOne !';

?>