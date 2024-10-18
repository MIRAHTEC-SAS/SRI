<?php 
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Systeme de remonte des incidents, DAGE, DTAI">
    <meta name="author" content="SEDIF">
	<title></title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="../css/style.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="../css/custom.css" rel="stylesheet">
    
	<script type="text/javascript">
    function delayedRedirect(){
        window.location = "../"
    }
    </script>

</head>
<body onLoad="setTimeout('delayedRedirect()', 8000)" style="background-color:#fff;">
<!-- <body style="background-color:#fff;"> -->


<!-- END SEND MAIL SCRIPT -->   

<?php
if (isset($_POST['process'])) {
	
	include ('../config/app.php');

	// 1/5 localisation
	$code_service=$_POST['code_service'];
	$code_batiment=$_POST['code_batiment'];
	$code_etage=$_POST['code_etage'];
	$piece=$_POST['piece'];

	// Categories
	 $categories=[];
	 for ($i=0;$i<count($_POST['question_1']);$i++) {
		$categories[]=$_POST['question_1'][$i];
	 }

	 // recuperation des codes incidents
	 $codes_incident=[];
	 for ($i=0;$i<count($categories);$i++) {
		$type=$categories[$i];

		$recupCode = $con->query("SELECT * FROM type_incidents WHERE type_incident='$type'");

		 while ($row = mysqli_fetch_array($recupCode)) { 
        	$codes_incident[]=$row['code_incident'];
		}

	 }
	 // Description
	 
	 	 // Reference incident
		//   $numero_incident='44DC432';

		  $getLastRef = mysqli_query($con, "SELECT max(numero_incident) as lastRef FROM signalements");
		  while ($row = mysqli_fetch_array($getLastRef)) { 
			  $lastRef=$row['lastRef'];
			  }
		  
			  if (!empty($lastRef)) {
				  $numero_incident=$lastRef+1;
			  }
			  else {
				 $numero_incident=20221;
			  }
			
		// echo $code_service.'</br>';
		// echo $code_batiment.'</br>';
		// echo $code_etage.'</br>';
		// echo $numero_incident.'</br>';
		// echo $description.'</br>';
		// echo $$codes_incident.'</br>';die;


	
	 //Photo...

	 $rep = $numero_incident;

	 $repertoire="Signalements/".$rep."/";
	 if (is_dir($repertoire)) 
	 {
		 $m = "Signalements/".$rep."/".$_FILES['fileupload']['name'];
		 move_uploaded_file ($_FILES['fileupload']['tmp_name'], $m);
		 $photo = $_FILES['fileupload']['name'];  
	 }
	 else
	 {
		 mkdir("Signalements/".$rep);
		 $m = "Signalements/".$rep."/".$_FILES['fileupload']['name'];
		 move_uploaded_file ($_FILES['fileupload']['tmp_name'], $m);
		 $photo = $_FILES['fileupload']['name'];
	 }


	 if (!empty($photo)) {
		$link="Signalements/".$rep."/".$photo;
	}
	 else {
		$link='Signalements/no_image.png';
	}
	
	//  echo $link.'</br>';

	 // Identification
	 $prenom=$_POST['firstname'];
	 $nom=$_POST['lastname'];
	 $contact=$_POST['contact'];

	//  $type_intervention='Informatique';
	//  $description='Les climatisations de l\'étage 2 ne fonctionnent plus';
	//  $service='DTAI';
	//  $code_service='43100000';

	 // recup Infos services 

	 $reqInfosService = $con->query("SELECT * FROM `services` WHERE code_service='$code_service'");
	 
	 while ($row = mysqli_fetch_array($reqInfosService)) { 
		$service=$row['libelle'];
		// $emailDage=$row['email']; 
	}

	$reqInfosLocalisation = $con->query("SELECT * FROM `localisation_services` INNER JOIN batiments on localisation_services.code_batiment=batiments.code_batiment WHERE localisation_services.code_service='$code_service'");
	 
	 while ($row = mysqli_fetch_array($reqInfosLocalisation)) { 
		$localisation=$row['nom_batiment'];
		$adresse=$row['adresse'];
		$contact=$row['contact'];
	}
	//  $localisation='Immeuble Moussa';
	//  $adresse='5, Rue Lamine GUEYE BP2300 Dakar';
	//  $contact='338904478';
	


	// Les types selectionnés
	// for ($i=0;$i<count($codes_incident);$i++) {

	// 	$code_incident=$codes_incident[$i];

		// $sql = $con->query("INSERT INTO `signalements_incidents` (`numero_incident`, `code_incident`) 
		// VALUES ('$numero_incident', '$code_incident');");
	//  }
	
	 // Table signalements
	// $sql = $con->query("INSERT INTO `signalements` (`numero_incident`, `date_reception`, `prenom`, `nom`, `contact`, `code_service`, `code_batiment`, `code_etage`, `piece`,`description`, `photo`, `statut`) 
	// VALUES ('$numero_incident', '$date_saisie', '$prenom', '$nom', '$contact', '$code_service', '$code_batiment', '$code_etage', '$piece', '$description', '$link', 'en attente')");

	//  // Recup Infos

	  	// Infos Dage
		  $reqInfosDage = $con->query("SELECT * FROM contacts_dage");

		  while ($row = mysqli_fetch_array($reqInfosDage)) { 
			 $telephoneDage=$row['telephone'];
			 $emailDage=$row['email']; 
		 }
	
	  // Infos Responsables DAGE
	 $telephonesResponsables=[];
	 $emailsResponsables=[];
	 $responsables=[];
 
	 //Recuperer les codes incidents
	//  $reqCodeIncidents = $con->query("SELECT * FROM signalements_incidents where numero_incident='$numero_incident'");
 
	//  while ($row = mysqli_fetch_array($reqCodeIncidents)) { 
		// for ($i=0;$i<count($codes_incident);$i++) {
		// 	$code_incident=$codes_incident[$i];
			//  $codeIncident=$row['code_incident'];
 
		 	$reqInfosResponsablesDage = $con->query("SELECT * FROM responsables_incidents INNER JOIN responsables_dage on responsables_dage.matricule=responsables_incidents.matricule_responsable where responsables_incidents.code_incident='$code_incident'");
 
			 while ($row = mysqli_fetch_array($reqInfosResponsablesDage)) { 
				 $telephonesResponsables[]=$row['telephone'];
				 $emailsResponsables[]=$row['email']; 
				 $responsables[]=$row['prenom'].' '.$row['nom'];
			 }
	//  }

	 $reqInfosGestionnaires = $con->query("SELECT * FROM `gestionnaires` INNER JOIN gestionnaires_services on gestionnaires_services.matricule_gestionnaire=gestionnaires.matricule_gestionnaire WHERE gestionnaires_services.code_service='$code_service'");
	 
	 $telephonesGestionnaires=[];
	 $emailsGestionnaires=[];
	 $gestionnaires=[];
 
	 while ($row = mysqli_fetch_array($reqInfosGestionnaires)) { 
		 $telephonesGestionnaires[]=$row['telephone'];
		 $emailsGestionnaires[]=$row['email'];
		 $gestionnaires[]=$row['prenom'].' '.$row['nom'];
	 }
	 //  $gestionnaire='Awa DIOP';
	 //  $messageGestionnaire ="Bonjour $gestionnaire,\nUn incident provenant de votre service et porte la reference $numero_incident est declaré.\n\nConnectez-vous pour suivre la prise en charge.\n\nDAGE - MFB";
 
	 
	// Notifications
	// include ('notification_signalement.php');
	

	?>

	<div id="success">
		<div class="icon icon--order-success svg">
			<svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
			<g fill="none" stroke="#8EC343" stroke-width="2">
				<circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
				<path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
			</g>
			</svg>
		</div>
		<h4><span>Signalement envoyé !</span>Merci pour votre temps</h4>
		<small>Vous serez redirigé dans 5 secondes.</small>
	</div>
	<?php 
} ?>

