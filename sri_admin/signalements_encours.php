<?php
session_start();
include('config/app.php');

if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable' || $_SESSION['role'] == 'Gestionnaire') {
	$profil = $_SESSION['role'];
	$emailUser = $_SESSION['email'];

	// Get matricule user

	switch ($profil) {
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

	// Get service...

	if ($profil == 'Gestionnaire') {
		$getCodeService = mysqli_query($con, "SELECT code_service FROM gestionnaires_services WHERE matricule_gestionnaire='$matricule'");

		while ($row = mysqli_fetch_array($getCodeService)) {
			$code_service = $row['code_service'];
		}
	}

	$t_i_1 = 0;
	$t_i_2 = 0;
	$t_i_3 = 0;
	$t_i_4 = 0;
	$t_i_5 = 0;

	$liste_codes_incident_resp = [];

	$liste_types_incident_resp = [];
	// get signalements en attente en fonction du profil
	switch ($profil) {
		case 'Administrateur':
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
				code_priorite.couleur_priorite,
				interventions.date_intervention,
				interventions.intervenant,
				interventions.type_intervenant
				FROM `signalements` 
				INNER JOIN services on services.code_service=signalements.code_service
				INNER JOIN type_incidents ON type_incidents.code_incident=signalements.code_incident 
				INNER JOIN code_priorite ON code_priorite.code=signalements.code_priorite 
				INNER JOIN interventions ON interventions.numero_incident=signalements.numero_incident
				WHERE signalements.statut='en cours'");
			break;
		case 'Responsable':
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
				code_priorite.couleur_priorite,
				interventions.date_intervention,
				interventions.intervenant,
				interventions.type_intervenant
				FROM `signalements` 
				INNER JOIN services on services.code_service=signalements.code_service
				INNER JOIN type_incidents ON type_incidents.code_incident=signalements.code_incident 
				INNER JOIN code_priorite ON code_priorite.code=signalements.code_priorite 
				INNER JOIN interventions ON interventions.numero_incident=signalements.numero_incident
				where signalements.statut='en cours' AND signalements.code_incident IN ('$t_i_1','$t_i_2','$t_i_3','$t_i_4','$t_i_5')");
			break;
		case 'Gestionnaire':
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
				code_priorite.couleur_priorite,
				interventions.date_intervention,
				interventions.intervenant,
				interventions.type_intervenant
				FROM `signalements` 
				INNER JOIN services on services.code_service=signalements.code_service
				INNER JOIN type_incidents ON type_incidents.code_incident=signalements.code_incident 
				INNER JOIN code_priorite ON code_priorite.code=signalements.code_priorite 
				INNER JOIN interventions ON interventions.numero_incident=signalements.numero_incident
				WHERE signalements.statut='en cours' AND services.code_service='$code_service'");
			break;
	}
?>
	<?php
	$page = 'Signalements';
	include('layouts/head.php');
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
											<li class="breadcrumb-item active" aria-current="page">En attente</li>
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
						<div class="row">
							<div class="col-12">
								<div class="box">
									<div class="box-header with-border">
										<h4 class="box-title">Liste des incidents en cours de traitement</h4>
									</div>
									<div class="box-body" style="background-color:#FBFBFB">
										<?php include('contents/content-signalements-encours.php'); ?>
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

	</body>

	</html>
<?php } else {
	header('Location: ../sri_admin');
}  ?>