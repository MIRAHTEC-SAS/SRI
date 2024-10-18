<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:10%">Ref</th>
				<th style="width:15%">Service</th>
				<th style="width:60%">Description</th>
				<!-- <th style="width:23%">Intervenant</th> -->
				<th style="width:15%">Date</th>
				<!-- <th style="width:20%">Responsable</th> -->
				<!-- <th>Responsable</th> -->
				<!-- <th>Status</th> -->
				<th style="width:10%;text-align:center">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($getInterventionsValidees)) {
				$intervenant = $row['intervenant'];
				$service = $row['sigle'];
				$couleur = $row['couleur'];
				$categorie = $row['type_incident'];
				$date_intervention = $row['date_intervention'];
				$code_intervention = $row['code_intervention'];
				$type_intervenant = $row['type_intervenant'];
				$numero_incident = $row['numero_incident'];
				$couleur_type_incident = $row['couleur_type'];
				$date_reception = $row['date_reception'];
				$description = $row['description'];




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
					<td><?php echo $description; ?>
						<!-- <span class="badge badge-pill" style="background-color:blue<?php //echo $couleur_type_incident;
																																						?>"><?php //echo $categorie; 
																																																										?></span></br> -->

					</td>
					<td><?php echo date('d/m/Y', strtotime($date_reception)); ?></td>

					<td style="text-align:center">

						<a href="fiche_intervention.php?code_intervention=<?php echo  $code_intervention; ?>" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Settings-1 fs-18"><span class="path1"></span><span class="path2"></span></span></a>

						<!-- <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
						<i class="ti-trash"></i>
					</a> -->
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>