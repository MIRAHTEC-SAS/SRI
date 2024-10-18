
<div class="table-responsive">
	<table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
		<thead>
			<tr>
				<th style="width:5%">Code</th>
				<th style="width:15%">Declarant</th>
				<th style="width:15%">Service</th>
				<th style="width:25%">Incident</th>
				<th style="width:10%">Categorie</th>
				<th style="width:10%">Priorité</th>
				<th style="width:15%">Intervenant</th>
				<!-- <th style="width:10%">Date intervention</th> -->

				<!-- <th>Status</th> -->
				<th style="width:10%;text-align:center">Actions</th>					 
			</tr>
		</thead>
		<tbody>
            <?php while ($row = mysqli_fetch_array($getSignalements)) { 
               $numero_incident=$row['numero_incident']; 
			   $code_incident=$row['code_incident']; 
			   $type_incident=$row['type_incident']; 
			   $service=$row['sigle'];
			   $date_reception=date('d/m/Y', strtotime($row['date_reception']));
			   $description=$row['description'];
			   $priorite=$row['priorite'];
			   $auteur=$row['auteur'];
			   $couleur_type_incident=$row['couleur_type'];
			   $couleur_priorite=$row['couleur_priorite'];
			   $statut=$row['statut'];
			   $type_intervenant=$row['type_intervenant'];
			   $intervenant=$row['intervenant'];

			//    if(in_array($code_incident, $liste_codes_incident_resp)) 
			// 	{
				?>

				
			<tr>
				<td><?php echo '#'.$numero_incident; ?></td>
				<td><?php echo $auteur; ?></td>
				<td><?php echo $service; ?></td>
				<td><?php echo substr($description,0,100).'<small>...</small>'; ?></td>
				<td>
                    <span class="badge badge-pill" style="background-color:<?php echo $couleur_type_incident;?>"><?php echo $type_incident; ?></span></br>
                </td>
				<td>
                    <span class="badge badge-pill" style="background-color:<?php echo $couleur_priorite;?>"><?php echo $priorite; ?></span></br>
                </td>
				
				<td>
					<?php 
					switch ($type_intervenant)
					{
						case 'interne' : 
							$getIntervenant = mysqli_query($con, "SELECT * FROM intervenants_interne WHERE matricule_intervenant='$intervenant'"); 
							while ($row = mysqli_fetch_array($getIntervenant)) { 
							$pn_intervenant=$row['prenom'].' '.$row['nom'];
							} 
							echo $pn_intervenant; 
							break;
					}
					
					?>
				</td>
				<td style="text-align:center">
                    <a href="details_signalements.php?numero_incident=<?php echo  $numero_incident; ?>" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
				        <i class="fa fa-eye" style="font-size:16px;color:black"></i>
					</a> 
					<!-- <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
						<i class="ti-trash"></i>
					</a> -->
				</td>
			</tr>
			<?php } //}?>	
        </tbody>						
	</table>
</div>