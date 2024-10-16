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
					<td> <span class="badge badge-pill badge-lg" style="background-color:<?php echo $couleur; ?>"><?php echo $categorie; ?></span></td>
				</tr>
				<tr>
					<td>Date d'intervention</td>
					<td><strong style="color: #4C18EA"><?php echo $date_intervention; ?></strong></td>
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
												<td><?php // echo $heure_reception; 
														?></td>
											</tr> -->

				<tr>
					<td>Responsable Dage</td>
					<td><strong style="color: #4C18EA"><?php echo $responsableDage . ' ( ' . $telephoneResponsable . ' )'; ?></strong></td>
				</tr>
				<tr>
					<td style="width: 390px;">Reference</td>
					<td><strong style="color: #4C18EA">#<?php echo $code_intervention; ?></strong></td>
				</tr>

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

			</tbody>
		</table>
		<!-- </div>	 -->
		<!-- <hr> -->
	</div>

	<div class="row">
		<div class="col-md-5 col-sm-6">
			<div class="box box-body b-1 text-center no-shadow">
				<div id="image-popups">
					<!-- <a><img src="sri_dage/notifications/<?php //echo $image; 
																										?>" id="product-image" class="img-fluid" alt="" /></a> -->
					<a href="../sri_client/notifications/<?php echo $image; ?>" data-effect="mfp-3d-unfold"><img src="../sri_client/notifications/<?php echo $image; ?>" class="img-fluid" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="col-md-7 col-sm-6">
			<div class="row text-center">
				</br>
				<h3 class="box-title mt-0" style="text-align:center">Description de l'incident</h3>

			</div>

			<!-- <h4 class="text-danger">Priorité</h4> -->

			<hr>
			<p><?php echo $description; ?></p>
			<div class="row">
				<div class="col-sm-12">
					<h6 class="mt-20">Categorie</h6>
					<p class="mb-0">
						<span class="badge badge-pill badge-lg" style="background-color:<?php echo $couleur; ?>"><?php echo $categorie; ?></span>
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
								<td><?php echo $date_reception . ' à ' . $heure_reception; ?></td>
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

			<!-- <a class="popup-with-form btn btn-success" href="#cloture"><i class="mdi mdi-check"></i> Clôturer l'incident</a>
			<a class="popup-with-form btn btn-warning" href="#relance"><i class="mdi mdi-format-rotate-90"></i> Relancer l'intervenant</a> -->
			<!-- <button class="btn btn-danger"><i class="mdi mdi-close"></i></button> -->
			<!-- <a class="popup-with-form btn btn-danger" href="#test-form"><i class="mdi mdi-close"></i> Annuler l'intervention</a> -->

			<?php
			$utilisateurConnecte = $_SESSION['prenom'] . ' ' . $_SESSION['nom'];
			$role = $_SESSION['role'];

			if ((($role == 'Intervenant' && $utilisateurConnecte == $intervenant_incident) || ($role == 'Responsable' && $utilisateurConnecte == $responsableDage) || $role == 'Administrateur') && $statut == 'planifiee') : ?>

				<!-- Option pour faire une préapprobation -->
				<a class="popup-with-form btn btn-info" href="#preapprobation"><i class="mdi mdi-check"></i> Préapprobation</a>
				<a class="popup-with-form btn btn-warning" href="#relance"><i class="mdi mdi-format-rotate-90"></i> Relancer l'intervenant</a>
				<a class="popup-with-form btn btn-danger" href="#test-form"><i class="mdi mdi-close"></i> Annuler l'intervention</a>
			<?php endif; ?>

			<?php
			$gestionnaireDuService =	$con->query("SELECT 
							gestionnaires_services.id,
							gestionnaires.matricule_gestionnaire,
							gestionnaires.prenom,
							gestionnaires.nom,
							gestionnaires.email,
							gestionnaires.telephone
							FROM 
							gestionnaires_services
							INNER JOIN 
							gestionnaires ON gestionnaires.matricule_gestionnaire = gestionnaires_services.matricule_gestionnaire
							WHERE 
							gestionnaires_services.code_service = '$code_service'
					");
			$gestionnaireDuService = $gestionnaireDuService->fetch_assoc();
			$NomCompletGestionnaire = $gestionnaireDuService['prenom'] . '' . $gestionnaireDuService['nom'];
			if ((($role == 'Gestionnaire' && $NomCompletGestionnaire == $utilisateurConnecte) || $role == 'Administrateur') && $statut == 'Approuvée par le responsable') : ?>
				<!-- Option pour clore l'incident -->
				<a class="popup-with-form btn btn-success" href="#cloture"><i class="mdi mdi-check"></i> Clôturer l'incident</a>
				<a class="popup-with-form btn btn-warning" href="#relance"><i class="mdi mdi-format-rotate-90"></i> Relancer l'intervenant</a>
				<!-- Option d'annulation disponible pour tous les utilisateurs -->
				<a class="popup-with-form btn btn-danger" href="#test-form"><i class="mdi mdi-close"></i> Annuler l'intervention</a>
			<?php endif; ?>

			<!-- Option d'annulation disponible pour tous les utilisateurs -->
		</div>
	</div>

	<!-- Formulaires modals pour préapprobation et clôture -->

	<!-- Préapprobation -->
	<form action="notifications/gestion_interventions.php" method="POST" id="preapprobation" class="mfp-hide white-popup-block" style="background-color:#FBFBFB">
		<div class="box-header with-border">
			<h4 class="box-title">Prémiere approbation</h4>
		</div>
		<div class="box-body" style="background-color:#FBFBFB">
			<fieldset style="border:0;">
				<p>Vous êtes sur le point de faire une préapprobation pour cette intervention.</p>
				<textarea class="form-control" name="commentaire" required placeholder="Commentaire pour la préapprobation"></textarea>
			</fieldset>
			<div class="mt-3">
				<input type="hidden" name="code_intervention" value="<?php echo $code_intervention; ?>">
				<input type="hidden" name="auteur" value="<?php echo $emailUser; ?>">
				<button class="btn btn-success" type="submit" name="preapprobationIntervention"><i class="mdi mdi-check"></i> Valider</button>
			</div>
		</div>
	</form>

	<!-- form itself -->
	<form action="notifications/gestion_interventions.php" method="POST" id="test-form" class="mfp-hide white-popup-block">
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
			<input type="hidden" name="code_intervention" value="<?php echo $code_intervention; ?>">
			<input type="hidden" name="auteur" value="<?php echo $emailUser; ?>">
			<button class="btn btn-success" type="submit" name="annulerIntervention"><i class="mdi mdi-check"></i> Valider</button>
			<!-- <button class="btn btn-danger"><i class="mdi mdi-close"></i> Annuler</button> -->
		</div>
	</form>

	<!-- Relance -->
	<form action="notifications/gestion_interventions.php" style="background-color:#FBFBFB" method="POST" id="relance" class="mfp-hide white-popup-block">
		<!-- <div class="row">
										<div class="col-12"> -->
		<!-- <div class="box"> -->
		<div class="box-header with-border">
			<h4 class="box-title">Relancer l'intervenant</h4>
		</div>
		<div class="box-body" style="background-color:#FBFBFB">
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
				<input type="hidden" name="code_intervention" value="<?php echo $code_intervention; ?>">
				<input type="hidden" name="auteur" value="<?php echo $emailUser; ?>">
				<button class="btn btn-success" type="submit" name="relancerIntervenant"><i class="mdi mdi-share"></i> Envoyer</button>
				<!-- <button class="btn btn-danger"><i class="mdi mdi-close"></i> Annuler</button> -->
			</div>
		</div>
		<!-- </div> -->
		<!-- </div> -->
		<!-- </div> -->
	</form>
	<!-- Relance -->
	<form action="notifications/gestion_interventions.php" method="POST" style="background-color:#FBFBFB" id="cloture" class="mfp-hide white-popup-block">
		<!-- <div class="row">
										<div class="col-12"> -->
		<div class="box">
			<div class="box-header with-border">
				<h4 class="box-title">Cloture de l'intervention</h4>
			</div>
			<div class="box-body" style="background-color:#FBFBFB">
				<fieldset style="border:0;">
					<p>Cet ecran permet de cloturer une intervention realisée avec succès. </br></p>
					<div class="form-group">
						<label class="form-label" for="textarea">Commentaire du responsable</label>
						<br>
						<textarea class="form-control" name="comment" id="textarea" required></textarea>
					</div>
					</br>
				</fieldset>
				<div>
					<input type="hidden" name="code_intervention" value="<?php echo $code_intervention; ?>">
					<input type="hidden" name="auteur" value="<?php echo $emailUser; ?>">
					<button class="btn btn-success" type="submit" name="cloturerIntervention"><i class="mdi mdi-share"></i> Cloturer</button>
					<!-- <button class="btn btn-danger"><i class="mdi mdi-close"></i> Annuler</button> -->
				</div>
			</div>
			<!-- </div> -->
			<!-- </div> -->
		</div>
	</form>
</div>
</br>
</div>
</div>