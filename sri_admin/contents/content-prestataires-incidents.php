<?php
// include ('config/app.php');

$getPrestataireParIncident = mysqli_query($con, "SELECT 
prestataires_incidents.id,
prestataires.matricule_presta,
prestataires.denomination,
prestataires.adresse,
prestataires.telephone,
prestataires.email,
type_incidents.code_incident,
type_incidents.type_incident,
type_incidents.couleur
FROM `prestataires_incidents` INNER JOIN prestataires on prestataires.matricule_presta=prestataires_incidents.matricule_prestataire inner JOIN type_incidents on type_incidents.code_incident=prestataires_incidents.code_incident order by prestataires_incidents.id desc");


?>
<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:20%">Code Incident</th>
				<th style="width:30%">Type d'incident</th>
				<th style="width:35%">Prestataire</th>
				<th style="width:15%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getPrestataireParIncident)) while ($row = mysqli_fetch_array($getPrestataireParIncident)) {  ?>
				<tr>
					<td><?php echo '#' . $row['code_incident']; ?></td>
					<td>
						<span class="badge badge-pill" style="background-color:<?php echo $row['couleur']; ?>"><?php echo $row['type_incident']; ?></span></br>
						<?php //echo $row['type_incident']; 
						?>
					</td>
					<td><?php echo $row['denomination']; ?></td>
					<td style="text-align:center">
						<a href="prestataires_incidents.php?edit=<?php echo $row['id']; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="prestataires_incidents.php?delete=<?php echo $row['id']; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>