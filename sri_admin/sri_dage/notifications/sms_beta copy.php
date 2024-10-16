<?php
include('../config/app.php');

require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC7bff5efabe2de67bcbfd6f1a3692e526';
$auth_token = '9d69d8010cbc54fb5805968e6cbe9a25';
$client = new Client($account_sid, $auth_token);


 if (isset($_POST['notifierCandidats'])) {

    $codeConcours=$_POST['codeConcours'];

                    // recuperation du numero
                        $recuInfos = $con->query("SELECT 
                        candidats.matricule,
                        candidats.prenom,
                        candidats.nom,
                        candidats.telephone,
                        candidats.email,
                        concours.codeConcours,
                        concours.nomConcours,
                        concours_init.dateConcours,
                        concours_init.debut,
                        concours_init.fin,
                        centres.codeCentre,
                        centres.nom as nomCentre,
                        centres.adresse,
                        centres.region,
                        concours_planifie_salles.ordre_table,
                        salles.nom as nomSalle
                        FROM concours_planifie_salles INNER JOIN concours_init ON concours_planifie_salles.codeConcours=concours_init.codeConcours  INNER JOIN candidats ON candidats.matricule=concours_planifie_salles.matricule INNER JOIN centres ON centres.codeCentre=concours_planifie_salles.codeCentre INNER JOIN salles ON salles.codeSalle=concours_planifie_salles.codeSalle INNER JOIN concours ON concours.codeConcours=concours_planifie_salles.codeConcours where concours_planifie_salles.codeConcours='$codeConcours'");
 
                        while ($row = mysqli_fetch_array($recuInfos)) { 

                        $prenom=$row['prenom'];
                        $nom=$row['nom'];
                        $matricule=$row['matricule'];
                        $telephone=$row['telephone'];
                        $email=$row['email'];
                        $nomConcours=$row['nomConcours'];
                        $nomCentre=$row['nomCentre'];
                        $adresse=$row['adresse'];
                        $region=$row['region'];
                        $nomSalle=$row['nomSalle'];
                        $dateConcours=date("d / m / Y", strtotime($row['dateConcours']));
                        $debut=$row['debut'];
                        $fin=$row['fin'];
                        $numero_table=$row['ordre_table'];
                       

                        $message ="Bonjour $prenom $nom,\nVous etes convoque au $nomConcours, le $dateConcours de $debut à $fin au centre $nomCentre .\nLes epreuves se derouleront dans la salle $nomSalle et votre table porte le numero $numero_table. \nVous recevez la convocation sur votre adresse courriel $email.\n\nCordialement \nCentre Formation Judiciaire";
                      
            
                            // Persistance SMS
                            $sql = $con->query("INSERT INTO historique_sms (matricule,numero,message,date_saisie) VALUES ('$matricule','$telephone','$message','$date_saisie')");
                            // Envoi du SMS
                                $client->messages->create($telephone,
                                    array(
                                    // "from" => "CFJ",
                                    "messagingServiceSid" => 'MGf3c9896cbe7d180452fade5013466a98',
                                    'body' => $message
                                    )
                                );

                        // include ('/sendmail.php');
                        }
                             include ('mail.php');

                
                    // echo ' SENT !!!';
                     

 }



                    // echo $choix.'</br>';
                    // echo $destinataire.'</br>';
                    // echo $message.'</br>';
                    // echo $numeroDestinataire.'</br>';
                    // echo 'DOne !';
                //     break;
                // case 'Groupe' :
                //     $liste=$_POST['liste'];
                //     $message=$_POST['message'];

                //      // recuperation des numeros
                //      $recupNums = $con->query("SELECT * FROM liste_candidats INNER JOIN candidats ON candidats.matricule= liste_candidats.matricule WHERE liste_candidats.id_liste='$liste'");
                //      $listeNumeros=[];
                //      $matricules=[];
                //      while ($row = mysqli_fetch_array($recupNums)) { 
                //         array_push($listeNumeros, $row['telephone']);
                //         array_push($matricules, $row['matricule']);
                //          }
                //          //Persistance SMS
                //          for ($i=0;$i<count($listeNumeros);$i++) {
                //             $sql = $con->query("INSERT INTO historique_sms (matricule,numero,message,date_saisie) VALUES ('$matricules[$i]','$listeNumeros[$i]','$message','$date_saisie')");
                //          }

                //          // Envoi SMS
                //          for ($i=0;$i<count($listeNumeros);$i++) {
                //             $client->messages->create($listeNumeros[$i],
                //                 array(
                //                 // "from" => "CFJ",
                //                 "messagingServiceSid" => 'MGf3c9896cbe7d180452fade5013466a98',
                //                 'body' => $message
                //                 )
                //             );
                //         }

                         
                //         $_SESSION['errorMsg']=false;
                //         $_SESSION['successMsg']=true;
                //         $_SESSION['message'] ="SMS envoyé avec succès ! ";
                //         header("Location: ../envoi_sms.php");

                //     // echo $liste.'</br>';
                //     // echo $choix.'</br>';                    
                //     // echo $message.'</br>';

                //     // for ($i=0;$i<count($listeNumeros);$i++) {
                //     //     echo $listeNumeros[$i].'</br>';
                //     // }
                //     break;

            // }
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

// }

