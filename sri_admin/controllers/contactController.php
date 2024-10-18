<?php
session_start();
include ('../config/app.php');

/************************************* Contacts DAGE ***************************************/
// Creation
if (isset($_POST['ajouterContact'])) {

    $prenom=$_POST['prenom'];
    $nom=$_POST['nom'];
    $telephone='+221'.$_POST['telephone'];
    $email=$_POST['email'];
    $type_contact=$_POST['type_contact'];

    // echo $prenom.'</br>';
    // echo $nom.'</br>';
    // echo $telephone.'</br>';
    // echo $email.'</br>';
    // echo $type_contact;
    // die;

    // NORMAL
    if ($type_contact=='normal')
    {
        $verifIntegrite = mysqli_query($con, "SELECT * FROM contacts_dage WHERE email='$email' OR telephone='$telephone'");

        if (mysqli_num_rows($verifIntegrite) > 0)
        {
            // $sql =  $con->query("UPDATE contacts SET telephone='$telephone', email='$email', adresse='$adresse' WHERE matricule='$matricule'");
    
            $_SESSION['errorMsg']=true;
            $_SESSION['successMsg']=false;
            $_SESSION['message'] ="Ce contact existe deja ! ";
            header("Location: ../contacts_dage.php");
        }
        else
        {
      
        $sql=mysqli_query($con, "INSERT INTO `contacts_dage` (`prenom`, `nom`, `email`, `telephone`) 
        VALUES ('$prenom', '$nom', '$email', '$telephone')"); 

        if($sql) 
            {
                $_SESSION['errorMsg']=false;
                $_SESSION['successMsg']=true;
                $_SESSION['message'] = "Contact ajouté avec succès !"; 
                header ('Location: ../contacts_dage.php');
            }
            else
            {

            $_SESSION['errorMsg']=true;
            $_SESSION['successMsg']=false;
            $_SESSION['message'] = "Echec de la creation !"; 
            header ('Location: ../contacts_dage.php');
            }
        }
    }
    // URGENT
    if ($type_contact=='urgent')
    {
        $verifIntegrite = mysqli_query($con, "SELECT * FROM contacts_dage_urgent WHERE email='$email' OR telephone='$telephone'");

        if (mysqli_num_rows($verifIntegrite) > 0)
        {
            // $sql =  $con->query("UPDATE contacts SET telephone='$telephone', email='$email', adresse='$adresse' WHERE matricule='$matricule'");
    
            $_SESSION['errorMsg']=true;
            $_SESSION['successMsg']=false;
            $_SESSION['message'] ="Ce contact existe deja ! ";
            header("Location: ../contacts_dage.php");
        }
        else
        {
      
        $sql=mysqli_query($con, "INSERT INTO `contacts_dage_urgent` (`prenom`, `nom`, `email`, `telephone`) 
        VALUES ('$prenom', '$nom', '$email', '$telephone')"); 

        if($sql) 
            {
                $_SESSION['errorMsg']=false;
                $_SESSION['successMsg']=true;
                $_SESSION['message'] = "Contact ajouté avec succès !"; 
                header ('Location: ../contacts_dage.php');
            }
            else
            {

            $_SESSION['errorMsg']=true;
            $_SESSION['successMsg']=false;
            $_SESSION['message'] = "Echec de la creation !"; 
            header ('Location: ../contacts_dage.php');
            }
        }
    }
        
}
// Modification
if (isset($_POST['modifierContact'])) {

    $prenom=$_POST['prenom'];
    $nom=$_POST['nom'];
    $telephone=$_POST['telephone'];
    $email=$_POST['email'];
    $idE=$_POST['idE'];
    $new_type=$_POST['new_type'];
    $old_type=$_POST['old_type'];

    if ($new_type==$old_type) 
    {
        $change=0;
    }
    else 
    {
        $change=1;
    }

    // echo $prenom.'</br>';
    // echo $nom.'</br>';
    // echo $telephone.'</br>';
    // echo $email.'</br>';
    // echo $id.'</br>';
    // echo $new_type.'</br>';
    // echo $change.'</br>';
    // die;

    if ($change==0)
    {
        switch ($old_type)
        {
            case 'normal' :
                $sql=mysqli_query($con, "UPDATE contacts_dage SET prenom='$prenom', nom='$nom', telephone='$telephone', email='$email' WHERE id='$idE'"); 
            break;
            case 'urgent' :
                $sql=mysqli_query($con, "UPDATE contacts_dage_urgent SET prenom='$prenom', nom='$nom', telephone='$telephone', email='$email' WHERE id='$idE'"); 
        }

        $_SESSION['errorMsg']=false;
        $_SESSION['successMsg']=true;
        $_SESSION['message'] = "Contact modifié avec succès !"; 
        header ('Location: ../contacts_dage.php');
    }
    else
    {
        switch ($old_type)
        {
            case 'normal' :
                // On supprime dans normal
                $sql=mysqli_query($con, "DELETE FROM contacts_dage WHERE id='$idE'"); 
                // On cree dans urgent
                $sql=mysqli_query($con, "INSERT INTO `contacts_dage_urgent` (`prenom`, `nom`, `email`, `telephone`) 
                VALUES ('$prenom', '$nom', '$email', '$telephone')"); 
            break;
            case 'urgent' :
                // On supprine dans urgent
                $sql=mysqli_query($con, "DELETE FROM contacts_dage_urgent WHERE id='$idE'"); 
                // On cree dans urgent
                $sql=mysqli_query($con, "INSERT INTO `contacts_dage` (`prenom`, `nom`, `email`, `telephone`) 
                VALUES ('$prenom', '$nom', '$email', '$telephone')"); 
        }
        $_SESSION['errorMsg']=false;
        $_SESSION['successMsg']=true;
        $_SESSION['message'] = "Contact modifié avec succès !"; 
        header ('Location: ../contacts_dage.php');
    }
    
}
// Suppression
if (isset($_POST['supprimerContact'])) {

    $idE=$_POST['idE'];
    $type_contact=$_POST['type_c'];

    // echo $idE.'</br>';
    // echo $type_contact.'</br>';
    // die;

    switch ($type_contact)
    {
        case 'normal' :
            $sql=mysqli_query($con, "DELETE FROM contacts_dage WHERE id='$idE'"); 
        break;
        case 'urgent' :
            $sql=mysqli_query($con, "DELETE FROM contacts_dage_urgent WHERE id='$idE'"); 
        break;
    }

   
    $_SESSION['errorMsg']=false;
    $_SESSION['successMsg']=true;
    $_SESSION['message'] = "Contact supprimé avec succés !"; 
    header ('Location: ../contacts_dage.php');


}


?>