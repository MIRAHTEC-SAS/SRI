
<section class="content">
	<div class="row">
		<div class="col-xxxl-8 col-xl-9 col-12">	
		  <div class="row">
			<!-- Incidents -->
		  	<div class="col-xl-6 col-12">
				<!-- small box -->
				<!-- <div class="small-box box-inverse bg-img" style="background-image: url(../../../images/gallery/thumb/7.jpg);" data-overlay="5"> -->
				<div class="small-box bg-success">	
				<div class="inner">
					<h3><?php echo $nbMembre; ?></h3>
					<p>Membres</p>
					</div>
					<div class="icon text-white">
					<span class="icon-Equalizer"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>
					</div>
					<a href="#" class="small-box-footer">Voir <i class="fa fa-arrow-right"></i></a>
				</div>
			</div>
		<!-- Interventions  -->
			<div class="col-xl-6 col-12">
			  <!-- small box -->
			  <div class="small-box bg-primary">
				<div class="inner">
				  <h3><?php echo $nbDemandesValidation; ?></h3>
				  <p>Demandes de validation</p>
				</div>
				<div class="icon">
				  <span class="icon-Add-user text-white"><span class="path1"></span><span class="path2"></span></span>
				</div>
				<a href="demandes_validation_profil" class="small-box-footer">Voir <i class="fa fa-arrow-right"></i></a>
			  </div>
			</div>
		  </div>
		  <!-- /.row -->	
		  <!-- Tableau interventions... -->
<div class="box">
						<div class="box-header">
							<h3 class="box-title">Incidents en cours dans le service</h3>
						</div>
						<div class="box-body" style="background-color:#FBFBFB">
                            <div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:10%">Reference</th>
				<th style="width:20%">Service</th>
				<th style="width:50%">Incident</th>
				<th style="width:10%">Priorité</th>
				<!-- <th style="width:10%">Date</th>
				<th style="width:15%">Auteur</th> -->
				<th style="width:10%">Categorie</th>
				<!-- <th>Responsable</th> -->
				<!-- <th>Status</th> -->
				<th style="width:10%;text-align:center">Actions</th>					 
			</tr>
		</thead>
		<tbody>
            <?php while ($row = mysqli_fetch_array($getSignalements)) { 
                $numero_incident=$row['numero_incident']; 
				$code_incident=$row['code_incident']; 
				$type_incident=$row['type_incident']; 
				$service=$row['sigle'];
				$date_reception=date('d/m/Y', strtotime($row['date_reception']));
				$description=$row['description'];
				$priorite=$row['priorite'];
				$auteur=$row['auteur'];
				$couleur_type_incident=$row['couleur_type'];
				$couleur_priorite=$row['couleur_priorite'];

				?>

				
			<tr>
				<td><?php echo '#'.$numero_incident; ?></td>
				<td><?php echo $service; ?></td>
                <td><?php echo substr($description,0,100).'<small>...</small>'; ?></td>
				<td>
                    <span class="badge badge-pill" style="background-color:<?php echo $couleur_priorite;?>"><?php echo $priorite; ?></span></br>
                </td>
				
				<!-- <td><?php //echo $date_reception; ?></td>
				<td><?php //echo $auteur; ?></td> -->
				<!-- <td>
                    <?php 
                        //$getTypes = mysqli_query($con, "SELECT DISTINCT signalements_incidents.numero_incident, type_incidents.type_incident FROM `signalements_incidents` INNER JOIN type_incidents ON type_incidents.code_incident=signalements_incidents.code_incident where signalements_incidents.numero_incident='$numero_incident'");
                       // while ($row = mysqli_fetch_array($getTypes)) { 
                           // echo '<span class="badge badge-pill badge-success">P1</span></br>';
                       // }
                    ?>
                </td> -->
				<td>
                    <span class="badge badge-pill" style="background-color:<?php echo $couleur_type_incident;?>"><?php echo $type_incident; ?></span></br>
                </td>
                <td style="text-align:center">
                    <a href="details_signalements?numero_incident=<?php echo  $numero_incident; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
				        <i class="fa fa-eye" style="font-size:16px;color:black"></i>
					</a> 
					<!-- <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
						<i class="ti-trash"></i>
					</a> -->
				</td>
			</tr>
			<?php } ?>	
        </tbody>						
	</table>
                            </div>
						</div>	
					</div>

