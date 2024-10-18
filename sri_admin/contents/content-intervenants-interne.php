<?php
// include ('config/app.php');

$getIntervenantParIncident = mysqli_query($con, "SELECT 
intervenants_interne_incidents.id,
intervenants_interne_incidents.code_incident,
type_incidents.type_incident,
type_incidents.couleur,
intervenants_interne.matricule_intervenant,
intervenants_interne.prenom,
intervenants_interne.nom
FROM `intervenants_interne_incidents` INNER JOIN type_incidents on type_incidents.code_incident=intervenants_interne_incidents.code_incident INNER JOIN intervenants_interne on intervenants_interne.matricule_intervenant=intervenants_interne_incidents.matricule_intervenant ORDER BY intervenants_interne_incidents.id DESC");


?>
<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:20%">Code Incident</th>
				<th style="width:30%">Type d'incident</th>
				<th style="width:35%">Intervenant interne</th>
				<th style="width:15%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getIntervenantParIncident)) while ($row = mysqli_fetch_array($getIntervenantParIncident)) {  ?>
				<tr>
					<td><?php echo '#' . $row['code_incident']; ?></td>
					<td>
						<span class="badge badge-pill" style="background-color:<?php echo $row['couleur']; ?>"><?php echo $row['type_incident']; ?></span></br>
						<?php //echo $row['type_incident']; 
						?>
					</td>
					<td><?php echo $row['prenom'] . ' ' . $row['nom']; ?></td>
					<td style="text-align:center">
						<a href="intervenants_interne.php?edit=<?php echo $row['id']; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="intervenants_interne.php?delete=<?php echo $row['id']; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>