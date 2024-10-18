<div class="box-body">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<h4 class="box-title mt-40">Fiche Incident</h4>
			<div class="table-responsive">
				<table class="table">
					<tbody>
						<tr>
							<td>Service</td>
							<td><?php echo $service; ?></td>
						</tr>
						<tr>
							<td style="width: 390px;">Gestionnaire</td>
							<td><strong style="color: #4C18EA"><?php echo $gestionnaire_service . ' / ' . $telephone_gestionnaire; ?></strong></td>
						</tr>
						<!-- Localisation -->
						<tr>
							<td>Localisation</td>
							<td>
								<?php echo $batiment . '</br>' . $etage . '</br>' . $adresse . '</br>'; ?>
							</td>
						</tr>
						<!-- Description -->
						<tr>
							<td style="width: 390px;">Description</td>
							<td><strong style="color: #4C18EA"><?php echo $description; ?></strong></td>
						</tr>
						<!-- Categorie -->
						<tr>
							<td style="width: 390px;">Categorie</td>
							<td>
								<span class="badge badge-pill badge-lg" style="background-color:<?php echo $couleur; ?>"><?php echo $categorie; ?></span>
							</td>
						</tr>
						<!-- Statut -->
						<tr>

							<td style="width: 390px;">Statut de l'incident</td>
							<td>
								<span class="badge badge-pill" style="background-color:<?php
																																				if ($statut == 'en attente') echo "#C63D2F";
																																				if ($statut == 'en cours') echo "#FFC436";
																																				if ($statut == 'termine') echo "#1A5D1A";
																																				if ($statut == 'rejete') echo "#4E4FEB";
																																				?>"><?php echo $statut; ?>
								</span>
							</td>
						</tr>
						<!-- Priorite -->
						<tr>
							<td style="width: 390px;">Priorité</td>
							<td><span class="badge badge-pill" style="background-color:<?php echo $couleur_priorite; ?>"><?php echo $priorite; ?></span></td>
						</tr>

						<tr>
							<td>Signalé par </td>
							<td><?php echo $auteur . ' - ' . $telephone; ?></td>
						</tr>
						<!-- <tr>
							<td>Telephone</td>
							<td><?php //echo $telephone; 
									?></td>
						</tr> -->
						<?php if ($email != NULL) { ?>
							<tr>
								<td>Email</td>
								<td><?php echo $email; ?></td>
							</tr>
						<?php } ?>

						<tr>
							<td>Date de declaration </td>
							<td><strong style="color: #4C18EA"><?php echo $date_reception . ' à ' . $heure_reception; ?></strong></td>
						</tr>
						<?php if ($statut == 'en cours') { ?>
							<tr>
								<td>Date de d'affectation </td>
								<td><strong style="color: #4C18EA"><?php echo $date_affectation . ' à ' . $heure_affectation; ?></strong></td>
							</tr>
							<!-- <tr>
							<td>Priorité</td>
							<td><?php // echo $heure_reception; 
									?></td>
						</tr> -->
							<tr>
								<td>Date limite d'intervention</td>
								<td><strong style="color: #4C18EA"><?php echo $date_intervention . ' à ' . $heure_intervention; ?></strong></td>
							</tr>
							<!-- Piece jointe -->

						<?php } ?>
						<?php if ($image != 'Signalements/no_image.png') { ?>
							<tr>
								<td style="width: 100px;">Piece Jointe</td>
								<td>
									<div class="box box-body b-1 text-center no-shadow">
										<div id="image-popups">
											<!-- <a><img src="sri_dage/notifications/<?php //echo $image; 
																																?>" id="product-image" class="img-fluid" alt="" /></a> -->
											<a href="../sri_client/notifications/<?php echo $image; ?>" data-effect="mfp-3d-unfold"><img src="../sri_client/notifications/<?php echo $image; ?>" class="img-fluid" alt="" /></a>
										</div>
									</div>
								</td>
							</tr>

						<?php } ?>

					</tbody>
				</table>
				<?php if ($statut == 'en attente' && $roleUser != 'Gestionnaire') { ?>
					<div class="gap-items text-center">
						<button class="btn btn-success"><a href="details_signalements.php?numero_incident=<?php echo $numero_incident; ?>&amp;affect=1" style="color:white"><i class="mdi mdi-share"></i> Affecter</a></button>
						<button class="btn btn-warning"><a href="details_signalements.php?numero_incident=<?php echo $numero_incident; ?>&amp;edit=1" style="color:white"><i class="mdi mdi-pencil"></i> Editer</a></button>
						<?php if ($emailUser == 'alphalimalediop@minfinances.sn') { ?><button class="btn btn-danger"><a href="details_signalements.php?numero_incident=<?php echo $numero_incident; ?>&amp;rejet=1" style="color:white"><i class="mdi mdi-close"></i> Rejeter</a></button><?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<!-- <div class="col-md-5 col-sm-6">
			<div class="box box-body b-1 text-center no-shadow">
				<div id="image-popups">
					<a href="../sri_client/notifications/<?php //echo $image; 
																								?>" data-effect="mfp-3d-unfold"><img src="../sri_client/notifications/<?php echo $image; ?>" class="img-fluid" alt="" /></a>
				</div>
			</div>
			-->
		<!-- </div>  -->
		<!-- <div class="col-md-7 col-sm-6">
			<h2 class="box-title mt-0"><?php echo $service; ?></h2>
			<hr>
			<b>Description de l'incident :</b></br>
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
			<?php if ($statut == 'en attente' && $roleUser != 'Gestionnaire') { ?>
			<div class="gap-items">
				<button class="btn btn-success"><a href="details_signalements.php?numero_incident=<?php echo $numero_incident; ?>&amp;affect=1" style="color:white" ><i class="mdi mdi-share"></i> Affecter</a></button>
				<button class="btn btn-warning"><a href="details_signalements.php?numero_incident=<?php echo $numero_incident; ?>&amp;edit=1" style="color:white" ><i class="mdi mdi-pencil"></i> Editer</a></button>
				<?php if ($emailUser == 'alphalimalediop@minfinances.sn') { ?><button class="btn btn-danger"><a href="details_signalements.php?numero_incident=<?php echo $numero_incident; ?>&amp;rejet=1" style="color:white" ><i class="mdi mdi-close"></i> Rejeter</a></button><?php } ?>
			</div>
			<?php } ?>

		</div> -->

	</div>
</div>