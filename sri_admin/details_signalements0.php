<?php
include('config/app.php');
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable') {
	$emailUser = $_SESSION['email'];
?>
	<?php

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
	}
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
											<li class="breadcrumb-item active" aria-current="page">En attente</li>
										</ol>
									</nav>
								</div>
							</div>

						</div>
					</div>

					<!-- Main content -->
					<section class="content">
						<div class="row">
							<div class="col-12">
								<div class="box">
									<div class="box-header with-border">
										<h4 class="box-title">Details de l'incident <strong style="color:red"><?php echo $numero_incident; ?></strong></h4>
									</div>
									<div class="box-body">
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

	</body>

	</html>
<?php } else {
	header('Location: ../sri_admin');
}  ?>