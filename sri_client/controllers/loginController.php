<?php 
require_once ('../config/app.php');
session_start();
$login = $_POST['email'];
// $pass = $_POST['pass'];

$pass = stripslashes($_POST['pwd']);

$pass = mysqli_real_escape_string($con, $pass);

$pwdH = hash('sha256', $pass);

//  // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
//  $mdp1 = stripslashes($_POST['mdp1']);
//  $mdp1 = mysqli_real_escape_string($con, $mdp1);

//  $mdp2 = stripslashes($_POST['mdp2']);
//  $mdp2 = mysqli_real_escape_string($con, $mdp2);



// $pwdH = hash('sha256', $mdp1);



$query1 = " SELECT * FROM users  WHERE email ='".$login."' and password='".$pwdH."'";
$result1 = mysqli_query($con,$query1);
while ($row = mysqli_fetch_array($result1)) 
{
    $emailUser = $row['email'];
    $passUser = $row['password'];
    $prenomUser = $row['prenom'];
    $nomUser = $row['nom'];
    $roleUser = $row['role'];
    
}

    if (isset($_POST['login']))
    {
        if (empty($_POST['email']) || empty($_POST['pwd']))
        {
            // header('Location:../login?Empty= ');
                $_SESSION['errorMsg']=true;
                $_SESSION['successMsg']=false;
                $_SESSION['message'] = "Veuillez remplir tous les champs ! ";
                header ('Location: ../');
        }
        else
        {
            $query = "SELECT * from users where email ='".$login."' and password = '".$pwdH."'";
            $result = mysqli_query($con,$query);
          

            if (mysqli_fetch_assoc($result)) 
            {
                $_SESSION ['User'] = $login;
                $_SESSION ['UserPass'] = $passUser;
                $_SESSION ['prenom'] = $prenomUser;
                $_SESSION ['nom'] = $nomUser;
                $_SESSION ['email'] = $emailUser;
                $_SESSION ['role'] = $roleUser;

                if ($passUser=='c355c70cca980e819a59f9d34f71460b6f207c950bccc62965b0da3669442fb9') 
                {
                    // echo 'Yes';
                    header("Location: ../create_password?email=$emailUser");
                }
                else {
                date_default_timezone_set('Africa/Dakar');
                $dateConnexion = date("Y-m-d H:i:s");

                function getIp(){
                    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
                      $ip = $_SERVER['HTTP_CLIENT_IP'];
                    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    }else{
                      $ip = $_SERVER['REMOTE_ADDR'];
                    }
                    return $ip;
                  }

                  $ipAdress = getIp();

                mysqli_query($con, "INSERT INTO journal_connexion (login, dateConnexion, ip) 
                VALUES ('$login', '$dateConnexion', '$ipAdress')"); 

                    if (isset($_SESSION['User']) && isset($_SESSION['UserPass']))  {
                        switch($_SESSION['role']) {
                            case 'administrateur' : header ('Location: ../dashboard'); break;
                            case 'Directeur' : header ('Location: ../creer_fond_commun'); break;
                            case 'Adjoint(e) Directeur' : header ('Location: ../creer_fond_commun'); break;
                            case 'DRH' : header ('Location: ../creer_fond_commun'); break;
                            case 'DTAI' : header ('Location: ../creer_fond_commun'); break;
                            case 'Agent Tresor' : header ('Location: ../creer_fond_commun'); break;
                            case 'DG Tresor' : header ('Location: ../creer_fond_commun'); break;
                            case 'SG Ministere' : header ('Location: ../creer_fond_commun'); break;
                            case 'super admin' : header ('Location: ../dashboard'); break;

                            }
                     
                    }
                    else
                    {
                        $_SESSION['errorMsg']=true;
                        $_SESSION['successMsg']=false;
                        $_SESSION['message'] = "Votre rôle ne vous permet pas d'acceder a cette page. ";
                        header ('Location: ../');
                    }
               
                }      
            }
            else 
            {
                $_SESSION['errorMsg']=true;
                $_SESSION['successMsg']=false;
                $_SESSION['message'] = "Email ou mot de passe incorrecte ! ";
                header ('Location: ../');
            }
        }
    }
    else
    {
        echo 'Not workinggg !!!';
    }
?>