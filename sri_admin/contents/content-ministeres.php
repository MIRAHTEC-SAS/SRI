<?php
$getMinisteres = mysqli_query($con, "SELECT * FROM ministeres order by id desc");

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
				<th style="width:50%">Libelle</th>
				<th style="width:25%">Sigle</th>
				<th style="width:10%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getMinisteres)) while ($row = mysqli_fetch_array($getMinisteres)) {  ?>
				<tr>
					<td><?php echo '#' . $row['codeMinistere']; ?></td>
					<td><?php echo $row['libelle']; ?></td>
					<td><?php echo $row['acronyme']; ?></td>
					<td style="text-align:center">
						<a href="ministeres?edit=<?php echo $row['codeMinistere']; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="ministeres?delete=<?php echo $row['codeMinistere']; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>