<?php
 include ('../config/app.php');
session_start();
 if (isset($_POST['changeInfos'])) {
     $matricule=$_POST['matricule'];
     $prenom=$_POST['prenom'];
     $nom=$_POST['nom'];
     $telephone=$_POST['telephone'];
     $email=$_POST['email'];
     $adresse=$_POST['adresse'];
     $statut=$_POST['statut'];
     $commentaire=$_POST['commentaire'];
    
    //  echo $matricule.'</br>';
    //  echo $prenom.'</br>';
    //  echo $nom.'</br>';
    //  echo $telephone.'</br>';
    //  echo $email.'</br>';
    //  echo $adresse.'</br>';
    //  echo $statut.'</br>';
    //  echo $commentaire.'</br>';

    $sql =  $con->query("UPDATE agents SET prenom='$prenom', nom='$nom' WHERE matricule='$matricule'");

    // Contacts
    $verifContact = mysqli_query($con, "SELECT * FROM contacts where matricule='$matricule'");

    if (mysqli_num_rows($verifContact ) > 0) 
    {
        $sql =  $con->query("UPDATE contacts SET telephone='$telephone', email='$email', adresse='$adresse' WHERE matricule='$matricule'");

        $_SESSION['errorMsg']=false;
        $_SESSION['successMsg']=true;
        $_SESSION['message'] ="Informations modifiées avec succès ! ";
        header("Location: ../profil-agent.php?matricule=$matricule");
    }
    else
    {
        $sql = $con->query("INSERT INTO contacts (matricule,telephone,email,adresse) VALUES ('$matricule', '$telephone','$email','$adresse')");
        
        $_SESSION['errorMsg']=false;
        $_SESSION['successMsg']=true;
        $_SESSION['message'] ="Informations de contact ajoutées avec succès ! ";
        header("Location: ../profil-agent.php?matricule=$matricule");
    }

    // Statut
    $verifStatut = mysqli_query($con, "SELECT * FROM statut_agents where matricule='$matricule'");

    if (mysqli_num_rows($verifStatut) > 0) 
    {
        $sql =  $con->query("UPDATE statut_agents SET statut='$statut', commentaire='$commentaire' WHERE matricule='$matricule'");

        $_SESSION['errorMsg']=false;
        $_SESSION['successMsg']=true;
        $_SESSION['message'] ="Informations modifiées avec succès ! ";
        header("Location: ../profil-agent.php?matricule=$matricule");
    }
    else
    {
        $sql = $con->query("INSERT INTO statut_agents (matricule,statut,commentaire) VALUES ('$matricule', '$statut','$commentaire')");
        
        $_SESSION['errorMsg']=false;
        $_SESSION['successMsg']=true;
        $_SESSION['message'] ="Informations de contact ajoutées avec succès ! ";
        header("Location: ../profil-agent.php?matricule=$matricule");
    }

 }

 // Informations bancaires
 if (isset($_POST['changeInfosBancaires'])) {
    $matricule=$_POST['matricule'];
    $codeBanque=$_POST['banque'];
    $codeAgence=$_POST['agence'];
    $numeroCompte=$_POST['numeroCompte'];
    $iban=$_POST['iban'];

    // echo $matricule.'</br>';
    //  echo $codeBanque.'</br>';
    //  echo $codeAgence.'</br>';
    //  echo $numeCompte.'</br>';
    //  echo $iban.'</br>';

    $sql =  $con->query("UPDATE agents SET codeBanque='$codeBanque', codeAgence='$codeAgence', numeroCompte='$numeroCompte', iban='$iban' WHERE matricule='$matricule'");
    
    $_SESSION['errorMsg']=false;
    $_SESSION['successMsg']=true;
    $_SESSION['message'] ="Informations bancaires modifiées avec succès ! ";
    header("Location: ../profil-agent.php?matricule=$matricule");
  
     }
?>