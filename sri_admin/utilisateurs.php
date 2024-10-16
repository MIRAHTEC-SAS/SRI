<?php
include('config/app.php');
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable') {
	$emailUser = $_SESSION['email'];
?>
	<?php
	$page = 'Utilisateurs';
	include('layouts/head.php');
	$update = 0;
	if (isset($_GET['edit'])) {
		$update = 1;

		$code_piece = $_GET['edit'];

		$getInfosPiece = mysqli_query($con, "SELECT * FROM `pieces` INNER JOIN etages on etages.code_etage=pieces.code_etage INNER JOIN batiments ON batiments.code_batiment=etages.code_batiment where pieces.code_piece='$code_piece'");

		while ($row = mysqli_fetch_array($getInfosPiece)) {
			$nom_piece = $row['nom_piece'];
			$code_batiment = $row['code_batiment'];
			$nom_batiment = $row['nom_batiment'];
			$nom_etage = $row['nom_etage'];
			$code_etage = $row['code_etage'];
		}

		// Liste batiments
		$getBatiments = mysqli_query($con, "SELECT * FROM batiments");
		$getEtages = mysqli_query($con, "SELECT * FROM etages");
	}
	if (isset($_GET['delete'])) {
		$update = 2;

		$email = $_GET['delete'];

		$getUsersD = mysqli_query($con, "SELECT * FROM `users` WHERE email='$email'");

		while ($row = mysqli_fetch_array($getUsersD)) {
			$prenom = $row['prenom'];
			$nom = $row['nom'];
			$role = $row['role'];
		}
	}
	if (isset($_GET['upd']) && isset($_GET['statut'])) {
		$update = 3;

		$email = $_GET['upd'];
		$statut = $_GET['statut'];

		$getStatut = mysqli_query($con, "SELECT * FROM `users` WHERE email='$email'");

		while ($row = mysqli_fetch_array($getStatut)) {
			$prenom = $row['prenom'];
			$nom = $row['nom'];
			$role = $row['role'];
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
								<h4 class="page-title">Utilisateurs</h4>
								<div class="d-inline-block align-items-center">
									<nav>
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
											<li class="breadcrumb-item" aria-current="page">Accès</li>
											<li class="breadcrumb-item active" aria-current="page">Utilisateurs</li>
										</ol>
									</nav>
								</div>
							</div>
							<div id="app">
								<div class="text-end">
									<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-success mt-10 d-block text-center"><i class="fa fa-plus-circle"></i> Nouveau utilisateur</a>
								</div>
								<!-- Popup Model Plase Here -->
								<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header" style="background-color:#DFDFDE">
												<h4 class="modal-title" id="myModalLabel">Ajout d'un utilisateur</h4>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body" style="background-color:#F7F5F2">
												<form action="controllers/referentielController.php" method="POST">
													<div class="form-group">
														<label class="col-md-12 form-label">Rôle</label>
														<div class="col-md-12">
															<select name="code_role" class="form-control" v-model="newUser.role">
																<option v-for="role in roles" :value="role.code_role">{{role.role}}</option>
															</select>
														</div>
														</br>
														<label class="col-md-12 form-label" v-if="newUser.role && newUser.role==2">Selectionner le Gestionnaire</label>
														<label class="col-md-12 form-label" v-if="newUser.role && newUser.role==3">Selectionner le Responsable</label>
														<label class="col-md-12 form-label" v-if="newUser.role && newUser.role==6">Selectionner l'intervenant</label>
														<!-- Gestionnaire -->
														<div class="col-md-12" v-if="newUser.role==2">
															<select name="matricule" class="form-control" v-model="newUser.matricule">
																<option v-for="gestionnaire in gestionnaires" :value="gestionnaire.matricule_gestionnaire">{{gestionnaire.prenom}} {{gestionnaire.nom}}</option>
															</select>
														</div>
														<!-- Responsable -->
														<div class="col-md-12" v-if="newUser.role==3">
															<select name="matricule" class="form-control" v-model="newUser.matricule">
																<option v-for="responsable in responsables" :value="responsable.matricule">{{responsable.prenom}} {{responsable.nom}}</option>
															</select>
														</div>
														<!-- Intervenant -->
														<div class="col-md-12" v-if="newUser.role==6">
															<select name="matricule" class="form-control" v-model="newUser.matricule">
																<option v-for="intervenant in intervenants" :value="intervenant.matricule_intervenant">{{intervenant.prenom}} {{intervenant.nom}}</option>
															</select>
														</div>
														</br>
														<!-- administrateurs -->
														<div class="row" v-if="newUser.role==1">
															<div class="col-md-12">
																<label class="col-md-12 form-label">Prenom</label>

																<input type="text" name="prenom" v-model="newUser.prenom" class="form-control" placeholder="Prenom..."></br>
																<!-- <input type="hidden" name="code_batiment" :value="newEtage.code_batiment"> -->
																<!-- <input type="hidden" name="nom_etage" :value="newEtage.nom_etage"> -->
															</div>
															</br>
															<div class="col-md-12">
																<label class="col-md-12 form-label">NOM</label>

																<input type="text" name="nom" v-model="newUser.nom" class="form-control" placeholder="Nom..."></br>
																<!-- <input type="hidden" name="code_batiment" :value="newEtage.code_batiment"> -->
																<!-- <input type="hidden" name="nom_etage" :value="newEtage.nom_etage"> -->
															</div>
															</br>
															<div class="col-md-12">
																<label class="col-md-12 form-label">EMAIL</label>

																<input type="email" name="email" v-model="newUser.email" class="form-control" placeholder="Email">
																<!-- <input type="hidden" name="code_batiment" :value="newEtage.code_batiment"> -->
																<!-- <input type="hidden" name="nom_etage" :value="newEtage.nom_etage"> -->
															</div>
															</br>
														</div>
													</div>
													<div class="modal-footer">
														<button type="submit" name="ajouterUser" class="btn btn-success">Ajouter</button>
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


					</div>

					<!-- Main content -->
					<section class="content">
						<div class="row">
							<div class="col-12">
								<!-- Confirmation box -->
								<?php include('confirmation.php'); ?>
							</div>
							<div id="main">
								<?php if ($update > 0) { ?>
									<div class="col-12">
										<div class="box">
											<div class="box-body">
												<form action="controllers/referentielController.php" method="POST">
													<div class="row">
														<div class="col-3">
															<input type="text" name="nom_piece" value="<?php echo $prenom; ?>" class="form-control" <?php if ($update == 2 || $update == 3) echo 'disabled'; ?>>
															<input type="hidden" name="email" value="<?php echo $email; ?>">
														</div>
														<div class="col-3">
															<input type="text" name="nom_piece" value="<?php echo $nom; ?>" class="form-control" <?php if ($update == 2 || $update == 3) echo 'disabled'; ?>>
														</div>
														<div class="col-4">
															<select name="code_batiment" class="form-control" disabled>
																<option value="<?php echo $role; ?>"><?php echo $role; ?></option>
															</select>
														</div>
														<div class="col-2">
															<?php if ($update == 3 && $statut == 1) { ?> <button type="submit" name="desactiverUser" class="btn btn-danger form-control" style="color:white;height:90%"><i class="fa fa-toggle-off"></i> Desactiver</button><?php  } ?>
															<?php if ($update == 3 && $statut == 0) { ?> <button type="submit" name="activerUser" class="btn btn-success form-control" style="color:white;height:90%"><i class="fa fa-toggle-on"></i> Activer</button><?php  } ?>
															<?php if ($update == 2) { ?> <button type="submit" name="supprimerUser" class="btn btn-danger form-control" style="color:white;height:90%"><i class="fa fa-trash"></i> Supprimer</button><?php } ?>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
							<div class="col-12">
								<div class="box">
									<div class="box-header with-border">
										<h4 class="box-title">Liste des utilisateurs</h4>
									</div>

									<div class="box-body" style="background-color:#FBFBFB">
										<?php include('contents/content-utilisateurs.php'); ?>
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

			<!-- Vue & Axios -->
			<?php include('lib.php'); ?>

			<!--  VUE JS -->
			<?php include('vuejs/scriptReferentiel.php'); ?>

			<!-- FIN FOOTER -->
			<?php include('layouts/rightbar.php'); ?>

			<?php include('layouts/modal_user.php'); ?>



			<!-- Page Content overlay -->


			<!-- Vendor JS -->
			<?php include('layouts/js.php'); ?>

	</body>

	</html>
<?php } else {
	header('Location: ../sri_admin/');
}  ?>