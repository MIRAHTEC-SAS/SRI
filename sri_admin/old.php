<?php 
include ('config/app.php');
session_start();
$page='Pieces';
include('layouts/head.php'); 
$update=0;
if (isset($_GET['edit'])) {
	$update=1;

	$code_piece=$_GET['edit'];

	$getInfosPiece = mysqli_query($con, "SELECT * FROM `pieces` INNER JOIN etages on etages.code_etage=pieces.code_etage INNER JOIN batiments ON batiments.code_batiment=etages.code_batiment where pieces.code_piece='$code_piece'");
    
	while ($row = mysqli_fetch_array($getInfosPiece)) 
	{ 
		$nom_piece=$row['nom_piece'];
		$code_batiment=$row['code_batiment'];
		$nom_batiment=$row['nom_batiment'];
		$nom_etage=$row['nom_etage'];
		$nom_etage=$row['nom_etage'];

    }

	// Liste batiments
	$getBatiments = mysqli_query($con, "SELECT * FROM batiments");
	$getEtages = mysqli_query($con, "SELECT * FROM etages");

}
if (isset($_GET['delete'])) {
	$update=2;

	$code_etage=$_GET['delete'];

	$getInfosEtage = mysqli_query($con, "SELECT batiments.nom_batiment, batiments.code_batiment, etages.nom_etage FROM etages inner join batiments on batiments.code_batiment=etages.code_batiment where etages.code_etage='$code_etage'");
    
	while ($row = mysqli_fetch_array($getInfosEtage)) 
	{ 
		$nom_batiment=$row['nom_batiment'];
		$code_batiment=$row['code_batiment'];
		$nom_etage=$row['nom_etage'];
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
  <?php include ('layouts/sidebar.php'); ?>
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->	  
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="me-auto">
					<h4 class="page-title">Etages</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Referentiel</li>
								<li class="breadcrumb-item active" aria-current="page">Etages</li>
							</ol>
						</nav>
					</div>
				</div>
			<div id="app">
				<div class="text-end">
					<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-success mt-10 d-block text-center"><i class="fa fa-plus-circle"></i> Nouvelle Etage</a>
				</div>
					  <!-- Popup Model Plase Here -->
						<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header" style="background-color:#DFDFDE">
										<h4 class="modal-title" id="myModalLabel">Ajouter une nouvelle Etage</h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body" style="background-color:#F7F5F2">
										<form action="controllers/referentielController.php" method="POST">
											<div class="form-group">
												<label class="col-md-12 form-label">Batiment</label>
												<div class="col-md-12">
													<select name="code_batiment" class="form-control" v-model="newPiece.code_batiment">
														<option v-for="batiment in batiments" :value="batiment.code_batiment">{{batiment.nom_batiment}}</option>
													</select>
												</div>
												</br>
												<label class="col-md-12 form-label">Etage</label>
												<div class="col-md-12">
													<select name="code_etage" class="form-control" v-model="newPiece.code_etage">
														<option v-for="etage in selectedEtages" :value="etage.code_etage">{{etage.nom_etage}}</option>
													</select>
												</div>
												</br>
												<label class="col-md-12 form-label">Piece</label>
												<div class="col-md-12">
													<input type="text" name="nom_piece" v-model="newPiece.nom_piece" class="form-control" placeholder="Nom de la piece">
													<!-- <input type="hidden" name="code_batiment" :value="newEtage.code_batiment"> -->
													<!-- <input type="hidden" name="nom_etage" :value="newEtage.nom_etage"> -->
												</div>
											</div>
											<div class="modal-footer">
												<button type="submit" name="ajouterPiece" class="btn btn-success">Ajouter</button>
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
				<div id="app">
				<?php if ($update>0) { ?>
				<div class="col-12">
					<div class="box">
						<div class="box-body">
                			<form action="controllers/referentielController.php" method="POST">
								<div class="row">
									<div class="col-3">
										<input type="text" name="nom_piece" value="<?php echo $nom_piece; ?>" class="form-control" <?php if ($update==2) echo 'disabled';?>>
										<input type="hidden" name="code_piece" value="<?php echo $code_piece; ?>">
									</div>
									<div class="col-3">
										<select name="code_etage" class="form-control">
											<option value="<?php echo $code_etage;?>"><?php echo $nom_etage;?></option>
											<?php while ($row = mysqli_fetch_array($getEtages)) {
												$codeBatiment=$row['code_batiment']; 
												if ($code_batiment!=$codeBatiment) {?>
												<option value="<?php echo $row['code_batiment'];?>"><?php echo $row['nom_batiment'];?></option>
											<?php }} ?>

										</select>
										<input type="hidden" name="code_etage" value="<?php echo $code_etage; ?>">
									</div>
									<div class="col-4">
										<select name="code_batiment" class="form-control">
											<option value="<?php echo $code_batiment;?>"><?php echo $nom_batiment;?></option>
											<?php while ($row = mysqli_fetch_array($getBatiments)) {
												$codeBatiment=$row['code_batiment']; 
												if ($code_batiment!=$codeBatiment) {?>
												<option value="<?php echo $row['code_batiment'];?>"><?php echo $row['nom_batiment'];?></option>
											<?php }} ?>

										</select>
									</div>
									<div class="col-2" >
										<?php if ($update==1) {?> <button type="submit" name="modifierEtage" class="btn btn-warning form-control" style="color:black;height:90%"><i class="fa fa-edit" ></i> Modifier</button><?php } ?>
										<?php if ($update==2) {?> <button type="submit" name="supprimerEtage" class="btn btn-danger form-control" style="color:white;height:90%"><i class="fa fa-trash" ></i> Supprimer</button><?php } ?>
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
						  <h4 class="box-title">Liste des batiments</h4>
						</div>

						<div class="box-body">
                			<?php include('contents/content-pieces.php'); ?>
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
   <?php include('layouts/footer.php');?>

         <!-- Vue & Axios -->
	<?php include ('lib.php'); ?>

	<!--  VUE JS -->
	<?php include ('vuejs/scriptReferentiel.php'); ?>

   <!-- FIN FOOTER -->
  <?php include('layouts/rightbar.php'); ?>
  
  <?php include('layouts/modal_user.php'); ?>


	
	<!-- Page Content overlay -->
	

	<!-- Vendor JS -->
	<script src="../src/js/vendors.min.js"></script>
	<script src="../src/js/pages/chat-popup.js"></script>
    <script src="../../../assets/icons/feather-icons/feather.min.js"></script>	<script src="../../../assets/vendor_components/datatable/datatables.min.js"></script>
	
	<!-- CRMi App -->
	<script src="../src/js/template.js"></script>    
	    
	<script src="../src/js/pages/data-table.js"></script>

</body>
</html>
