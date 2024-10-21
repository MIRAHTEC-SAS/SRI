<?php
// include ('config/app.php');
$jour_j = date("d");
// $listeAgents=[];
// $codeDirections=[];
// while ($row = mysqli_fetch_array($getSignalements)) { 
//     $listeAgents[] = $row['matricule'];
//     $codeDirections[]=$row['codeDirection'];
// }


?>
<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead style="background-color:#5C607B; color:white">
			<tr>
				<th style="width:10%">Reference</th>
				<th style="width:20%">Declarant</th>
				<th style="width:15%">Service</th>
				<th style="width:35%">Incident</th>
				<!-- <?php //if ($_SESSION['role']!='Responsable') { 
							?> -->
				<th style="width:10%">Categorie</th>
				<?php //} 
				?>
				<th style="width:10%">Priorité</th>
				<th style="width:10%">Date</th>
				<!-- <th>Status</th> -->
				<th style="width:10%;text-align:center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($getSignalements)) {
				$numero_incident = $row['numero_incident'];
				$code_incident = $row['code_incident'];
				$type_incident = $row['type_incident'];
				$service = $row['sigle'];
				$date_reception = date('d/m/Y', strtotime($row['date_reception']));
				$description = $row['description'];
				$priorite = $row['priorite'];
				$auteur = $row['auteur'];
				$couleur_type_incident = $row['couleur_type'];
				$couleur_priorite = $row['couleur_priorite'];
				$statut = $row['statut'];

				$jour_d = date('d', strtotime($row['date_reception']));

				$dif_jour = $jour_j - $jour_d;

				switch ($dif_jour) {
					case '0':
						$line_color = '#F2FFE9';
						break;
					case '1':
						$line_color = '#FFFFDD';
						break;
					default:
						$line_color = '#FFDFDF';
						break;
				}


				//    if(in_array($code_incident, $liste_codes_incident_resp)) 
				//    {
			?>


				<tr style="background-color:<?php echo $line_color; ?>">
					<td><?php echo '#' . $numero_incident; ?></td>
					<td><?php echo $auteur; ?></td>
					<td><?php echo $service; ?></td>
					<td><?php echo substr($description, 0, 100) . '<small>...</small>'; ?></td>
					<!-- <?php //if ($_SESSION['role']!='Responsable') { 
								?> -->
					<td>
						<span class="badge badge-pill" style="background-color:<?php echo $couleur_type_incident; ?>"><?php echo $type_incident; ?></span></br>
					</td>
					<?php //} 
					?>
					<td>
						<span class="badge badge-pill" style="background-color:<?php echo $couleur_priorite; ?>"><?php echo $priorite; ?></span></br>
					</td>

					<td><?php echo $date_reception; ?></td>
					<td style="text-align:center">
						<a href="details_signalements?numero_incident=<?php echo  $numero_incident; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
							<i class="fa fa-eye" style="font-size:16px;color:black"></i>
						</a>
						<!-- <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
						<i class="ti-trash"></i>
					</a> -->
					</td>
				</tr>
			<?php } //}
			?>
		</tbody>
	</table>
	<!-- <?php
				// echo 'Jour j : '.$jour_j.'</br>';
				// echo 'Jour declaration : '.$jour_d.'</br>';
				// echo 'difference : '.$dif_jour.'</br>';
				?> -->
</div>