<?php
if (isset($_POST['declarerIncident'])) {
	
	include ('../config/app.php');

	// 1/5 localisation
	$code_incident=$_POST['code_incident'];

	// echo $code_incident;die;
	$code_service=$_POST['code_service'];
	$code_batiment=$_POST['code_batiment'];
	$code_etage=$_POST['code_etage'];
	$code_piece=$_POST['code_piece'];
	$numero_piece=$_POST['numero_piece'];
	$auteur=$_POST['auteur'];
	$telephone=$_POST['telephone'];
	$email=$_POST['email'];
	 // Description
	$desc=$_POST['description'];
	$description = str_replace("'", "''",$desc);
	$telephoneDeclarant='+221'.$telephone;


	// Categories
	//  $categories=[];
	//  for ($i=0;$i<count($_POST['question_1']);$i++) {
	// 	$categories[]=$_POST['question_1'][$i];
	//  }

	 // recuperation des codes incidents
	//  $codes_incident=[];
	//  for ($i=0;$i<count($categories);$i++) {
	// 	$type=$categories[$i];

	// 	$recupCode = $con->query("SELECT * FROM type_incidents WHERE type_incident='$type'");

	// 	 while ($row = mysqli_fetch_array($recupCode)) { 
    //     	$codes_incident[]=$row['code_incident'];
	// 	}

	//  }
	 
	 	 // Reference incident
		//   $numero_incident='44DC432';

		$getLastRef = mysqli_query($con, "SELECT max(numero_incident) as lastRef FROM signalements");
		while ($row = mysqli_fetch_array($getLastRef)) { 
			$lastRef=$row['lastRef'];
			}
		
			if (!empty($lastRef)) {
				$numero_incident=$lastRef+1;
			}
			else {
				$numero_incident=20221;
			}
			
		// Detection de la prioritaire
		// Get priorite incident
		$priorite_type_incident=0;
		$priorite_type_localisation=0;
		$priorite_incident==0;

		$get_type_incident = mysqli_query($con, "SELECT * FROM `type_incidents` WHERE code_incident='$code_incident'");
		
		while ($row = mysqli_fetch_array($get_type_incident)) { 
			$type_incident=$row['type_incident'];
		}

		$get_priorite_incident = mysqli_query($con, "SELECT * FROM `priorite_type_incident` WHERE type_incident='$code_incident'");
		while ($row = mysqli_fetch_array($get_priorite_incident)) { 
			$priorite_type_incident=$row['priorite_incident'];
		}

		$get_priorite_localisation = mysqli_query($con, "SELECT * FROM `priorite_localisation` WHERE localisation='$code_piece'");
		while ($row = mysqli_fetch_array($get_priorite_localisation)) { 
			$priorite_type_localisation=$row['priorite_localisation'];
		}

		if ($priorite_type_localisation<=$priorite_type_incident) 
		{
			$priorite_incident=$priorite_type_localisation;
		}
		else
		{
			$priorite_incident=$priorite_type_incident;
		}

		// echo $priorite_incident;die;

		switch ($priorite_incident) {
			case 0 : $priorite='Haute';break;
			case 1 : $priorite= 'Moyenne';break;
			case 2 : $priorite= 'Basse';break;
		}

		// echo 'Code incident : '.$code_incident.'</br>';
		// echo 'Code service : '.$code_service.'</br>';
		// echo 'Code batiment : '.$code_batiment.'</br>';
		// echo 'Code etage : '.$code_etage.'</br>';
		// echo 'code Piece : '.$code_piece.'</br>';
		// echo 'Numero Piece : '.$numero_piece.'</br>';
		// echo 'numero incident: '.$numero_incident.'</br>';
		// echo 'Description : '.$description.'</br>';
		// echo 'Auteur : '.$auteur.'</br>';
		// echo 'Telephone : '.$telephone.'</br>';
		// echo 'Email : '.$email.'</br>';

		// echo 'Type Incident : '.$priorite_type_incident.'</br>';
		// echo 'Localisation : '.$priorite_type_localisation.'</br>';
		// echo 'Priorite Incident : '.$priorite_incident.'</br>';
		
		// die;
	
	 //Photo...

	 $rep = $numero_incident;

	 $repertoire="Signalements/".$rep."/";
	 if (is_dir($repertoire)) 
	 {
		 $m = "Signalements/".$rep."/".$_FILES['fileupload']['name'];
		 move_uploaded_file ($_FILES['fileupload']['tmp_name'], $m);
		 $photo = $_FILES['fileupload']['name'];  
	 }
	 else
	 {
		 mkdir("Signalements/".$rep);
		 $m = "Signalements/".$rep."/".$_FILES['fileupload']['name'];
		 move_uploaded_file ($_FILES['fileupload']['tmp_name'], $m);
		 $photo = $_FILES['fileupload']['name'];
	 }


	 if (!empty($photo)) {
		$link="Signalements/".$rep."/".$photo;
	}
	 else {
		$link='Signalements/no_image.png';
	}
	
	//  echo $link.'</br>';

	//  // Identification
	//  $prenom=$_POST['firstname'];
	//  $nom=$_POST['lastname'];
	//  $contact=$_POST['contact'];


	//  $type_intervention='Informatique';
	//  $description='Les climatisations de l\'étage 2 ne fonctionnent plus';
	//  $service='DTAI';
	//  $code_service='43100000';

	 // recup Infos services 

	 $reqInfosService = $con->query("SELECT * FROM `services` WHERE code_service='$code_service'");
	 
	 while ($row = mysqli_fetch_array($reqInfosService)) { 
		$service=$row['libelle'];
		// $emailDage=$row['email']; 
	}

	// Localisation Batiment
	$reqBatiment = $con->query("SELECT * FROM `batiments` WHERE code_batiment='$code_batiment'");
	 while ($row = mysqli_fetch_array($reqBatiment)) { 
		$batiment=$row['nom_batiment'];
		$adresse=$row['adresse'];
		$contact=$row['contact'];
	}
	// Localisation Etage
	$reqEtage = $con->query("SELECT * FROM `etages` WHERE code_etage='$code_etage'");
	 while ($row = mysqli_fetch_array($reqEtage)) { 
		$etage=$row['nom_etage'];
	}
	// Localisation Piece
	$reqPiece = $con->query("SELECT * FROM `pieces` WHERE code_piece='$code_piece'");
	 while ($row = mysqli_fetch_array($reqPiece)) { 
		$piece=$row['nom_piece'];
	}

	// Localisation Piece
	$reqService = $con->query("SELECT * FROM `services` WHERE code_service='$code_service'");
	while ($row = mysqli_fetch_array($reqService)) { 
	$service=$row['sigle'];
	}

	if ($code_piece==907) { $piece=$numero_piece; }

	$localisation=$batiment.' - '.$etage.' - '.$piece;
	
	// echo 'Numero Piece : '.$numero_piece.'</br>';
	// echo 'Code incident : '.$code_incident.'</br>';
	// echo 'Code service : '.$code_service.' -- Service :'.$service.'</br>';
	// echo 'Code batiment : '.$code_batiment.' -- Batiment :'.$batiment.'</br>';
	// echo 'Code etage : '.$code_etage.' -- Etage :'.$etage.'</br>';
	// echo 'code Piece : '.$code_piece.' -- Piece :'.$piece.'</br>';
	// echo 'numero incident: '.$numero_incident.'</br>';
	// echo 'Description : '.$description.'</br>';
	// echo 'Auteur : '.$auteur.'</br>';
	// echo 'Telephone : '.$telephone.'</br>';
	// echo 'Email : '.$email.'</br>';

	// echo 'Priorite Type Incident : '.$priorite_type_incident.'</br>';
	// echo 'Priorite Localisation : '.$priorite_type_localisation.'</br>';
	// echo 'Code Priorite Incident : '.$priorite_incident.'</br></br>';
	// echo 'Priorite Incident : '.$priorite.'</br></br>';
	// echo 'Localisation : '.$localisation.'</br>';

	
	// die;
	// Numero Piece :
	// Code incident : 208
	// Code service : 43000000 -- Service :CABINET MFB
	// Code batiment : 102 -- Batiment :Immeuble CCAP
	// Code etage : 242 -- Etage :6ème étage
	// code Piece : 906 -- Piece :Bureau DC
	// numero incident: 20290
	// Description : rfehehfefe
	// Auteur : Amet Fakk
	// Telephone : 666666666
	// Email :
	// Priorite Type Incident : 3
	// Priorite Localisation : 1
	// Code Priorite Incident : 1	
	// Priorite Incident : Moyenne
	// Localisation : Immeuble CCAP - 6ème étage - Bureau DC
	
	// PERSISTE...
	 // Table signalements
	$sql = $con->query("INSERT INTO `signalements` (`numero_incident`, `date_reception`, `auteur`, `telephone`, `email`, `code_incident` , `code_priorite`, `code_service`, `code_batiment`, `code_etage`, `piece`, `description`, `photo`, `statut`) 
	VALUES ('$numero_incident', '$date_saisie', '$auteur', '$telephone', '$email', '$code_incident', '$priorite_incident', '$code_service', '$code_batiment', '$code_etage', '$code_piece', '$description', '$link', 'en attente')");

	 // Infos Responsables DAGE
	//  $telephonesResponsables=[];
	//  $emailsResponsables=[];
	//  $responsables=[];

	// // Responsables de domaines  
	// $reqInfosResponsablesDage = $con->query("SELECT * FROM responsables_incidents INNER JOIN responsables_dage on responsables_dage.matricule=responsables_incidents.matricule_responsable where responsables_incidents.code_incident='$code_incident'");
	// while ($row = mysqli_fetch_array($reqInfosResponsablesDage)) { 
	// 	$telephonesResponsables[]=$row['telephone'];
	// 	$emailsResponsables[]=$row['email']; 
	// 	$responsables[]=$row['prenom'].' '.$row['nom'];
	// }
	// 	//  }

	//  $reqInfosGestionnaires = $con->query("SELECT * FROM `gestionnaires` INNER JOIN gestionnaires_services on gestionnaires_services.matricule_gestionnaire=gestionnaires.matricule_gestionnaire WHERE gestionnaires_services.code_service='$code_service'");
	 
	//  $telephonesGestionnaires=[];
	//  $emailsGestionnaires=[];
	//  $gestionnaires=[];
 
	//  while ($row = mysqli_fetch_array($reqInfosGestionnaires)) { 
	// 	 $telephonesGestionnaires[]=$row['telephone'];
	// 	 $emailsGestionnaires[]=$row['email'];
	// 	 $gestionnaires[]=$row['prenom'].' '.$row['nom'];
	//  }

	// Notifications
	// include ('notification_signalement.php');
	
	// Notifications des administrateurs DAGE... 
	// echo $priorite;die;
	switch ($priorite) 
	{
		case 'Haute' : 
			include('mail_sms_dage_resp_gestionnaire_urgent.php');
			break;
		default :
			include('mail_sms_dage_resp_gestionnaire.php');
			break;
	}

	include('sms_declarant.php');


	// Notifications des responsables DAGE... 
	// include('mail_sms_responsable_dage.php');

	// Notifications des gestionnaires... 
	// include('mail_sms_gestionnaire.php');

	?>

	<div id="success">
		<div class="icon icon--order-success svg">
			<svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
			<g fill="none" stroke="#8EC343" stroke-width="2">
				<circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
				<path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
			</g>
			</svg>
		</div>
		<h4><span>Déclaration d'incident envoyée à la DAGE!</span></h4>
		<small>Vous serez redirigé dans 5 secondes.</small>
	</div>
	<?php 
} ?>

</body>
</html>