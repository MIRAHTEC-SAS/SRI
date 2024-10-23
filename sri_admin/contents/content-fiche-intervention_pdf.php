<div class="box-body" style="background-color:#FBFBFB">
	<!-- <div class="row"> -->
	<div class="col-lg-12 col-md-12 col-sm-12">
		<!-- <h4 class="box-title">Informations generales</h4> -->
		<!-- <div class="table-responsive"> -->
		<table class="table">
			<tbody>
				<!-- Service -->
				<tr>
					<td>Service</td>
					<td><?php echo $service; ?></td>
				</tr>
				<tr>
					<td style="width: 390px;">Gestionnaire</td>
					<td><strong style="color: #4C18EA"><?php echo $gestionnaire_service . ' / ' . $telephone_gestionnaire; ?></strong></td>
				</tr>
				<!-- Description -->
				<tr>
					<td>Description de l'incident </td>
					<td><?php echo $description; ?></td>
				</tr>
				<!-- Date d'intervention -->
				<tr>
					<td>Date limite d'intervention</td>
					<td><strong style="color: #4C18EA"><?php echo $date_intervention; ?></strong></td>
				</tr>
				<!-- Intervenantn -->
				<tr>
					<td>Intervenant </td>
					<td><?php echo $intervenant_incident; ?></td>
				</tr>
				<!-- Typer Intervenant -->
				<tr>
					<td>Type Intervenant </td>
					<td><?php echo $type_intervenant; ?></td>
				</tr>
				<!-- STATUT -->
				<tr>
					<td style="width: 390px;">Statut</td>
					<td>
						<strong style="color: #4C18EA">
							<span class="badge badge-<?php
																				switch ($statut) {
																					case 'planifiee':
																						echo 'primary';
																						break;
																					case 'terminee':
																						echo 'success';
																						break;
																					case 'annulee':
																						echo 'danger';
																						break;
																					case 'en retard':
																						echo 'info';
																						break;

																					default:
																						echo 'info';
																						break;
																				}
																				?>-light" style="font-size:17px; font-weight:bold"><?php echo $statut; ?></span>
						</strong>
					</td>
				</tr>
				<?php if ($statut == 'validee') {
					// var_dump($code_intervention);
					// get commentaires...
					$getComm = mysqli_query($con, "SELECT cvi.commentaire, cvi.date_validation,cvi.auteur
       			 FROM commentaires_validation_intervention cvi
        			JOIN responsables_dage rd ON cvi.auteur = rd.email
        			WHERE cvi.code_intervention = '$code_intervention'");
					if ($getComm->num_rows > 0) {
						while ($row = mysqli_fetch_array($getComm)) {
							$commentaire = $row['commentaire'];
							$date_commentaire = date('d / m / Y', strtotime($row['date_validation']));
							$heure_commentaire = date('H:i', strtotime($row['date_validation']));
						}
				?>
						<tr>
							<td style="width: 390px;">Commentaires de l'intervenant</td>
							<td><strong><?php echo $commentaire; ?></strong></td>
						</tr>
						<tr>
							<td style="width: 390px;">Commentaire rédigé le :</td>
							<td><strong><?php echo $date_commentaire . ' à ' . $heure_commentaire; ?></strong></td>
						</tr>
				<?php }
				} ?>
				<!-- Commentaire Responsable... -->
				<?php if ($statut == 'validee') {
					// Partie Intervenant
					// get commentaires intervenant...
					$getComm = mysqli_query($con, "SELECT cvi.commentaire, cvi.						date_validation, cvi.auteur
        		FROM commentaires_validation_intervention cvi
        		JOIN intervenants_interne ii ON cvi.auteur = ii.email
        		WHERE cvi.code_intervention = '$code_intervention'");

					if ($getComm->num_rows > 0) {
						while ($row = mysqli_fetch_array($getComm)) {
							$commentaire = $row['commentaire'];
							$date_commentaire = date('d / m / Y', strtotime($row['date_validation']));
							$heure_commentaire = date('H:i', strtotime($row['date_validation']));
						}

				?>
						<tr>
							<td style="width: 390px;">Commentaires de l'intervenant</td>
							<td><strong><?php echo $commentaire; ?></strong></td>
						</tr>
						<tr>
							<td style="width: 390px;">Commentaire rédigé le :</td>
							<td><strong><?php echo $date_commentaire . ' à ' . $heure_commentaire; ?></strong></td>
						</tr>
					<?php
					}
				}
				if ($statut == 'terminee') {

					// get commentaires...
					$getCommRes = mysqli_query($con, "SELECT * FROM commentaires_cloture_intervention WHERE code_intervention='$code_intervention'");
					if ($getCommRes->num_rows > 0) {
						while ($row = mysqli_fetch_array($getCommRes)) {
							$commentaire_res = $row['commentaire'];
							$date_commentaire_res = date('d / m / Y', strtotime($row['date_cloture']));
							$heure_commentaire_res = date('H:i', strtotime($row['date_cloture']));
						}
					?>
						<tr>
							<td style="width: 390px;">Commentaires du Responsable Dage</td>
							<td><strong><?php echo $commentaire_res; ?></strong></td>
						</tr>
						<tr>
							<td style="width: 390px;">Commentaire rédigé le :</td>
							<td><strong><?php echo $date_commentaire_res . ' à ' . $heure_commentaire_res; ?></strong></td>
						</tr>
				<?php }
				} ?>
				<?php if ($statut == 'annulee') {
					// Recuperer les commentaires d'annulation dans la table commentaires_annulation_intervention 
					$getCommentaireAnnulation = $con->query("SELECT * FROM commentaires_annulation_intervention WHERE code_intervention='$code_intervention'");
					if ($getCommentaireAnnulation->num_rows > 0) {

						$row = $getCommentaireAnnulation->fetch_assoc();
						$date_annulation = $row['date_annulation'];
						$raisons_annulation = $row['commentaire'];
						$auteur_annulation = $row['matricule_auteur'];

				?>
						<tr>
							<td style="width: 390px;">Date de l'annulation :</td>
							<td><strong><?php echo $date_annulation; ?></strong></td>
						</tr>
						<tr>
							<td style="width: 390px;">Raisons :</td>
							<td><strong><?php echo $raisons_annulation; ?></strong></td>
						</tr>
						<tr>
							<td style="width: 390px;">Auteur (annulation) :</td>
							<td><strong><?php echo $auteur_annulation; ?></strong></td>
						</tr>
				<?php }
				} ?>

			</tbody>
		</table>
		<!-- </div>	 -->
		<!-- <hr> -->
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="row">
			<h5 class="box-title mt-0"> Informations concernant l'incident</h5>
		</div>
		<div class="row">
			<div class="col-md-12 col-md-12 col-sm-12">
				<!-- Incidents  -->
				<table class="table">
					<tbody>
						<!-- REF -->
						<tr>
							<td>Reference incident</td>
							<td><strong style="color: #4C18EA"><?php echo $numero_incident; ?></strong></td>
						</tr>
						<!-- Description -->
						<tr>
							<td>Localisation </td>
							<td>
								<?php
								echo $batiment . ' - ' . $etage . ' - ' . $piece . '</br>' .
									$adresse . ' - ' . $contact_immeuble;
								?>
							</td>
						</tr>

						<!-- Date declaration -->
						<tr>
							<td>Declaré le </td>
							<td><?php echo $date_reception . ' à ' . $heure_reception; ?></td>
						</tr>
						<!-- Date d'affectation -->
						<tr>
							<td>Date d'affectation </td>
							<td><?php echo $date_affectation . ' à ' . $heure_affectation; ?></td>
						</tr>
						<!-- Date limite d'intervention -->
						<?php if ($statut == 'annulee') {  ?>
							<tr>
								<td>Date d'annulation</td>
								<td><?php echo $date_annulation; ?></td>
							</tr>
						<?php } ?>
						<!-- Declarant -->
						<tr>
							<td>Dèclarant </td>
							<td><?php echo $auteur . ' / ' . $telephone; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>