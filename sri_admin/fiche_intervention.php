<?php
session_start();
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable' || $_SESSION['role'] == 'Intervenant' || $_SESSION['role'] == 'Gestionnaire') {
	$showEdit = 0;
	$showAffect = 0;
	$emailUser = $_SESSION['email'];
	$roleUser = $_SESSION['role'];
?>
	<?php
	include('config/app.php');

	if (isset($_GET['code_intervention'])) {
		$code_intervention = $_GET['code_intervention'];
		// echo $code_intervention;die;
		$getInterventions = mysqli_query($con, "SELECT 
	interventions.code_intervention,
	interventions.code_incident,
	interventions.intervenant,
	interventions.numero_incident,
	interventions.date_intervention,
	interventions.date_saisie,
	interventions.statut,
	services.code_service,
	services.libelle,
	services.sigle,
	type_incidents.type_incident,
	interventions.type_intervenant
	FROM `interventions`
	INNER JOIN services ON services.code_service=interventions.service
	INNER JOIN type_incidents ON type_incidents.code_incident=interventions.code_incident WHERE interventions.code_intervention='$code_intervention'");

		while ($row = mysqli_fetch_array($getInterventions)) {
			$intervenant = $row['intervenant'];
			$code_incident = $row['code_incident'];
			$numero_incident = $row['numero_incident'];
			$service = $row['libelle'];
			$code_service = $row['code_service'];
			$statut = $row['statut'];
			$categorie = $row['type_incident'];
			$date_intervention = date('d / m / Y', strtotime($row['date_intervention']));
			$date_affectation = date('d / m / Y', strtotime($row['date_saisie']));
			$heure_affectation = date('H:i', strtotime($row['date_saisie']));
			$code_intervention = $row['code_intervention'];
			$type_intervenant = $row['type_intervenant'];
			$date_annulation = date('d / m / Y', strtotime($row['date_saisie']));
		}
		// GET gestionnaire...
		$getGestionnaire = mysqli_query($con, "SELECT * FROM `gestionnaires_services` INNER JOIN gestionnaires ON gestionnaires.matricule_gestionnaire=gestionnaires_services.matricule_gestionnaire WHERE gestionnaires_services.code_service='$code_service'");

		while ($row = mysqli_fetch_array($getGestionnaire)) {
			$gestionnaire_service = $row['prenom'] . ' ' . $row['nom'];
			$telephone_gestionnaire = $row['telephone'];
		}
		// get couleur
		$getCouleur = mysqli_query($con, "SELECT * FROM signalements_incidents INNER JOIN type_incidents on type_incidents.code_incident=signalements_incidents.code_incident where signalements_incidents.numero_incident='$numero_incident'");
		while ($row = mysqli_fetch_array($getCouleur)) {
			$couleur = $row['couleur'];
		}
		// echo $sigle;die;
		if ($type_intervenant == 'prestataire') {
			$recupPresta = mysqli_query($con, "SELECT * FROM prestataires WHERE matricule_presta='$intervenant'");
			while ($row = mysqli_fetch_array($recupPresta)) {
				$intervenant_incident = $row['denomination'];
			}
		}

		if ($type_intervenant == 'interne') {
			$recupInterne = mysqli_query($con, "SELECT * FROM intervenants_interne WHERE matricule_intervenant='$intervenant'");
			while ($row = mysqli_fetch_array($recupInterne)) {
				$intervenant_incident = $row['prenom'] . ' ' . $row['nom'];
			}
		}

		if ($type_intervenant == 'service') {
			$recupService = mysqli_query($con, "SELECT * FROM services_intervenant WHERE matricule_service='$intervenant'");
			while ($row = mysqli_fetch_array($recupService)) {
				$intervenant_incident = $row['nom_service'];
			}
		}


		// Contacts responsable Dage
		$getContactResponsable = mysqli_query($con, "SELECT * FROM `responsables_incidents` INNER JOIN responsables_dage ON responsables_incidents.matricule_responsable=responsables_incidents.matricule_responsable WHERE responsables_incidents.code_incident='$code_incident'");

		while ($row = mysqli_fetch_array($getContactResponsable)) {
			$matriculeResponsable = $row['matricule_responsable'];
			$responsableDage = $row['prenom'] . ' ' . $row['nom'];
			// $nomResponsable=$row['nom']; 
			$emailResponsable = $row['email'];
			$telephoneResponsable = $row['telephone'];
		}

		// Infos Incident
		$getIncidents = mysqli_query($con, "SELECT * FROM `signalements` INNER JOIN services on services.code_service=signalements.code_service where signalements.numero_incident='$numero_incident'");

		while ($row = mysqli_fetch_array($getIncidents)) {
			$description = $row['description'];
			$auteur = $row['auteur'];
			$telephone = $row['telephone'];
			$date_reception = date('d / m / Y', strtotime($row['date_reception']));
			$heure_reception = date('H:i', strtotime($row['date_reception']));
			$image = $row['photo'];
			$contact = $row['telephone'];
			$code_batiment = $row['code_batiment'];
			$code_etage = $row['code_etage'];
			$code_piece = $row['piece'];
			$statut_incident = $row['piece'];
			$libelle_service = $row['libelle'];
			$sigle_service = $row['sigle'];
			// date("Y-m-d H:i:s");
		}

		// Get localisation 
		$getLoc = mysqli_query($con, "SELECT 
	signalements.numero_incident,
	batiments.nom_batiment,
	batiments.adresse,
	batiments.contact,
	etages.nom_etage,
	types_localisation_c.type
	FROM `signalements` 
	INNER JOIN batiments ON batiments.code_batiment=signalements.code_batiment 
	INNER JOIN etages ON signalements.code_etage=etages.code_etage
	INNER JOIN types_localisation_c ON types_localisation_c.code_localisation=signalements.piece
	WHERE signalements.numero_incident='$numero_incident' AND signalements.code_batiment='$code_batiment' AND signalements.code_etage='$code_etage' AND signalements.piece='$code_piece';");

		while ($row = mysqli_fetch_array($getLoc)) {
			$batiment = $row['nom_batiment'];
			$etage = $row['nom_etage'];
			$piece = $row['type'];
			$adresse = $row['adresse'];
			$contact_immeuble = $row['contact'];
		}

		$getInfosAnn = mysqli_query($con, "SELECT * FROM `commentaires_annulation_intervention` INNER JOIN interventions ON interventions.code_intervention=commentaires_annulation_intervention.code_intervention INNER JOIN responsables_dage ON responsables_dage.email=commentaires_annulation_intervention.matricule_auteur WHERE interventions.code_intervention='$code_intervention'");

		while ($row = mysqli_fetch_array($getInfosAnn)) {
			$raisons_annulation = $row['commentaire'];
			$date_annulation = date('d / m / Y', strtotime($row['date_annulation']));
			$auteur_annulation = $row['prenom'] . ' ' . $row['nom'];
		}

		// Get infos annulation...
	}

	//Edition...
	if (isset($_GET['numero_incident']) && isset($_GET['edit'])) {

		$numero_incident = $_GET['numero_incident'];
		$showEdit = 1;

		$getIncidentsE = mysqli_query($con, "SELECT * FROM `signalements` INNER JOIN services on services.code_service=signalements.code_service where signalements.numero_incident='$numero_incident'");

		while ($row = mysqli_fetch_array($getIncidentsE)) {
			$service = $row['libelle'];
			$descriptionEdit = $row['description'];
			$auteur = $row['prenom'] . ' ' . $row['nom'];
			$date_reception = date('d / m / Y', strtotime($row['date_reception']));
			$heure_reception = date('H:i', strtotime($row['date_reception']));
			$image = $row['photo'];
			$contact = $row['contact'];
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

		$getIncidentsE = mysqli_query($con, "SELECT * FROM `signalements` INNER JOIN services on services.code_service=signalements.code_service where signalements.numero_incident='$numero_incident'");

		while ($row = mysqli_fetch_array($getIncidentsE)) {
			$service = $row['libelle'];
			$descriptionEdit = $row['description'];
			$code_service = $row['code_service'];
			$auteur = $row['prenom'] . ' ' . $row['nom'];
			$date_reception = date('d / m / Y', strtotime($row['date_reception']));
			$heure_reception = date('H:i', strtotime($row['date_reception']));
			$image = $row['photo'];
			$contact = $row['contact'];
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
								<h4 class="page-title">Interventions</h4>
								<!-- <div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Signalements</li>
								<li class="breadcrumb-item active" aria-current="page">En attente</li>
							</ol>
						</nav>
					</div> -->
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
						<!-- Fin de l'affectation -->


						<div class="row">
							<div class="col-12">
								<div class="box">
									<div class="box-header with-border">
										<h4 class="box-title">Fiche d'intervention <strong style="color:red"><?php echo $code_intervention; ?></strong></h4>
									</div>
									<!-- <div class="box-body"> -->
									<?php include('contents/content-fiche-intervention.php'); ?>
									<!-- </div> -->
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
			<script src="../src/js/pages/chat-popup.js"></script>
			<script src="../../../assets/icons/feather-icons/feather.min.js"></script>
			<script src="../../../assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
			<script src="../../../assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>

	</body>

	</html>
<?php } else {
	header('Location: ../sri_admin');
}  ?>