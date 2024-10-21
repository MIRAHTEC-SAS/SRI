<?php
// include ('config/app.php');

$getGestionnairesParService = mysqli_query($con, "SELECT 
gestionnaires_services.id,
gestionnaires.matricule_gestionnaire,
gestionnaires.prenom,
gestionnaires.nom,
gestionnaires.email,
gestionnaires.telephone,
services.code_service,
services.libelle,
services.sigle
FROM `gestionnaires_services` INNER JOIN services on services.code_service=gestionnaires_services.code_service inner JOIN gestionnaires on gestionnaires.matricule_gestionnaire=gestionnaires_services.matricule_gestionnaire");

// $listeAgents = [];
// $codeDirections = [];
// while ($row = mysqli_fetch_array($getSignalements)) {
// 	$listeAgents[] = $row['matricule'];
// 	$codeDirections[] = $row['codeDirection'];
// }

?>
<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:20%">Gestionnaire</th>
				<th style="width:50%">Services</th>
				<th style="width:15%">Sigle</th>
				<th style="width:15%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getGestionnairesParService)) while ($row = mysqli_fetch_array($getGestionnairesParService)) {  ?>
				<tr>
					<td><?php echo $row['prenom'] . ' ' . $row['nom']; ?></td>
					<td><?php echo $row['libelle']; ?></td>
					<td>
						<?php echo $row['sigle']; ?>
					</td>
					<td style="text-align:center">
						<a href="affecter_gestionnaires?edit=<?php echo $row['id']; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="affecter_gestionnaires?delete=<?php echo $row['id']; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>