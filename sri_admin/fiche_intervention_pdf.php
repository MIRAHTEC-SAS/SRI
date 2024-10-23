<?php

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
		break;
	case "Intervenant":
		$getMatriculeInt = mysqli_query($con, "SELECT matricule_intervenant FROM intervenants_interne WHERE email='$emailUser'");
		while ($row = mysqli_fetch_array($getMatriculeInt)) {
			$matricule = $row['matricule_intervenant'];
		}
}



//Fin edition...
$page = 'Incident';
?>
<?php include('layouts/head.php'); ?>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

	<div class="wrapper">

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<div class="container-full">
				<div class="content-header">
					<div class="d-flex align-items-center">
						<div class="me-auto">
							<h4 class="page-title">Interventions</h4>
						</div>

					</div>
				</div>

				<!-- Main content -->
				<section class="content">


					<div class="row">
						<div class="col-12">
							<div class="box">
								<div class="box-header with-border">
									<h4 class="box-title">Fiche d'intervention <strong style="color:red"><?php echo $code_intervention; ?></strong></h4>
								</div>
								<!-- <div class="box-body"> -->
								<?php include('contents/content-fiche-intervention_pdf.php'); ?>
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
		<?php //include('layouts/footer.php'); 
		?>
		<!-- FIN FOOTER -->
		<?php //include('layouts/rightbar.php'); 
		?>

		<?php //include('layouts/modal_user.php'); 
		?>

		<!-- Page Content overlay -->


		<!-- Vendor JS -->
		<?php include('layouts/js.php'); ?>
		<script src="src/js/pages/chat-popup.js"></script>
		<script src="assets/icons/feather-icons/feather.min.js"></script>
		<script src="assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
		<script src="assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>

</body>

</html>