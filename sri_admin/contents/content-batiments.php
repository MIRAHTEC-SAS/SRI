<?php

$getBatiments = mysqli_query($con, "SELECT * FROM batiments order by code_batiment desc");

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
				<th style="width:25%">Nom du batiment</th>
				<th style="width:35%">Adresse</th>
				<th style="width:10%">Contact</th>
				<th style="width:10%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getBatiments)) while ($row = mysqli_fetch_array($getBatiments)) {  ?>
				<tr>
					<td><?php echo '#' . $row['code_batiment']; ?></td>
					<td><?php echo $row['nom_batiment']; ?></td>
					<td><?php echo $row['adresse']; ?></td>
					<td><?php echo $row['contact']; ?></td>
					<td style="text-align:center">
						<a href="batiments?edit=<?php echo $row['code_batiment']; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="batiments?delete=<?php echo $row['code_batiment']; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>