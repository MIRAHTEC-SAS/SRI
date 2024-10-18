
<?php
  header('Content-Type: text/html; charset=UTF-8');

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
                        $dateConcours=date("d/m/Y", strtotime($row['dateConcours']));
                        $debut=$row['debut'];
                        $fin=$row['fin'];
                        $numero_table=$row['ordre_table'];
                       

                        $message ="Bonjour $prenom $nom,\nVous êtes convoqué(e) au $nomConcours, le $dateConcours de $debut à $fin au centre $nomCentre .\nLes epreuves se dérouleront dans la salle $nomSalle et votre table porte le numéro $numero_table. \nVous recevez la convocation sur votre adresse courriel $email.\n\nCordialement \nCentre Formation Judiciaire";
                      
            
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

                        // MAIL...

                        //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    $candidat = $prenom.' '.$nom;
	// $nomConcours='Concours direct Magistrature';

    $htmlversion='
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="fr">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title></title>
	<style type="text/css">
		div[style*="margin: 16px 0"] {
		  margin: 0 !important;
		}
		@media screen and (max-width: 499px) {
		  .inner {
		    padding-top: 24px !important;
		    padding-left: 24px !important;
		    padding-right: 24px !important;
		  }
		  img {
		    height: auto !important;
		  }
		}
		@media screen and (max-width: 620px) {
		  .hide {
		    display: none !important;
		  }
		}
		a.link-hover {
		  color: #333333;
		  text-decoration: underline;
		}
		a.link-hover:hover {
		  text-decoration: none !important;
		  color: #aace01 !important;
		}
		.section-footer a:hover {
		  text-decoration: underline !important;
		}
		a[x-apple-data-detectors=true] {
		  text-decoration: none !important;
		  color: inherit !important;
		  cursor: default;
		}
		.preheader {display: none;}
	</style>
	<!--[if !mso]><!-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!--<![endif]-->
	<!--[if mso]>
	<style type="text/css">
		table {border-collapse: collapse !important;}
		table, div {font-family: Arial, sans-serif !important;}
		.button {padding: 4px 6px 4px 6px !important;}
	</style>
	<![endif]-->
</head><body style="font-family:Arial,sans-serif;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;background-color:#f5f7fa;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;">
<div class="preheader mktEditable" id="Preheader" style="mso-hide:all;visibility:hidden;opacity:0;color:transparent;mso-line-height-rule:exactly;line-height:0;font-size:0;overflow:hidden;border-width:0;display:none !important;"><p style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;"></p></div>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="wrapper" style="margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;font-family:Arial,sans-serif;table-layout:fixed;width:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#f5f7fa;">
	<tr>
		<td align="center">
			<center>
				<div class="webkit" style="margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;width:94%;max-width:600px;">
					
					<!--[if(mso)|(IE)]>
					<table cellpadding="0" cellspacing="0" border="0" width="600"><tr><td>
					<![endif]-->

					<table width="100%" cellpadding="0" cellspacing="0" border="0" class="outer" style="margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;width:100%;max-width:600px;">
					<tr class="hide"><td style="font-size:20px;line-height:20px;">&nbsp;</td></tr>
						<tr>
							<td>
								<!-- Masthead -->
								<table width="100%" cellpadding="0" cellspacing="0" border="0" class="contents section-masthead" style="font-size:14px;line-height:22px;text-align:left;">
									<tr class="one-col">
										<td class="inner type" align="center" style="font-family:Arial,sans-serif;padding-right:30px;padding-left:30px;padding-top:26px;padding-bottom:24px;">
											<div class="mktEditable" id="logo">
												<p style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;"><a href="#" style="text-decoration:none;color:inherit;"><img src="https://concours-cfj.sn/admin/logo.png" alt="CENTRE DE FORMATION JUDICIAIRE" width="185" style="border-width:0;height:auto;-ms-interpolation-mode:bicubic;display:block;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;max-width:70%;" /></a></p>
											</div>
										</td>
									</tr>
								</table>
								<!-- Main -->
								<table width="100%" cellpadding="0" cellspacing="0" border="0" class="section-main contents" style="font-size:14px;line-height:22px;background-color:#ffffff;color:#333333;text-align:left;border-width:1px;border-style:solid;border-color:#d4dae6;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#b3bdd2;">
									<tr class="one-col">
										<td class="inner type" style="font-family:Arial,sans-serif;padding-top:30px;padding-bottom:30px;padding-right:30px;padding-left:30px;">
											<div class="mktEditable" id="main-content">
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;">Bonjour '.$candidat.', </p>
	
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;">Vous êtes invité(e) à vous présenter au <strong>'.$nomConcours.'</strong> le <strong>'.$dateConcours.'</strong> muni(e) d\'une piece d\'identite. Faute de quoi la possibilité de passer le concours vous sera refusée.</br> Aucun
												remboursement des droits d’inscription ne sera alors effectué.</p>
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;">Le concours se deroulera au centre ci-apres : </br> </p>
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;text-align:center"><strong>'.$nomCentre.'</strong></p>
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;text-align:center;"><strong>Salle : '.$nomSalle.'</strong></p>
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;text-align:center;"><strong>Table numero : '.$numero_table.'</strong></p>
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;">&nbsp;</p>
												<p style="text-align:center;font-size:12px;margin-bottom:10px;margin-top:0;margin-right:0;margin-left:0;">
													<img src="https://placehold.it/75x75" border="0" alt="" style="max-width:100%;border-width:0;height:auto;-ms-interpolation-mode:bicubic;" />
												</p>
												<p style="text-align:center;font-size:12px;line-height:15px;margin-bottom:5px;margin-top:0;margin-right:0;margin-left:0;">
													Pape Abdou FALL<br/><span style="color:#a3afc8;">Le directeur du centre</span>
												</p>
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table width="100%" cellpadding="0" cellspacing="0" border="0" class="section-footer">
									<tr class="one-col">
										<td class="inner" style="padding-top:44px;padding-bottom:26px;padding-right:15px;padding-left:15px;">
											<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contents" style="font-size:12px;line-height:16px;color:#a3afc8;text-align:center;">
												<tr>
													<td  class="type" style="padding-bottom:10px;font-family:Arial,sans-serif;">
														<table align="center" cellpadding="0" cellspacing="0" border="0" class="social" style="font-size:8px;line-height:10px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;">
															<tr>
	
															</tr>
														</table>
													</td>
												</tr>
												<tr>
													<td class="type" style="font-family:Arial,sans-serif;">
														<div class="mktEditable" id="footer">
															<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:4px;">Centre de Formation Judiciaire: Boulevard DIAL DIOP DAKAR/SENEGAL</p>
															<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:4px;"><b><a href="{{system.forwardToFriendLink}}" style="text-decoration:none;color:#a3afc8;">Tel</a> &middot; <a href="{{system.unsubscribeLink}}" style="text-decoration:none;color:#a3afc8;">(+221) 33 824 24 67</a> &middot; <a href="{{system.viewAsWebpageLink}}" style="text-decoration:none;color:#a3afc8;">cfj@cfj.sn</a></b></p>
														</div>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>	
					</table>
					
					<!--[if(mso)|(IE)]>
					</td></tr></table>
					<![endif]-->

				</div>
			</center>
		</td>
	</tr>
