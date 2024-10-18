<?php
include('../config/app.php');

require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC7bff5efabe2de67bcbfd6f1a3692e526';
$auth_token = '9d69d8010cbc54fb5805968e6cbe9a25';
$client = new Client($account_sid, $auth_token);

    if (isset($_POST['envoyerMessage'])) {

            $choix=$_POST['choix'];
           
            switch ($choix) {
                case 'Individuel' : 
                    $destinataire=$_POST['destinataire'];
                    $message=$_POST['message'];

                    // recuperation du numero
                        $recupNum = $con->query("SELECT telephone FROM candidats WHERE matricule='$destinataire'");

                        while ($row = mysqli_fetch_array($recupNum)) { 
                        $numeroDestinataire=$row['telephone'];
                        
                        }
                    // Persistance SMS
                    $sql = $con->query("INSERT INTO historique_sms (matricule,numero,message,date_saisie) VALUES ('$destinataire','$numeroDestinataire','$message','$date_saisie')");
                    // Envoi du SMS
                        $client->messages->create($numeroDestinataire,
                            array(
                            // "from" => "CFJ",
                            "messagingServiceSid" => 'MGf3c9896cbe7d180452fade5013466a98',
                            'body' => $message
                            )
                        );
                    
                        $_SESSION['errorMsg']=false;
                        $_SESSION['successMsg']=true;
                        $_SESSION['message'] ="SMS envoyé avec succès ! ";
                        header("Location: ../envoi_sms.php");

                    // echo $choix.'</br>';
                    // echo $destinataire.'</br>';
                    // echo $message.'</br>';
                    // echo $numeroDestinataire.'</br>';
                    // echo 'DOne !';
                    break;
                case 'Groupe' :
                    $liste=$_POST['liste'];
                    $message=$_POST['message'];

                     // recuperation des numeros
                     $recupNums = $con->query("SELECT * FROM liste_candidats INNER JOIN candidats ON candidats.matricule= liste_candidats.matricule WHERE liste_candidats.id_liste='$liste'");
                     $listeNumeros=[];
                     $matricules=[];
                     while ($row = mysqli_fetch_array($recupNums)) { 
                        array_push($listeNumeros, $row['telephone']);
                        array_push($matricules, $row['matricule']);
                         }
                         //Persistance SMS
                         for ($i=0;$i<count($listeNumeros);$i++) {
                            $sql = $con->query("INSERT INTO historique_sms (matricule,numero,message,date_saisie) VALUES ('$matricules[$i]','$listeNumeros[$i]','$message','$date_saisie')");
                         }

                         // Envoi SMS
                         for ($i=0;$i<count($listeNumeros);$i++) {
                            $client->messages->create($listeNumeros[$i],
                                array(
                                // "from" => "CFJ",
                                "messagingServiceSid" => 'MGf3c9896cbe7d180452fade5013466a98',
                                'body' => $message
                                )
                            );
                        }

                         
                        $_SESSION['errorMsg']=false;
                        $_SESSION['successMsg']=true;
                        $_SESSION['message'] ="SMS envoyé avec succès ! ";
                        header("Location: ../envoi_sms.php");

                    // echo $liste.'</br>';
                    // echo $choix.'</br>';                    
                    // echo $message.'</br>';

                    // for ($i=0;$i<count($listeNumeros);$i++) {
                    //     echo $listeNumeros[$i].'</br>';
                    // }
                    break;

            }
            die;
        // }
    

    // $numero1='+221771752617';
    // $numero2='+221770771258';
    // $numero3='+221781776133';
    // $numero4='+221774111051';

    // $destinataires =[$numero1,$numero2,$numero3,$numero4];

    for ($i=0;$i<count($destinataires);$i++) {
        $message = $client->messages->create( $destinataires[$i],
            array(
            "from" => "CFJ",
            "messagingServiceSid" => 'MGf3c9896cbe7d180452fade5013466a98',
            'body' => 'Test Messagerie SEDIF ! '
            )
        );
    }


    // if ($message) {
    //     echo 'SMS Envoyé avec succes !!';
    // }
    // else {
    //     echo 'something happen !';
    // }

}

