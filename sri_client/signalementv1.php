<?php 
$qrCodeDetected=0;
if(isset($_GET['code_service'])) {
	$code_service=$_GET['code_service'];
	$code_batiment=101;
	$code_etage=205;
	$qrCodeDetected=1;
}
else {
	$qrCodeDetected=0;
}



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
    <title>DAGE | Signalement</title>

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

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">
	
	<!-- MODERNIZR MENU -->
	<script src="js/modernizr.js"></script>

</head>

<body>

	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->
	
	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->
	
	<nav>
		<ul class="cd-primary-nav">
			<!-- <li><a href="index.html" class="animated_link">Home</a></li>
			<li><a href="quotation-wizard-version.html" class="animated_link">Quote Version</a></li>
			<li><a href="review-wizard-version.html" class="animated_link">Review Version</a></li>
			<li><a href="registration-wizard-version.html" class="animated_link">Registration Version</a></li>
			<li><a href="about.html" class="animated_link">About Us</a></li> -->
			<li><a href="#" class="animated_link">Nous contacter</a></li>
		</ul>
	</nav>
	<!-- /menu -->
	
	<div class="container-fluid full-height">
		<div class="row row-height">
			<div class="col-lg-6 content-left">
				<div class="content-left-wrapper">
					
					<a href="#" id="logo"><img src="img/logo.png" alt="" width="300" height="80"></a>
					<!-- <div id="social">
						<ul>
							<li><a href="#0"><i class="icon-facebook"></i></a></li>
							<li><a href="#0"><i class="icon-twitter"></i></a></li>
							<li><a href="#0"><i class="icon-google"></i></a></li>
							<li><a href="#0"><i class="icon-linkedin"></i></a></li>
						</ul>
					</div> -->
					<!-- /social -->
					<div>
						<figure><img src="img/illustration_signalement.png" alt="" class="img-fluid"></figure>
						<h2 style="color:black;text-align:center">Bienvenue sur la plateforme de signalement des incidents ou de demandes d'intervention à la DAGE.</h2>
						<p style="color:#413F42; text-align:justify;font-size:16px;">Un disfonctionnement dans vos locaux ou un evenement inattendu ?</br> Vous êtes au bon endroit pour demander une intervention.</br></br>Merci de remplir le formulaire ci-dessous pour remonter l'incident en quelques clics. </p>
						<!-- <a href="#0" class="btn_1 rounded">Purchase this template</a> -->
						<a href="#start" class="btn_1 rounded mobile_btn">Commencer maintenant !</a>
					</div>
					<div class="copy" style="color:#413F42">© 2022 DTAI / MFB</div>
				</div>
				<!-- /content-left-wrapper -->
			</div>
			<!-- /content-left -->

			<div class="col-lg-6 content-right" id="start">
				<div id="wizard_container">
					<div id="top-wizard">
							<div id="progressbar">
					</div>
						</div>
						<!-- /top-wizard -->
						<!-- action="controllers/signalementController.php" -->
						<!-- <?php //include ('form_with_qrc.php'); ?> -->

						<?php 
							if ($qrCodeDetected==1) 
							{
								include ('form_with_qrc.php'); 
							}
							else
							{
								include ('form_without_qrc.php'); 
							}
						?>

					</div>
					<!-- /Wizard container -->
			</div>
			<!-- /content-right-->
		</div>
		<!-- /row-->
	</div>
	<!-- /container-fluid -->

	<div class="cd-overlay-nav">
		<span></span>
	</div>
	<!-- /cd-overlay-nav -->

	<div class="cd-overlay-content">
		<span></span>
	</div>
	<!-- /cd-overlay-content -->

	<a href="#0" class="cd-nav-trigger">Menu<span class="cd-icon"></span></a>
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
	<?php include ('../lib.php'); ?>

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