<?php
// include ('config/app.php');

$getResponsables = mysqli_query($con, "SELECT * FROM `responsables_dage` order by id desc");

?>
<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:30%">Responsable</th>
				<th style="width:20%">Telephone</th>
				<th style="width:20%">Email</th>
				<th style="width:20%">Domaine d'intervention</th>
				<th style="width:10%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getResponsables)) while ($row = mysqli_fetch_array($getResponsables)) {
				$matricule_responsable = $row['matricule']  ?>
				<tr>
					<td><?php echo $row['prenom'] . ' ' . $row['nom']; ?></td>
					<td><?php echo $row['telephone']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td>
						<?php
						$getDomainesResponsable = mysqli_query($con, "SELECT * FROM `responsables_incidents` INNER JOIN type_incidents on type_incidents.code_incident=responsables_incidents.code_incident WHERE responsables_incidents.matricule_responsable='$matricule_responsable'");
						$domaines = [];
						$couleurs = [];
						while ($row = mysqli_fetch_array($getDomainesResponsable)) {
							$domaines[] = $row['type_incident'];
							$couleurs[] = $row['couleur'];
						}
						if (empty($getDomainesResponsable)) {
							echo '';
						} else {
							for ($i = 0; $i < count($domaines); $i++) { ?>
								<span class="badge badge-pill" style="background-color:<?php echo $couleurs[$i]; ?>"><?php echo $domaines[$i] . '</br>'; ?></span></br></br>

						<?php }
						}

						?>
					</td>
					<td style="text-align:center">
						<a href="responsables_dage?edit=<?php echo $matricule_responsable; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="responsables_dage?delete=<?php echo $matricule_responsable; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>