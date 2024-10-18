<div class="row">
				<div class="col-12">
					<div class="box">
						<div class="box-header with-border">
						  <h4 class="box-title">Affectation de l'incident <strong style="color:red"><?php echo $numero_incident; ?></strong></h4>
						</div>
						<div class="box-body" style="background-color:#F7F7F7">
									<form action="notifications/gestion_incidents.php" method="POST">
                                            <label class="col-md-12 form-label">Categorie</label>
											<select name="categorie"  class="form-control" disabled>
												<option value="<?php echo $code_incident;?>"><?php echo $categorie;?></option>
												<?php 
													$getListeTypes = mysqli_query($con, "SELECT * FROM `type_incidents` WHERE type_incident<>'$categorie'");
													while ($row = mysqli_fetch_array($getListeTypes)) { 
												?>
												<option value="<?php echo $row['code_incident'];?>"><?php echo $row['type_incident'];?></option>
												<?php } ?>

											</select>
</br>
                                            <label class="col-md-12 form-label">Description</label>

											<textarea class="form-control" name="description" style="text-align:left" disabled><?php echo htmlspecialchars($descriptionEdit); ?></textarea>
</br>
                                            <label class="col-md-12 form-label">Intervenant</label>
                                            <select name="intervenant"  class="form-control" required>
                                   
                                                    <optgroup label="Prestataire">
                                                        <?php if (!empty($getPrestataires)) {  while ($row = mysqli_fetch_array($getPrestataires)) { ?>
                                                        <option value="<?php echo $row['matricule_presta'];?>"><?php echo $row['denomination'];?></option>
                                                        <!-- <input type="hidden" name="type_intervenant" value="prestataire"> -->
                                                <?php } }?>
                                                    <optgroup label="Intervenants Interne">
                                                        <?php if (!empty($getIntervenantsInterne)) {   while ($row = mysqli_fetch_array($getIntervenantsInterne)) { ?>
                                                        <option value="<?php echo $row['matricule_intervenant'];?>"><?php echo $row['prenom'].' '.$row['nom'];?></option>
                                                        <!-- <input type="hidden" name="type_intervenant" value="interne"> -->
                                                <?php } }?>
                                                <?php if ($categorie=='informatique') { ?>
                                                    <optgroup label="Services intervenant">
                                                        <?php }?>
                                                        <?php if (!empty($getServicesIntervenant)) { while ($row = mysqli_fetch_array($getServicesIntervenant)) { ?>
                                                            <optgroup label="Services intervenant">
                                                            <option value="<?php echo $row['matricule_service'];?>"><?php echo $row['nom_service'];?></option>
                                                            <!-- <input type="hidden" name="type_intervenant" value="service"> -->
                                                <?php } }?>
                                            </select>
                                                    </br>
                                                    <label class="col-md-12 form-label">Date Limite d'intervention</label>
                                                    <input type="date" name="date_intervention" min="<?php echo $dateDuJour; ?>" class="form-control" required>
                                                    </br>

											<input type="hidden" name="numero_incident" value="<?php echo $numero_incident;?>">
                                            <input type="hidden" name="code_service" value="<?php echo $code_service;?>">
                                            <input type="hidden" name="code_incident" value="<?php echo $code_incident;?>">
                                            <input type="hidden" name="auteur" value="<?php echo $emailUser;?>">
											<button type="submit" name="affecterIncident" class="btn btn-success form-control"><i class="mdi mdi-share"></i> Affecter l'incident a un intervenant</button>
									</form>
						</div>
					</div>
				</div>
			</div>