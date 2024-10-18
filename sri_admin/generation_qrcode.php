<?php
session_start();
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable') {
	$emailUser = $_SESSION['email'];
?>
	<?php
	include('config/app.php');
	// session_start();
	$page = 'Generation QRCODE';
	include('layouts/head.php');
	$update = 0;

	$getServices = mysqli_query($con, "SELECT * FROM services order by id DESC");
	$getBatiments = mysqli_query($con, "SELECT * FROM batiments order by id DESC");

	$getServices2 = mysqli_query($con, "SELECT * FROM services order by id DESC");
	$getBatiments2 = mysqli_query($con, "SELECT * FROM batiments order by id DESC");

	if (isset($_GET['delete'])) {
		$update = 2;

		$id_qr = $_GET['delete'];

		$getInfos = mysqli_query($con, "SELECT qrcodes_sri.id, services.libelle, services.sigle, batiments.nom_batiment, batiments.adresse, etages.nom_etage, qrcodes_sri.lien
			FROM `qrcodes_sri` 
			INNER JOIN services ON services.code_service=qrcodes_sri.code_service 
			INNER JOIN batiments ON batiments.code_batiment=qrcodes_sri.code_batiment
			INNER JOIN etages ON etages.code_etage=qrcodes_sri.code_etage WHERE qrcodes_sri.id='$id_qr'");

		while ($row = mysqli_fetch_array($getInfos)) {
			$nom_batiment = $row['nom_batiment'];
			$nom_etage = $row['nom_etage'];
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
								<h4 class="page-title">Parametrages</h4>
								<div class="d-inline-block align-items-center">
									<nav>
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-wrench"></i></a></li>
											<li class="breadcrumb-item" aria-current="page">QR CODE</li>
											<li class="breadcrumb-item active" aria-current="page">Generation</li>
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

						<div class="row" id="app">
							<div class="col-12">
								<!-- Confirmation box -->
								<?php include('confirmation.php'); ?>
							</div>

							<div class="col-12">
								<div class="box">
									<div class="box-body" style="background-color:#FBFBFB">
										<form action="genere_qrcode_sri.php" method="POST">
											<div class="row">
												<div class="col-5">
													<label class="col-md-12 form-label"><b>Service</b></label>
													<?php if ($update == 0) { ?>
														<select class="form-control" name="code_service" v-model="newParam.code_service" <?php if ($update == 2) echo 'disabled'; ?>>
															<option v-for="s in services" :value="s.code_service">{{s.libelle}}</option>
														</select>
													<?php } ?>
													<?php if ($update > 0) { ?>
														<select class="form-control" name="code_service" <?php if ($update == 2) echo 'disabled'; ?>>
															<option value="<?php echo $sigle; ?>"><?php echo $sigle; ?></option>
															<?php while ($row = mysqli_fetch_array($getServices2)) {
																$code = $row['code_service'];
																if ($code_service != $code) { ?>
																	<option value="<?php echo $row['code_service']; ?>"><?php echo $row['libelle'] . ' ( ' . $row['sigle'] . ' ) '; ?></option>
															<?php }
															} ?>
														<?php } ?>
														</select>
												</div>
												<!-- Batiments -->
												<div class="col-4">
													<label class="col-md-12 form-label"><b>Batiment</b></label>
													<!-- Batiments... -->
													<?php if ($update == 0) { ?>
														<select class="form-control" name="code_batiment" v-model="newParam.code_batiment">
															<option v-for="b in selectedBatiments" :value="b.code_batiment">{{b.nom_batiment}}</option>
														</select>
													<?php } ?>
													<?php if ($update > 0) { ?>
														<select class="form-control" name="code_service" <?php if ($update == 2) echo 'disabled'; ?>>
															<option value="<?php echo $code_service; ?>"><?php echo $nom_batiment; ?></option>
															<?php while ($row = mysqli_fetch_array($getServices2)) {
																$code = $row['code_service'];
																if ($code_service != $code) { ?>
																	<option value="<?php echo $row['code_service']; ?>"><?php echo $row['libelle'] . ' ( ' . $row['sigle'] . ' ) '; ?></option>
															<?php }
															} ?>
														</select>
													<?php } ?>

												</div>
												<div class="col-3">
													<label class="col-md-12 form-label"><b>Etages</b></label>
													<!-- Etages... -->
													<?php if ($update == 0) { ?>
														<select class="form-control" name="code_etage" data-placeholder=" Selectionner" style="width: 100%;">
															<option v-for="e in selectedEtages" :value="e.code_etage">{{e.nom_etage}}</option>
														</select>
													<?php } ?>
													<?php if ($update > 0) { ?>
														<select class="form-control" name="code_batiment" <?php if ($update == 2) echo 'disabled'; ?>>
															<option value="<?php echo $nom_etage; ?>"><?php echo $nom_etage; ?></option>
															<?php while ($row = mysqli_fetch_array($getBatiments2)) {
																if ($row['code_batiment'] != $code_batiment) { ?>
																	<option value="<?php echo $row['code_batiment']; ?>"><?php echo $row['nom_batiment']; ?></option>
															<?php }
															} ?>
														</select>
													<?php } ?>

												</div>

												<div class="col-12">
													<label class="col-md-12 form-label">&nbsp;</label>
													<?php if ($update == 0) { ?> <button type="submit" name="genererQrcode" class="btn btn-success form-control" style="color:white;height:50%"><i class="fa fa-check"></i> Générer le QR CODE</button><?php } ?>
													<?php if ($update == 2) { ?>
														<input type="hidden" name="id_qr" value="<?php echo $id_qr; ?>">
														<input type="hidden" name="id_affectation_init" value="<?php echo $id_affectation_init; ?>">

														<button type="submit" name="supprimerQrcode" class="btn btn-danger form-control" style="color:white;height:50%"><i class="fa fa-trash"></i> Supprimer le QR CODE</button><?php } ?>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>

							<div class="col-12">
								<div class="box">
									<div class="box-header with-border">
										<h4 class="box-title">Liste des QRCODES disponibles</h4>
									</div>

									<div class="box-body" style="background-color:#FBFBFB">
										<?php include('contents/content-qrcode.php'); ?>
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

			<!-- Vue & Axios -->
			<?php include('lib.php'); ?>

			<!--  VUE JS -->
			<?php include('vuejs/scriptParametrage.php'); ?>

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