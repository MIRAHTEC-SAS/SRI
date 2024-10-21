<?php
// include ('config/app.php');

$getPieces = mysqli_query($con, "SELECT * FROM `pieces` order by id desc");

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
				<th style="width:15%">Code</th>
				<th style="width:15%">Piece</th>
				<!-- <th style="width:15%">Etage</th>
				<th style="width:45%">Batiment</th> -->
				<th style="width:10%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getPieces)) while ($row = mysqli_fetch_array($getPieces)) {  ?>
				<tr>
					<td><?php echo '#' . $row['code_piece']; ?></td>
					<td><?php echo $row['nom_piece']; ?></td>
					<!-- <td><?php //echo $row['nom_etage']; 
										?></td>
					<td><?php // echo $row['nom_batiment']; 
							?></td> -->
					<td style="text-align:center">
						<a href="pieces?edit=<?php echo $row['code_piece']; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="pieces?delete=<?php echo $row['code_piece']; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>