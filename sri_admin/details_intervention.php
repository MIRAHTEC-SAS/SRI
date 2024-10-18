<?php
session_start();
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable' || $_SESSION['role'] == 'Gestionnaire') {
	$showEdit = 0;
	$showAffect = 0;
	$emailUser = $_SESSION['email'];
	$roleUser = $_SESSION['role']; ?>
	<?php
	include('config/app.php');

	if (isset($_GET['numero_incident'])) {
		$numero_incident = $_GET['numero_incident'];

		$getIncidents = mysqli_query($con, "SELECT * FROM `signalements` INNER JOIN services on services.code_service=signalements.code_service where signalements.numero_incident='$numero_incident'");

		while ($row = mysqli_fetch_array($getIncidents)) {
			$service = $row['libelle'];
			$description = $row['description'];
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
		}
	}
	//Fin edition...
	$page = 'Interventions';
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
								<li class="breadcrumb-item" aria-current="page">Interventions</li>
								<li class="breadcrumb-item active" aria-current="page">Planifiees</li>
							</ol>
						</nav>
					</div> -->
							</div>

						</div>
					</div>

					<!-- Main content -->
					<?php include('contents/content-details-interventions.php'); ?>
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