<?php
// include ('config/app.php');

$getResponsablesParIncident = mysqli_query($con, "SELECT 
responsables_incidents.id,
responsables_incidents.code_incident,
type_incidents.type_incident,
type_incidents.couleur,
responsables_dage.prenom,
responsables_dage.nom
FROM `responsables_incidents` INNER JOIN type_incidents on type_incidents.code_incident=responsables_incidents.code_incident INNER JOIN responsables_dage on responsables_dage.matricule=responsables_incidents.matricule_responsable ORDER BY responsables_incidents.id DESC");


?>
<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:20%">Code Incident</th>
				<th style="width:30%">Domaine d'intervention</th>
				<th style="width:35%">Responsable attitré</th>
				<th style="width:15%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getResponsablesParIncident)) while ($row = mysqli_fetch_array($getResponsablesParIncident)) {  ?>
				<tr>
					<td><?php echo '#' . $row['code_incident']; ?></td>
					<td>
						<span class="badge badge-pill" style="background-color:<?php echo $row['couleur']; ?>"><?php echo $row['type_incident']; ?></span></br>
						<?php //echo $row['type_incident']; 
						?>
					</td>
					<td><?php echo $row['prenom'] . ' ' . $row['nom']; ?></td>
					<td style="text-align:center">
						<a href="responsables_incidents?edit=<?php echo $row['id']; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="responsables_incidents?delete=<?php echo $row['id']; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>