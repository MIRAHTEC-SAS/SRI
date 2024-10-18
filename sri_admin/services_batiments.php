<?php
session_start();
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable') {
	$emailUser = $_SESSION['email'];
?>
	<?php
	include('config/app.php');
	// session_start();
	$page = 'Localisation services';
	include('layouts/head.php');
	$update = 0;

	$getServices = mysqli_query($con, "SELECT * FROM services order by id DESC");
	$getBatiments = mysqli_query($con, "SELECT * FROM batiments order by id DESC");

	$getServices2 = mysqli_query($con, "SELECT * FROM services order by id DESC");
	$getBatiments2 = mysqli_query($con, "SELECT * FROM batiments order by id DESC");

	if (isset($_GET['edit'])) {
		$update = 1;
		$id_affectation = $_GET['edit'];

		$getInfos = mysqli_query($con, "SELECT services.libelle, services.sigle, batiments.nom_batiment, batiments.adresse, localisation_services.id, localisation_services.code_service, localisation_services.code_batiment
	FROM `localisation_services` 
	INNER JOIN services ON services.code_service=localisation_services.code_service 
	INNER JOIN batiments ON batiments.code_batiment=localisation_services.code_batiment WHERE localisation_services.id='$id_affectation'");

		while ($row = mysqli_fetch_array($getInfos)) {
			$id_affectation_init = $row['id'];
			$code_batiment = $row['code_batiment'];
			$code_service = $row['code_service'];
			$sigle = $row['sigle'];
			$libelle = $row['libelle'];
			$nom_batiment = $row['nom_batiment'];
		}
		// echo $id_affectation;die;
		// echo $prestataires;die;


	}
	if (isset($_GET['delete'])) {
		$update = 2;

		$id_affectation = $_GET['delete'];

		$getInfos = mysqli_query($con, "SELECT services.libelle, services.sigle, batiments.nom_batiment, batiments.adresse, localisation_services.id, localisation_services.code_service, localisation_services.code_batiment
	FROM `localisation_services` 
	INNER JOIN services ON services.code_service=localisation_services.code_service 
	INNER JOIN batiments ON batiments.code_batiment=localisation_services.code_batiment WHERE localisation_services.id='$id_affectation'");

		while ($row = mysqli_fetch_array($getInfos)) {
			$id_affectation_init = $row['id'];
			$code_batiment = $row['code_batiment'];
			$code_service = $row['code_service'];
			$sigle = $row['sigle'];
			$libelle = $row['libelle'];
			$nom_batiment = $row['nom_batiment'];
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
								<h4 class="page-title">Services</h4>
								<div class="d-inline-block align-items-center">
									<nav>
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-wrench"></i></a></li>
											<li class="breadcrumb-item" aria-current="page">Parametrage</li>
											<li class="breadcrumb-item active" aria-current="page">Services interne</li>
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
												<div class="col-8">
													<label class="col-md-12 form-label">Selectionner un service</label>
													<select class="form-control" name="code_service">
														<?php if ($update > 0) { ?>
															<option value="<?php echo $code_service; ?>"><?php echo $libelle; ?></option>
															<?php while ($row = mysqli_fetch_array($getServices2)) {
																$code = $row['code_service'];
																if ($code_service != $code) { ?>
																	<option value="<?php echo $row['code_service']; ?>"><?php echo $row['libelle'] . ' ( ' . $row['sigle'] . ' ) '; ?></option>
															<?php }
															} ?>
														<?php } ?>
														<?php if ($update == 0) while ($row = mysqli_fetch_array($getServices)) { ?>
															<option value="<?php echo $row['code_service']; ?>"><?php echo $row['libelle']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-4">
													<label class="col-md-12 form-label">Selectionner les bâtiments du service</label>
													<?php if ($update > 0) { ?>
														<select class="form-control" name="code_batiment" <?php if ($update == 2) echo 'disabled'; ?>>
															<option value="<?php echo $code_batiment; ?>"><?php echo $nom_batiment; ?></option>
															<?php while ($row = mysqli_fetch_array($getBatiments2)) {
																if ($row['code_batiment'] != $code_batiment) { ?>
																	<option value="<?php echo $row['code_batiment']; ?>"><?php echo $row['nom_batiment']; ?></option>
															<?php }
															} ?>
														</select>
													<?php } ?>
													<?php if ($update == 0) { ?>
														<select class="form-control select2" name="code_batiment[]" multiple="multiple" data-placeholder=" Selectionner" style="width: 100%;">
															<?php while ($row = mysqli_fetch_array($getBatiments)) { ?>
																<option value="<?php echo $row['code_batiment']; ?>"><?php echo $row['nom_batiment']; ?></option>
															<?php } ?>
														</select>
													<?php } ?>
												</div>

												<div class="col-12">
													<label class="col-md-12 form-label">&nbsp;</label>

													<?php if ($update == 0) { ?> <button type="submit" name="validerServicesBatiments" class="btn btn-success form-control" style="color:white;height:50%"><i class="fa fa-check"></i> Valider affectation</button><?php } ?>
													<?php if ($update == 1) { ?>
														<input type="hidden" name="code_serviceEdit" value="<?php echo $code_service; ?>">
														<input type="hidden" name="id_affectation" value="<?php echo $id_affectation; ?>">
														<input type="hidden" name="id_affectation_init" value="<?php echo $id_affectation_init; ?>">
														<button type="submit" name="modifierServiceBatiments" class="btn btn-warning form-control" style="color:black;height:50%"><i class="fa fa-edit"></i> Modifier affectation</button><?php } ?>
													<?php if ($update == 2) { ?>
														<input type="hidden" name="code_serviceEdit" value="<?php echo $code_service; ?>">
														<input type="hidden" name="id_affectation" value="<?php echo $id_affectation; ?>">
														<input type="hidden" name="id_affectation_init" value="<?php echo $id_affectation_init; ?>">
														<button type="submit" name="supprimerServiceBatiments" class="btn btn-danger form-control" style="color:white;height:50%"><i class="fa fa-trash"></i> Supprimer</button><?php } ?>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>

							<div class="col-12">
								<div class="box">
									<div class="box-header with-border">
										<h4 class="box-title">Liste des services par Bâtiment</h4>
									</div>

									<div class="box-body" style="background-color:#FBFBFB">
										<?php include('contents/content-services-batiments.php'); ?>
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