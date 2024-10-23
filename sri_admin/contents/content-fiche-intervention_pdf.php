<div class="box-body" style="background-color:#FBFBFB">
	<!-- <div class="row"> -->
	<div class="col-lg-12 col-md-12 col-sm-12">
		<!-- <h4 class="box-title">Informations generales</h4> -->
		<!-- <div class="table-responsive"> -->
		<table class="table">
			<tbody>

				<tr>
					<td>Service</td>
					<td><?php echo $service; ?></td>
				</tr>
				<tr>
					<td>Type d'intervention</td>
					<td> <span class="badge badge-pill badge-lg" style="background-color:<?php echo $couleur; ?>"><?php echo $categorie; ?></span></td>
				</tr>
				<tr>
					<td>Date d'intervention</td>
					<td><strong style="color: #4C18EA"><?php echo $date_intervention; ?></strong></td>
				</tr>
				<tr>
					<td>Intervenant </td>
					<td><?php echo $intervenant_incident; ?></td>
				</tr>
				<tr>
					<td>Type Intervenant </td>
					<td><?php echo $type_intervenant; ?></td>
				</tr>
				<!-- <tr>
												<td>Priorité</td>
												<td><?php // echo $heure_reception; 
														?></td>
											</tr> -->

				<tr>
					<td>Responsable Dage</td>
					<td><strong style="color: #4C18EA"><?php echo $responsableDage . ' ( ' . $telephoneResponsable . ' )'; ?></strong></td>
				</tr>
				<tr>
					<td style="width: 390px;">Reference</td>
					<td><strong style="color: #4C18EA">#<?php echo $code_intervention; ?></strong></td>
				</tr>

			</tbody>
		</table>
		<!-- </div>	 -->
		<!-- <hr> -->
	</div>

	<div class="row">
		<div class="col-md-5 col-sm-6">
			<div class="box box-body b-1 text-center no-shadow">
				<div id="image-popups">
					<!-- <a><img src="sri_dage/notifications/<?php //echo $image; 
																										?>" id="product-image" class="img-fluid" alt="" /></a> -->
					<img src="<?php echo $modified_path; ?>/sri_client/notifications/<?php echo $image; ?>" class="img-fluid" alt="" />
				</div>
			</div>
		</div>
		<div class="col-md-7 col-sm-6">
			<div class="row text-center">
				</br>
				<h3 class="box-title mt-0" style="text-align:center">Description de l'incident</h3>

			</div>

			<!-- <h4 class="text-danger">Priorité</h4> -->

			<hr>
			<p><?php echo $description; ?></p>
			<div class="row">
				<div class="col-sm-12">
					<h6 class="mt-20">Categorie</h6>
					<p class="mb-0">
						<span class="badge badge-pill badge-lg" style="background-color:<?php echo $couleur; ?>"><?php echo $categorie; ?></span>
					</p>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12 col-md-12 col-sm-12">
					<table class="table">
						<tbody>
							<tr>
								<td>Declaré le </td>
								<td><?php echo $date_reception . ' à ' . $heure_reception; ?></td>
							</tr>
							<tr>
								<td>Auteur </td>
								<td><?php echo $auteur; ?></td>
							</tr>
							<tr>
								<td>Contact </td>
								<td><?php echo $contact; ?></td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
	<hr>