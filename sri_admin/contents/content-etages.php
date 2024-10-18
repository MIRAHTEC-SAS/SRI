<?php
// include ('config/app.php');

$getEtages = mysqli_query($con, "SELECT * FROM etages inner join batiments on batiments.code_batiment=etages.code_batiment");

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
				<th style="width:20%">Code</th>
				<th style="width:20%">Etage</th>
				<th style="width:50%">Batiment</th>
				<th style="width:10%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getEtages)) while ($row = mysqli_fetch_array($getEtages)) {  ?>
				<tr>
					<td><?php echo '#' . $row['code_etage']; ?></td>
					<td><?php echo $row['nom_etage']; ?></td>
					<td><?php echo $row['nom_batiment']; ?></td>
					<td style="text-align:center">
						<a href="etages.php?edit=<?php echo $row['code_etage']; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="etages.php?delete=<?php echo $row['code_etage']; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>