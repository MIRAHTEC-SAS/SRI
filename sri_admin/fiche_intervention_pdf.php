<?php
//Fin edition...
$page = 'Incident';
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="MIRAHTEC">
	<link rel="icon" href="img/favicon.png">
	<title>DAGE - <?php echo $page; ?></title>
	<style>
		@page {
			margin: 0;
			size: A4;
		}

		body {
			font-family: Arial, sans-serif;
			/* background-color: #f5f5f5; */
			color: #333;
			height: 100%;
		}

		.table {
			width: 100%;
			margin-bottom: 1rem;
			background-color: #fff;
			border-collapse: separate;
			border-spacing: 0;
			border-radius: 0.25rem;
		}

		.table th,
		.table td {
			padding: 0.75rem;
			vertical-align: top;
			border-top: 1px solid #dee2e6;
		}

		.table tbody tr:nth-of-type(odd) {
			background-color: #f9f9f9;
		}

		.table td {
			font-size: 14px;
			color: #555;
		}

		h4.box-title {
			font-size: 20px;
			font-weight: bold;
			color: #333;
		}

		h5.box-title {
			font-size: 18px;
			font-weight: bold;
			color: #333;
			margin-bottom: 15px;
		}

		.box {
			background-color: #fff;
			border: 1px solid #e5e5e5;
			border-radius: 8px;
			padding: 20px;
			margin-bottom: 20px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
		}

		.box-header {
			display: flex;
			justify-content: space-around;
			align-items: center;
			padding-bottom: 10px;
			border-bottom: 1px solid #e5e5e5;
			margin-bottom: 20px;
		}

		.box-title {
			margin: 0;
			/* Supprime la marge par défaut des h4 */
			flex-grow: 1;
			/* Permet à chaque h4 de croître pour occuper l'espace disponible */
			text-align: center;
			/* Centre le texte dans chaque h4 */
		}

		.box-body {
			padding: 15px;
			background-color: #fbfbfb;
		}

		.badge {
			font-size: 16px;
			padding: 5px 10px;
			border-radius: 5px;
			font-weight: bold;
		}

		.badge-primary-light {
			background-color: #6a38ff;
			color: white;
		}

		.badge-success-light {
			background-color: #5ccc6d;
			color: white;
		}

		.badge-danger-light {
			background-color: #e34a4f;
			color: white;
		}

		.badge-info-light {
			background-color: #17a2b8;
			color: white;
		}

		strong {
			font-weight: bold;
			color: #333;
		}

		table {
			width: 100%;
			margin: 10px 0;
			border: 1px solid #ddd;
			border-radius: 8px;
		}

		table tr td:first-child {
			font-weight: bold;
			color: #555;
		}

		table tr td {
			padding: 10px;
			vertical-align: top;
			border-bottom: 1px solid #eaeaea;
		}
	</style>

</head>


<body class="hold-transition light-skin sidebar-mini theme-primary fixed ">

	<div class="wrapper">

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<div class="container-full">

				<!-- Main content -->
				<section class="content">


					<div class="row">
						<div class="col-12">
							<div class="box">
								<div class="box-header with-border">
									<h4 class="box-title" style="flex-grow: 1;">Fiche d'intervention <strong style="color:red"><?php echo $code_intervention; ?></strong></h4>
									<h4 class="box-title" style="flex-grow: 1;">DAGE - <span style="color: #6a38ff;">SRI</span></h4>
								</div>
								<?php include('contents/content-fiche-intervention_pdf.php'); ?>
							</div>
						</div>
					</div>
				</section>
				<!-- /.content -->

			</div>
		</div>
	</div>


	<!-- Vendor JS -->
	<?php include('layouts/js.php'); ?>
	<script src="src/js/pages/chat-popup.js"></script>
	<script src="assets/icons/feather-icons/feather.min.js"></script>
	<script src="assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
	<script src="assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>


</body>

</html>