<?php
include('config/app.php');
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'prestataire') {
	$emailUser = $_SESSION['email'];
	$getInfosprestataires = mysqli_query($con, "SELECT * FROM `prestataires_interne` order by id desc");

?>
	<?php
	$page = 'prestataires';
	include('layouts/head.php');
	$update = 0;
	if (isset($_GET['edit'])) {
		$update = 1;

		$matricule_presta = $_GET['edit'];

		$getInfosprestataire = mysqli_query($con, "SELECT * FROM prestataires where matricule_presta='$matricule_presta'");
		while ($row = mysqli_fetch_array($getInfosprestataire)) {
			$denomination = $row['denomination'];
			$adresse = $row['adresse'];
			$telephone = $row['telephone'];
			$email = $row['email'];
		}
	}
	if (isset($_GET['delete'])) {
		$update = 2;

		$matricule_presta = $_GET['delete'];

		$getInfosprestataire = mysqli_query($con, "SELECT * FROM prestataires where matricule_presta='$matricule_presta'");
		while ($row = mysqli_fetch_array($getInfosprestataire)) {
			$denomination = $row['denomination'];
			$adresse = $row['adresse'];
			$telephone = $row['telephone'];
			$email = $row['email'];
		}
	}

	// $getDomaines = mysqli_query($con, "SELECT * FROM `prestataires_incidents` INNER JOIN type_incidents on type_incidents.code_incident=prestataires_incidents.code_incident WHERE prestataires_incidents.matricule_prestataire='$matricule_presta'");

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
								<h4 class="page-title">prestataires</h4>
								<div class="d-inline-block align-items-center">
									<nav>
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
											<li class="breadcrumb-item" aria-current="page">Referentiel</li>
											<li class="breadcrumb-item active" aria-current="page">prestataires</li>
										</ol>
									</nav>
								</div>
							</div>
							<div class="text-end">
								<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-success mt-10 d-block text-center"><i class="fa fa-plus-circle"></i> Nouveau Prestataire</a>
							</div>
							<!-- Popup Model Plase Here -->
							<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header" style="background-color:#DFDFDE">
											<h4 class="modal-title" id="myModalLabel">Ajout d'un nouveau Prestataire</h4>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body" style="background-color:#F7F5F2">
											<form action="controllers/referentielController.php" method="POST">
												<div class="form-group">
													<!-- <label class="form-label">denomination</label> -->
													<div class="input-group mb-3">
														<span class="input-group-text"><i class="ti-envelope"></i></span>
														<input type="text" name="denomination" class="form-control" placeholder="Denomination">
													</div>
													<!-- <label class="form-label">Nom</label> -->
													<div class="input-group mb-3">
														<span class="input-group-text"><i class="ti-location-pin"></i></span>
														<input type="text" name="adresse" class="form-control" placeholder="Adresse">
													</div>
													<!-- <label class="form-label">Telephone</label> -->
													<div class="input-group mb-3">
														<span class="input-group-text"><i class="ti-mobile"></i></span>
														<input type="number" name="telephone" class="form-control" placeholder="Telephone">
													</div>
													<!-- <label class="form-label">Email</label> -->
													<div class="input-group mb-3">
														<span class="input-group-text"><i class="ti-email"></i></span>
														<input type="email" name="email" class="form-control" placeholder="Email">
													</div>

												</div>
												<div class="modal-footer">
													<button type="submit" name="ajouterPrestataire" class="btn btn-success">Ajouter</button>
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
											<form action="controllers/referentielController.php" method="POST">
												<div class="row">
													<div class="col-4">
														<label class="col-md-12 form-label">Denomination</label>
														<input type="text" name="denomination" class="form-control" value="<?php echo $denomination; ?>" <?php if ($update == 2) echo 'disabled'; ?>>
													</div>

													<div class="col-4">
														<label class="col-md-12 form-label">Adresse</label>
														<input type="text" name="adresse" value="<?php echo $adresse; ?>" class="form-control" <?php if ($update == 2) echo 'disabled'; ?>>
													</div>
													<div class="col-2">
														<label class="col-md-12 form-label">Email</label>
														<input type="text" name="email" value="<?php echo $email; ?>" class="form-control" <?php if ($update == 2) echo 'disabled'; ?>>
														<!-- <input type="hidden" name="email" value="<?php echo $email; ?>"> -->
													</div>
													<div class="col-2">
														<label class="col-md-12 form-label">Telephone</label>
														<input type="text" name="telephone" value="<?php echo $telephone; ?>" class="form-control" <?php if ($update == 2) echo 'disabled'; ?>>
														<input type="hidden" name="matricule_presta" value="<?php echo $matricule_presta; ?>">
													</div>
												</div>
												</br>


												<div class="row">
													<div class="container-fluid">

														<?php if ($update == 1) { ?> <button type="submit" name="modifierPrestataire" class="btn btn-warning form-control" style="color:black;height:90%"><i class="fa fa-edit"></i> Modifier</button><?php } ?>
														<?php if ($update == 2) { ?> <button type="submit" name="supprimerPrestataire" class="btn btn-danger form-control" style="color:white;height:90%"><i class="fa fa-trash"></i> Supprimer</button><?php } ?>
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
								<h4 class="box-title">Liste des Prestataires par domaine d'intervention</h4>
							</div>

							<div class="box-body" style="background-color:#FBFBFB">
								<?php include('contents/content-prestataires.php'); ?>
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


		<?php include('layouts/js.php'); ?>
		<script src="../../../assets/vendor_components/select2/dist/js/select2.full.js"></script>
		<script src="../src/js/pages/advanced-form-element.js"></script>

	</body>

	</html>
<?php } else {
	header('Location: ../sri_admin');
}  ?>