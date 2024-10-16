<div class="box-body">
	<div class="row">
		<div class="col-md-5 col-sm-6">
			<div class="box box-body b-1 text-center no-shadow">
				<div id="image-popups">
					<!-- <a><img src="../<?php //echo $image; 
																?>" id="product-image" class="img-fluid" alt="" /></a> -->
					<a href="../sri_client/notifications/<?php echo $image; ?>" data-effect="mfp-3d-unfold"><img src="../sri_client/notifications/<?php echo $image; ?>" class="img-fluid" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="col-md-7 col-sm-6">
			<h2 class="box-title mt-0"><?php echo $service; ?></h2>

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
			<div class="gap-items">
				<button class="btn btn-success"><a href="details_signalements?numero_incident=<?php echo $numero_incident; ?>&amp;affect=1" style="color:white"><i class="mdi mdi-share"></i> Affecter</a></button>
				<button class="btn btn-warning"><a href="details_signalements?numero_incident=<?php echo $numero_incident; ?>&amp;edit=1" style="color:white"><i class="mdi mdi-pencil"></i> Editer</a></button>
				<button class="btn btn-danger"><a href="details_signalements?numero_incident=<?php echo $numero_incident; ?>&amp;rejet=1" style="color:white"><i class="mdi mdi-close"></i> Rejeter</a></button>
			</div>

		</div>
		<div class="col-lg-12 col-md-12 col-sm-12">
			<h4 class="box-title mt-40">Fiche Incident</h4>
			<div class="table-responsive">
				<table class="table">
					<tbody>
						<tr>
							<td style="width: 390px;">Priorité</td>
							<td><span class="badge badge-pill" style="background-color:<?php echo $couleur_priorite; ?>"><?php echo $priorite; ?></span></td>
						</tr>
						<tr>
							<td style="width: 390px;">Reference</td>
							<td><strong style="color: #4C18EA">#<?php echo $numero_incident; ?></strong></td>
						</tr>
						<tr>
							<td>Signalé par </td>
							<td><?php echo $auteur; ?></td>
						</tr>
						<tr>
							<td>Telephone</td>
							<td><?php echo $telephone; ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><?php echo $email; ?></td>
						</tr>
						<tr>
							<td>Reçu le </td>
							<td><?php echo $date_reception . ' à ' . $heure_reception; ?></td>
						</tr>
						<!-- <tr>
												<td>Priorité</td>
												<td><?php // echo $heure_reception; 
														?></td>
											</tr> -->
						<tr>
							<td>Date limite d'intervention</td>
							<td><strong style="color: #4C18EA"><?php echo $date_reception . ' à ' . $heure_reception; ?></strong></td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>