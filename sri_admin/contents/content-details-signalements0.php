
					<div class="box-body">
						<div class="row">
							<div class="col-md-5 col-sm-6">
								<div class="box box-body b-1 text-center no-shadow">
									<a><img src="sri_dage/notifications/<?php echo $image; ?>" id="product-image" class="img-fluid" alt="" /></a>
								</div>
								<div class="clear"></div>
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
											<span class="badge badge-pill badge-lg badge-secondary-light">Electricite</span>
										</p>
									</div>
								</div>
								<hr>
								<div class="gap-items">
									<button class="btn btn-success"><i class="mdi mdi-shopping"></i> Affecter</button>
									<button class="btn btn-primary"><i class="mdi mdi-calendar"></i> Intervention</button>
									<button class="btn btn-info"><i class="mdi mdi-compare"></i> Classer</button>
									<button class="btn btn-danger"><i class="mdi mdi-pencil"></i> Editer</button>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<h4 class="box-title mt-40">Informations generales</h4>
								<div class="table-responsive">
									<table class="table">
										<tbody>
											<tr>
												<td style="width: 390px;">Reference</td>
												<td><strong style="color: #4C18EA">#<?php echo $numero_incident; ?></strong></td>
											</tr>
											<tr>
												<td>Signalé par </td>
												<td><?php echo $auteur; ?></td>
											</tr>
											<tr>
												<td>Contact </td>
												<td><?php echo $contact; ?></td>
											</tr>
											<tr>
												<td>Reçu le </td>
												<td><?php echo $date_reception.' à '.$heure_reception; ?></td>
											</tr>
											<!-- <tr>
												<td>Priorité</td>
												<td><?php // echo $heure_reception; ?></td>
											</tr> -->
											<tr>
												<td>Date limite d'intervention</td>
												<td><strong style="color: #4C18EA"><?php echo $date_reception.' à '.$heure_reception; ?></strong></td>
											</tr>

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>	