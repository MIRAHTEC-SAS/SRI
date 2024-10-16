<?php
if (isset($_POST['creerCompte'])) {

    include ('app.config.php');
    date_default_timezone_set('Africa/Dakar');
    $date_c = date("Y-m-d");

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $role= $_POST['role'];
    $email = $_POST['email'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];

    // echo $prenom.'</br>' ;
    // echo $nom.'</br>' ;
    // echo $email.'</br>';
    // echo $pwd1.'</br>' ;
    // echo $pwd2.'</br>';

    //  récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
    $mdp1 = stripslashes($_POST['pwd1']);
    $mdp1 = mysqli_real_escape_string($con, $mdp1);

    $mdp2 = stripslashes($_POST['pwd2']);
    $mdp2 = mysqli_real_escape_string($con, $mdp2);
 
    //  echo $mdp1.'</br>' ;
    //  echo $mdp2.'</br>';

  $pwdH = hash('sha256', $mdp1);


    if ($mdp1 != $mdp2) 
    {
        $_SESSION['errorMsg']=true;
        $_SESSION['successMsg']=false;
        $_SESSION['message'] = "Les mots de passe doivent être identiques ! "; 
        header ('Location: creer_user.php');
    }

    else
    {

        mysqli_query($con, "INSERT INTO users (prenom,nom,email, password, role,  date_c) 
        VALUES ('$prenom', '$nom', '$email', '$pwdH', '$role', '$date_c')"); 
    
        $_SESSION['errorMsg']=false;
        $_SESSION['successMsg']=true;
        $_SESSION['message'] = "Utilisateur créé avec succès !"; 
        header ('Location: creer_user.php');
    
    }



     // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
//   $password = stripslashes($_REQUEST['password']);
//   $password = mysqli_real_escape_string($conn, $password);
//   //requéte SQL + mot de passe crypté
//     $query = "INSERT into `users` (username, email, password)
//               VALUES ('$username', '$email', '".hash('sha256', $password)."')";


    // echo $mat.'</br>' ;
    // echo $service.'</br>' ;
    // echo $mdp1.'</br>' ;
    // echo $mdp2.'</br>';

   

    // INSERT INTO `emargement_elementaire` (`id`, `matriculeEnseignant`, `dateEmargement`, `nb_heure`, `date_saisie`) 
    // VALUES (NULL, '2323', '2021-02-10', '2', '2021-02-18 00:00:00');
 
  
}


?>