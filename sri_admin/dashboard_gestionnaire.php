<?php
session_start();
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable') {
	$emailUser = $_SESSION['email'];
?>
	<?php
	include('config/app.php');

	$page = 'Dashboard Gestionnaire';
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

	// echo $nbIncident.'</br>';
	// echo $nbIncidentEnCours.'</br>';
	// echo $nbIncidentEnAttente.'</br>';
	// echo $nbIncidentRejetes.'</br>';
	// echo $nbIncidentTermine.'</br>';

	// echo $pNbIncidentEnCours.'%</br>';
	// echo $pNbIncidentEnAttente.'%</br>';
	// echo $pNbIncidentRejetes.'%</br>';
	// echo $pNbIncidentTermine.'%</br>';
	// die;


	//Interventions
	$nbIntervention = 0;
	$nbInterventionPlanifiee = 0;
	$nbInterventionEnRetard = 0;
	$nbInterventionAnnulee = 0;
	$nbInterventionTerminee = 0;

	//
	$pNbInterventionPlanifiee = 0;
	$pNbInterventionEnRetard = 0;
	$pNbInterventionAnnulee = 0;
	$pNbInterventionTerminee = 0;

	$getNbIntervention = mysqli_query($con, "SELECT COUNT(code_intervention) as nbIntervention FROM `interventions`");
	while ($row = mysqli_fetch_array($getNbIntervention)) {
		$nbIntervention = $row['nbIntervention'];
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

	// echo $nbIntervention.'</br>';
	// echo 'Planifiee : '.$nbInterventionPlanifiee.'</br>';
	// echo 'Terminee: '.$nbInterventionTerminee.'</br>';
	// echo 'Annulee : '.$nbInterventionAnnulee.'</br>';
	// echo 'En retard : '.$nbInterventionEnRetard.'</br></br>';

	// echo $pNbInterventionPlanifiee.'%</br>';
	// echo $pNbInterventionTerminee.'%</br>';
	// echo $pNbInterventionAnnulee.'%</br>';
	// echo $pNbInterventionEnRetard.'%</br>';
	// die;


	$getIncidents = mysqli_query($con, "SELECT * FROM `signalements` 
	INNER JOIN services on services.code_service=signalements.code_service 
	INNER JOIN signalements_incidents on signalements_incidents.numero_incident=signalements.numero_incident
	INNER JOIN type_incidents on type_incidents.code_incident=signalements_incidents.code_incident
	order by signalements.id desc limit 10");

	// while ($row = mysqli_fetch_array($getIncidents)) { 
	//     $service = $row['sigle'];
	//     $description=$row['description'];
	// 	$auteur=$row['prenom'].' '.$row['nom'];
	// 	$date_reception=date('d-m', strtotime($row['date_reception']));
	// 	$jour_reception=date('d', strtotime($row['date_reception']));
	// 	$heure_reception=date('H:i', strtotime($row['date_reception']));
	// 	$couleur=$row['couleur'];
	// 	// echo $service.'</br>';
	// 	// echo $date_reception.'</br>';
	// 	// echo $jour_reception.'</br>';
	// 	// echo $heure_reception.'</br>';
	// 	// echo $description.'</br>';
	// 	// echo $couleur.'</br>';



	// }
	// $today=date('d', strtotime($dateDuJour));
	// echo 'Tay: '.$today.'</br>';
	// die;

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
	type_incidents.couleur,
	interventions.type_intervenant
	FROM `interventions`
	INNER JOIN services ON services.code_service=interventions.service
	INNER JOIN type_incidents ON type_incidents.code_incident=interventions.code_incident");

	$getSignalements = mysqli_query($con, "SELECT 
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
	code_priorite.couleur_priorite

	FROM `signalements` INNER JOIN services on services.code_service=signalements.code_service INNER JOIN type_incidents ON type_incidents.code_incident=signalements.code_incident INNER JOIN code_priorite ON code_priorite.code=signalements.code_priorite where statut='en attente'");


	?>

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
					<!-- Main content -->
					<?php include('contents/content-dashboard-gestionnaire.php'); ?>
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


			<!-- <?php //include ('layouts/js.php');
						?> -->


	</body>

	</html>
<?php } else {
	header('Location: ../sri_admin');
}  ?>