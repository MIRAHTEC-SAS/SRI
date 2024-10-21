<?php
session_start();
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable') {
	$emailUser = $_SESSION['email'];
?>
	<?php
	include('config/app.php');
	// session_start();
	$page = 'Localisation services - Etages';
	include('layouts/head.php');
	$update = 0;

	$getServices = mysqli_query($con, "SELECT * FROM services order by id DESC");
	$getBatiments = mysqli_query($con, "SELECT * FROM batiments order by id DESC");
	$getEtages = mysqli_query($con, "SELECT * FROM etages order by id DESC");

	$getServices2 = mysqli_query($con, "SELECT * FROM services order by id DESC");
	$getBatiments2 = mysqli_query($con, "SELECT * FROM batiments order by id DESC");
	$getEtages2 = mysqli_query($con, "SELECT * FROM etages ORDER BY id DESC");

	if (isset($_GET['edit'])) {
		$update = 1;
		$id_affectation = $_GET['edit'];
		// var_dump($id_affectation);
		// die();
		$getInfos = mysqli_query($con, "SELECT services.libelle, services.sigle, batiments.nom_batiment, batiments.adresse, localisation_services_etage.id, localisation_services_etage.code_service, localisation_services_etage.code_batiment,localisation_services_etage.code_etage,etages.nom_etage
		FROM `localisation_services_etage` 
		INNER JOIN services ON services.code_service=localisation_services_etage.	code_service 
		INNER JOIN batiments ON batiments.code_batiment=localisation_services_etage.code_batiment
		INNER JOIN etages ON etages.code_etage=localisation_services_etage.code_etage
		 WHERE localisation_services_etage.id='$id_affectation'");

		while ($row = mysqli_fetch_array($getInfos)) {
			$id_affectation_init = $row['id'];
			$code_batiment = $row['code_batiment'];
			$code_etage = $row['code_etage'];
			$code_service = $row['code_service'];
			$sigle = $row['sigle'];
			$libelle = $row['libelle'];
			$nom_batiment = $row['nom_batiment'];
			$nom_etage = $row['nom_etage'];
		}
		// echo $id_affectation;die;
		// echo $prestataires;die;


	}
	if (isset($_GET['delete'])) {
		$update = 2;

		$id_affectation = $_GET['delete'];

		$getInfos = mysqli_query($con, "SELECT services.libelle, services.sigle, batiments.nom_batiment, batiments.adresse, localisation_services_etage.id, localisation_services_etage.code_service, localisation_services_etage.code_batiment,localisation_services_etage.code_etage,etages.nom_etage
		FROM `localisation_services_etage` 
		INNER JOIN services ON services.code_service=localisation_services_etage.	code_service 
		INNER JOIN batiments ON batiments.code_batiment=localisation_services_etage.code_batiment
		INNER JOIN etages ON etages.code_etage=localisation_services_etage.code_etage
		 WHERE localisation_services_etage.id='$id_affectation'");

		while ($row = mysqli_fetch_array($getInfos)) {
			$id_affectation_init = $row['id'];
			$code_batiment = $row['code_batiment'];
			$code_etage = $row['code_etage'];
			$code_service = $row['code_service'];
			$sigle = $row['sigle'];
			$libelle = $row['libelle'];
			$nom_batiment = $row['nom_batiment'];
			$nom_etage = $row['nom_etage'];
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

						<div class="row" id="app">
							<div class="col-12">
								<!-- Confirmation box -->
								<?php include('confirmation.php'); ?>
							</div>

							<div class="col-12">
								<div class="box">
									<div class="box-body" style="background-color:#FBFBFB">
										<form action="services/parametrages" method="POST">
											<div class="row">
												<div class="col-5">
													<label class="col-md-12 form-label">Service</label>
													<?php if ($update == 0) { ?>
														<select class="form-control" name="code_service" v-model="newParam.code_service" <?php if ($update == 2) echo 'disabled'; ?>>
															<option v-for="s in services" :value="s.code_service">{{s.libelle}}</option>
														</select>
													<?php } ?>
													<?php if ($update > 0) { ?>
														<select class="form-control" name="code_service">
															<option value="<?php echo $code_service; ?>"><?php echo $libelle; ?></option>
															<?php
															// Exécuter à nouveau la requête pour récupérer les services
															$getServices2 = mysqli_query($con, "SELECT * FROM services");
															while ($row = mysqli_fetch_array($getServices2)) {
																if ($code_service != $row['code_service']) { ?>
																	<option value="<?php echo $row['code_service']; ?>"><?php echo $row['libelle'] . ' ( ' . $row['sigle'] . ' ) '; ?></option>
															<?php }
															} ?>
														</select>
													<?php } ?>
												</div>
												<!-- Batiments -->
												<div class="col-3">
													<label class="col-md-12 form-label">Batiment</label>
													<!-- Batiments... -->
													<?php if ($update == 0) { ?>
														<select class="form-control" name="code_batiment" v-model="newParam.code_batiment">
															<option v-for="b in selectedBatiments" :value="b.code_batiment">{{b.nom_batiment}}</option>
														</select>
													<?php } ?>
													<?php if ($update > 0) { ?>
														<select class="form-control" name="code_batiment" <?php if ($update == 2) echo 'disabled'; ?>>
															<option value="<?php echo $code_batiment; ?>"><?php echo $nom_batiment; ?></option>
															<?php
															// Exécuter la requête à nouveau pour récupérer les bâtiments
															// $getBatiments2 = mysqli_query($con, "SELECT * FROM batiments");
															while ($row = mysqli_fetch_array($getBatiments2)) {
																if ($row['code_batiment'] != $code_batiment) { ?>
																	<option value="<?php echo $row['code_batiment']; ?>"><?php echo $row['nom_batiment']; ?></option>
															<?php }
															} ?>
														</select>
													<?php } ?>


												</div>
												<div class="col-4">
													<label class="col-md-12 form-label">Etages</label>
													<!-- Etages... -->
													<?php if ($update == 0) { ?>
														<select class="form-control select2" name="codes_etage[]" multiple="multiple" data-placeholder=" Selectionner" style="width: 100%;">
															<option v-for="e in selectedEtages" :value="e.code_etage">{{e.nom_etage}}</option>
														</select>
													<?php } ?>
													<?php if ($update > 0) { ?>
														<select class="form-control" name="code_etage[]" <?php if ($update == 2) echo 'disabled'; ?>>
															<option value="<?php echo $code_etage; ?>"><?php echo $nom_etage; ?></option>
															<?php while ($row = mysqli_fetch_array($getBatiments2)) {
																if ($row['code_etage'] != $code_etage) { ?>
																	<option value="<?php echo $row['code_etage']; ?>"><?php echo $row['nom_etage']; ?></option>
															<?php }
															} ?>
														</select>
													<?php } ?>

												</div>

												<div class="col-12">
													<label class="col-md-12 form-label">&nbsp;</label>

													<?php if ($update == 0) { ?> <button type="submit" name="validerServicesBatimentsEtages" class="btn btn-success form-control" style="color:white;height:50%"><i class="fa fa-check"></i> Valider affectation</button><?php } ?>
													<?php if ($update == 1) { ?>
														<input type="hidden" name="id_affectation" value="<?php echo $id_affectation; ?>">
														<input type="hidden" name="id_affectation_init" value="<?php echo $id_affectation_init; ?>">
														<button type="submit" name="modifierServiceBatimentsEtages" class="btn btn-warning form-control" style="color:black;height:50%"><i class="fa fa-edit"></i> Modifier affectation</button><?php } ?>
													<?php if ($update == 2) { ?>
														<input type="hidden" name="id_affectation" value="<?php echo $id_affectation; ?>">
														<input type="hidden" name="id_affectation_init" value="<?php echo $id_affectation_init; ?>">
														<button type="submit" name="supprimerServiceBatimentsEtages" class="btn btn-danger form-control" style="color:white;height:50%"><i class="fa fa-trash"></i> Supprimer</button><?php } ?>
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
										<?php include('contents/content-services-etages.php'); ?>
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