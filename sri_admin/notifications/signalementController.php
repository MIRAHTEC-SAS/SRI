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
        window.location = "../signalement"
    }
    </script>

</head>
<body onLoad="setTimeout('delayedRedirect()', 8000)" style="background-color:#fff;">

<!-- END SEND MAIL SCRIPT -->   

<?php
if (isset($_POST['process'])) {
	
	include ('../config/app.php');

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
	 $description=$_POST['additional_message'];
	 
	
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
 
	 $link="Signalements/".$rep."/".$photo;

	//  echo $link.'</br>';

	 // Identification
	 $prenom=$_POST['firstname'];
	 $nom=$_POST['lastname'];
	 $contact=$_POST['contact'];

	 // Infos gen Signalement
	 $numero_incident='44DC432';
	 $type_intervention='Informatique';
	//  $description='Les climatisations de l\'étage 2 ne fonctionnent plus';
	 $service='DTAI';
	 $code_service='43100000';

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
	for ($i=0;$i<count($codes_incident);$i++) {

		$code_incident=$codes_incident[$i];

		$sql = $con->query("INSERT INTO `signalements_incidents` (`numero_incident`, `code_incident`) 
		VALUES ('$numero_incident', '$code_incident');");
	 }
	
	 // Table signalements
	$sql = $con->query("INSERT INTO `signalements` (`numero_incident`, `date_reception`, `prenom`, `nom`, `code_service`, `description`, `photo`) 
	VALUES ('$numero_incident', '$date_saisie', '$prenom', '$nom', '$code_service', '$description', '$link')");

	 // Recup Infos

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
		for ($i=0;$i<count($codes_incident);$i++) {
			$code_incident=$codes_incident[$i];
			//  $codeIncident=$row['code_incident'];
 
		 	$reqInfosResponsablesDage = $con->query("SELECT * FROM responsables_incidents INNER JOIN responsables_dage on responsables_dage.matricule=responsables_incidents.matricule_responsable where responsables_incidents.code_incident='$code_incident'");
 
			 while ($row = mysqli_fetch_array($reqInfosResponsablesDage)) { 
				 $telephonesResponsables[]=$row['telephone'];
				 $emailsResponsables[]=$row['email']; 
				 $responsables[]=$row['prenom'].' '.$row['nom'];
			 }
	 }

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
	include ('notification_signalement.php');
	

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
	<h4><span>Signalement reçu !</span>Merci pour votre temps</h4>
	<small>Vous serez redirigé dans 5 secondes.</small>
</div>
<?php } ?>
</body>
</html>