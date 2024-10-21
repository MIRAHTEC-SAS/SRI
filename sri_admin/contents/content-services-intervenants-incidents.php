<?php
// include ('config/app.php');

$getServiceIntervenantParIncident = mysqli_query($con, "SELECT 
services_intervenant_incidents.id,
services_intervenant_incidents.code_incident,
services_intervenant_incidents.matricule_service,
services_intervenant.nom_service,
services_intervenant.telephone,
type_incidents.type_incident,
type_incidents.couleur,
services_intervenant.email
FROM `services_intervenant` INNER JOIN services_intervenant_incidents ON services_intervenant.matricule_service=services_intervenant_incidents.matricule_service INNER JOIN type_incidents ON type_incidents.code_incident=services_intervenant_incidents.code_incident order by services_intervenant_incidents.id desc");


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
			<?php if (!empty($getServiceIntervenantParIncident)) while ($row = mysqli_fetch_array($getServiceIntervenantParIncident)) {  ?>
				<tr>
					<td><?php echo '#' . $row['code_incident']; ?></td>
					<td>
						<span class="badge badge-pill" style="background-color:<?php echo $row['couleur']; ?>"><?php echo $row['type_incident']; ?></span></br>
						<?php //echo $row['type_incident']; 
						?>
					</td>
					<td><?php echo $row['nom_service']; ?></td>
					<td style="text-align:center">
						<a href="services_intervenants_incidents?edit=<?php echo $row['id']; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="services_intervenants_incidents?delete=<?php echo $row['id']; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>