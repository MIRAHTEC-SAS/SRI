<?php include('layouts/head.php'); ?>
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
					<h4 class="page-title">Titre page</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Emplacement</li>
								<li class="breadcrumb-item active" aria-current="page">Titre page</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="box">
						<div class="box-header with-border">
						  <h4 class="box-title">Titre de la page </h4>
						</div>
						<div class="box-body">
                <?php include('contents/content-template.php'); ?>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
						  Footer
						</div>
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
   <!-- FIN FOOTER -->
  <?php include('rightbar.php'); ?>
  
  <?php include('modal_user.php'); ?>
	
	<!-- Page Content overlay -->
	
	
<?php include('layouts/js.php'); ?>
	

</body>
</html>
