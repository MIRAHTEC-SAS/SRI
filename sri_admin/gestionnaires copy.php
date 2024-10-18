<?php
session_start();
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable') {
	$emailUser = $_SESSION['email'];
?>
	<?php
	include('config/app.php');
	session_start();
	$page = 'Gestionnaires';
	include('layouts/head.php');
	$update = 0;
	if (isset($_GET['edit'])) {
		$update = 1;

		$code_ministere = $_GET['edit'];

		$getInfosMinisteres = mysqli_query($con, "SELECT * FROM ministeres where codeMinistere='$code_ministere'");
		while ($row = mysqli_fetch_array($getInfosMinisteres)) {
			$libelle = $row['libelle'];
			$sigle = $row['acronyme'];
		}
	}
	if (isset($_GET['delete'])) {
		$update = 2;

		$code_ministere = $_GET['delete'];

		$getInfosMinisteres = mysqli_query($con, "SELECT * FROM ministeres where codeMinistere='$code_ministere'");
		while ($row = mysqli_fetch_array($getInfosMinisteres)) {
			$libelle = $row['libelle'];
			$sigle = $row['acronyme'];
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
								<h4 class="page-title">Gestionnaires</h4>
								<div class="d-inline-block align-items-center">
									<nav>
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
											<li class="breadcrumb-item" aria-current="page">Referentiel</li>
											<li class="breadcrumb-item active" aria-current="page">Gestionnaires</li>
										</ol>
									</nav>
								</div>
							</div>
							<div class="text-end">
								<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-success mt-10 d-block text-center"><i class="fa fa-plus-circle"></i> Nouveau Gestionnaire</a>
							</div>
							<!-- Popup Model Plase Here -->
							<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header" style="background-color:#DFDFDE">
											<h4 class="modal-title" id="myModalLabel">Ajout d'un nouveau gestionnaire</h4>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body" style="background-color:#F7F5F2">
											<form action="controllers/referentielController.php" method="POST">
												<div class="form-group">
													<!-- <label class="form-label">Prenom</label> -->
													<div class="input-group mb-3">
														<span class="input-group-text"><i class="ti-user"></i></span>
														<input type="text" name="prenom" class="form-control" placeholder="Prenom">
													</div>
													<!-- <label class="form-label">Nom</label> -->
													<div class="input-group mb-3">
														<span class="input-group-text"><i class="ti-user"></i></span>
														<input type="text" name="nom" class="form-control" placeholder="Nom de famille">
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
													<div class="input-group mb-3">
														<span class="input-group-text"><i class="ti-layout-grid2"></i></span>
														<input type="email" name="email" class="form-control" placeholder="Email">
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" name="ajouterGestionnaire" class="btn btn-success">Ajouter</button>
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
														<input type="text" name="code" class="form-control" value="<?php echo $code_ministere; ?>" <?php if ($update == 2) echo 'disabled'; ?>>
													</div>
													<div class="col-5">
														<input type="text" name="libelle" value="<?php echo $libelle; ?>" class="form-control" <?php if ($update == 2) echo 'disabled'; ?>>
													</div>
													<div class="col-2">
														<input type="text" name="sigle" value="<?php echo $sigle; ?>" class="form-control" <?php if ($update == 2) echo 'disabled'; ?>>
														<input type="hidden" name="code_ministere" value="<?php echo $code_ministere; ?>">
													</div>
													<div class="col-2">
														<?php if ($update == 1) { ?> <button type="submit" name="modifierMinistere" class="btn btn-warning form-control" style="color:black;height:90%"><i class="fa fa-edit"></i> Modifier</button><?php } ?>
														<?php if ($update == 2) { ?> <button type="submit" name="supprimerMinistere" class="btn btn-danger form-control" style="color:white;height:90%"><i class="fa fa-trash"></i> Supprimer</button><?php } ?>
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
										<h4 class="box-title">Liste des gestionnaires de service</h4>
									</div>

									<div class="box-body" style="background-color:#FBFBFB">
										<?php include('contents/content-gestionnaires.php'); ?>
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

	</body>

	</html>
<?php } else {
	header('Location: ../sri_admin');
}  ?>