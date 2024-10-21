<?php
session_start();
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable') {
	$emailUser = $_SESSION['email'];
?>
	<?php
	include('config/app.php');
	// session_start();
	$page = 'Services';
	include('layouts/head.php');
	$update = 0;
	if (isset($_GET['edit'])) {
		$update = 1;

		$code_service = $_GET['edit'];

		$getServices = mysqli_query($con, "SELECT services.code_service, services.libelle, services.sigle, ministeres.libelle as libelleMinistere, ministeres.codeMinistere FROM `services` INNER JOIN ministeres ON ministeres.codeMinistere=services.codeMinistere WHERE services.code_service='$code_service'");

		while ($row = mysqli_fetch_array($getServices)) {
			$code_service_init = $row['code_service'];
			$libelle = $row['libelle'];
			$sigle = $row['sigle'];
			$libelleMinistere = $row['libelleMinistere'];
			$code_ministere = $row['codeMinistere'];
		}
	}
	if (isset($_GET['delete'])) {
		$update = 2;

		$code_service = $_GET['delete'];

		$getServices = mysqli_query($con, "SELECT services.code_service, services.libelle, services.sigle, ministeres.libelle as libelleMinistere, ministeres.codeMinistere FROM `services` INNER JOIN ministeres ON ministeres.codeMinistere=services.codeMinistere WHERE services.code_service='$code_service'");

		while ($row = mysqli_fetch_array($getServices)) {
			$code_service_init = $row['code_service'];
			$libelle = $row['libelle'];
			$sigle = $row['sigle'];
			$libelleMinistere = $row['libelleMinistere'];
			$code_ministere = $row['codeMinistere'];
		}
	}
	$getMinisteres = mysqli_query($con, "SELECT * FROM ministeres");
	$getMinisteres2 = mysqli_query($con, "SELECT * FROM ministeres");


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
											<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
											<li class="breadcrumb-item" aria-current="page">Referentiel</li>
											<li class="breadcrumb-item active" aria-current="page">services</li>
										</ol>
									</nav>
								</div>
							</div>
							<div class="text-end">
								<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-success mt-10 d-block text-center"><i class="fa fa-plus-circle"></i> Nouveau service</a>
							</div>
							<!-- Popup Model Plase Here -->
							<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header" style="background-color:#DFDFDE">
											<h4 class="modal-title" id="myModalLabel">Ajout d'un nouveau service</h4>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body" style="background-color:#F7F5F2">
											<form action="controllers/referentielController" method="POST">
												<div class="form-group">

													<label class="col-md-12 form-label">Ministere</label>
													<div class="col-md-12">
														<select name="code_ministere" class="form-control">
															<?php while ($row = mysqli_fetch_array($getMinisteres)) { ?>
																<option value="<?php echo $row['codeMinistere']; ?>"><?php echo $row['libelle']; ?></option>
															<?php } ?>
														</select>
													</div>
													</br>
													<label class="col-md-12 form-label">Code</label>
													<div class="col-md-12">
														<input type="text" name="code_service" class="form-control" placeholder="Code du service">
													</div>
													</br>

													<label class="col-md-12 form-label">Service</label>
													<div class="col-md-12">
														<input type="text" name="libelle" class="form-control" placeholder="Libelle du service">
													</div>
													</br>
													<label class="col-md-12 form-label">Sigle</label>
													<div class="col-md-12">
														<input type="text" name="sigle" class="form-control" placeholder="Sigle">
													</div>
													</br>
												</div>
												<div class="modal-footer">
													<button type="submit" name="ajouterService" class="btn btn-success">Ajouter</button>
													<button type="button" class="btn btn-danger float-end" data-bs-dismiss="modal">Annuler</button>
												</div>
											</form>
										</div>

									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
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
							<?php if ($update > 0) { ?>
								<div class="col-12">
									<div class="box">
										<div class="box-header with-border">
											<h4 class="box-title">Edition</h4>
										</div>
										<div class="box-body" style="background-color:#FBFBFB">
											<form action="controllers/referentielController" method="POST">
												<div class="row">
													<div class="col-2">
														<label class="col-md-12 form-label">Code Service</label>
														<input type="text" name="code_service" class="form-control" value="<?php echo $code_service; ?>" <?php if ($update == 2) echo 'disabled'; ?>>
													</div>
													<div class="col-4">
														<label class="col-md-12 form-label">Libelle</label>
														<input type="text" name="libelle" value="<?php echo $libelle; ?>" class="form-control" <?php if ($update == 2) echo 'disabled'; ?>>
													</div>
													<div class="col-2">
														<label class="col-md-12 form-label">Sigle</label>
														<input type="text" name="sigle" value="<?php echo $sigle; ?>" class="form-control" <?php if ($update == 2) echo 'disabled'; ?>>
														<input type="hidden" name="code_service_init" value="<?php echo $code_service_init; ?>">
														<!-- <input type="hidden" name="code_service" value="<?php //echo $code_service; 
																																									?>"> -->

													</div>
													<div class="col-4">
														<label class="col-md-12 form-label">Ministere</label>
														<select name="code_ministere" class="form-control">
															<option value="<?php echo $code_ministere; ?>"><?php echo $libelleMinistere; ?></option>
															<?php while ($row = mysqli_fetch_array($getMinisteres2)) {
																$code = $row['codeMinistere'];
																if ($code != $code_ministere) { ?>
																	<option value="<?php echo $row['codeMinistere']; ?>"><?php echo $row['libelle']; ?></option>
															<?php }
															} ?>
														</select>
													</div>
												</div>
												</br>
												<div class="row">
													</br>
													<div class="container-fluid">
														<?php if ($update == 1) { ?> <button type="submit" name="modifierService" class="btn btn-warning form-control" style="color:black;height:90%"><i class="fa fa-edit"></i> Modifier</button><?php } ?>
														<?php if ($update == 2) { ?> <button type="submit" name="supprimerService" class="btn btn-danger form-control" style="color:white;height:90%"><i class="fa fa-trash"></i> Supprimer</button><?php } ?>
													</div>
												</div>
										</div>
										</form>
									</div>
								</div>
						</div>
					<?php } ?>
					<div class="col-12">
						<div class="box">
							<div class="box-header with-border">
								<h4 class="box-title">Liste des services</h4>
							</div>

							<div class="box-body" style="background-color:#FBFBFB">
								<?php include('contents/content-services.php'); ?>
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