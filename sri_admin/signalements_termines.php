<?php
include('config/app.php');
if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable') {
	$emailUser = $_SESSION['email'];
?>
	<?php
	$page = 'Signalements';
	include('layouts/head.php');
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
								<h4 class="page-title">Incidents</h4>
								<div class="d-inline-block align-items-center">
									<nav>
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
											<li class="breadcrumb-item" aria-current="page">Signalements</li>
											<li class="breadcrumb-item active" aria-current="page">Terminé</li>
										</ol>
									</nav>
								</div>
							</div>

						</div>
					</div>

					<!-- Main content -->
					<section class="content">
						<!-- Confirmation box -->
						<?php include('confirmation.php'); ?>
						<div class="row">
							<div class="col-12">
								<div class="box">
									<div class="box-header with-border">
										<h4 class="box-title">Liste des incidents traités</h4>
									</div>
									<div class="box-body" style="background-color:#FBFBFB">
										<?php include('contents/content-signalements-termines.php'); ?>
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