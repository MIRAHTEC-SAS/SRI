<?php
session_start();
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable') {
	$emailUser = $_SESSION['email'];
	//   $getContacts = mysqli_query($con, "SELECT * FROM `contacts_dage` order by id desc");

?>
	<?php
	include('config/app.php');
	session_start();
	$page = 'Contacts';
	include('layouts/head.php');
	$update = 0;

	if (isset($_GET['edit']) && isset($_GET['type'])) {
		$update = 1;
		$idE = $_GET['edit'];
		$typeE = $_GET['type'];

		if ($typeE == 'normal') {
			$getInfosContact = mysqli_query($con, "SELECT * FROM contacts_dage where id='$idE'");
			while ($row = mysqli_fetch_array($getInfosContact)) {
				$prenom = $row['prenom'];
				$nom = $row['nom'];
				$telephone = $row['telephone'];
				$email = $row['email'];
				$contactE = $prenom . ' ' . $nom;
			}
		} else {
			$getInfosContact = mysqli_query($con, "SELECT * FROM contacts_dage_urgent where id='$idE'");
			while ($row = mysqli_fetch_array($getInfosContact)) {
				$prenom = $row['prenom'];
				$nom = $row['nom'];
				$telephone = $row['telephone'];
				$email = $row['email'];
				$contactE = $prenom . ' ' . $nom;
			}
		}
	}
	if (isset($_GET['delete'])) {
		$update = 2;

		$idE = $_GET['delete'];
		$typeE = $_GET['type'];

		if ($typeE == 'normal') {
			$getInfosContact = mysqli_query($con, "SELECT * FROM contacts_dage where id='$idE'");
			while ($row = mysqli_fetch_array($getInfosContact)) {
				$prenom = $row['prenom'];
				$nom = $row['nom'];
				$telephone = $row['telephone'];
				$email = $row['email'];
				$contactE = $prenom . ' ' . $nom;
			}
		} else {
			$getInfosContact = mysqli_query($con, "SELECT * FROM contacts_dage_urgent where id='$idE'");
			while ($row = mysqli_fetch_array($getInfosContact)) {
				$prenom = $row['prenom'];
				$nom = $row['nom'];
				$telephone = $row['telephone'];
				$email = $row['email'];
				$contactE = $prenom . ' ' . $nom;
			}
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
								<h4 class="page-title">Contacts</h4>
								<div class="d-inline-block align-items-center">
									<nav>
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
											<li class="breadcrumb-item" aria-current="page">Referentiel</li>
											<li class="breadcrumb-item active" aria-current="page">Contacts</li>
										</ol>
									</nav>
								</div>
							</div>
							<div class="text-end">
								<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-success mt-10 d-block text-center"><i class="fa fa-plus-circle"></i> Nouveau Contact</a>
							</div>
							<!-- Popup Model Plase Here -->
							<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header" style="background-color:#DFDFDE">
											<h4 class="modal-title" id="myModalLabel">Ajout d'un contact DAGE</h4>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body" style="background-color:#F7F5F2">
											<form action="controllers/contactController.php" method="POST">
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
														<input type="text" maxlength="9" name="telephone" class="form-control" placeholder="Telephone">
													</div>
													<!-- <label class="form-label">Email</label> -->
													<div class="input-group mb-3">
														<span class="input-group-text"><i class="ti-email"></i></span>
														<input type="email" name="email" class="form-control" placeholder="Email">
													</div>
													<div class="input-group mb-3">
														<span class="input-group-text"><i class="ti-exchange-vertical"></i></span>
														<!-- <input type="email" name="type_contact" class="form-control" placeholder="Email"> -->
														<select name="type_contact" class="form-control">
															<option value="normal">NORMAL</option>
															<option value="urgent">URGENT</option>
														</select>
													</div>

												</div>
												<div class="modal-footer">
													<button type="submit" name="ajouterContact" class="btn btn-success">Ajouter</button>
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
											<!-- <h4 class="box-title">Edition</h4> -->
											<?php if ($update > 1) { ?>
												<h4 class="box-title">Souhaitez-vous vraiment supprimer le contact <strong style="color:red"><?php echo $contactE; ?></strong></h4>
											<?php } else { ?>
												<h4 class="box-title">Edition des informations de <strong style="color:red"><?php echo $contactE; ?></strong></h4>
											<?php } ?>

										</div>
										<div class="box-body" style="background-color:#FBFBFB">
											<form action="controllers/contactController.php" method="POST">
												<div class="row">
													<div class="col-6">
														<label class="col-md-12 form-label">Prenom</label>
														<input type="text" name="prenom" class="form-control" value="<?php echo $prenom; ?>" <?php if ($update == 2) echo 'disabled'; ?>>
													</div>

													<div class="col-6">
														<label class="col-md-12 form-label">Nom</label>
														<input type="text" name="nom" value="<?php echo $nom; ?>" class="form-control" <?php if ($update == 2) echo 'disabled'; ?>>
													</div>
													<div class="col-12">&nbsp;</div>
													<div class="col-4">
														<label class="col-md-12 form-label">Email</label>
														<input type="text" name="email" value="<?php echo $email; ?>" class="form-control" <?php if ($update == 2) echo 'disabled'; ?>>
														<!-- <input type="hidden" name="email" value="<?php echo $email; ?>"> -->
													</div>
													<div class="col-4">
														<label class="col-md-12 form-label">Telephone</label>
														<input type="text" name="telephone" value="<?php echo $telephone; ?>" class="form-control" <?php if ($update == 2) echo 'disabled'; ?>>
													</div>
													<div class="col-4">
														<label class="col-md-12 form-label">Type</label>
														<select name="new_type" class="form-control" <?php if ($update == 2) echo 'disabled'; ?>>
															<option value="<?php echo $typeE; ?>"><?php if ($typeE == 'normal') {
																																			echo 'NORMAL';
																																		} else {
																																			echo 'URGENT';
																																		} ?></option>
															<?php if ($typeE != 'normal') { ?><option value="normal">NORMAL</option><?php } ?>
															<?php if ($typeE != 'urgent') { ?><option value="urgent">URGENT</option><?php } ?>
														</select>
														<input type="hidden" name="old_type" value="<?php echo $typeE; ?>">
														<input type="hidden" name="type_c" value="<?php echo $typeE; ?>">
														<input type="hidden" name="idE" value="<?php echo $idE; ?>">

													</div>
												</div>
												</br>


												<div class="row">
													<div class="container-fluid">

														<?php if ($update == 1) { ?> <button type="submit" name="modifierContact" class="btn btn-warning form-control" style="color:black;height:90%"><i class="fa fa-edit"></i> Modifier les informations</button><?php } ?>
														<?php if ($update == 2) { ?> <button type="submit" name="supprimerContact" class="btn btn-danger form-control" style="color:white;height:90%"><i class="fa fa-trash"></i> Oui, je confirme la suppression</button><?php } ?>
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
								<h4 class="box-title">Liste des responsables a notifier en cas d'incident</h4>
							</div>

							<div class="box-body" style="background-color:#FBFBFB">
								<?php include('contents/content-contacts-dage.php'); ?>
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