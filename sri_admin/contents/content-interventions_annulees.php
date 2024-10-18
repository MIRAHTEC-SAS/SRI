<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:6%">Ref</th>
				<th style="width:13%">Service</th>
				<th style="width:10%">Type</th>
				<th style="width:15%">Intervenant</th>
				<th style="width:15%">Statut Incident</th>
				<th style="width:15%">Date d'annulation</th>
				<!-- <th style="width:20%">Responsable</th> -->
				<!-- <th>Responsable</th> -->
				<!-- <th>Status</th> -->
				<th style="width:10%;text-align:center">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($getInterventionsAnnulees)) {
				$intervenant = $row['intervenant'];
				$service = $row['sigle'];
				$couleur = $row['couleur'];
				$categorie = $row['type_incident'];
				$date_annulation = $row['date_saisie'];
				$code_intervention = $row['code_intervention'];
				$type_intervenant = $row['type_intervenant'];
				$numero_incident = $row['numero_incident'];
				$statut_incident = $row['statut_incident'];


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
					<td><?php echo $statut_incident; ?></td>
					<td><?php echo date('d/m/Y', strtotime($date_annulation)); ?></td>

					<td style="text-align:center">
						<a href="fiche_intervention.php?code_intervention=<?php echo  $code_intervention; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
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