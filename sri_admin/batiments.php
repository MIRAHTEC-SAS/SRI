<?php
include('config/app.php');
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable') {
	$emailUser = $_SESSION['email'];
?>
	<?php
	$page = 'Bâtiments';
	include('layouts/head.php');
	$update = 0;
	if (isset($_GET['edit'])) {
		$update = 1;
		$code_batiment = $_GET['edit'];
		$getInfosBatiment = mysqli_query($con, "SELECT * FROM batiments where code_batiment='$code_batiment'");
		while ($row = mysqli_fetch_array($getInfosBatiment)) {
			$nom_batiment = $row['nom_batiment'];
			$contact_batiment = $row['contact'];
			$adresse_batiment = $row['adresse'];
		}
	}
	if (isset($_GET['delete'])) {
		$update = 2;
		$code_batiment = $_GET['delete'];
		$getInfosBatiment = mysqli_query($con, "SELECT * FROM batiments where code_batiment='$code_batiment'");
		while ($row = mysqli_fetch_array($getInfosBatiment)) {
			$nom_batiment = $row['nom_batiment'];
			$contact_batiment = $row['contact'];
			$adresse_batiment = $row['adresse'];
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
								<h4 class="page-title">Bâtiments</h4>
								<div class="d-inline-block align-items-center">
									<nav>
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
											<li class="breadcrumb-item" aria-current="page">Referentiel</li>
											<li class="breadcrumb-item active" aria-current="page">Bâtiments</li>
										</ol>
									</nav>
								</div>
							</div>
							<div class="text-end">
								<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-success mt-10 d-block text-center"><i class="fa fa-plus-circle"></i> Nouveau Bâtiment</a>
							</div>
							<!-- Popup Model Plase Here -->
							<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header" style="background-color:#DFDFDE">
											<h4 class="modal-title" id="myModalLabel">Ajout d'un nouveau bâtiment</h4>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body" style="background-color:#F7F5F2">
											<form action="controllers/referentielController.php" method="POST">
												<div class="form-group">
													<label class="col-md-12 form-label">Nom</label>
													<div class="col-md-12">
														<input type="text" name="nom_batiment" class="form-control" placeholder="Nom du batiment">
													</div>
													</br>

													<label class="col-md-12 form-label">Contact</label>
													<div class="col-md-12">
														<input type="number" name="contact_batiment" class="form-control" placeholder="Telephone">
													</div>
													</br>

													<div class="form-group">
														<label class="col-md-12 form-label">Adresse</label>
														<div class="col-md-12">
															<textarea name="adresse_batiment" class="form-control" placeholder=""></textarea>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" name="ajouterBatiment" class="btn btn-success">Ajouter</button>
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
										<div class="box-body">
											<form action="controllers/referentielController.php" method="POST">
												<div class="row">
													<div class="col-3">
														<input type="text" name="nom_batiment" class="form-control" value="<?php echo $nom_batiment; ?>" <?php if ($update == 2) echo 'disabled'; ?>>
													</div>
													<div class="col-5">
														<input type="text" name="adresse_batiment" value="<?php echo $adresse_batiment; ?>" class="form-control" <?php if ($update == 2) echo 'disabled'; ?>>
													</div>
													<div class="col-2">
														<input type="number" name="contact_batiment" value="<?php echo $contact_batiment; ?>" class="form-control" <?php if ($update == 2) echo 'disabled'; ?>>
														<input type="hidden" name="code_batiment" value="<?php echo $code_batiment; ?>">
													</div>
													<div class="col-2">
														<?php if ($update == 1) { ?> <button type="submit" name="modifierBatiment" class="btn btn-warning form-control" style="color:black;height:90%"><i class="fa fa-edit"></i> Modifier</button><?php } ?>
														<?php if ($update == 2) { ?> <button type="submit" name="supprimerBatiment" class="btn btn-danger form-control" style="color:white;height:90%"><i class="fa fa-trash"></i> Supprimer</button><?php } ?>
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
										<h4 class="box-title">Liste des batiments</h4>
									</div>

									<div class="box-body">
										<?php include('contents/content-batiments.php'); ?>
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