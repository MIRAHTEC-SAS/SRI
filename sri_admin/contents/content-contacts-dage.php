<?php
// include ('config/app.php');

$getContacts = mysqli_query($con, "SELECT * FROM `contacts_dage` order by id desc");
$getContactsUrgent = mysqli_query($con, "SELECT * FROM `contacts_dage_urgent` order by id desc");

?>
<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:30%">Contact</th>
				<th style="width:20%">Telephone</th>
				<th style="width:20%">Email</th>
				<th style="width:20%">Type</th>
				<th style="width:10%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getContactsUrgent)) while ($row = mysqli_fetch_array($getContactsUrgent)) {
				$id = $row['id']  ?>
				<tr>
					<td><?php echo $row['prenom'] . ' ' . $row['nom']; ?></td>
					<td><?php echo $row['telephone']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td>
						<span class="badge badge-pill" style="background-color:red">URGENT</span></br></br>
					</td>
					<td style="text-align:center">
						<a href="contacts_dage?edit=<?php echo $id; ?>&type=urgent" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="contacts_dage?delete=<?php echo $id; ?>&type=urgent" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
			<?php if (!empty($getContacts)) while ($row = mysqli_fetch_array($getContacts)) {
				$id = $row['id']  ?>
				<tr>
					<td><?php echo $row['prenom'] . ' ' . $row['nom']; ?></td>
					<td><?php echo $row['telephone']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td>
						<span class="badge badge-pill" style="background-color:green">NORMAL</span></br></br>
					</td>
					<td style="text-align:center">
						<a href="contacts_dage?edit=<?php echo $id; ?>&type=normal" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-edit" style="font-size:16px;color:orange"></i>
						</a>
						<a href="contacts_dage?delete=<?php echo $id; ?>&type=normal" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>