<?php
session_start();
include('config/app.php');
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable') {
	$emailUser = $_SESSION['email'];
?>
	<?php
	// session_start();
	$page = 'prestataires Dage';
	include('layouts/head.php');
	$update = 0;

	$getPrestataires = mysqli_query($con, "SELECT * FROM prestataires order by id DESC");
	$getTypeIncident = mysqli_query($con, "SELECT * FROM type_incidents order by id DESC");

	$getPrestataires2 = mysqli_query($con, "SELECT * FROM prestataires order by id DESC");
	$getTypeIncident2 = mysqli_query($con, "SELECT * FROM type_incidents order by id DESC");

	if (isset($_GET['edit'])) {
		$update = 1;

		$id_affectation = $_GET['edit'];

		$getInfos = mysqli_query($con, "SELECT 
			prestataires_incidents.id,
			prestataires.matricule_presta,
			prestataires.denomination,
			prestataires.adresse,
			prestataires.telephone,
			prestataires.email,
			type_incidents.code_incident,
			type_incidents.type_incident,
			type_incidents.couleur
			FROM `prestataires_incidents` INNER JOIN prestataires on prestataires.matricule_presta=prestataires_incidents.matricule_prestataire inner JOIN type_incidents on type_incidents.code_incident=prestataires_incidents.code_incident WHERE prestataires_incidents.id='$id_affectation'");
		while ($row = mysqli_fetch_array($getInfos)) {
			$code_incident = $row['code_incident'];
			$type_incident = $row['type_incident'];
			$matricule_presta = $row['matricule_presta'];
			$prestataire = $row['denomination'];
		}
		// echo $id_affectation;die;
		// echo $prestataires;die;


	}
	if (isset($_GET['delete'])) {
		$update = 2;

		$id_affectation = $_GET['delete'];

		$getInfos = mysqli_query($con, "SELECT 
	prestataires_incidents.id,
	prestataires.matricule_presta,
	prestataires.denomination,
	prestataires.adresse,
	prestataires.telephone,
	prestataires.email,
	type_incidents.code_incident,
	type_incidents.type_incident,
	type_incidents.couleur
	FROM `prestataires_incidents` INNER JOIN prestataires on prestataires.matricule_presta=prestataires_incidents.matricule_prestataire inner JOIN type_incidents on type_incidents.code_incident=prestataires_incidents.code_incident WHERE prestataires_incidents.id='$id_affectation'");
		while ($row = mysqli_fetch_array($getInfos)) {
			$code_incident = $row['code_incident'];
			$type_incident = $row['type_incident'];
			$matricule_presta = $row['matricule_presta'];
			$prestataire = $row['denomination'];
		}
	}
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
								<h4 class="page-title">Prestataires</h4>
								<div class="d-inline-block align-items-center">
									<nav>
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-wrench"></i></a></li>
											<li class="breadcrumb-item" aria-current="page">Parametrage</li>
											<li class="breadcrumb-item active" aria-current="page">Prestataires</li>
										</ol>
									</nav>
								</div>
							</div>
							<div class="text-end">
								<!-- <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-success mt-10 d-block text-center"><i class="fa fa-plus-circle"></i> Nouveau Ministere</a> -->
							</div>

						</div>


					</div>

					<!-- Main content -->
					<section class="content">
						<div class="row">
							<div class="col-12">
								<!-- Confirmation box -->
								<?php include('confirmation.php'); ?>
							</div>

							<div class="col-12">
								<div class="box">
									<div class="box-body" style="background-color:#FBFBFB">
										<form action="services/parametrages.php" method="POST">
											<div class="row">
												<div class="col-5">
													<label class="col-md-12 form-label">Prestataire</label>
													<select class="form-control" name="prestataire" <?php if ($update == 2) echo 'disabled'; ?>>
														<?php if ($update > 0) { ?>
															<option value="<?php echo $matricule_presta; ?>"><?php echo $prestataire; ?></option>
															<?php while ($row = mysqli_fetch_array($getPrestataires2)) {
																$matricule = $row['matricule_presta'];
																if ($matricule_presta != $matricule) { ?>
																	<option value="<?php echo $row['matricule_presta']; ?>"><?php echo $row['denomination']; ?></option>
															<?php }
															} ?>
														<?php } ?>
														<?php if ($update == 0) while ($row = mysqli_fetch_array($getPrestataires)) { ?>

															<option value="<?php echo $row['matricule_presta']; ?>"><?php echo $row['denomination']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<label class="col-md-12 form-label">Domaines d'intervention</label>
													<?php if ($update > 0) { ?>
														<select class="form-control" name="type_incident" <?php if ($update == 2) echo 'disabled'; ?>>
															<option value="<?php echo $code_incident; ?>"><?php echo $type_incident; ?></option>
															<?php while ($row = mysqli_fetch_array($getTypeIncident2)) {
																if ($row['code_incident'] != $code_incident) { ?>
																	<option value="<?php echo $row['code_incident']; ?>"><?php echo $row['type_incident']; ?></option>
															<?php }
															} ?>
														</select>
													<?php } ?>
													<?php if ($update == 0) { ?>
														<select class="form-control select2" name="typesIncident[]" multiple="multiple" data-placeholder=" Selectionner" style="width: 100%;">
															<?php while ($row = mysqli_fetch_array($getTypeIncident)) { ?>
																<option value="<?php echo $row['code_incident']; ?>"><?php echo $row['type_incident']; ?></option>
															<?php } ?>
														</select>
													<?php } ?>
												</div>

												<div class="col-3">
													<label class="col-md-12 form-label">&nbsp;</label>
													<?php if ($update == 0) { ?> <button type="submit" name="parametrerPrestataire" class="btn btn-success form-control" style="color:white;height:50%"><i class="fa fa-check"></i> Valider affectation</button><?php } ?>
													<?php if ($update == 1) { ?>
														<input type="hidden" name="id_affectation" value="<?php echo $id_affectation; ?>">
														<button type="submit" name="modifierPrestataire" class="btn btn-warning form-control" style="color:black;height:50%"><i class="fa fa-edit"></i> Modifier affectation</button><?php } ?>
													<?php if ($update == 2) { ?>
														<input type="hidden" name="id_affectation" value="<?php echo $id_affectation; ?>">
														<button type="submit" name="supprimerPrestataire" class="btn btn-danger form-control" style="color:white;height:50%"><i class="fa fa-trash"></i> Supprimer</button><?php } ?>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>

							<div class="col-12">
								<div class="box">
									<div class="box-header with-border">
										<h4 class="box-title">Liste des Prestataires par domaine</h4>
									</div>

									<div class="box-body" style="background-color:#FBFBFB">
										<?php include('contents/content-prestataires-incidents.php'); ?>
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
			<script src="../../../assets/vendor_components/select2/dist/js/select2.full.js"></script>
			<script src="../src/js/pages/advanced-form-element.js"></script>


	</body>

	</html>
<?php } else {
	header('Location: ../sri_admin');
}  ?>