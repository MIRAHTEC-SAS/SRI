
<?php
  header('Content-Type: text/html; charset=UTF-8');

include('../config/app.php');

require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC7bff5efabe2de67bcbfd6f1a3692e526';
$auth_token = '9d69d8010cbc54fb5805968e6cbe9a25';
$client = new Client($account_sid, $auth_token);


                        // $message ="Bonjour $prenom $nom,\nVous êtes convoqué(e) au $nomConcours, le $dateConcours de $debut à $fin au centre $nomCentre .\nLes epreuves se dérouleront dans la salle $nomSalle et votre table porte le numéro $numero_table. \nVous recevez la convocation sur votre adresse courriel $email.\n\nCordialement \nCentre Formation Judiciaire";
                      $message='test dtai';
                      $telephone='+15145741304';
            
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

              echo 'Done !';



