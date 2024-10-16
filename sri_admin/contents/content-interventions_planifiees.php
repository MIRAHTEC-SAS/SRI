<?php
// Recuperation du type d'intervenant

// $getTypeIntervenant = mysqli_query($con, "SELECT type_intervenant FROM interventions");

$getInterventionsPlanifiees = mysqli_query($con, "SELECT 
interventions.code_intervention,
interventions.code_incident,
interventions.intervenant,
interventions.numero_incident,
interventions.date_intervention,
interventions.date_saisie,
interventions.statut,
services.code_service,
services.libelle,
services.sigle,
type_incidents.type_incident,
interventions.type_intervenant
FROM `interventions`
INNER JOIN services ON services.code_service=interventions.service
INNER JOIN type_incidents ON type_incidents.code_incident=interventions.code_incident WHERE interventions.statut='planifiee'");

// $listeAgents=[];
// $codeDirections=[];
// while ($row = mysqli_fetch_array($getSignalements)) { 
//     $listeAgents[] = $row['matricule'];
//     $codeDirections[]=$row['codeDirection'];
// }


?>
<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:6%">Ref</th>
				<th style="width:13%">Service</th>
				<th style="width:10%">Type</th>
				<th style="width:23%">Intervenant</th>
				<th style="width:15%">Date</th>
				<!-- <th style="width:20%">Responsable</th> -->
				<!-- <th>Responsable</th> -->
				<!-- <th>Status</th> -->
				<th style="width:10%;text-align:center">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($getInterventionsPlanifiees)) {
				$intervenant = $row['intervenant'];
				$service = $row['sigle'];
				$categorie = $row['type_incident'];
				$date_intervention = $row['date_intervention'];
				$code_intervention = $row['code_intervention'];
				$type_intervenant = $row['type_intervenant'];
				$numero_incident = $row['numero_incident'];

				// get couleur
				$getCouleur = mysqli_query($con, "SELECT * FROM signalements INNER JOIN type_incidents on type_incidents.code_incident=signalements.code_incident where signalements.numero_incident='$numero_incident'");
				$couleur = '';
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
				// var_dump($row);

				// Fin intervenant
			?>
				<tr>
					<td><?php echo '#' . $code_intervention; ?></td>
					<td><?php echo $service; ?></td>
					<td>

						<span class="badge badge-pill" style="background-color:<?php echo $couleur; ?>"><?php echo $categorie; ?></span></br>

					</td>
					<td><?php echo $intervenant_incident; ?></td>
					<td><?php echo $date_intervention; ?></td>

					<td style="text-align:center">

						<a href="fiche_intervention?code_intervention=<?php echo  $code_intervention; ?>" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Settings-1 fs-18"><span class="path1"></span><span class="path2"></span></span></a>

						<!-- <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
						<i class="ti-trash"></i>
					</a> -->
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>