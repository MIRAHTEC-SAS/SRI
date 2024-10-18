<?php
// include ('config/app.php');

$getIntervenants = mysqli_query($con, "SELECT * FROM `intervenants_interne` order by id desc");

?>
<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:30%">Responsable</th>
				<th style="width:20%">Telephone</th>
				<th style="width:20%">Email</th>
				<th style="width:20%">Domaine</th>
				<th style="width:10%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getIntervenants)) while ($row = mysqli_fetch_array($getIntervenants)) {
				$matricule_intervenant = $row['matricule_intervenant']  ?>
				<tr>
					<td><?php echo $row['prenom'] . ' ' . $row['nom']; ?></td>
					<td><?php echo $row['telephone']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td>
						<?php
						$getDomainesResponsable = mysqli_query($con, "SELECT * FROM `intervenants_interne_incidents` INNER JOIN type_incidents on type_incidents.code_incident=intervenants_interne_incidents.code_incident WHERE intervenants_interne_incidents.matricule_intervenant='$matricule_intervenant'");
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
						<a href="intervenants_dage.php?edit=<?php echo $matricule_intervenant; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="intervenants_dage.php?delete=<?php echo $matricule_intervenant; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>