<!-- End interventions -->			
<!-- Tableau interventions... -->
<div class="box">
						<div class="box-header">
							<h3 class="box-title">Interventions planifiées dans le service</h3>
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
										<th style="width:10%;text-align:center">Action</th>					 
									</tr>
								</thead>
								<tbody>
									<?php while ($row = mysqli_fetch_array($getInterventions)) { 
										$intervenant=$row['intervenant'];
										$service=$row['sigle'];
										$categorie=$row['type_incident'];
										$couleur=$row['couleur'];
										$date_intervention=$row['date_intervention'];
										$code_intervention=$row['code_intervention'];
										$type_intervenant=$row['type_intervenant']; 
										$numero_incident=$row['numero_incident']; 
										$statut=$row['statut'];

										// 	// get couleur
										// $getCouleur = mysqli_query($con, "SELECT * FROM signalements_incidents INNER JOIN type_incidents on type_incidents.code_incident=signalements_incidents.code_incident where signalements_incidents.numero_incident='$numero_incident'");
										// while ($row = mysqli_fetch_array($getCouleur)) { 
										// 	$couleur=$row['couleur_incident'];
										// }

										// echo $couleur;die;


										if ($type_intervenant=='prestataire') {
										$recupPresta=mysqli_query($con, "SELECT * FROM prestataires WHERE matricule_presta='$intervenant'");
										while ($row = mysqli_fetch_array($recupPresta)) { 
											$intervenant_incident=$row['denomination'];
											}
										}
										if ($type_intervenant=='interne') {
										$recupInterne=mysqli_query($con, "SELECT * FROM intervenants_interne WHERE matricule_intervenant='$intervenant'");
										while ($row = mysqli_fetch_array($recupInterne)) { 
											$intervenant_incident=$row['prenom'].' '.$row['nom'];
											}
										}
									
										if ($type_intervenant=='service') {
											$recupService=mysqli_query($con, "SELECT * FROM services_intervenant WHERE matricule_service='$intervenant'");
										while ($row = mysqli_fetch_array($recupService)) { 
											$intervenant_incident=$row['nom_service'];
											}
										}				

											// Fin intervenant
										?>
									<tr>
										<td><?php echo '#'.$code_intervention; ?></td>
										<td><?php echo $service; ?></td>
										<td>
											
										<span class="badge badge-pill" style="background-color:<?php echo $couleur;?>"><?php echo $categorie;?></span></br>
										
										</td>
										<td><?php echo $intervenant_incident; ?></td>
										<td><?php echo date('d-m-Y', strtotime($date_intervention)); ?></td>
										<td><span class="badge badge-<?php 
										switch($statut) {
											case 'planifiee' : echo 'primary';break;
											case 'terminee' : echo 'success';break;
											case 'annulee' : echo 'danger';break;
											case 'en retard' : echo 'info';break;

											default : echo 'info';break;
										}
										?>-light"><?php echo $statut; ?></span></td>
										
										<td style="text-align:center">
											<!-- <a href="fiche_intervention?code_intervention=<?php echo  $code_intervention; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
												<i class="fa fa-eye" style="font-size:16px;color:black"></i>
											</a>  -->
											<a href="fiche_intervention?code_intervention=<?php echo  $code_intervention; ?>" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Settings-1 fs-18"><span class="path1"></span><span class="path2"></span></span></a>
												<!-- <a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle mx-5"><span class="icon-Write"><span class="path1"></span><span class="path2"></span></span></a>
												<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Trash1 fs-18"><span class="path1"></span><span class="path2"></span></span></a> -->
											<!-- <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
												<i class="ti-trash"></i>
											</a> -->
										</td>
									</tr>
									<?php } ?>	
									</tbody>			
												
															
                                </table>
                            </div>
						</div>	
					</div>

