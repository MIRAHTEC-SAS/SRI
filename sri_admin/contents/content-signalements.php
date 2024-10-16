<?php


$getSignalements = mysqli_query($con, "SELECT 
signalements.date_reception,
signalements.numero_incident,
signalements.code_incident,
signalements.auteur,
signalements.statut,
signalements.description,
services.sigle,
type_incidents.type_incident,
type_incidents.couleur as couleur_type,
code_priorite.priorite,
code_priorite.couleur_priorite

FROM `signalements` INNER JOIN services on services.code_service=signalements.code_service INNER JOIN type_incidents ON type_incidents.code_incident=signalements.code_incident INNER JOIN code_priorite ON code_priorite.code=signalements.code_priorite where statut='en attente'");

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
				<th style="width:10%">Reference</th>
				<th style="width:20%">Service</th>
				<th style="width:25%">Incident</th>
				<th style="width:10%">Priorité</th>
				<th style="width:10%">Date</th>
				<th style="width:15%">Auteur</th>
				<th style="width:10%">Categorie</th>
				<!-- <th>Responsable</th> -->
				<!-- <th>Status</th> -->
				<th style="width:10%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($getSignalements)) {
				$numero_incident = $row['numero_incident'];
				$code_incident = $row['code_incident'];
				$type_incident = $row['type_incident'];
				$service = $row['sigle'];
				$date_reception = date('d/m/Y', strtotime($row['date_reception']));
				$description = $row['description'];
				$priorite = $row['priorite'];
				$auteur = $row['auteur'];
				$couleur_type_incident = $row['couleur_type'];
				$couleur_priorite = $row['couleur_priorite'];

			?>


				<tr>
					<td><?php echo '#' . $numero_incident; ?></td>
					<td><?php echo $service; ?></td>
					<td><?php echo substr($description, 0, 100) . '<small>...</small>'; ?></td>
					<td>
						<span class="badge badge-pill" style="background-color:<?php echo $couleur_priorite; ?>"><?php echo $priorite; ?></span></br>
					</td>

					<td><?php echo $date_reception; ?></td>
					<td><?php echo $auteur; ?></td>
					<!-- <td>
                    <?php
										//$getTypes = mysqli_query($con, "SELECT DISTINCT signalements_incidents.numero_incident, type_incidents.type_incident FROM `signalements_incidents` INNER JOIN type_incidents ON type_incidents.code_incident=signalements_incidents.code_incident where signalements_incidents.numero_incident='$numero_incident'");
										// while ($row = mysqli_fetch_array($getTypes)) { 
										// echo '<span class="badge badge-pill badge-success">P1</span></br>';
										// }
										?>
                </td> -->
					<td>
						<span class="badge badge-pill" style="background-color:<?php echo $couleur_type_incident; ?>"><?php echo $type_incident; ?></span></br>
					</td>
					<td style="text-align:center">

						<a href="details_signalements?numero_incident=<?php echo  $numero_incident; ?>" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Settings-1 fs-18"><span class="path1"></span><span class="path2"></span></span></a>
						<!-- <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
						<i class="ti-trash"></i>
					</a> -->
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>