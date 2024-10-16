<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Systeme de remonte des incidents, DAGE, DTAI">
    <meta name="author" content="SEDIF">
    <title>DAGE | Signalement </title>

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
					<a href="index.html" id="logo"><img src="img/logo.png" alt="" width="300" height="80"></a>
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
						<h2 style="color:black;text-align:center">Bienvenue sur la plateforme de signalement des incidents de la DAGE du ministere des finances et du budget </h2>
						<p style="color:#413F42; text-align:justify;font-size:16px;">Un disfonctionnement dans vos locaux ou un evenement inattendu ?</br> Vous êtes au bon endroit pour demander une intervention.</br></br>Merci de prendre une à 3 photos et remplir le formulaire ci-dessous pour remonter l'incident en quelques clics. </p>
						<!-- <a href="#0" class="btn_1 rounded">Purchase this template</a> -->
						<a href="#start" class="btn_1 rounded mobile_btn">Commencer maintenant !</a>
					</div>
					<div class="copy" style="color:#413F42">© 2022 Ministere des finances et du budget - DTAI - DAGE</div>
				</div>
				<!-- /content-left-wrapper -->
			</div>
			<!-- /content-left -->

			<div class="col-lg-6 content-right" id="start">
				<div id="wizard_container">
					<div id="top-wizard">
							<div id="progressbar"></div>
						</div>
						<!-- /top-wizard -->
						<!-- action="controllers/signalementController.php" -->
						<form method="POST" action="notifications/signalementController" enctype="multipart/form-data">
							<input id="website" name="website" type="text" value="">
							<!-- Leave for security protection, read docs for details -->
							<div id="middle-wizard">
								<div class="step">
									<h3 class="main_question"><strong>1/4</strong>Dans quelle categorie classeriez-vous l'incident ?</h3>
									<div class="form-group">
										<label class="container_check version_2">Electricite
											<input type="checkbox" name="question_1[]" value="Electricite" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_check version_2">Plomberie
											<input type="checkbox" name="question_1[]" value="Plomberie" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_check version_2">Ascenseur
											<input type="checkbox" name="question_1[]" value="Seo optimization" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_check version_2">Mobilier
											<input type="checkbox" name="question_1[]" value="CMS integrations (Wordpress)" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_check version_2">Climatisation
											<input type="checkbox" name="question_1[]" value="Newsletter Campaign" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_check version_2">Autre
											<input type="checkbox" name="question_1[]" value="Logo Design" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>
								</div>
								<!-- /step-->
								<div class="step">
									<h3 class="main_question"><strong>2/4</strong>Decrivez l'incident</h3>
									<div class="form-group add_top_30">
										<!-- <label>Additional information</label> -->
										<textarea name="additional_message" class="form-control required" style="height:150px;" placeholder="Decrire ici brievement l'incident..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
									<div class="form-group add_top_30">
										<label>Joindre une photo<br><small>(Fichiers acceptés: gif, jpg, jpeg, .png, .pdf - Taille Maximum: 50ko.)</small></label>
										<div class="fileupload">
											<input type="file" name="fileupload" accept="image/*,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" onchange="getVals(this, 'fileupload');">
										</div>
									</div>
								</div>
								<!-- /step-->
								<div class="step">
									<h3 class="main_question"><strong>3/4</strong>Identification</h3>
									<div class="form-group">
										<input type="text" name="firstname" class="form-control required" placeholder="Prenom" onkeyup="getVals(this, 'firstname');">
									</div>
									<div class="form-group">
										<input type="text" name="lastname" class="form-control required" placeholder="Nom">
									</div>
									<!-- <div class="form-group">
										<input type="email" name="email" class="form-control required" placeholder="Your Email">
									</div> -->
									<div class="form-group">
										<input type="text" name="contact" class="form-control" placeholder="Email, Matricule ou Telephone">
									</div>
									<div class="form-group terms">
										<label class="container_check">Merci de lire les <a href="#" data-bs-toggle="modal" data-bs-target="#terms-txt">Termes et conditions</a>
											<input type="checkbox" name="terms" value="Yes" class="required">
											<span class="checkmark"></span>
										</label>
									</div>
								</div>
								<!-- /step-->
								<div class="submit step">
									<h3 class="main_question"><strong>4/4</strong>Revoir le resumé avant de soumettre le formulaire</h3>
									<div class="summary">
										<ul>
											<li><strong>1</strong>
												<h5>Categorie de l'incident</h5>
												<p id="question_1"></p>
											</li>
											<li><strong>2</strong>
												<h5>Description</h5>
												<p id="additional_message"></p>
												<p><label>Fichier chargé</label>: <span id="fileupload"></span></p>
											</li>
											<!-- <li><strong>3</strong>
												<h5>Declarant</h5>
												<p id="firstname"></p>
											</li> -->
										</ul>
									</div>
								</div>
								<!-- /step-->
							</div>
							<!-- /middle-wizard -->
							<div id="bottom-wizard">
								<button type="button" name="backward" class="backward">Precedent</button>
								<button type="button" name="forward" class="forward">Suivant</button>
								<button type="submit" name="process" class="submit">Envoyer</button>
							</div>
							<!-- /bottom-wizard -->
						</form>
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
	
	<!-- COMMON SCRIPTS -->
	<script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/common_scripts.min.js"></script>
	<script src="js/velocity.min.js"></script>
	<script src="js/functions.js"></script>
	<script src="js/file-validator.js"></script>

	<!-- Wizard script -->
	<script src="js/quotation_func.js"></script>

</body>
</html>