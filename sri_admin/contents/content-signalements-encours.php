<?php
// include ('config/app.php');

$getSignalements = mysqli_query($con, "SELECT * FROM `signalements` 
INNER JOIN services on services.code_service=signalements.code_service
INNER JOIN type_incidents ON type_incidents.code_incident=signalements.code_incident
 where statut='en cours'");

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
				<th style="width:15%">Service</th>
				<th style="width:35%">Incident</th>
				<th style="width:20%">Auteur</th>
				<!-- <th style="width:10%">Priorité</th> -->
				<th style="width:10%">Categorie</th>
				<!-- <th>Responsable</th> -->
				<!-- <th>Status</th> -->
				<!-- <th style="width:10%;text-align:center">Actions</th> -->
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($getSignalements)) {
				$numero_incident = $row['numero_incident'];
				$service = $row['sigle'];
				$description = $row['description'];
				$declarant = $row['auteur'];
				$couleur = $row['couleur'];
				$type_incident = $row['type_incident'];
			?>


				<tr>
					<td><?php echo '#' . $numero_incident; ?></td>
					<td><?php echo $service; ?></td>
					<td><?php echo substr($description, 0, 100) . '<small>...</small>'; ?></td>
					<td><?php echo $declarant; ?></td>
					<td>
						<span class="badge badge-pill" style="background-color:<?php echo $couleur; ?>"><?php echo $type_incident; ?></span></br>
					</td>
					<!-- <td style="text-align:center">
						<a href="#?numero_incident=<?php //echo  $numero_incident; 
																				?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-eye" style="font-size:16px;color:black"></i>
						</a>
					</td> -->
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>