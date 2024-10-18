<section class="content">
	<div class="row">
		<div class="col-xxxl-12 col-xl-12 col-12">

			<div class="row">
				<!-- Incidents -->
				<div class="col-xl-6 col-12">
					<div class="box">
						<div class="col-xl-12 col-12">
							<div class="flexbox flex-justified text-center bg-white rounded10 overflow-hidden">
								<div class="no-shrink py-30">
									<span class="icon-Flag fs-50 text-primary"><span class="path1"></span><span class="path2"></span></span>
								</div>

								<div class="py-30 bg-primary-light">
									<div class="fs-30">
										<a href="signalements.php">+<?php echo $nbIncident; ?>
									</div>
									<span style="font-weight:bold; font-size:larger">Incidents</span>
									</a>
								</div>

							</div>
						</div>

						<div class="box-body bg-lightest bar-0">
							<div class="flexbox fs-12">
								<a href="signalements_en_attente.php">
									<span style="font-size:14px">En attente : <strong style="color:blue; font-size:16px"><?php echo $nbIncidentEnAttente; ?></strong></span>
								</a>
								<span style="color:blue;font-weight:bold"><?php echo $pNbIncidentEnAttente; ?>%</span>

							</div>
							<div class="progress progress-xxs mt-0 mb-10">
								<div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $pNbIncidentEnAttente; ?>%; height: 4px;" aria-valuenow="<?php echo $nbIncidentEnAttente; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>

							<div class="flexbox fs-12">
								<a href="signalements_encours.php">
									<span style="font-size:14px">En cours : <strong style="color:blueviolet; font-size:16px"><?php echo $nbIncidentEnCours; ?></strong></span>
								</a>
								<span style="color:blueviolet;font-weight:bold"><?php echo $pNbIncidentEnCours; ?>%</span>
							</div>
							<div class="progress progress-xxs mt-0 mb-10">
								<div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $pNbIncidentEnCours; ?>%; height: 4px;" aria-valuenow="<?php echo $nbIncidentEnCours; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>


							<div class="flexbox fs-12">
								<a href="signalements_termines.php">
									<span style="font-size:14px">Résolus : <strong style="color:green; font-size:16px"><?php echo $nbIncidentTermine; ?></strong></span>
								</a>
								<span style="color:green;font-weight:bold"><?php echo $pNbIncidentTermine; ?>%</span>
							</div>
							<div class="progress progress-xxs mt-0 mb-10">
								<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $pNbIncidentTermine; ?>%; height: 4px;" aria-valuenow="<?php echo $nbIncidentTermine; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>


							<div class="flexbox fs-12">
								<a href="signalements_rejetes.php">
									<span style="font-size:14px">Rejetés : <strong style="color:red; font-size:16px"><?php echo $nbIncidentRejetes; ?></strong></span>
								</a>
								<span style="color:red;font-weight:bold"><?php echo $pNbIncidentRejetes; ?>%</span>
							</div>
							<div class="progress progress-xxs mt-0 mb-10">
								<div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $pNbIncidentRejetes; ?>%; height: 4px;" aria-valuenow="<?php echo $nbIncidentRejetes; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>


						</div>

					</div>

				</div>
				<!-- Interventions  -->
				<div class="col-xl-6 col-12">
					<div class="box">
						<div class="col-xl-12 col-12">
							<div class="flexbox flex-justified text-center bg-white rounded10 overflow-hidden">
								<div class="no-shrink py-30">
									<span class="icon-Tools fs-50 text-success"><span class="path1"></span><span class="path2"></span></span>
								</div>

								<div class="py-30 bg-success-light">
									<div class="fs-30">+<?php echo $nbInterventionBon; ?></div>
									<span style="font-weight:bold; font-size:larger">Interventions</br></span>
								</div>
							</div>
						</div>

						<div class="box-body bg-lightest bar-0">
							<div class="flexbox fs-12">
								<a href="interventions_planifiees.php">
									<span style="font-size:14px">Planifiées : <strong style="color:blueviolet; font-size:16px"><?php echo $nbInterventionPlanifiee; ?></strong></span>
								</a>
								<span style="color:blueviolet;font-weight:bold"><?php echo $pNbInterventionPlanifiee; ?>%</span>
							</div>
							<div class="progress progress-xxs mt-0 mb-10">
								<?php if (!empty($pNbInterventionPlanifiee)) { ?>
									<div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $pNbInterventionPlanifiee; ?>%; height: 4px;" aria-valuenow="<?php echo $nbInterventionPlanifiee; ?>" aria-valuemin="0" aria-valuemax="100"></div>
								<?php } ?>
							</div>

							<div class="flexbox fs-12">
								<a href="interventions_terminees.php">
									<span style="font-size:14px">Terminées : <strong style="color:blue; font-size:16px"><?php echo $nbInterventionTerminee; ?></strong></span>
								</a>
								<span style="color:blue;font-weight:bold"><?php echo $pNbInterventionTerminee; ?>%</span>
							</div>
							<div class="progress progress-xxs mt-0 mb-10">
								<div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $pNbInterventionTerminee; ?>%; height: 4px;" aria-valuenow="<?php echo $nbInterventionTerminee; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>

							<div class="flexbox fs-12">
								<a href="interventions_retards.php">
									<span style="font-size:14px">En retards: <strong style="color:green; font-size:16px"><?php echo $nbInterventionEnRetard; ?></strong></span>
								</a>
								<span style="color:green;font-weight:bold"><?php echo $pNbInterventionEnRetard; ?>%</span>
							</div>
							<div class="progress progress-xxs mt-0 mb-10">
								<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $pNbInterventionEnRetard; ?>%; height: 4px;" aria-valuenow="<?php echo $nbInterventionEnRetard; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>


							<div class="flexbox fs-12">
								<a href="interventions_annulees.php">
									<span style="font-size:14px">Annulées : <strong style="color:red; font-size:16px"><?php echo $nbInterventionAnnulee; ?></strong></span>
								</a>
								<span style="color:red;font-weight:bold"><?php echo $pNbInterventionAnnulee; ?>%</span>
							</div>
							<div class="progress progress-xxs mt-0 mb-10">
								<div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $pNbInterventionAnnulee; ?>%; height: 4px;" aria-valuenow="<?php echo $nbInterventionAnnulee; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>


						</div>

					</div>

				</div>
			</div>
			<!-- /.row -->
			<!-- <div class="box">
				<div class="box-header">
					<h3 class="box-title">
						Evolutions du nombre de signalement
					</h3>
				</div>
				<div class="box-body pb-0" style="background-color:#FBFBFB">
					<div id="chart44"></div>
				</div>
				<div class="box-body pb-0" style="background-color:#FBFBFB">							
					<div class="row">
						<div class="col-lg-4 col-12">
							<div class="box no-shadow no-border bg-lightest">
								<div class="box-body">
									<h2 class="fw-600">5</h2>
									<small> Signalements</small>
									<p class="text-mute mb-0">Aujourd'hui</p>
									<p class="text-success mb-0"><i class="fa fa-arrow-up"></i> 4%</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-12">
							<div class="box no-shadow no-border bg-lightest">
								<div class="box-body">
									<h2 class="fw-600 text-primary">16</h2>
									<small> Signalements</small>
									<p class="text-mute mb-0">Cette semaine</p>
									<p class="text-success mb-0"><i class="fa fa-arrow-up"></i> 2.5%</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-12">
							<div class="box no-shadow no-border bg-lightest">
								<div class="box-body">
									<h2 class="fw-600 text-success">39</h2>
									<small> Signalements</small>
									<p class="text-mute mb-0">Ce mois</p>
									<p class="text-success mb-0"><i class="fa fa-arrow-up"></i> 7%</p>
								</div>
							</div>
						</div>
					</div>	
					</br>

				</div>
			</div>
		</div> -->
			<!-- <div class="col-xxxl-4 col-xl-3 col-12">
			<div class="box">
				<div class="box-header">
					<h4 class="box-title">
						Signalements
					</h4>
				</div>
				<div class="box-body" style="background-color:#FBFBFB">
					<div class="activity-div">
						<div class="timeline-label">
							<?php
							$today = date('d', strtotime($dateDuJour));

							while ($row = mysqli_fetch_array($getIncidents)) {
								$service = $row['sigle'];
								$description = $row['description'];
								$auteur = $row['prenom'] . ' ' . $row['nom'];
								$date_reception = date('d-m', strtotime($row['date_reception']));
								$jour_reception = date('d', strtotime($row['date_reception']));
								$heure_reception = date('H:i', strtotime($row['date_reception']));
								$couleur = $row['couleur'];

								if ($today == $jour_reception) {
									$jour = "Aujourd'hui";
								} elseif ($today == ($jour_reception - 1)) {
									$jour = 'Hier';
								} else {
									$jour = $date_reception;
								}
							?>

							<div class="timeline-item">
								<div class="timeline-label fw-500 fs-13">
									<?php echo $heure_reception; ?></br>
									<small style="font-size:10px; font-style:italic"><?php echo $jour; ?></small></br>
									<small style="font-size:10px; font-style:italic"><?php echo $service; ?></small>

								</div>
								
								<div class="timeline-badge">
									<i class="fa fa-genderless fs-14" style="color:<?php echo $couleur; ?>"></i>
								</div>
								<div class="timeline-content text-muted ps-3"><?php echo $description; ?></div>
							</div>
							<?php } ?>

						</div>
					</div>							
				</div>
			</div>
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">
						Repartition
					</h3>
				</div>
				<div class="box-body" style="background-color:#FBFBFB">
					<div style="min-height: 207.7px;">
						<div id="sales-chart"></div>
					</div>	
			</br>						
				</div>
			</div>	
		</div> -->

			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title align-items-start flex-column">
							Listes des interventions
							<!-- <small class="subtitle">More than 400+ new members</small> -->
						</h3>
					</div>
					<div class="box-body" style="background-color:#FBFBFB">
						<div class="table-responsive">
							<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
								<thead>
									<tr>
										<th style="width:6%">Ref</th>
										<th style="width:13%">Service</th>
										<th style="width:10%">Type</th>
										<th style="width:15%">Intervenant</th>
										<th style="width:12%">Date</th>
										<th style="width:11%">Statut</th>
										<!-- <th style="width:20%">Responsable</th> -->
										<!-- <th>Responsable</th> -->
										<!-- <th>Status</th> -->
										<?php if ($roleUser == 'Administrateur') { ?>
											<th style="width:10%;text-align:center">Action</th>
										<?php }; ?>
									</tr>
								</thead>
								<tbody>
									<?php while ($row = mysqli_fetch_array($getInterventions)) {
										$intervenant = $row['intervenant'];
										$service = $row['sigle'];
										$categorie = $row['type_incident'];
										$date_intervention = $row['date_intervention'];
										$code_intervention = $row['code_intervention'];
										$type_intervenant = $row['type_intervenant'];
										$numero_incident = $row['numero_incident'];
										$statut = $row['statut'];

										// get couleur
										$getCouleur = mysqli_query($con, "SELECT * FROM signalements INNER JOIN type_incidents on type_incidents.code_incident=signalements.code_incident where signalements.numero_incident='$numero_incident'");
										while ($row = mysqli_fetch_array($getCouleur)) {
											$couleur = $row['couleur'];
										}

										// echo $couleur;die;


										if ($type_intervenant == 'prestataire') {
											$recupPresta = mysqli_query($con, "SELECT * FROM prestataires WHERE matricule_presta='$intervenant'");
											while ($row = mysqli_fetch_array($recupPresta)) {
												$intervenant_incident = $row['denomination'];
											}
										}
										if ($type_intervenant == 'interne') {
											$recupInterne = mysqli_query($con, "SELECT * FROM intervenants_interne WHERE matricule_intervenant='$intervenant'");
											while ($row = mysqli_fetch_array($recupInterne)) {
												$intervenant_incident = $row['prenom'] . ' ' . $row['nom'];
											}
										}

										if ($type_intervenant == 'service') {
											$recupService = mysqli_query($con, "SELECT * FROM services_intervenant WHERE matricule_service='$intervenant'");
											while ($row = mysqli_fetch_array($recupService)) {
												$intervenant_incident = $row['nom_service'];
											}
										}

										// Fin intervenant
									?>
										<tr>
											<td><?php echo '#' . $code_intervention; ?></td>
											<td><?php echo $service; ?></td>
											<td>

												<span class="badge badge-pill" style="background-color:<?php echo $couleur; ?>"><?php echo $categorie; ?></span></br>

											</td>
											<td><?php echo $intervenant_incident; ?></td>
											<td><?php echo date('d-m-Y', strtotime($date_intervention)); ?></td>
											<td><span class="badge badge-<?php
																										switch ($statut) {
																											case 'planifiee':
																												echo 'primary';
																												break;
																											case 'terminee':
																												echo 'success';
																												break;
																											case 'annulee':
																												echo 'danger';
																												break;
																											case 'en retard':
																												echo 'info';
																												break;

																											default:
																												echo 'info';
																												break;
																										}
																										?>-light"><?php echo $statut; ?></span></td>
											<?php if ($roleUser == 'Administrateur') { ?>

												<td style="text-align:center">
													<!-- <a href="fiche_intervention?code_intervention=<?php //echo  $code_intervention; 
																																							?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
										<i class="fa fa-eye" style="font-size:16px;color:black"></i>
									</a>  -->
													<a href="fiche_intervention.php?code_intervention=<?php echo  $code_intervention; ?>" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Settings-1 fs-18"><span class="path1"></span><span class="path2"></span></span></a>
													<!-- <a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle mx-5"><span class="icon-Write"><span class="path1"></span><span class="path2"></span></span></a>
										<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Trash1 fs-18"><span class="path1"></span><span class="path2"></span></span></a> -->
													<!-- <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
										<i class="ti-trash"></i>
									</a> -->
												</td>
											<?php }; ?>
										</tr>
									<?php } ?>
								</tbody>


							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>