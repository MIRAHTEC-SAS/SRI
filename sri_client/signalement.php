<?php 
include ('config/app.php');

$qrCodeDetected=0;
if(isset($_GET['token']) && isset($_GET['priorite'])) {
	$token=$_GET['token'];
	$priorite=$token=$_GET['priorite'];
	$code_service=$_GET['code_service'];
	$code_batiment=$_GET['code_batiment'];
	$code_etage=$_GET['code_etage'];
	
	$qrCodeDetected=1;

	// Get codes

	// Get infos resume
	$getCodes= mysqli_query($con, "SELECT * FROM `detection_qrcode` WHERE token_qrcode='$token'");

	while ($row = mysqli_fetch_array($getCodes)) {
		$code_service=$row['code_service'];
		$code_batiment=$row['code_batiment'];
		$code_etage=$row['code_etage'];
	}

	// echo $token.'</br>';
    // echo $code_service.'</br>';
    // echo $code_batiment.'</br>';
    // echo $code_etage.'</br>';die;

	// Get infos resume
	$getInfosService= mysqli_query($con, "SELECT * FROM `services` WHERE code_service='$code_service'");

	while ($row = mysqli_fetch_array($getInfosService)) {
	$nom_service=$row['libelle'];
	$sigle_service=$row['sigle'];
	}
	// Infos batiments
	$getInfosBatiment= mysqli_query($con, "SELECT * FROM `batiments` WHERE code_batiment='$code_batiment'");

	while ($row = mysqli_fetch_array($getInfosBatiment)) {
	$nom_batiment=$row['nom_batiment'];
	$adresse_batiment=$row['adresse'];
	}

	// Infos Etages
	$getInfosEtage= mysqli_query($con, "SELECT * FROM `etages` WHERE code_batiment='$code_batiment' AND code_etage='$code_etage'");

	while ($row = mysqli_fetch_array($getInfosEtage)) {
	$nom_etage=$row['nom_etage'];
	}

}
// else {
// 	$qrCodeDetected=0;
// }



include ('config/app.php');

$getDomaines = mysqli_query($con, "SELECT * FROM type_incidents");
// 	$code_incident=$row['code_incident']; 
// 	$type_incident=$row['type_incident']; 

// 	echo $code_incident.'</br>';
// 	echo $type_incident.'</br>';


// }die;

// echo $qrCodeDetected;die;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Systeme de remonte des incidents, DAGE, DTAI">
    <meta name="author" content="SEDIF">
    <title>DAGE | Signalement 2222</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/menu.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="css/vendors.css" rel="stylesheet">
	<!-- <link href="css/timeline.css" rel="stylesheet"> -->


    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">
	
	<!-- MODERNIZR MENU -->
	<script src="js/modernizr.js"></script>

</head>
<!-- style="background-color:#028540;" -->
<body style="background-color:#E7E7E9">	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->
	
	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->
	
	<!-- <nav>
		<ul class="cd-primary-nav"> -->
			<!-- <li><a href="index.html" class="animated_link">Home</a></li>
			<li><a href="quotation-wizard-version.html" class="animated_link">Quote Version</a></li>
			<li><a href="review-wizard-version.html" class="animated_link">Review Version</a></li>
			<li><a href="registration-wizard-version.html" class="animated_link">Registration Version</a></li>
			<li><a href="about.html" class="animated_link">About Us</a></li> -->
			<!-- <li><a href="#" class="animated_link">Nous contacter</a></li> -->
		<!-- </ul>
	</nav> -->
	<!-- /menu -->
	
	<div class="container-fluid full-height">
	
		<!-- /row-->
		<!-- Partie declaration... -->

		<div class="row" id="start">
			<?php 
			if ($qrCodeDetected==0) 
			{
				include ('form_without_qrc2.php'); 
			}
			else 
			{
				include ('form_with_qrc2.php'); 
			} 
			?>
		</div>

		<!-- <div class="row text-center">
			<div class="copy" style="color:#413F42">© 2022 DTAI / MFB</div>

		</div>
	</div> -->
	<!-- /container-fluid -->

	<div class="cd-overlay-nav">
		<span></span>
	</div>
	<!-- /cd-overlay-nav -->

	<div class="cd-overlay-content">
		<span></span>
	</div>
	<!-- /cd-overlay-content -->

	<!-- <a href="#0" class="cd-nav-trigger">Menu<span class="cd-icon"></span></a> -->
	<!-- /menu button -->
	
	<!-- Modal terms -->
	<div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="termsLabel">Termes et conditions</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-bs-dismiss="modal">Fermer</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	<!-- Vue & Axios -->
	<?php include ('lib.php'); ?>

	<!--  VUE JS -->
	<?php include ('vuejs/scriptSignalement.php'); ?>

	<!-- COMMON SCRIPTS -->
	<script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/common_scripts.min.js"></script>
	<script src="js/velocity.min.js"></script>
	<script src="js/functions.js"></script>
	<script src="js/file-validator.js"></script>

	<!-- Wizard script -->
	<script src="js/quotation_func.js"></script>
</div>
</body>
</html>