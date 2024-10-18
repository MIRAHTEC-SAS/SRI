
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
							<td><strong style="color: #4C18EA"><?php echo $gestionnaire_service.' / '.$telephone_gestionnaire; ?></strong></td>
						</tr>
						<!-- Description -->
						<tr>
							<td>Description de l'incident </td>
							<td><?php echo $description; ?></td>
						</tr>
						<!-- Date d'intervention -->
						<tr>
							<td>Date limite d'intervention</td>
							<td><strong style="color: #4C18EA"><?php echo $date_intervention;?></strong></td>
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
									switch($statut) {
										case 'planifiee' : echo 'primary';break;
										case 'terminee' : echo 'success';break;
										case 'annulee' : echo 'danger';break;
										case 'en retard' : echo 'info';break;

										default : echo 'info';break;
									}
									?>-light" style="font-size:17px; font-weight:bold"><?php echo $statut; ?></span>
								</strong>
							</td>
						</tr>
						<?php if ($statut=='validee') { 
							// get commentaires...
							$getComm = mysqli_query($con, "SELECT * FROM commentaires_validation_intervention WHERE code_intervention='$code_intervention'");
							while ($row = mysqli_fetch_array($getComm)) { 
								$commentaire=$row['commentaire'];
								$date_commentaire=date('d / m / Y', strtotime($row['date_validation']));
								$heure_commentaire=date('H:i', strtotime($row['date_validation']));
							}
							?>
							<tr>
								<td style="width: 390px;">Commentaires de l'intervenant</td>
								<td><strong><?php echo $commentaire; ?></strong></td>
							</tr>
							<tr>
								<td style="width: 390px;">Commentaire rédigé le :</td>
								<td><strong><?php echo $date_commentaire.' à '.$heure_commentaire; ?></strong></td>
							</tr>
						<?php } ?>
						<!-- Commentaire Responsable... -->
						<?php if ($statut=='terminee') { 
							// Partie Intervenant
							// get commentaires intervenant...
								$getComm = mysqli_query($con, "SELECT * FROM commentaires_validation_intervention WHERE code_intervention='$code_intervention'");
								while ($row = mysqli_fetch_array($getComm)) { 
									$commentaire=$row['commentaire'];
									$date_commentaire=date('d / m / Y', strtotime($row['date_validation']));
									$heure_commentaire=date('H:i', strtotime($row['date_validation']));
								}
								?>
								<tr>
									<td style="width: 390px;">Commentaires de l'intervenant</td>
									<td><strong><?php echo $commentaire; ?></strong></td>
								</tr>
								<tr>
									<td style="width: 390px;">Commentaire rédigé le :</td>
									<td><strong><?php echo $date_commentaire.' à '.$heure_commentaire; ?></strong></td>
								</tr>
								<?php 
								// get commentaires...
								$getCommRes = mysqli_query($con, "SELECT * FROM commentaires_cloture_intervention WHERE code_intervention='$code_intervention'");
								while ($row = mysqli_fetch_array($getCommRes)) { 
									$commentaire_res=$row['commentaire'];
									$date_commentaire_res=date('d / m / Y', strtotime($row['date_cloture']));
									$heure_commentaire_res=date('H:i', strtotime($row['date_cloture']));
								}
								?>
								<tr>
									<td style="width: 390px;">Commentaires du Responsable Dage</td>
									<td><strong><?php echo $commentaire_res; ?></strong></td>
								</tr>
								<tr>
									<td style="width: 390px;">Commentaire rédigé le :</td>
									<td><strong><?php echo $date_commentaire_res.' à '.$heure_commentaire_res; ?></strong></td>
								</tr>
							<?php } ?>
							<?php if ($statut=='annulee') { ?>
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
							<?php } ?>

					</tbody>
				</table>
			<!-- </div>	 -->
			<!-- <hr> -->
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="row">
				<h5 class="box-title mt-0" >     Informations concernant l'incident</h5>
			</div>
		<div class="row">
			<div class="col-md-12 col-md-12 col-sm-12">
					<!-- Incidents  -->
					<table class="table">
						<tbody>
							<!-- REF -->
							<tr>
								<td>Reference incident</td>
								<td><strong style="color: #4C18EA"><?php echo $numero_incident;?></strong></td>
							</tr>
							<!-- Description -->
							<tr>
								<td>Localisation </td>
								<td>
									<?php 
										echo $batiment.' - '.$etage.' - '.$piece.'</br>'.
										$adresse.' - '.$contact_immeuble;
									?>
								</td>
							</tr>
							
							<!-- Date declaration -->
							<tr>
								<td>Declaré le </td>
								<td><?php echo $date_reception.' à '.$heure_reception; ?></td>
							</tr>
							<!-- Date d'affectation -->
							<tr>
								<td>Date d'affectation </td>
								<td><?php echo $date_affectation.' à '.$heure_affectation; ?></td>
							</tr>
							<!-- Date limite d'intervention -->
							<?php if ($statut=='annulee') {  ?>
							<tr>
								<td>Date d'annulation</td>
								<td><?php echo $date_annulation; ?></td>
							</tr>
							<?php } ?>
							<!-- Declarant -->
							<tr>
								<td>Dèclarant </td>
								<td><?php echo $auteur.' / '.$telephone; ?></td>
							</tr>		
						</tbody>
					</table>
			</div>
		</div>
		</div>
	<div class="row text-center">
		<!-- <a class="popup-with-form btn btn-success" target="#cloture"><i class="mdi mdi-check"></i> Clôturer l'incident</a> -->
		<!-- <a class="popup-with-form btn btn-warning" href="#relance"><i class="mdi mdi-format-rotate-90"></i> Relancer l'intervenant</a> -->
		<!-- <a class="popup-with-form btn btn-danger" href="#annuler"><i class="mdi mdi-close"></i> Annuler l'intervention</a> -->
		<?php if ($roleUser!='Intervenant' && $roleUser!= 'Gestionnaire' && $statut != 'annulee') { ?>
		<?php if ($statut=='validee') { ?><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#cloturer" class="btn btn btn-success mt-10 d-block text-center"><i class="mdi mdi-check"></i> Clôturer l'intervention</a><?php } ?>
		<?php if ($statut!='terminee') { ?><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#relancer" class="btn btn btn-warning mt-10 d-block text-center"><i class="mdi mdi-format-rotate-90"></i> Relancer l'intervenant</a><?php } ?>
		<?php if ($statut!='validee' && $statut!='terminee') { ?><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#annuler" class="btn btn btn-danger mt-10 d-block text-center"> <i class="mdi mdi-close"></i> Annuler Intervention</a><?php } ?>
		<?php } ?>
		<!-- Bouton Intervenant -->
		<?php if ($roleUser=='Intervenant' || $roleUser=='Responsable' && $statut!='validee' && $statut!='terminee' && $statut != 'annulee') { ?>
		<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#confirmerIntervention" class="btn btn btn-success mt-10 d-block text-center"><i class="mdi mdi-check"></i> Valider l'intervention</a>
		<?php } ?>
		<!-- <div class="text-end">
			<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#annuler" class="btn btn-success mt-10 d-block text-center"><i class="fa fa-plus-circle"></i> Nouvelle Etage</a>
		</div> -->
		<!-- Popup Cloture-->
		<div id="cloturer" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="background-color:#DFDFDE">
						<h4 class="modal-title" id="myModalLabel">Clôture d'une intervention</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body" style="background-color:#F7F5F2">
						<form action="notifications/gestion_interventions.php"  method="POST">
							<!-- <div class="row">
								<div class="col-12"> -->
									<!-- <div class="box"> -->
										<!-- <div class="box-header with-border">
										<h4 class="box-title">Cloture de l'intervention</h4>
										</div> -->
										<div class="box-body">
											<fieldset style="border:0;">
												<p>Cet ecran permet de cloturer une intervention realisée avec succès. </br></p>
												<div class="form-group">
													<label class="form-label" for="textarea">Commentaire de l'intervenant (ou du responsable)</label>
													<br>
													<textarea class="form-control" name="comment" id="textarea" required></textarea>
												</div>
											</br>
											</fieldset>
											<div>
												<input type="hidden" name="code_intervention" value="<?php echo $code_intervention;?>">
												<input type="hidden" name="auteur" value="<?php echo $emailUser;?>">
												<button class="btn btn-success" type="submit" name="cloturerIntervention"><i class="mdi mdi-share"></i> Cloturer</button>
											<!-- <button class="btn btn-danger"><i class="mdi mdi-close"></i> Annuler</button> -->
											</div>
										</div>	
									<!-- </div> -->
								<!-- </div> -->
							<!-- </div> -->
						</form>
					</div>
					
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

		<!-- Popup Relancer -->
		<div id="relancer" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="background-color:#DFDFDE">
						<h4 class="modal-title" id="myModalLabel">Relance d'un intervenant</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body" style="background-color:#F7F5F2">
					<form action="notifications/gestion_interventions.php" style="background-color:#FBFBFB"  method="POST">
							
							<!-- <div class="box-body" style="background-color:#FBFBFB"> -->
								<fieldset style="border:0;">
									<p>Ce formulaire permet de relancer un intervant ou d'envoyer un complement d'information.</br>Votre message sera envoyé par mail et par SMS à l'intervenant.</p>
									<div class="form-group">
										<label class="form-label" for="textarea">Message</label>
										<br>
										<textarea class="form-control" name="msg" id="textarea" required></textarea>
									</div>
							</br>
								</fieldset>
								<div>
									<input type="hidden" name="code_intervention" value="<?php echo $code_intervention;?>">
									<input type="hidden" name="auteur" value="<?php echo $emailUser;?>">
									<button class="btn btn-success" type="submit" name="relancerIntervenant"><i class="mdi mdi-share"></i> Envoyer</button>
								<!-- <button class="btn btn-danger"><i class="mdi mdi-close"></i> Annuler</button> -->
								</div>
							<!-- </div>	 -->
						<!-- </div> -->
						<!-- </div> -->
						<!-- </div> -->
					</form>
					</div>
					
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

		<!-- Popup Annulation-->
		<div id="annuler" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="background-color:#DFDFDE">
						<h4 class="modal-title" id="myModalLabel">Annulation d'intervention</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body" style="background-color:#F7F5F2">
						<form action="notifications/gestion_interventions.php"  method="POST">
							<!-- <h1>Annulation d'intervention</h1> -->
							<fieldset style="border:0;">
								<p>L'annulation de l'intervention est definitive et l'intervenant sera automatiquement notifié. </br>La saisie d'un commentaire decrivant la raison est obligatoire pour valider l'operation</p>
								<div class="form-group">
									<label class="form-label" for="textarea">Raisons de l'annulation</label>
									<br>
									<textarea class="form-control" name="raisons" id="textarea" required></textarea>
								</div>
								<label>Preciser le nouveau statut de l'incident</label>
								<select class="form-control" name="statutIncident">
									<option value="resolu">Résolu</option>
									<option value="en cours">En cours</option>
									<option value="en attente">En attente</option>
									<option value="rejete">Rejeté</option>
								</select>
								</br>
							</fieldset>
							<div class="pull-righ">
								<input type="hidden" name="code_intervention" value="<?php echo $code_intervention;?>">
								<input type="hidden" name="auteur" value="<?php echo $emailUser;?>">
								<button class="btn btn-success" type="submit" name="annulerIntervention"><i class="mdi mdi-check"></i> Valider</button>
								<!-- <button class="btn btn-danger"><i class="mdi mdi-close"></i> Annuler</button> -->
							</div>
						</form>
					</div>
					
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>	
		
		<!-- Popup Valider Intervention -->
		<div id="confirmerIntervention" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="background-color:#DFDFDE">
						<h4 class="modal-title" id="myModalLabel">Validation intervention</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body" style="background-color:#F7F5F2">
						<form action="notifications/gestion_interventions.php"  method="POST">
							<!-- <div class="row">
								<div class="col-12"> -->
									<!-- <div class="box"> -->
										<!-- <div class="box-header with-border">
										<h4 class="box-title">Cloture de l'intervention</h4>
										</div> -->
											<fieldset style="border:0;">
												<p>Cet ecran permet de confirmer et valider une intervention realisée avec succès. </br></p>
												<div class="form-group">
													<label class="form-label" for="textarea">Commentaire de l'intervenant (ou du responsable)</label>
													<br>
													<textarea class="form-control" name="comment" id="textarea" required></textarea>
												</div>
											</br>
											</fieldset>
											<div>
												<input type="hidden" name="code_intervention" value="<?php echo $code_intervention;?>">
												<input type="hidden" name="auteur" value="<?php echo $emailUser;?>">
												<button class="btn btn-success" type="submit" name="validerIntervention"><i class="mdi mdi-share"></i> Valider l'intervention</button>
											<!-- <button class="btn btn-danger"><i class="mdi mdi-close"></i> Annuler</button> -->
											</div>
									<!-- </div> -->
								<!-- </div> -->
							<!-- </div> -->
						</form>
					</div>
					
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
	</div>
		</br>
</div>
</div>	
