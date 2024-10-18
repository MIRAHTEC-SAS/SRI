<?php
// include ('config/app.php');

$getRoles = mysqli_query($con, "SELECT * FROM roles order by id asc");

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
				<th style="width:20%">Identifiant</th>
				<th style="width:70%">Rôle</th>
				<th style="width:10%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getRoles)) while ($row = mysqli_fetch_array($getRoles)) {  ?>
				<tr>
					<td><?php echo '#' . $row['code_role']; ?></td>
					<td><?php echo $row['role']; ?></td>
					<td style="text-align:center">
						<a href="roles?edit=<?php echo $row['id']; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="roles?delete=<?php echo $row['id']; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>