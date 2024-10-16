<?php 

include('phpqrcode/qrlib.php');
include('config/app.php');

if (isset($_POST['genererQrcode'])) {

    $n=50;
function getRandomString($n) 
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

    $token=getRandomString(20);
    // $code_service='43100000';
    // $code_batiment='102';
    // $code_etage='209';

    $code_service=$_POST['code_service'];
    $code_batiment=$_POST['code_batiment'];
    $code_etage=$_POST['code_etage'];

    // echo $code_service.'</br>';
    // echo $code_batiment.'</br>';
    // echo $code_etage.'</br>';
    // echo $token.'</br>';
    // die;


    // Persiste...

    $verifIntegrite = mysqli_query($con, "SELECT * FROM detection_qrcode WHERE code_service='$code_service' AND code_batiment='$code_batiment' AND code_etage='$code_etage'");

    if (mysqli_num_rows($verifIntegrite) > 0)
    {
        $_SESSION['errorMsg']=true;
        $_SESSION['successMsg']=false;
        $_SESSION['message'] = "Ce QR CODE existe deja !!"; 
        header ('Location: generation_qrcode.php');
    }
    else
    {
        $sql=mysqli_query($con, "INSERT INTO `detection_qrcode` (`token_qrcode`, `code_service`, `code_batiment`, `code_etage`) 
        VALUES ('$token', '$code_service', '$code_batiment', '$code_etage')"); 

        $url="https://sri.minfinances.sn/sri_client/?token=$token";

        $file_name=$code_service.'_'.$code_batiment.'_'.$code_etage.'.png';

        QRcode::png($url, $file_name);

        $sql=mysqli_query($con, "INSERT INTO `qrcodes_sri` (`code_service`, `code_batiment`, `code_etage`, `lien`, `date_saisie`) 
        VALUES ('$code_service', '$code_batiment', '$code_etage', '$file_name', '$date_saisie')"); 

        $_SESSION['errorMsg']=false;
        $_SESSION['successMsg']=true;
        $_SESSION['message'] = "QRCODE généré avec succès !!"; 
        header ('Location: generation_qrcode.php');

    }
}
if (isset($_POST['supprimerQrcode'])) {

    $id_qr=$_POST['id_qr'];

    // echo $id_qr.'</br>';
    // die;
    $getInfos = mysqli_query($con, "SELECT * FROM qrcodes_sri WHERE id='$id_qr'");
    
	while ($row = mysqli_fetch_array($getInfos)) { 
		$code_batiment=$row['code_batiment'];
		$code_etage=$row['code_etage'];
		$code_service=$row['code_service'];
    }

    // echo $code_service.'</br>';
    // echo $code_batiment.'</br>';
    // echo $code_etage.'</br>';
    // echo $id_qr.'</br>';
    // die;

    $sql=mysqli_query($con, "DELETE FROM `qrcodes_sri` WHERE id='$id_qr'");
    $sql=mysqli_query($con, "DELETE FROM `detection_qrcode` WHERE code_service='$code_service' AND code_batiment='$code_batiment' AND code_etage='$code_etage'");
    
    $_SESSION['errorMsg']=false;
    $_SESSION['successMsg']=true;
    $_SESSION['message'] = "QRCODE supprimé avec succès !!"; 
    header ('Location: generation_qrcode.php');
}
?>