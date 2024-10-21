<?php
// include ('config/app.php');

$getUsers = mysqli_query($con, "SELECT * FROM `users` order by id desc");

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
				<th style="width:35%">Prenom</th>
				<th style="width:15%">NOM</th>
				<th style="width:25%">Email</th>
				<th style="width:15%">Rôle</th>
				<th style="width:10%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getUsers)) while ($row = mysqli_fetch_array($getUsers)) {
				$statut = $row['statut']; ?>
				<tr>
					<td><?php echo $row['prenom']; ?></td>
					<td><?php echo $row['nom']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['role']; ?></td>
					<td style="text-align:center">
						<!-- <a href="utilisateurs?edit=<?php //echo $row['email']; 
																						?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
				        <i class="fa fa-edit" style="font-size:16px;color:orange"></i>
					</a> -->
						<a href="utilisateurs?upd=<?php echo $row['email']; ?>&statut=<?php echo $statut; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<?php if ($statut == 1) { ?><i class="fa fa-toggle-on " style="font-size:22px;color:#1C9E74"></i> <?php } else { ?>
								<i class="fa fa-toggle-off" style="font-size:22px;color:#65647C"></i>
							<?php } ?>

						</a>&nbsp;&nbsp;&nbsp;
						<a href="utilisateurs?delete=<?php echo $row['email']; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:22px;color:red"></i>
						</a>

					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>