<!-- End interventions -->				
		  <div class="box">
				<div class="box-header">
					<h3 class="box-title">Statistiques incidents du service</h3>
						</div>
						<div class="box-body" style="background-color:#FBFBFB">
							<div class="d-md-flex d-block justify-content-between">
								<div>
									<p class="mb-0 text-fade"><small>Indicateur</small></p>
									<h3 class="my-0">...5</h3>
									<p class="mb-0 text-success"><i class="fa fa-arrow-up me-5"></i>12.37%</p>
								</div>
								<div>
									<p class="mb-0 text-fade"><small>Indicateur</small></p>
									<h3 class="my-0">3.98K</h3>
									<p class="mb-0 text-success"><i class="fa fa-arrow-up me-5"></i>47.74%</p>
								</div>
								<div>
									<p class="mb-0 text-fade"><small>Indicateur</small></p>
									<h3 class="my-0">28.49%</h3>
									<p class="mb-0 text-danger"><i class="fa fa-arrow-down me-5"></i>12.37%</p>
								</div>
								<div>
									<p class="mb-0 text-fade"><small>Indicateur</small></p>
									<h3 class="my-0">...</h3>
									<p class="mb-0 text-success"><i class="fa fa-arrow-up me-5"></i>12.37%</p>
								</div>
							</div>
							<div id="flotChart" class="mt-50"></div>
						</div>
					</div>
					

			</div>
				<div class="col-xxxl-4 col-xl-3 col-12">
					<div class="box">
						<div class="box-header">
							<h4 class="box-title">
								Activités
							</h4>
						</div>
						<div class="box-body" style="background-color:#FBFBFB">
							<div class="activity-div">
								<div class="timeline-label">
									<?php 
										// $today=date('d', strtotime($dateDuJour));

										// while ($row = mysqli_fetch_array($getIncidents)) { 
										// $service = $row['sigle'];
										// $description=$row['description'];
										// $auteur=$row['prenom'].' '.$row['nom'];
										// $date_reception=date('d-m', strtotime($row['date_reception']));
										// $jour_reception=date('d', strtotime($row['date_reception']));
										// $heure_reception=date('H:i', strtotime($row['date_reception']));
										// $couleur=$row['couleur'];
										
										// if ($today==$jour_reception) 
										// {
										// 	$jour="Aujourd'hui";
										// }
										// elseif ($today==($jour_reception-1))
										// {
										// 	$jour='Hier';
										// }
										// else {
										// 	$jour=$date_reception;
										// }
										?>

									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-13">
											<?php //echo $heure_reception; ?> 13h:08</br>
											<small style="font-size:10px; font-style:italic"><?php //echo $jour; ?>Aujourd'hui</small></br>
											<small style="font-size:10px; font-style:italic"><?php //echo $service; ?></small>

										</div>
										
										<div class="timeline-badge">
											<i class="fa fa-genderless fs-14" style="color:blue<?php //echo $couleur; ?>"></i>
										</div>
										<div class="timeline-content text-muted ps-3">Profil etudiant valide<?php //echo $description; ?></div>
									</div>

									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-13">
											<?php //echo $heure_reception; ?> 12h:38</br>
											<small style="font-size:10px; font-style:italic"><?php //echo $jour; ?>Aujourd'hui</small></br>
											<small style="font-size:10px; font-style:italic"><?php //echo $service; ?></small>

										</div>
										
										<div class="timeline-badge">
											<i class="fa fa-genderless fs-14 primary" style="color:red<?php //echo $couleur; ?>"></i>
										</div>
										<div class="timeline-content text-muted ps-3">Demande de validation<?php //echo $description; ?></div>
									</div>

									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-13">
											<?php //echo $heure_reception; ?> 10h:09</br>
											<small style="font-size:10px; font-style:italic"><?php //echo $jour; ?>Aujourd'hui</small></br>
											<small style="font-size:10px; font-style:italic"><?php //echo $service; ?></small>

										</div>
										
										<div class="timeline-badge">
											<i class="fa fa-genderless fs-14 primary" style="color:purple<?php //echo $couleur; ?>"></i>
										</div>
										<div class="timeline-content text-muted ps-3">Nouvelle publication<?php //echo $description; ?></div>
									</div>

									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-13">
											<?php //echo $heure_reception; ?> 10h:09</br>
											<small style="font-size:10px; font-style:italic"><?php //echo $jour; ?>Aujourd'hui</small></br>
											<small style="font-size:10px; font-style:italic"><?php //echo $service; ?></small>

										</div>
										
										<div class="timeline-badge">
											<i class="fa fa-genderless fs-14 primary" style="color:brown<?php //echo $couleur; ?>"></i>
										</div>
										<div class="timeline-content text-muted ps-3">Nouvelle publication<?php //echo $description; ?></div>
									</div>
									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-13">
											<?php //echo $heure_reception; ?> 10h:09</br>
											<small style="font-size:10px; font-style:italic"><?php //echo $jour; ?>Aujourd'hui</small></br>
											<small style="font-size:10px; font-style:italic"><?php //echo $service; ?></small>

										</div>
										
										<div class="timeline-badge">
											<i class="fa fa-genderless fs-14 primary" style="color:bleu<?php //echo $couleur; ?>"></i>
										</div>
										<div class="timeline-content text-muted ps-3">Nouvelle publication<?php //echo $description; ?></div>
									</div>
									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-13">
											<?php //echo $heure_reception; ?> 10h:09</br>
											<small style="font-size:10px; font-style:italic"><?php //echo $jour; ?>Aujourd'hui</small></br>
											<small style="font-size:10px; font-style:italic"><?php //echo $service; ?></small>

										</div>
										
										<div class="timeline-badge">
											<i class="fa fa-genderless fs-14 primary" style="color:orange<?php //echo $couleur; ?>"></i>
										</div>
										<div class="timeline-content text-muted ps-3">Nouvelle publication<?php //echo $description; ?></div>
									</div>
									<?php //} ?>

								</div>
							</div>							
						</div>
					</div>
					<div class="box">
								<div class="box-header no-border">
									<h4 class="box-title">
										Rendez-vous des membres
									</h4>
									<ul class="box-controls pull-right">
									  <li class="dropdown">
										<a data-bs-toggle="dropdown" href="#"><i class="ti-more-alt rotate-90"></i></a>
										<div class="dropdown-menu dropdown-menu-end">
										  <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>
										  <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>
										  <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>
										  <div class="dropdown-divider"></div>
										  <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
										</div>
									  </li>
									</ul>
								</div>
								<div class="box-body px-0 pt-0" style="background-color:#FBFBFB">
									<div id="calendar" class="dask min-h-400"></div>
								</div>
								<div class="box-body p-0" style="background-color:#FBFBFB">
									<div class="events-side">
										<div class="media-list media-list-hover">
											<div class="media media-single">
											  <div class="media-body">
												<h6 class="fw-600"><a href="#">08 Août</a></h6>
												<p class="text-fader">Rendez-vous Amet et Moussa</p>
											  </div>
											</div>
											<div class="media media-single">
											  <div class="media-body">
											  <h6 class="fw-600"><a href="#">08 Août</a></h6>
												<p class="text-fader">Rendez-vous Amet et Moussa</p>
											  </div>
											</div>
										
										</div>
									</div>
									<!-- <div class="text-center bt-1 border-light p-10">
										<a class="text-uppercase d-block" href="#">Add Events</a>
								    </div> -->
								</div>
							</div>
				</div>
				
			</div>				
</section>