</table>
</body>
</html>';

    // $htmlversion=include('mail/mail.php');

    $textversion="This is the text version";
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.concours-cfj.sn';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'contact@concours-cfj.sn';                     //SMTP username
    $mail->Password   = 'Cfj@2022';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('contact@concours-cfj.sn', 'CENTRE DE FORMATION JUDICIAIRE');
    $mail->addAddress($email, $candidat);     //Add a recipient
    // $mail->addAddress('ametsene21@gmail.com');               //Name is optional
    // $mail->addReplyTo('support@sedif.sn', 'Information');
    // $mail->addCC('ametsene0304@gmail.com');
    // $mail->addBCC('bcc@example.com');
    // /Applications/MAMP/htdocs/cfj/admin/Documents/Listes/2204/Convocation_22001.pdf
    $convocationFIle='../Documents/listes/'.$codeConcours.'/Convocation_'.$matricule.'.pdf';
    // //Attachments
    $mail->addAttachment($convocationFIle);         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML();                                  //Set email format to HTML
    $mail->Subject = 'Convocation '.$nomConcours;
    $mail->Body    = $htmlversion;
    $mail->AltBody = $textversion;

    $mail->send();


} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

                        // include ('/sendmail.php');
                        }
                            //  include ('mail.php');

                
	$_SESSION['errorMsg']=false;
	$_SESSION['successMsg']=true;
	$_SESSION['message'] ="Les candidats sont notifiés avec succès par Email et par SMS ! ";
	header("Location: ../notifications.php");
      
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
    //         die;
    //     // }
    

    // // $numero1='+221771752617';
    // // $numero2='+221770771258';
    // // $numero3='+221781776133';
    // // $numero4='+221774111051';

    // // $destinataires =[$numero1,$numero2,$numero3,$numero4];

    // for ($i=0;$i<count($destinataires);$i++) {
    //     $message = $client->messages->create( $destinataires[$i],
    //         array(
    //         "from" => "CFJ",
    //         "messagingServiceSid" => 'MGf3c9896cbe7d180452fade5013466a98',
    //         'body' => 'Test Messagerie SEDIF ! '
    //         )
    //     );
    // }


    // if ($message) {
    //     echo 'SMS Envoyé avec succes !!';
    // }
    // else {
    //     echo 'something happen !';
    // }

// }

