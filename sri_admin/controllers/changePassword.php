<?php
require_once('../config/app.php');

// create PassWord

if (isset($_POST['createPwd'])) {

    $email = $_POST['email'];
    $newPass = $_POST['pwd1'];
    $confPass = $_POST['pwd2'];


    $chekEmail = mysqli_query($con, "SELECT * FROM users WHERE email ='$email'");

    if (mysqli_num_rows($chekEmail) > 0) {
        if ($newPass == $confPass) {
            $passNewH = hash('sha256', $newPass);

            mysqli_query($con, "UPDATE users set password='$passNewH' WHERE email='$email'");

            // $headers .= 'Cc: info@ontimeinfotech.com' . "\r\n";
            // $to=$email;
            // $subject='[Support DTAI]: Modification de votre mot de passe';
            // $contenu="Votre mot de passe a bien été modifié.<br></br> Veuillez contacter le support si vous n'etes pas a l'origine de ce changement.";
            // // $msg = wordwrap($contenu, 70);
            // mail($to, $subject, $contenu, $headers);

            $_SESSION['errorMsg'] = false;
            $_SESSION['successMsg'] = true;
            $_SESSION['message'] = "Mot de passe modifié avec success !! ";
            header('Location: ../');
        } else {
            $_SESSION['errorMsg'] = true;
            $_SESSION['successMsg'] = false;
            $_SESSION['message'] = "Le mot de passe et la confirmation ne sont pas identiques ! ";
            header('Location: ../create_password?email=' . $email);
        }
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Cet utilisateur n'existe pas dans la base ";
        header('Location: ../');
    }
}
