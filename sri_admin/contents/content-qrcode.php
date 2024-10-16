<?php
// include ('config/app.php');

$getQrcodeDispo = mysqli_query($con, "SELECT qrcodes_sri.id, services.libelle, services.sigle, batiments.nom_batiment, batiments.adresse, etages.nom_etage, qrcodes_sri.lien
FROM `qrcodes_sri` 
INNER JOIN services ON services.code_service=qrcodes_sri.code_service 
INNER JOIN batiments ON batiments.code_batiment=qrcodes_sri.code_batiment
INNER JOIN etages ON etages.code_etage=qrcodes_sri.code_etage");


?>
<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:40%">Service</th>
				<th style="width:15%">Bâtiment</th>
				<th style="width:15%">Etage</th>
				<th style="width:20%">QR CODE</th>
				<th style="width:10%;text-align:center">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($getQrcodeDispo)) while ($row = mysqli_fetch_array($getQrcodeDispo)) {  ?>
				<tr>
					<td><?php echo $row['libelle']; ?></td>
					<td>
						<?php echo $row['nom_batiment']; ?>
					</td>
					<td><?php echo $row['nom_etage']; ?></td>
					<td><img src="<?php echo $row['lien']; ?>"></td>
					<td style="text-align:center">
						<!-- <a href="generation_qrcode?edit=<?php //echo $row['id']; 
																									?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
				        <i class="fa fa-edit" style="font-size:16px;color:orange"></i>
					</a>  -->
						<a href="generation_qrcode?delete=<?php echo $row['id']; ?>" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
							<i class="ti-trash" style="font-size:16px;color:red"></i>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>