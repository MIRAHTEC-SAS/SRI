<?php
$getGestionnaires = mysqli_query($con, "SELECT * FROM `gestionnaires` order by id desc");


// $getGestionnaires = mysqli_query($con, "SELECT 
// gestionnaires.matricule_gestionnaire,
// gestionnaires.prenom,
// gestionnaires.nom,
// gestionnaires.email,
// gestionnaires.telephone,
// services.code_service,
// services.libelle,
// services.sigle
// FROM `gestionnaires_services` INNER JOIN services on services.code_service=gestionnaires_services.code_service inner JOIN gestionnaires on gestionnaires.matricule_gestionnaire=gestionnaires_services.matricule_gestionnaire");

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
				<th style="width:20%">Gestionnaire</th>
				<th style="width:20%">Telephone</th>
				<th style="width:20%">Email</th>
				<th style="width:30%">Service</th>
				<th style="width:10%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getGestionnaires)) while ($row = mysqli_fetch_array($getGestionnaires)) {
				$matricule_gestionnaire = $row['matricule_gestionnaire']  ?>
				<tr>
					<td><?php echo $row['prenom'] . ' ' . $row['nom']; ?></td>
					<td><?php echo $row['telephone']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td>
						<?php
						$getServicesGestionnaires = mysqli_query($con, "SELECT * FROM `gestionnaires_services` INNER JOIN services ON services.code_service=gestionnaires_services.code_service WHERE matricule_gestionnaire='$matricule_gestionnaire'");
						$services = [];
						while ($row = mysqli_fetch_array($getServicesGestionnaires)) {
							$services[] = $row['sigle'];
						}
						if (empty($getServicesGestionnaires)) {
							echo '';
						} else {
							for ($i = 0; $i < count($services); $i++) {
								echo $services[$i] . '</br>';
							}
						}

						?>
					</td>
					<td style="text-align:center">
						<a href="gestionnaires?edit=<?php echo $matricule_gestionnaire; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="gestionnaires?delete=<?php echo $matricule_gestionnaire; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>