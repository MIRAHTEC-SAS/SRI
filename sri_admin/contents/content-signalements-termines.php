<?php
// include ('config/app.php');

$getSignalements = mysqli_query($con, "SELECT * FROM `signalements` INNER JOIN services on services.code_service=signalements.code_service where statut='termine'");

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
				// get code incident
				$getCouleur = mysqli_query($con, "SELECT * FROM signalements INNER JOIN type_incidents on type_incidents.code_incident=signalements.code_incident where signalements.numero_incident='$numero_incident'");
				while ($row = mysqli_fetch_array($getCouleur)) {
					$couleur = $row['couleur'];
				}

			?>


				<tr>
					<td><?php echo '#' . $numero_incident; ?></td>
					<td><?php echo $service; ?></td>
					<td><?php echo substr($description, 0, 100) . '<small>...</small>'; ?></td>
					<td><?php echo $declarant; ?></td>
					<!-- <td>
                    <?php
										//$getTypes = mysqli_query($con, "SELECT DISTINCT signalements_incidents.numero_incident, type_incidents.type_incident FROM `signalements_incidents` INNER JOIN type_incidents ON type_incidents.code_incident=signalements_incidents.code_incident where signalements_incidents.numero_incident='$numero_incident'");
										// while ($row = mysqli_fetch_array($getTypes)) { 
										// echo '<span class="badge badge-pill badge-success">P1</span></br>';
										// }
										?>
                </td> -->
					<td>
						<?php
						$getTypes = mysqli_query($con, "SELECT DISTINCT signalements.numero_incident, type_incidents.type_incident FROM `signalements` INNER JOIN type_incidents ON type_incidents.code_incident=signalements.code_incident where signalements.numero_incident='$numero_incident'");
						while ($row = mysqli_fetch_array($getTypes)) { ?>
							<span class="badge badge-pill" style="background-color:<?php echo $couleur; ?>"><?php echo $row['type_incident']; ?></span></br>
						<?php } ?>

					</td>
					<!-- <td style="text-align:center">
						<a href="#?numero_incident=<?php //echo  $numero_incident; 
																				?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-eye" style="font-size:16px;color:black"></i>
						</a> -->
					<!-- <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
						<i class="ti-trash"></i>
					</a> -->
					<!-- </td> -->
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>