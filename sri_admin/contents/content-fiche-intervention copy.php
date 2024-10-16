
					<div class="box-body" style="background-color:#FBFBFB">
						<!-- <div class="row"> -->
							<div class="col-lg-12 col-md-12 col-sm-12">
								<!-- <h4 class="box-title">Informations generales</h4> -->
								<!-- <div class="table-responsive"> -->
									<table class="table">
										<tbody>
											
											<tr>
												<td>Service</td>
												<td><?php echo $service; ?></td>
											</tr>
											<tr>
												<td>Type d'intervention</td>
												<td>											<span class="badge badge-pill badge-lg" style="background-color:<?php echo $couleur;?>"><?php echo $categorie; ?></span></td>
											</tr>
											<tr>
												<td>Date d'intervention</td>
												<td><strong style="color: #4C18EA"><?php echo $date_intervention;?></strong></td>
											</tr>
											<tr>
												<td>Intervenant </td>
												<td><?php echo $intervenant_incident; ?></td>
											</tr>
											<tr>
												<td>Type Intervenant </td>
												<td><?php echo $type_intervenant; ?></td>
											</tr>
											<!-- <tr>
												<td>Priorité</td>
												<td><?php // echo $heure_reception; ?></td>
											</tr> -->
											
											<tr>
												<td>Responsable Dage</td>
												<td><strong style="color: #4C18EA"><?php echo $responsableDage.' ( '.$telephoneResponsable.' )'; ?></strong></td>
											</tr>
											<tr>
												<td style="width: 390px;">Reference</td>
												<td><strong style="color: #4C18EA">#<?php echo $code_intervention; ?></strong></td>
											</tr>

										</tbody>
									</table>
								<!-- </div>	 -->
								<!-- <hr> -->
							</div>
						
							<div class="row">
							<div class="col-md-5 col-sm-6">
								<div class="box box-body b-1 text-center no-shadow">
									<div id="image-popups">
										<!-- <a><img src="sri_dage/notifications/<?php //echo $image; ?>" id="product-image" class="img-fluid" alt="" /></a> -->
										<a href="sri_dage/notifications/<?php echo $image; ?>" data-effect="mfp-3d-unfold"><img src="sri_dage/notifications/<?php echo $image; ?>" class="img-fluid" alt="" /></a>
									</div>
								</div>
							</div>
							<div class="col-md-7 col-sm-6">
								<div class="row text-center">
</br>
								<h3 class="box-title mt-0" style="text-align:center" >Description de l'incident</h3>

								</div>

								<!-- <h4 class="text-danger">Priorité</h4> -->
					
								<hr>
								<p><?php echo $description; ?></p>
								<div class="row">
									<div class="col-sm-12">
										<h6 class="mt-20">Categorie</h6>
										<p class="mb-0">
											<span class="badge badge-pill badge-lg" style="background-color:<?php echo $couleur;?>"><?php echo $categorie; ?></span>
										</p>
									</div>
								</div>
								<hr>
							<div class="row">
								<div class="col-md-12 col-md-12 col-sm-12">
										<table class="table">
											<tbody>
											<tr>
												<td>Declaré le </td>
												<td><?php echo $date_reception.' à '.$heure_reception; ?></td>
											</tr>
											<tr>
												<td>Auteur </td>
												<td><?php echo $auteur; ?></td>
											</tr>
											<tr>
												<td>Contact </td>
												<td><?php echo $contact; ?></td>
											</tr>
											
											</tbody>
										</table>
								</div>
							</div>

							</div>
						</div>
						<hr>
						<div class="row text-center">
						<div class="gap-items">
							<!-- <button class="btn btn-success"><a href="details_signalements?numero_incident=<?php //echo $numero_incident;?>&amp;affect=1" style="color:white" ><i class="mdi mdi-share"></i> Ecrire à l'intervenant </a></button> -->
							<!-- <button class="btn btn-success"><a href="details_signalements?numero_incident=<?php //echo $numero_incident;?>&amp;edit=1" style="color:white" ><i class="mdi mdi-format-rotate-90"></i> Relancer l'intervenant</a></button> -->
							<a class="popup-with-form btn btn-success" href="#relance"><i class="mdi mdi-format-rotate-90"></i> Relancer l'intervenant</a>
							<!-- <button class="btn btn-danger"><i class="mdi mdi-close"></i></button> -->
							<a class="popup-with-form btn btn-danger" href="#test-form"><i class="mdi mdi-close"></i> Annuler l'intervention</a>

								<!-- form itself -->
								<form action="notifications/gestion_interventions.php"  method="POST" id="test-form" class="mfp-hide white-popup-block">
									<h1>Annuler d'intervention</h1>
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

								<!-- Relance -->
								<form action="services/interventions.php"  method="POST" id="relance" class="mfp-hide white-popup-block">
									<h1>Relancer l'intervenant</h1>
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
								</form>
						</div>
</br>
					</div>
					</div>	
