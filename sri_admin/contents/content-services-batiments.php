<?php
// include ('config/app.php');

$getServiceBatiments = mysqli_query($con, "SELECT services.libelle, services.sigle, batiments.nom_batiment, batiments.adresse,localisation_services.id
FROM `localisation_services` 
INNER JOIN services ON services.code_service=localisation_services.code_service 
INNER JOIN batiments ON batiments.code_batiment=localisation_services.code_batiment");


?>
<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:50%">Service</th>
				<th style="width:20%">Bâtiment</th>
				<th style="width:20%">Adresse</th>
				<th style="width:10%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getServiceBatiments)) while ($row = mysqli_fetch_array($getServiceBatiments)) {  ?>
				<tr>
					<td><?php echo $row['libelle'] . ' ( ' . $row['sigle'] . ' )'; ?></td>
					<td>
						<?php echo $row['nom_batiment']; ?>
					</td>
					<td><?php echo $row['adresse']; ?></td>
					<td style="text-align:center">
						<a href="services_batiments.php?edit=<?php echo $row['id']; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="services_batiments.php?delete=<?php echo $row['id']; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>