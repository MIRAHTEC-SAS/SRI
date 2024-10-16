<?php
$getPrestataires = mysqli_query($con, "SELECT * FROM `prestataires` order by id desc");

?>
<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:20%">Prestataire</th>
				<th style="width:30%">Adresse</th>
				<th style="width:15%">Email</th>
				<th style="width:15%">Telephone</th>
				<th style="width:10%">Domaine</th>
				<th style="width:10%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getPrestataires)) while ($row = mysqli_fetch_array($getPrestataires)) {
				$matricule_presta = $row['matricule_presta']  ?>
				<tr>
					<td><?php echo $row['denomination']; ?></td>
					<td><?php echo $row['adresse']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['telephone']; ?></td>
					<td>
						<?php
						$getDomainesResponsable = mysqli_query($con, "SELECT * FROM `prestataires_incidents` INNER JOIN type_incidents on type_incidents.code_incident=prestataires_incidents.code_incident WHERE prestataires_incidents.matricule_prestataire='$matricule_presta'");
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
						<a href="prestataires?edit=<?php echo $matricule_presta; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="prestataires?delete=<?php echo $matricule_presta; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>