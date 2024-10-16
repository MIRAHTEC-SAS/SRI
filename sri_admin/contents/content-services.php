<?php
$getServices = mysqli_query($con, "SELECT services.code_service, services.libelle, services.sigle, ministeres.libelle as libelleMinistere FROM `services` INNER JOIN ministeres ON ministeres.codeMinistere=services.codeMinistere");

// $listeAgents=[];
// $codeDirections=[];
// while ($row = mysqli_fetch_array($getSignalements)) { 
//     $listeAgents[] = $row['matricule'];
//     $codeDirections[]=$row['codeDirection'];
// }


?>
<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:10%">Code</th>
				<th style="width:40%">Service</th>
				<th style="width:15%">Sigle</th>
				<th style="width:25%">Ministere</th>
				<th style="width:10%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getServices)) while ($row = mysqli_fetch_array($getServices)) {  ?>
				<tr>
					<td><?php echo '#' . $row['code_service']; ?></td>
					<td><?php echo $row['libelle']; ?></td>
					<td><?php echo $row['sigle']; ?></td>
					<td><?php echo $row['libelleMinistere']; ?></td>
					<td style="text-align:center">
						<a href="directions?edit=<?php echo $row['code_service']; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="directions?delete=<?php echo $row['code_service']; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>