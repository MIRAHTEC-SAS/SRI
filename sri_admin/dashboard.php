<?php
session_start();
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable' || $_SESSION['role'] == 'Gestionnaire' || $_SESSION['role'] == 'Intervenant') {
	$emailUser = $_SESSION['email'];
	$roleUser = $_SESSION['role'];

	//   echo $emailUser;die;
?>
	<?php
	include('config/app.php');

	$page = 'Dashboard';
	include('layouts/head.php');

	// Mise a jour des interventions en retard

	$majStatutIntervention = mysqli_query($con, "SELECT code_intervention, date_intervention, statut FROM `interventions` WHERE statut='planifiee'");

	while ($row = mysqli_fetch_array($majStatutIntervention)) {
		$code_intervention = $row['code_intervention'];
		$date_intervention = $row['date_intervention'];

		if ($dateDuJour > $date_intervention) {
			$sql = mysqli_query($con, "UPDATE interventions SET statut='en retard' WHERE code_intervention='$code_intervention'");
		}
	}

	// interventions
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
	INNER JOIN type_incidents ON type_incidents.code_incident=interventions.code_incident ORDER BY interventions.id DESC");
	// Fin mise a jour 
	//Statistiques
	//Incidents
	$nbIncident = 0;
	// nb
	$nbIncidentEnCours = 0;
	$nbIncidentEnAttente = 0;
	$nbIncidentRejetes = 0;
	$nbIncidentTermine = 0;
	// pourcentage
	$pNbIncidentEnCours = 0;
	$pNbIncidentEnAttente = 0;
	$pNbIncidentRejetes = 0;
	$pNbIncidentTermine = 0;

	//Interventions
	$nbIntervention = 0;
	$nbInterventionPlanifiee = 0;
	$nbInterventionEnRetard = 0;
	$nbInterventionAnnulee = 0;
	$nbInterventionTerminee = 0;

	//pourcentage
	$pNbInterventionPlanifiee = 0;
	$pNbInterventionEnRetard = 0;
	$pNbInterventionAnnulee = 0;
	$pNbInterventionTerminee = 0;

	switch ($roleUser) {
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
			// Service
			$getCodeService = mysqli_query($con, "SELECT code_service FROM gestionnaires_services WHERE matricule_gestionnaire='$matricule'");
			while ($row = mysqli_fetch_array($getCodeService)) {
				$code_service = $row['code_service'];
			}
			break;
		case "Intervenant":
			$getMatriculeInter = mysqli_query($con, "SELECT matricule_intervenant FROM intervenants_interne WHERE email='$emailUser'");

			while ($row = mysqli_fetch_array($getMatriculeInter)) {
				$matricule = $row['matricule_intervenant'];
			}
			break;
	}
	// ADMINISTRATEUR
	if ($roleUser == 'Administrateur') {
		// Nombres
		$getNbIncident = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncident FROM `signalements`");
		while ($row = mysqli_fetch_array($getNbIncident)) {
			$nbIncident = $row['nbIncident'];
		}

		// En cours
		$getNbIncidentEncours = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncidentEncours FROM `signalements` WHERE statut='en cours'");
		while ($row = mysqli_fetch_array($getNbIncidentEncours)) {
			$nbIncidentEnCours = $row['nbIncidentEncours'];
		}
		// Termines
		$getNbIncidentTermines = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncidentTermines FROM `signalements` WHERE statut='termine'");
		while ($row = mysqli_fetch_array($getNbIncidentTermines)) {
			$nbIncidentTermine = $row['nbIncidentTermines'];
		}
		// En attente
		$getNbIncidentEnAttente = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncidentEnAttente FROM `signalements` WHERE statut='en attente'");
		while ($row = mysqli_fetch_array($getNbIncidentEnAttente)) {
			$nbIncidentEnAttente = $row['nbIncidentEnAttente'];
		}
		// Rejeter
		$getNbIncidentRejetes = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncidentRejetes FROM `signalements` WHERE statut='rejete'");
		while ($row = mysqli_fetch_array($getNbIncidentRejetes)) {
			$nbIncidentRejetes = $row['nbIncidentRejetes'];
		}

		// Pourcentage
		$pNbIncidentEnCours = round((($nbIncidentEnCours / $nbIncident) * 100), 1);
		$pNbIncidentEnAttente = round((($nbIncidentEnAttente / $nbIncident) * 100), 1);
		$pNbIncidentRejetes = round((($nbIncidentRejetes / $nbIncident) * 100), 1);
		$pNbIncidentTermine = round((($nbIncidentTermine / $nbIncident) * 100), 1);

		$getNbIntervention = mysqli_query($con, "SELECT COUNT(code_intervention) as nbIntervention FROM `interventions`");
		while ($row = mysqli_fetch_array($getNbIntervention)) {
			$nbIntervention = $row['nbIntervention'];
			$nbInterventionBon = $row['nbIntervention'];
		}
		$getNbInterventionPlanifiee = mysqli_query($con, "SELECT COUNT(code_intervention) as nbInterventionEncours FROM `interventions` WHERE statut='planifiee'");
		while ($row = mysqli_fetch_array($getNbInterventionPlanifiee)) {
			$nbInterventionPlanifiee = $row['nbInterventionEncours'];
		}
		$getInterventionTermines = mysqli_query($con, "SELECT COUNT(code_intervention) as nbInterventionTermines FROM `interventions` WHERE statut='terminee'");
		while ($row = mysqli_fetch_array($getInterventionTermines)) {
			$nbInterventionTerminee = $row['nbInterventionTermines'];
		}
		// Annulee
		$getInterventionAnnulee = mysqli_query($con, "SELECT COUNT(code_intervention) as nbInterventionAnnulee FROM `interventions` WHERE statut='annulee'");
		while ($row = mysqli_fetch_array($getInterventionAnnulee)) {
			$nbInterventionAnnulee = $row['nbInterventionAnnulee'];
		}
		// En retard
		$getInterventionEnRetard = mysqli_query($con, "SELECT COUNT(code_intervention) as nbInterventionEnRetard FROM `interventions` WHERE statut='en retard'");
		while ($row = mysqli_fetch_array($getInterventionEnRetard)) {
			$nbInterventionEnRetard = $row['nbInterventionEnRetard'];
		}

		$pNbInterventionPlanifiee = round((($nbInterventionPlanifiee / $nbIntervention) * 100), 1);
		$pNbInterventionEnRetard = round((($nbInterventionEnRetard / $nbIntervention) * 100), 1);
		$pNbInterventionAnnulee = round((($nbInterventionAnnulee / $nbIntervention) * 100), 1);
		$pNbInterventionTerminee = round((($nbInterventionTerminee / $nbIntervention) * 100), 1);
	}
	// RESPONSABLE
	if ($roleUser == 'Responsable') {
		// Recuperation des domaines...
		$liste_codes_incident_resp = [];

		$getInfosResponsable = mysqli_query($con, "SELECT 
		responsables_dage.matricule,
		responsables_dage.prenom, responsables_dage.nom,
		responsables_dage.email,
		responsables_dage.telephone,
		responsables_incidents.code_incident,
		type_incidents.type_incident,
		type_incidents.couleur
		FROM `responsables_incidents` INNER JOIN responsables_dage ON responsables_dage.matricule=responsables_incidents.matricule_responsable INNER JOIN type_incidents ON type_incidents.code_incident=responsables_incidents.code_incident
		WHERE responsables_dage.email='$emailUser'");

		while ($row = mysqli_fetch_array($getInfosResponsable)) {
			$responsable = $row['prenom'] . '' . $row['nom'];
			$liste_codes_incident_resp[] = $row['code_incident'];
		}

		$t_i_1 = $liste_codes_incident_resp[0];
		$t_i_2 = $liste_codes_incident_resp[1];
		$t_i_3 = $liste_codes_incident_resp[2];
		$t_i_4 = $liste_codes_incident_resp[3];
		$t_i_5 = $liste_codes_incident_resp[4];
		// Nombres
		$getNbIncident = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncident FROM `signalements` WHERE code_incident IN ('$t_i_1','$t_i_2','$t_i_3','$t_i_4','$t_i_5')");
		while ($row = mysqli_fetch_array($getNbIncident)) {
			$nbIncident = $row['nbIncident'];
		}

		// En cours
		$getNbIncidentEncours = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncidentEncours FROM `signalements` WHERE statut='en cours' AND code_incident IN ('$t_i_1','$t_i_2','$t_i_3','$t_i_4','$t_i_5')");
		while ($row = mysqli_fetch_array($getNbIncidentEncours)) {
			$nbIncidentEnCours = $row['nbIncidentEncours'];
		}
		// Termines
		$getNbIncidentTermines = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncidentTermines FROM `signalements` WHERE statut='termine' AND code_incident IN ('$t_i_1','$t_i_2','$t_i_3','$t_i_4','$t_i_5')");
		while ($row = mysqli_fetch_array($getNbIncidentTermines)) {
			$nbIncidentTermine = $row['nbIncidentTermines'];
		}
		// En attente
		$getNbIncidentEnAttente = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncidentEnAttente FROM `signalements` WHERE statut='en attente' AND code_incident IN ('$t_i_1','$t_i_2','$t_i_3','$t_i_4','$t_i_5')");
		while ($row = mysqli_fetch_array($getNbIncidentEnAttente)) {
			$nbIncidentEnAttente = $row['nbIncidentEnAttente'];
		}
		// Rejeter
		$getNbIncidentRejetes = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncidentRejetes FROM `signalements` WHERE statut='rejete' AND code_incident IN ('$t_i_1','$t_i_2','$t_i_3','$t_i_4','$t_i_5')");
		while ($row = mysqli_fetch_array($getNbIncidentRejetes)) {
			$nbIncidentRejetes = $row['nbIncidentRejetes'];
		}

		// Pourcentage
		$pNbIncidentEnCours = round((($nbIncidentEnCours / $nbIncident) * 100), 1);
		$pNbIncidentEnAttente = round((($nbIncidentEnAttente / $nbIncident) * 100), 1);
		$pNbIncidentRejetes = round((($nbIncidentRejetes / $nbIncident) * 100), 1);
		$pNbIncidentTermine = round((($nbIncidentTermine / $nbIncident) * 100), 1);

		$getNbIntervention = mysqli_query($con, "SELECT COUNT(code_intervention) as nbIntervention FROM `interventions` WHERE code_incident IN ('$t_i_1','$t_i_2','$t_i_3','$t_i_4','$t_i_5')");
		while ($row = mysqli_fetch_array($getNbIntervention)) {
			$nbIntervention = $row['nbIntervention'];
		}
		$getNbInterventionPlanifiee = mysqli_query($con, "SELECT COUNT(code_intervention) as nbInterventionEncours FROM `interventions` WHERE statut='planifiee' AND code_incident IN ('$t_i_1','$t_i_2','$t_i_3','$t_i_4','$t_i_5')");
		while ($row = mysqli_fetch_array($getNbInterventionPlanifiee)) {
			$nbInterventionPlanifiee = $row['nbInterventionEncours'];
		}
		$getInterventionTermines = mysqli_query($con, "SELECT COUNT(code_intervention) as nbInterventionTermines FROM `interventions` WHERE statut='terminee' AND code_incident IN ('$t_i_1','$t_i_2','$t_i_3','$t_i_4','$t_i_5')");
		while ($row = mysqli_fetch_array($getInterventionTermines)) {
			$nbInterventionTerminee = $row['nbInterventionTermines'];
		}
		// Annulee
		$getInterventionAnnulee = mysqli_query($con, "SELECT COUNT(code_intervention) as nbInterventionAnnulee FROM `interventions` WHERE statut='annulee' AND code_incident IN ('$t_i_1','$t_i_2','$t_i_3','$t_i_4','$t_i_5')");
		while ($row = mysqli_fetch_array($getInterventionAnnulee)) {
			$nbInterventionAnnulee = $row['nbInterventionAnnulee'];
		}
		// En retard
		$getInterventionEnRetard = mysqli_query($con, "SELECT COUNT(code_intervention) as nbInterventionEnRetard FROM `interventions` WHERE statut='en retard' AND code_incident IN ('$t_i_1','$t_i_2','$t_i_3','$t_i_4','$t_i_5')");
		while ($row = mysqli_fetch_array($getInterventionEnRetard)) {
			$nbInterventionEnRetard = $row['nbInterventionEnRetard'];
		}

		$pNbInterventionPlanifiee = round((($nbInterventionPlanifiee / $nbIntervention) * 100), 1);
		$pNbInterventionEnRetard = round((($nbInterventionEnRetard / $nbIntervention) * 100), 1);
		$pNbInterventionAnnulee = round((($nbInterventionAnnulee / $nbIntervention) * 100), 1);
		$pNbInterventionTerminee = round((($nbInterventionTerminee / $nbIntervention) * 100), 1);
	}
	// GESTIONNAIRE
	if ($roleUser == 'Gestionnaire') {
		// Nombres
		$getNbIncident = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncident FROM `signalements` WHERE code_service='$code_service'");
		while ($row = mysqli_fetch_array($getNbIncident)) {
			$nbIncident = $row['nbIncident'];
		}

		// En cours
		$getNbIncidentEncours = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncidentEncours FROM `signalements` WHERE statut='en cours' AND code_service='$code_service'");
		while ($row = mysqli_fetch_array($getNbIncidentEncours)) {
			$nbIncidentEnCours = $row['nbIncidentEncours'];
		}
		// Termines
		$getNbIncidentTermines = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncidentTermines FROM `signalements` WHERE statut='termine' AND code_service='$code_service'");
		while ($row = mysqli_fetch_array($getNbIncidentTermines)) {
			$nbIncidentTermine = $row['nbIncidentTermines'];
		}
		// En attente
		$getNbIncidentEnAttente = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncidentEnAttente FROM `signalements` WHERE statut='en attente' AND code_service='$code_service'");
		while ($row = mysqli_fetch_array($getNbIncidentEnAttente)) {
			$nbIncidentEnAttente = $row['nbIncidentEnAttente'];
		}
		// Rejeter
		$getNbIncidentRejetes = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncidentRejetes FROM `signalements` WHERE statut='rejete' AND code_service='$code_service'");
		while ($row = mysqli_fetch_array($getNbIncidentRejetes)) {
			$nbIncidentRejetes = $row['nbIncidentRejetes'];
		}

		// Pourcentage
		$pNbIncidentEnCours = round((($nbIncidentEnCours / $nbIncident) * 100), 1);
		$pNbIncidentEnAttente = round((($nbIncidentEnAttente / $nbIncident) * 100), 1);
		$pNbIncidentRejetes = round((($nbIncidentRejetes / $nbIncident) * 100), 1);
		$pNbIncidentTermine = round((($nbIncidentTermine / $nbIncident) * 100), 1);

		$getNbIntervention = mysqli_query($con, "SELECT COUNT(code_intervention) as nbIntervention FROM `interventions` WHERE service='$code_service'");
		while ($row = mysqli_fetch_array($getNbIntervention)) {
			$nbIntervention = $row['nbIntervention'];
		}
		$getNbInterventionPlanifiee = mysqli_query($con, "SELECT COUNT(code_intervention) as nbInterventionEncours FROM `interventions` WHERE statut='planifiee' AND service='$code_service'");
		while ($row = mysqli_fetch_array($getNbInterventionPlanifiee)) {
			$nbInterventionPlanifiee = $row['nbInterventionEncours'];
		}
		$getInterventionTermines = mysqli_query($con, "SELECT COUNT(code_intervention) as nbInterventionTermines FROM `interventions` WHERE statut='terminee' AND service='$code_service'");
		while ($row = mysqli_fetch_array($getInterventionTermines)) {
			$nbInterventionTerminee = $row['nbInterventionTermines'];
		}
		// Annulee
		$getInterventionAnnulee = mysqli_query($con, "SELECT COUNT(code_intervention) as nbInterventionAnnulee FROM `interventions` WHERE statut='annulee' AND service='$code_service'");
		while ($row = mysqli_fetch_array($getInterventionAnnulee)) {
			$nbInterventionAnnulee = $row['nbInterventionAnnulee'];
		}
		// En retard
		$getInterventionEnRetard = mysqli_query($con, "SELECT COUNT(code_intervention) as nbInterventionEnRetard FROM `interventions` WHERE statut='en retard' AND service='$code_service'");
		while ($row = mysqli_fetch_array($getInterventionEnRetard)) {
			$nbInterventionEnRetard = $row['nbInterventionEnRetard'];
		}

		$pNbInterventionPlanifiee = round((($nbInterventionPlanifiee / $nbIntervention) * 100), 1);
		$pNbInterventionEnRetard = round((($nbInterventionEnRetard / $nbIntervention) * 100), 1);
		$pNbInterventionAnnulee = round((($nbInterventionAnnulee / $nbIntervention) * 100), 1);
		$pNbInterventionTerminee = round((($nbInterventionTerminee / $nbIntervention) * 100), 1);
	}
	// INTERVENANT
	if ($roleUser == 'Intervenant') {
		// Recuperation des domaines...
		$liste_codes_incident_resp = [];

		$getInfosIntervenant = mysqli_query($con, "SELECT intervenants_interne_incidents.code_incident, intervenants_interne.matricule_intervenant, intervenants_interne.prenom, intervenants_interne.nom,intervenants_interne.email, intervenants_interne.telephone, type_incidents.type_incident, type_incidents.couleur FROM `intervenants_interne_incidents` INNER JOIN intervenants_interne ON intervenants_interne.matricule_intervenant=intervenants_interne_incidents.matricule_intervenant INNER JOIN type_incidents on type_incidents.code_incident=intervenants_interne_incidents.code_incident WHERE intervenants_interne_incidents.matricule_intervenant='$matricule'");

		while ($row = mysqli_fetch_array($getInfosIntervenant)) {
			$responsable = $row['prenom'] . '' . $row['nom'];
			$liste_codes_incident_resp[] = $row['code_incident'];
		}

		$t_i_1 = $liste_codes_incident_resp[0];
		$t_i_2 = $liste_codes_incident_resp[1];
		$t_i_3 = $liste_codes_incident_resp[2];
		$t_i_4 = $liste_codes_incident_resp[3];
		$t_i_5 = $liste_codes_incident_resp[4];
		// Nombres
		$getNbIncident = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncident FROM `signalements` WHERE code_incident IN ('$t_i_1','$t_i_2','$t_i_3','$t_i_4','$t_i_5')");
		while ($row = mysqli_fetch_array($getNbIncident)) {
			$nbIncident = $row['nbIncident'];
		}

		// En cours
		$getNbIncidentEncours = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncidentEncours FROM `signalements` WHERE statut='en cours' AND code_incident IN ('$t_i_1','$t_i_2','$t_i_3','$t_i_4','$t_i_5')");
		while ($row = mysqli_fetch_array($getNbIncidentEncours)) {
			$nbIncidentEnCours = $row['nbIncidentEncours'];
		}
		// Termines
		$getNbIncidentTermines = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncidentTermines FROM `signalements` WHERE statut='termine' AND code_incident IN ('$t_i_1','$t_i_2','$t_i_3','$t_i_4','$t_i_5')");
		while ($row = mysqli_fetch_array($getNbIncidentTermines)) {
			$nbIncidentTermine = $row['nbIncidentTermines'];
		}
		// En attente
		$getNbIncidentEnAttente = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncidentEnAttente FROM `signalements` WHERE statut='en attente' AND code_incident IN ('$t_i_1','$t_i_2','$t_i_3','$t_i_4','$t_i_5')");
		while ($row = mysqli_fetch_array($getNbIncidentEnAttente)) {
			$nbIncidentEnAttente = $row['nbIncidentEnAttente'];
		}
		// Rejeter
		$getNbIncidentRejetes = mysqli_query($con, "SELECT COUNT(numero_incident) as nbIncidentRejetes FROM `signalements` WHERE statut='rejete' AND code_incident IN ('$t_i_1','$t_i_2','$t_i_3','$t_i_4','$t_i_5')");
		while ($row = mysqli_fetch_array($getNbIncidentRejetes)) {
			$nbIncidentRejetes = $row['nbIncidentRejetes'];
		}

		// Pourcentage
		$pNbIncidentEnCours = round((($nbIncidentEnCours / $nbIncident) * 100), 1);
		$pNbIncidentEnAttente = round((($nbIncidentEnAttente / $nbIncident) * 100), 1);
		$pNbIncidentRejetes = round((($nbIncidentRejetes / $nbIncident) * 100), 1);
		$pNbIncidentTermine = round((($nbIncidentTermine / $nbIncident) * 100), 1);

		$getNbIntervention = mysqli_query($con, "SELECT COUNT(code_intervention) as nbIntervention FROM `interventions` WHERE intervenant='$matricule'");
		while ($row = mysqli_fetch_array($getNbIntervention)) {
			$nbIntervention = $row['nbIntervention'];
		}
		$getNbInterventionPlanifiee = mysqli_query($con, "SELECT COUNT(code_intervention) as nbInterventionEncours FROM `interventions` WHERE statut='planifiee' AND intervenant='$matricule'");
		while ($row = mysqli_fetch_array($getNbInterventionPlanifiee)) {
			$nbInterventionPlanifiee = $row['nbInterventionEncours'];
		}
		$getInterventionTermines = mysqli_query($con, "SELECT COUNT(code_intervention) as nbInterventionTermines FROM `interventions` WHERE statut='terminee' AND intervenant='$matricule'");
		while ($row = mysqli_fetch_array($getInterventionTermines)) {
			$nbInterventionTerminee = $row['nbInterventionTermines'];
		}
		// Annulee
		$getInterventionAnnulee = mysqli_query($con, "SELECT COUNT(code_intervention) as nbInterventionAnnulee FROM `interventions` WHERE statut='annulee' AND intervenant='$matricule'");
		while ($row = mysqli_fetch_array($getInterventionAnnulee)) {
			$nbInterventionAnnulee = $row['nbInterventionAnnulee'];
		}
		// En retard
		$getInterventionEnRetard = mysqli_query($con, "SELECT COUNT(code_intervention) as nbInterventionEnRetard FROM `interventions` WHERE statut='en retard' AND intervenant='$matricule'");
		while ($row = mysqli_fetch_array($getInterventionEnRetard)) {
			$nbInterventionEnRetard = $row['nbInterventionEnRetard'];
		}

		$pNbInterventionPlanifiee = round((($nbInterventionPlanifiee / $nbIntervention) * 100), 1);
		$pNbInterventionEnRetard = round((($nbInterventionEnRetard / $nbIntervention) * 100), 1);
		$pNbInterventionAnnulee = round((($nbInterventionAnnulee / $nbIntervention) * 100), 1);
		$pNbInterventionTerminee = round((($nbInterventionTerminee / $nbIntervention) * 100), 1);
	}



	?>

	<body class="hold-transition light-skin sidebar-mini theme-primary fixed">
		<div class="wrapper">
			<div id="loader"></div>

			<!-- Header -->
			<?php
			include('layouts/header.php'); ?>
			<!-- Fin header -->

			<!-- Left side column. contains the logo and sidebar -->
			<?php
			include('layouts/sidebar.php'); ?>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<div class="container-full">
					<!-- Main content -->
					<?php include('contents/content-dashboard.php'); ?>
					<!-- /.content -->
				</div>
			</div>
			<!-- /.content-wrapper -->

			<?php include('layouts/footer.php'); ?>
			<!-- Side panel -->
			<?php include('layouts/rightbar.php'); ?>

			<?php include('layouts/modal_user.php'); ?>

			<!-- Page Content overlay -->


			<!-- Vendor JS -->
			<script src="../src/js/vendors.min.js"></script>
			<!-- <script src="../src/js/pages/chat-popup.js"></script> -->
			<script src="../../../assets/icons/feather-icons/feather.min.js"></script>

			<script src="assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>

			<!-- CRMi App -->
			<script src="../src/js/template.js"></script>
			<script src="../src/js/pages/dashboard.js"></script>
			<script src="../src/js/pages/data-table.js"></script>
			<script src="../src/js/pages/chart-widgets.js"></script>
			<script src="../src/js/pages/chartjs-int.js"></script>


			<?php include('layouts/js.php'); ?>


	</body>

	</html>
<?php } else {
	header('Location: ../sri_admin');
}  ?>