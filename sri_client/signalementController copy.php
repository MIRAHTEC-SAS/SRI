<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="QUOTE - Request a quote for every type of companies">
	<meta name="author" content="Ansonika">
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
	<link href="css/style.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">
    
	<script type="text/javascript">
    function delayedRedirect(){
        window.location = "signalement"
    }
    </script>

</head>
<body onLoad="setTimeout('delayedRedirect()', 8000)" style="background-color:#fff;">

<!-- END SEND MAIL SCRIPT -->   

<?php
if (isset($_POST['process'])) {
	
	include ('config/app.php');

	 $code_service='43100000';
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

	 if ($photo==NULL) {
		$link='0';
	}

	//  echo $link.'</br>';

	 // Identification
	 $prenom=$_POST['firstname'];
	 $nom=$_POST['lastname'];
	 $contact=$_POST['contact'];


	//  for ($i=0;$i<count($categories);$i++) {
	// 	echo $categories[$i].'</br>';
	//  }
	 
	//  echo$description.'</br>';
	//  echo $prenom.'</br>';
	//  echo $nom.'</br>';
	//  echo $contact.'</br>';

	//  $sql = $con->query("INSERT INTO `test` (`login`) VALUES ('33');");
	 
	//  $reqTest = $con->query("SELECT * FROM test");

    // while ($row = mysqli_fetch_array($reqTest)) { 
    //     $login=$row['login'];
	// }
	// echo $login;

	// Persistence...

	// Les types selectionnés
	for ($i=0;$i<count($codes_incident);$i++) {

		$code_incident=$codes_incident[$i];
		
		// echo $code_incident.' - '.$numero_incident.'</br>';
		// echo $code_incident.'</br>';

		$sql = $con->query("INSERT INTO `signalements_incidents` (`numero_incident`, `code_incident`) 
		VALUES ('$numero_incident', '$code_incident');");
	 }
	
	 // Table signalements
	$sql = $con->query("INSERT INTO `signalements` (`numero_incident`, `date_reception`, `prenom`, `nom`, `code_service`, `description`, `photo`) 
	VALUES ('$numero_incident', '$date_saisie', '$prenom', '$nom', '$code_service', '$description', '$link')");

	// Notifications
	include ('notifications/notification_signalement.php');
	

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