<?php
// include ('config/app.php');

$getServiceBatimentsEtages = mysqli_query($con, "SELECT services.libelle, services.sigle, batiments.nom_batiment, batiments.adresse, etages.nom_etage,localisation_services_etage.id
FROM `localisation_services_etage` 
INNER JOIN services ON services.code_service=localisation_services_etage.code_service 
INNER JOIN batiments ON batiments.code_batiment=localisation_services_etage.code_batiment
INNER JOIN etages ON etages.code_etage=localisation_services_etage.code_etage");


?>
<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:60%">Service</th>
				<th style="width:20%">Bâtiment</th>
				<th style="width:10%">Etage</th>
				<th style="width:10%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getServiceBatimentsEtages)) while ($row = mysqli_fetch_array($getServiceBatimentsEtages)) {
			?>
				<tr>
					<td><?php echo $row['libelle'] . ' ( ' . $row['sigle'] . ' )'; ?></td>
					<td>
						<?php echo $row['nom_batiment']; ?>
					</td>
					<td><?php echo $row['nom_etage']; ?></td>
					<td style="text-align:center">
						<a href="?edit=<?php echo $row['id']; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="?delete=<?php echo $row['id']; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>