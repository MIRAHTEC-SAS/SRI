
<?php
  header('Content-Type: text/html; charset=UTF-8');

include('../config/app.php');

require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor2/autoload.php';

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC7bff5efabe2de67bcbfd6f1a3692e526';
$auth_token = '9d69d8010cbc54fb5805968e6cbe9a25';
$client = new Client($account_sid, $auth_token);


//  if (isset($_POST['notifierCandidats'])) {

    // $codeFc='FC-MFB-2022-1';
    // $codeDirection='43100000';

    $getDesc = mysqli_query($con, "SELECT * From fonds_commun where codeFc='$codeFc'");   
    while ($row = mysqli_fetch_array($getDesc)) { 
      $descriptionFc=$row['description'];
      $trimestre=$row['trimestre'];
    } 
    // $descriptionFc='Fond commun du ministere de finance et du budget du premier semestre 2022';

    $getInfos = mysqli_query($con, "SELECT users.prenom, users.nom, users.email, acteurs_directions.telephone, acteurs_directions.codeDirection FROM `acteurs_directions` INNER JOIN users on users.email=acteurs_directions.acteur where acteurs_directions.codeDirection=' $codeDirection'");

          while ($row = mysqli_fetch_array($getInfos)) { 

                        $prenom=$row['prenom'];
                        $nom=$row['nom'];
                        $telephone=$row['telephone'];
                        $email=$row['email'];

                        // $message ="Bonjour $prenom $nom,\nVous êtes convoqué(e) au $nomConcours, le $dateConcours de $debut à $fin au centre $nomCentre .\nLes epreuves se dérouleront dans la salle $nomSalle et votre table porte le numéro $numero_table. \nVous recevez la convocation sur votre adresse courriel $email.\n\nCordialement \nCentre Formation Judiciaire";
                        $message ="Bonjour $prenom $nom,\nNous vous informons que le $descriptionFc est ouvert ce jour.\nVos code d'acces et les etats initiaux vous seront envoyés par mail. \nDirection du Traitement Automatique de l'information";

            
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
    $directeur = $prenom.' '.$nom;
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
												<p style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;"><a href="#" style="text-decoration:none;color:inherit;"><img src="https://sedif.sn/dtai/pgav/dev/symbole.png" alt="DTAI" width="185" style="border-width:0;height:auto;-ms-interpolation-mode:bicubic;display:block;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;max-width:70%;" /></a></p>
											</div>
										</td>
									</tr>
								</table>
								<!-- Main -->
								<table width="100%" cellpadding="0" cellspacing="0" border="0" class="section-main contents" style="font-size:14px;line-height:22px;background-color:#ffffff;color:#333333;text-align:left;border-width:1px;border-style:solid;border-color:#d4dae6;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#b3bdd2;">
									<tr class="one-col">
										<td class="inner type" style="font-family:Arial,sans-serif;padding-top:30px;padding-bottom:30px;padding-right:30px;padding-left:30px;">
											<div class="mktEditable" id="main-content">
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;">Bonjour '.$directeur.', </p>
	
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;">Nous vous informons que le <strong>'.$descriptionFc.'</strong> est ouvert pour saisie.</br></p>
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;"></p>Vous avez desormais la possibilite d\'effectuer la saisie et la validation en ligne via la nouvelle plateforme de gestion des fonds commmun en cliquez sur le lien ci-dessous.</p>
                        <p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;text-align:center"><button style="background-color:#146132"><a style="color:white"href="https://sedif.sn/dtai/pgav/dev/">Acceder a la plateforme</a></button></p>
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;">Vous trouverez en piece jointe les etats initiaux en version PDF, que vous pouvez egalement remplir et nous retourner.</br> </p>
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;">&nbsp;</p>
												<p style="text-align:center;font-size:12px;margin-bottom:10px;margin-top:0;margin-right:0;margin-left:0;">
													<img src="https://placehold.it/75x75" border="0" alt="" style="max-width:100%;border-width:0;height:auto;-ms-interpolation-mode:bicubic;" />
												</p>
												<p style="text-align:center;font-size:12px;line-height:15px;margin-bottom:5px;margin-top:0;margin-right:0;margin-left:0;">
													Abdou FALL<br/><span style="color:#a3afc8;">Directeur des ressources humaines</span>
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
															<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:4px;">Direction du Traitement Automatique de l\'information</p>
															<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:4px;"><b><a href="{{system.forwardToFriendLink}}" style="text-decoration:none;color:#a3afc8;">Tel</a> &middot; <a href="{{system.unsubscribeLink}}" style="text-decoration:none;color:#a3afc8;">(+221) 33 824 33 33</a> &middot; <a href="{{system.viewAsWebpageLink}}" style="text-decoration:none;color:#a3afc8;">dtai@minfinances.sn</a></b></p>
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
    $mail->Host       = 'mail.sedif.sn';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'contact@sedif.sn';                     //SMTP username
    $mail->Password   = 'Sedif@2022';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('contact@sedif.sn', 'DTAI');
    $mail->addAddress($email, $directeur);     //Add a recipient
    // $mail->addAddress('ametsene21@gmail.com');               //Name is optional
    // $mail->addReplyTo('support@sedif.sn', 'Information');
    // $mail->addCC('ametsene0304@gmail.com');
    // $mail->addBCC('bcc@example.com');
    // /Applications/MAMP/htdocs/cfj/admin/Documents/Listes/2204/Convocation_22001.pdf
    // $convocationFIle='../Documents/listes/'.$codeConcours.'/Convocation_'.$matricule.'.pdf';
    $convocationFIle='Convocation_22008.pdf';

    $convocationFIle='../Etats/FC/'.$codeFc.'/Etats_initiaux_'.$codeFc.'_'.$codeDirection.'.pdf';

    // //Attachments
    $mail->addAttachment($convocationFIle);         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML();                                  //Set email format to HTML
    $mail->Subject = 'Ouverture '.$descriptionFc;
    $mail->Body    = $htmlversion;
    $mail->AltBody = $textversion;

    $mail->send();


} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

                        // include ('/sendmail.php');
                        }
                            //  include ('mail.php');

                
	// $_SESSION['errorMsg']=false;
	// $_SESSION['successMsg']=true;
	// $_SESSION['message'] ="Les candidats sont notifiés avec succès par Email et par SMS ! ";
	// header("Location: ../notifications.php");

  // echo 'done ! ';
      
                    // echo ' SENT !!!';
                     

//  }

