<?php
session_start();
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable' || $_SESSION['role'] == 'Gestionnaire') {
	$showEdit = 0;
	$showAffect = 0;
	$showRejet = 0;
	$emailUser = $_SESSION['email'];
	$roleUser = $_SESSION['role'];
?>
	<?php
	include('config/app.php');

	switch ($_SESSION['role']) {
		case "Responsable":
			$getMatriculeRes = mysqli_query($con, "SELECT matricule FROM responsables_dage WHERE email='$emailUser'");

			while ($row = mysqli_fetch_array($getMatriculeRes)) {
				$matricule = $row['matricule'];
			}
			break;
		case "Gestionnaire":
			$getMatriculeGes = mysqli_query($con, "SELECT matricule_gestionnaire FROM gestionnaires WHERE email='$emailUser'");

			while ($row = mysqli_fetch_array($getMatriculeGes)) {
				$matricule = $row['matricule_gestionnaire'];
			}
			break;
	}

	if (isset($_GET['numero_incident'])) {
		$numero_incident = $_GET['numero_incident'];

		$getLocIncidents = mysqli_query($con, "SELECT batiments.code_batiment, batiments.nom_batiment, batiments.adresse, etages.nom_etage FROM `signalements` INNER JOIN batiments ON batiments.code_batiment = signalements.code_batiment 
	INNER JOIN etages ON etages.code_batiment=batiments.code_batiment AND etages.code_etage=signalements.code_etage
	WHERE numero_incident='$numero_incident'");

		while ($row = mysqli_fetch_array($getLocIncidents)) {
			$batiment = $row['nom_batiment'];
			$etage = $row['nom_etage'];
			// $piece=$row['nom_piece'];
			$adresse = $row['adresse'];
		}


		$getIncidents = mysqli_query($con, "SELECT 
			signalements.date_reception,
			signalements.numero_incident,
			signalements.code_incident,
			signalements.auteur,
			signalements.statut,
			signalements.telephone,
			signalements.email,
			signalements.photo,
			signalements.description,
			services.sigle,
			services.libelle,
			services.code_service,
			type_incidents.type_incident,
			type_incidents.couleur as couleur_type,
			code_priorite.priorite,
			code_priorite.couleur_priorite
			FROM `signalements` INNER JOIN services on services.code_service=signalements.code_service INNER JOIN type_incidents ON type_incidents.code_incident=signalements.code_incident INNER JOIN code_priorite ON code_priorite.code=signalements.code_priorite where signalements.numero_incident='$numero_incident'");

		while ($row = mysqli_fetch_array($getIncidents)) {
			$service = $row['libelle'];
			$code_service = $row['code_service'];
			$sigle = $row['sigle'];
			$description = $row['description'];
			$auteur = $row['auteur'];
			$priorite = $row['priorite'];
			$code_incident = $row['code_incident'];
			$categorie = $row['type_incident'];
			$couleur = $row['couleur_type'];
			$telephone = $row['telephone'];
			$email = $row['email'];
			$couleur_priorite = $row['couleur_priorite'];
			$date_reception = date('d / m / Y', strtotime($row['date_reception']));
			$heure_reception = date('H:i', strtotime($row['date_reception']));
			$image = $row['photo'];
			$statut = $row['statut'];
			// $contact=$row['contact'];
			// date("Y-m-d H:i:s");
		}
		// var_dump($code_service);
		// die();

		// GET gestionnaire...
		$getGestionnaire = mysqli_query($con, "SELECT * FROM `gestionnaires_services` INNER JOIN gestionnaires ON gestionnaires.matricule_gestionnaire=gestionnaires_services.matricule_gestionnaire WHERE gestionnaires_services.code_service='$code_service'");

		while ($row = mysqli_fetch_array($getGestionnaire)) {
			$gestionnaire_service = $row['prenom'] . ' ' . $row['nom'];
			$telephone_gestionnaire = $row['telephone'];
		}

		// Incident en cours
		$getIncidentsEnCours = mysqli_query($con, "SELECT 
			signalements.date_reception,
			signalements.numero_incident,
			signalements.code_incident,
			signalements.auteur,
			signalements.statut,
			signalements.description,
			services.sigle,
			type_incidents.type_incident,
			type_incidents.couleur as couleur_type,
			code_priorite.priorite,
			code_priorite.couleur_priorite,
			interventions.date_intervention,
			interventions.date_saisie as date_affectation,
			interventions.intervenant,
			interventions.date_intervention,
			interventions.type_intervenant
			
			FROM `signalements` 
			INNER JOIN services on services.code_service=signalements.code_service
			INNER JOIN type_incidents ON type_incidents.code_incident=signalements.code_incident 
			INNER JOIN code_priorite ON code_priorite.code=signalements.code_priorite 
			INNER JOIN interventions ON interventions.numero_incident=signalements.numero_incident
			where signalements.numero_incident='$numero_incident'");

		while ($row = mysqli_fetch_array($getIncidentsEnCours)) {

			$date_affectation = date('d / m / Y', strtotime($row['date_affectation']));
			$heure_affectation = date('H:i', strtotime($row['date_affectation']));
			$date_intervention = date('d / m / Y', strtotime($row['date_intervention']));
			$heure_intervention = date('H:i', strtotime($row['date_intervention']));
			// $contact=$row['contact'];
			// date("Y-m-d H:i:s");
		}

		// Categorie de l'incident
		// $getCategorieIncident=mysqli_query($con, "SELECT DISTINCT signalements_incidents.numero_incident, type_incidents.code_incident, type_incidents.type_incident FROM `signalements_incidents` INNER JOIN type_incidents ON type_incidents.code_incident=signalements_incidents.code_incident WHERE signalements_incidents.numero_incident='$numero_incident'");
		// while ($row = mysqli_fetch_array($getCategorieIncident)) { 
		//     $categorie = $row['type_incident'];
		// }

		// // get couleur
		// $getCouleur = mysqli_query($con, "SELECT * FROM signalements_incidents INNER JOIN type_incidents on type_incidents.code_incident=signalements_incidents.code_incident where signalements_incidents.numero_incident='$numero_incident'");
		//     while ($row = mysqli_fetch_array($getCouleur)) { 
		// 		$couleur=$row['couleur'];
		// 	}

		// echo $couleur;die;


	}

	//Edition...
	if (isset($_GET['numero_incident']) && isset($_GET['edit'])) {

		$numero_incident = $_GET['numero_incident'];
		$showEdit = 1;

		$getIncidents = mysqli_query($con, "SELECT 
			signalements.date_reception,
			signalements.numero_incident,
			signalements.code_incident,
			signalements.auteur,
			signalements.statut,
			signalements.telephone,
			signalements.email,
			signalements.photo,
			signalements.description,
			services.sigle,
			services.libelle,
			type_incidents.type_incident,
			type_incidents.couleur as couleur_type,
			code_priorite.priorite,
			code_priorite.code as code_priorite,
			code_priorite.couleur_priorite
	
			FROM `signalements` INNER JOIN services on services.code_service=signalements.code_service INNER JOIN type_incidents ON type_incidents.code_incident=signalements.code_incident INNER JOIN code_priorite ON code_priorite.code=signalements.code_priorite where signalements.numero_incident='$numero_incident'");

		while ($row = mysqli_fetch_array($getIncidents)) {
			$service = $row['libelle'];
			$sigle = $row['sigle'];
			$descriptionEdit = $row['description'];
			$auteur = $row['auteur'];
			$priorite = $row['priorite'];
			$code_priorite = $row['code_priorite'];
			$code_incident = $row['code_incident'];
			$categorie = $row['type_incident'];
			$couleur = $row['couleur_type'];
			$telephone = $row['telephone'];
			$email = $row['email'];
			$couleur_priorite = $row['couleur_priorite'];
			$date_reception = date('d / m / Y', strtotime($row['date_reception']));
			$heure_reception = date('H:i', strtotime($row['date_reception']));
			$image = $row['photo'];
			// $contact=$row['contact'];
			// date("Y-m-d H:i:s");
		}

		// Categorie de l'incident
		$getCategorieIncident = mysqli_query($con, "SELECT DISTINCT signalements_incidents.numero_incident, type_incidents.code_incident, type_incidents.type_incident FROM `signalements_incidents` INNER JOIN type_incidents ON type_incidents.code_incident=signalements_incidents.code_incident WHERE signalements_incidents.numero_incident='$numero_incident'");
		while ($row = mysqli_fetch_array($getCategorieIncident)) {
			$categorie = $row['type_incident'];
			$code_incident = $row['code_incident'];
		}
	}
	//Fin edition...

	// Affectation
	if (isset($_GET['numero_incident']) && isset($_GET['affect'])) {

		$numero_incident = $_GET['numero_incident'];
		$showAffect = 1;

		$getIncidents = mysqli_query($con, "SELECT 
			signalements.date_reception,
			signalements.numero_incident,
			signalements.code_incident,
			signalements.auteur,
			signalements.statut,
			signalements.telephone,
			signalements.email,
			signalements.photo,
			signalements.description,
			services.sigle,
			services.code_service,
			services.libelle,
			type_incidents.type_incident,
			type_incidents.couleur as couleur_type,
			code_priorite.priorite,
			code_priorite.code as code_priorite,
			code_priorite.couleur_priorite
			
			FROM `signalements` INNER JOIN services on services.code_service=signalements.code_service INNER JOIN type_incidents ON type_incidents.code_incident=signalements.code_incident INNER JOIN code_priorite ON code_priorite.code=signalements.code_priorite where signalements.numero_incident='$numero_incident'");

		while ($row = mysqli_fetch_array($getIncidents)) {
			$service = $row['libelle'];
			$sigle = $row['sigle'];
			$descriptionEdit = $row['description'];
			$auteur = $row['auteur'];
			$priorite = $row['priorite'];
			$code_service = $row['code_service'];
			$code_priorite = $row['code_priorite'];
			$code_incident = $row['code_incident'];
			$categorie = $row['type_incident'];
			$couleur = $row['couleur_type'];
			$telephone = $row['telephone'];
			$email = $row['email'];
			$couleur_priorite = $row['couleur_priorite'];
			$date_reception = date('d / m / Y', strtotime($row['date_reception']));
			$heure_reception = date('H:i', strtotime($row['date_reception']));
			$image = $row['photo'];
			// $contact=$row['contact'];
			// date("Y-m-d H:i:s");
		}

		// Categorie de l'incident
		$getCategorieIncident = mysqli_query($con, "SELECT DISTINCT signalements_incidents.numero_incident, type_incidents.code_incident, type_incidents.type_incident FROM `signalements_incidents` INNER JOIN type_incidents ON type_incidents.code_incident=signalements_incidents.code_incident WHERE signalements_incidents.numero_incident='$numero_incident'");
		while ($row = mysqli_fetch_array($getCategorieIncident)) {
			$categorie = $row['type_incident'];
			$code_incident = $row['code_incident'];
		}

		// Get intervenants Internes
		$getIntervenantsInterne = mysqli_query($con, "SELECT intervenants_interne_incidents.code_incident, intervenants_interne.matricule_intervenant, intervenants_interne.prenom, intervenants_interne.nom, intervenants_interne.email, intervenants_interne.telephone FROM `intervenants_interne_incidents` INNER JOIN intervenants_interne ON intervenants_interne.matricule_intervenant=intervenants_interne_incidents.matricule_intervenant WHERE intervenants_interne_incidents.code_incident='$code_incident'");
		// while ($row = mysqli_fetch_array($getIntervenantsInterne)) { 
		//     $categorie = $row['type_incident'];
		// }

		// Get Prestataire
		$getPrestataires = mysqli_query($con, "SELECT prestataires_incidents.code_incident, prestataires.matricule_presta, prestataires.denomination, prestataires.adresse, prestataires.telephone, prestataires.email FROM `prestataires_incidents` INNER JOIN prestataires on prestataires.matricule_presta=prestataires_incidents.matricule_prestataire WHERE prestataires_incidents.code_incident='$code_incident'");

		// Get Prestataire
		$getServicesIntervenant = mysqli_query($con, "SELECT services_intervenant_incidents.code_incident, services_intervenant.nom_service, services_intervenant.telephone, services_intervenant.matricule_service, services_intervenant.email FROM `services_intervenant` INNER JOIN services_intervenant_incidents on services_intervenant_incidents.matricule_service=services_intervenant.matricule_service WHERE services_intervenant_incidents.code_incident='$code_incident'");
	}

	// Rejet
	if (isset($_GET['numero_incident']) && isset($_GET['rejet'])) {

		$numero_incident = $_GET['numero_incident'];
		$showRejet = 1;

		$getIncidentsE = mysqli_query($con, "SELECT * FROM `signalements` INNER JOIN services on services.code_service=signalements.code_service where signalements.numero_incident='$numero_incident'");

		while ($row = mysqli_fetch_array($getIncidentsE)) {
			$service = $row['libelle'];
			$descriptionEdit = $row['description'];
			$code_service = $row['code_service'];
			$auteur = $row['auteur'];
			$date_reception = date('d / m / Y', strtotime($row['date_reception']));
			$heure_reception = date('H:i', strtotime($row['date_reception']));
			$image = $row['photo'];
			$contact = $row['telephone'];
			// date("Y-m-d H:i:s");
		}

		// Categorie de l'incident
		$getCategorieIncident = mysqli_query($con, "SELECT DISTINCT signalements_incidents.numero_incident, type_incidents.code_incident, type_incidents.type_incident FROM `signalements_incidents` INNER JOIN type_incidents ON type_incidents.code_incident=signalements_incidents.code_incident WHERE signalements_incidents.numero_incident='$numero_incident'");
		while ($row = mysqli_fetch_array($getCategorieIncident)) {
			$categorie = $row['type_incident'];
			$code_incident = $row['code_incident'];
		}

		// Get intervenants Internes
		$getIntervenantsInterne = mysqli_query($con, "SELECT intervenants_interne_incidents.code_incident, intervenants_interne.matricule_intervenant, intervenants_interne.prenom, intervenants_interne.nom, intervenants_interne.email, intervenants_interne.telephone FROM `intervenants_interne_incidents` INNER JOIN intervenants_interne ON intervenants_interne.matricule_intervenant=intervenants_interne_incidents.matricule_intervenant WHERE intervenants_interne_incidents.code_incident='$code_incident'");
		// while ($row = mysqli_fetch_array($getIntervenantsInterne)) { 
		//     $categorie = $row['type_incident'];
		// }

		// Get Prestataire
		$getPrestataires = mysqli_query($con, "SELECT prestataires_incidents.code_incident, prestataires.matricule_presta, prestataires.denomination, prestataires.adresse, prestataires.telephone, prestataires.email FROM `prestataires_incidents` INNER JOIN prestataires on prestataires.matricule_presta=prestataires_incidents.matricule_prestataire WHERE prestataires_incidents.code_incident='$code_incident'");

		// Get Prestataire
		$getServicesIntervenant = mysqli_query($con, "SELECT services_intervenant_incidents.code_incident, services_intervenant.nom_service, services_intervenant.telephone, services_intervenant.matricule_service, services_intervenant.email FROM `services_intervenant` INNER JOIN services_intervenant_incidents on services_intervenant_incidents.matricule_service=services_intervenant.matricule_service WHERE services_intervenant_incidents.code_incident='$code_incident'");
	}
	//Fin edition...
	$page = 'Incident';
	?>
	<?php include('layouts/head.php'); ?>

	<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

		<div class="wrapper">
			<div id="loader"></div>

			<!-- Header -->
			<?php include('layouts/header.php'); ?>
			<!-- Fin header -->

			<!-- Left side column. contains the logo and sidebar -->
			<?php include('layouts/sidebar.php'); ?>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<div class="container-full">
					<!-- Content Header (Page header) -->
					<div class="content-header">
						<div class="d-flex align-items-center">
							<div class="me-auto">
								<h4 class="page-title">Incidents</h4>
								<div class="d-inline-block align-items-center">
									<nav>
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
											<li class="breadcrumb-item" aria-current="page">Signalements</li>
											<li class="breadcrumb-item active" aria-current="page"><?php echo ucfirst($statut) ?></li>
										</ol>
									</nav>
								</div>
							</div>

						</div>
					</div>

					<!-- Main content -->
					<section class="content">
						<!-- Confirmation box -->
						<?php include('confirmation.php'); ?>

						<!-- edition de l'incident -->
						<?php if ($showEdit == 1) { ?>
							<?php include('edition_incident.php'); ?>
						<?php } ?>
						<!-- Fin de l'edition -->
						<!-- Affectation de l'incident -->
						<?php if ($showAffect == 1) { ?>
							<?php include('affectation_incident.php'); ?>
						<?php } ?>
						<!-- Rejeter l'incident -->
						<?php if ($showRejet == 1) { ?>
							<?php include('rejet_incident.php'); ?>
						<?php } ?>
						<!-- Fin de l'affectation -->


						<div class="row">
							<div class="col-12">
								<div class="box">
									<div class="box-header with-border">
										<h4 class="box-title">Details de l'incident <strong style="color:red"><?php echo $numero_incident; ?></strong></h4>
									</div>
									<div class="box-body" style="background-color:#FBFBFB">
										<?php include('contents/content-details-signalements.php'); ?>
									</div>
									<!-- /.box-body -->
									<!-- <div class="box-footer">
						  Footer
						</div> -->
									<!-- /.box-footer-->
								</div>
							</div>
						</div>
					</section>
					<!-- /.content -->

				</div>
			</div>
			<!-- /.content-wrapper -->

			<!-- FOOTER -->
			<?php include('layouts/footer.php'); ?>
			<!-- FIN FOOTER -->
			<?php include('layouts/rightbar.php'); ?>

			<?php include('layouts/modal_user.php'); ?>

			<!-- Page Content overlay -->


			<!-- Vendor JS -->
			<?php include('layouts/js.php'); ?>
			<!-- <script src="../src/js/pages/chat-popup.js"></script>
			<script src="../../../assets/icons/feather-icons/feather.min.js"></script>
			<script src="../../../assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
			<script src="../../../assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script> -->

	</body>

	</html>
<?php } else {
	header('Location: ../sri_admin');
}  ?>