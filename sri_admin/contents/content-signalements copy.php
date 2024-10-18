
<?php 
include ('config/app.php');

$getSignalements = mysqli_query($con, "SELECT * FROM `signalements` INNER JOIN services on services.code_service=signalements.code_service");

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
				<th>Reference</th>
				<th>Service</th>
				<th>Incident</th>
				<th>Categorie</th>
				<!-- <th>Photo</th> -->
				<!-- <th>Responsable</th> -->
				<!-- <th>Status</th> -->
				<th>Actions</th>					 
			</tr>
		</thead>
		<tbody>
            <?php while ($row = mysqli_fetch_array($getSignalements)) { 
                $numero_incident=$row['numero_incident']; ?>
			<tr>
				<td><?php echo $row['numero_incident']; ?></td>
				<td><?php echo $row['sigle']; ?></td>
                <td><?php echo $row['description']; ?></td>

				<td>
                    <?php 
                        $getTypes = mysqli_query($con, "SELECT DISTINCT signalements_incidents.numero_incident, type_incidents.type_incident FROM `signalements_incidents` INNER JOIN type_incidents ON type_incidents.code_incident=signalements_incidents.code_incident where signalements_incidents.numero_incident='$numero_incident'");
                        while ($row = mysqli_fetch_array($getTypes)) { 
                            echo '<span class="badge badge-pill badge-success">'.$row['type_incident'].'</span></br>';
                        }
                    ?>
                </td>
                <td>
                    <a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
				        <i class="ti-marker-alt"></i>
					</a> 
					<a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
						<i class="ti-trash"></i>
					</a>
				</td>
			</tr>
			<?php } ?>	
        </tbody>						
	</table>
</div>