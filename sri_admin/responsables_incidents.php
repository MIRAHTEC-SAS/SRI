<?php
session_start();
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable') {
	$emailUser = $_SESSION['email'];
?>
	<?php
	include('config/app.php');
	// session_start();
	$page = 'Responsable Incidents';
	include('layouts/head.php');
	$update = 0;

	$getResponsables = mysqli_query($con, "SELECT * FROM responsables_dage order by id DESC");
	$getTypeIncident = mysqli_query($con, "SELECT * FROM type_incidents order by id DESC");

	$getResponsables2 = mysqli_query($con, "SELECT * FROM responsables_dage order by id DESC");
	$getTypeIncident2 = mysqli_query($con, "SELECT * FROM type_incidents order by id DESC");

	if (isset($_GET['edit'])) {
		$update = 1;

		$id_affectation = $_GET['edit'];

		$getInfos = mysqli_query($con, "SELECT 
			responsables_incidents.id,
			responsables_incidents.code_incident,
			type_incidents.type_incident,
			type_incidents.couleur,
			responsables_dage.matricule,
			responsables_dage.prenom,
			responsables_dage.nom
			FROM `responsables_incidents` INNER JOIN type_incidents on type_incidents.code_incident=responsables_incidents.code_incident INNER JOIN responsables_dage on responsables_dage.matricule=responsables_incidents.matricule_responsable WHERE responsables_incidents.id='$id_affectation'");
		while ($row = mysqli_fetch_array($getInfos)) {
			$code_incident = $row['code_incident'];
			$type_incident = $row['type_incident'];
			$matricule_responsable = $row['matricule'];
			$responsable_incident = $row['prenom'] . ' ' . $row['nom'];
		}
		// echo $id_affectation;die;
		// echo $responsable_incident;die;


	}
	if (isset($_GET['delete'])) {
		$update = 2;

		$id_affectation = $_GET['delete'];

		$getInfos = mysqli_query($con, "SELECT 
			responsables_incidents.id,
			responsables_incidents.code_incident,
			type_incidents.type_incident,
			type_incidents.couleur,
			responsables_dage.matricule,
			responsables_dage.prenom,
			responsables_dage.nom
			FROM `responsables_incidents` INNER JOIN type_incidents on type_incidents.code_incident=responsables_incidents.code_incident INNER JOIN responsables_dage on responsables_dage.matricule=responsables_incidents.matricule_responsable WHERE responsables_incidents.id='$id_affectation'");
		while ($row = mysqli_fetch_array($getInfos)) {
			$code_incident = $row['code_incident'];
			$type_incident = $row['type_incident'];
			$matricule_responsable = $row['matricule'];
			$responsable_incident = $row['prenom'] . ' ' . $row['nom'];
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
								<h4 class="page-title">Affections des responsables DAGE</h4>
								<div class="d-inline-block align-items-center">
									<nav>
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
											<li class="breadcrumb-item" aria-current="page">Affectation</li>
											<li class="breadcrumb-item active" aria-current="page">Responsables par type d'incident</li>
										</ol>
									</nav>
								</div>
							</div>
							<div class="text-end">
								<!-- <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-success mt-10 d-block text-center"><i class="fa fa-plus-circle"></i> Nouveau Ministere</a> -->
							</div>
							<!-- Popup Model Plase Here -->
							<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header" style="background-color:#DFDFDE">
											<h4 class="modal-title" id="myModalLabel">Ajout d'un nouveau ministere</h4>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body" style="background-color:#F7F5F2">
											<form action="controllers/referentielController.php" method="POST">
												<div class="form-group">
													<label class="col-md-12 form-label">Code</label>
													<div class="col-md-12">
														<input type="text" name="code" class="form-control" placeholder="Code du ministere">
													</div>
													</br>

													<label class="col-md-12 form-label">Libelle</label>
													<div class="col-md-12">
														<input type="text" name="libelle" class="form-control" placeholder="Libelle">
													</div>
													</br>
													<label class="col-md-12 form-label">Sigle</label>
													<div class="col-md-12">
														<input type="text" name="sigle" class="form-control" placeholder="Sigle">
													</div>
													</br>
												</div>
												<div class="modal-footer">
													<button type="submit" name="ajouterMinistere" class="btn btn-success">Ajouter</button>
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

							<div class="col-12">
								<div class="box">
									<div class="box-body" style="background-color:#FBFBFB">
										<form action="services/parametrages.php" method="POST">
											<div class="row">
												<div class="col-5">
													<label class="col-md-12 form-label">Responsable</label>
													<select class="form-control" name="responsable" <?php if ($update == 2) echo 'disabled'; ?>>
														<?php if ($update > 0) { ?>
															<option value="<?php echo $matricule_responsable; ?>"><?php echo $responsable_incident; ?></option>
															<?php while ($row = mysqli_fetch_array($getResponsables2)) {
																$matricule = $row['matricule'];
																if ($matricule_responsable != $matricule) { ?>
																	<option value="<?php echo $row['matricule'];; ?>"><?php echo $row['prenom'] . ' ' . $row['nom']; ?></option>
															<?php }
															} ?>
														<?php } ?>
														<?php if ($update == 0) while ($row = mysqli_fetch_array($getResponsables)) { ?>

															<option value="<?php echo $row['matricule']; ?>"><?php echo $row['prenom'] . ' ' . $row['nom']; ?></option>
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
														<select class="form-control select2" name="typesIncident[]" multiple="multiple" data-placeholder="Selectionner" style="width: 100%;">
															<?php while ($row = mysqli_fetch_array($getTypeIncident)) { ?>
																<option value="<?php echo $row['code_incident']; ?>"><?php echo $row['type_incident']; ?></option>
															<?php } ?>
														</select>
													<?php } ?>
												</div>

												<div class="col-3">
													<label class="col-md-12 form-label">&nbsp;</label>
													<?php if ($update == 0) { ?> <button type="submit" name="parametrerResponsables" class="btn btn-success form-control" style="color:white;height:50%"><i class="fa fa-check"></i> Valider affectation</button><?php } ?>
													<?php if ($update == 1) { ?>
														<input type="hidden" name="id_affectation" value="<?php echo $id_affectation; ?>">
														<button type="submit" name="modifierResponsables" class="btn btn-warning form-control" style="color:black;height:50%"><i class="fa fa-edit"></i> Modifier affectation</button><?php } ?>
													<?php if ($update == 2) { ?>
														<input type="hidden" name="id_affectation" value="<?php echo $id_affectation; ?>">
														<button type="submit" name="supprimerResponsables" class="btn btn-danger form-control" style="color:white;height:50%"><i class="fa fa-trash"></i> Supprimer</button><?php } ?>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>

							<div class="col-12">
								<div class="box">
									<div class="box-header with-border">
										<h4 class="box-title">Liste des responsables dage par domaine d'intervention</h4>
									</div>

									<div class="box-body" style="background-color:#FBFBFB">
										<?php include('contents/content-responsables-incidents.php'); ?>
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