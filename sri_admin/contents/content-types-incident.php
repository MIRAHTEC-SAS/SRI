<?php
$getTypes = mysqli_query($con, "SELECT * FROM type_incidents order by id desc");

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
				<th style="width:30%">Code Incident</th>
				<th style="width:35%">Type Incident</th>
				<th style="width:20%">Couleur</th>
				<th style="width:15%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getTypes)) while ($row = mysqli_fetch_array($getTypes)) {  ?>
				<tr>
					<td><?php echo '#' . $row['code_incident']; ?></td>
					<td><?php echo $row['type_incident']; ?></td>
					<td style="text-align:center">
						<p style="border-radius:50px; background-color:<?php echo $row['couleur']; ?>;text-align:center;width:20%">&nbsp;</p>
					</td>
					<td style="text-align:center">
						<a href="types_incident?edit=<?php echo $row['code_incident']; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="types_incident?delete=<?php echo $row['code_incident']; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>