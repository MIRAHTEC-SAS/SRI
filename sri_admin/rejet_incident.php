<div class="row">
				<div class="col-12">
					<div class="box">
						<div class="box-header with-border">
						  <h4 class="box-title">Rejet du signalement <strong style="color:red"><?php echo $numero_incident; ?></strong></h4>
						</div>
						<div class="box-body" style="background-color:#F7F7F7">
									<form action="services/incidents.php" method="POST">
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
                                            <label class="col-md-12 form-label">Raisons du rejet</label>
                                            <textarea class="form-control" name="raisons" style="text-align:left"></textarea>
</br>
											<input type="hidden" name="numero_incident" value="<?php echo $numero_incident;?>">
                                            <input type="hidden" name="code_service" value="<?php echo $code_service;?>">
                                            <input type="hidden" name="code_incident" value="<?php echo $code_incident;?>">
                                            <input type="hidden" name="auteur" value="<?php echo $emailUser;?>">
											<button type="submit" name="rejeterIncident" class="btn btn-danger form-control"><i class="mdi mdi-close"></i> Rejeter la demande d'intervention</button>
									</form>
						</div>
					</div>
				</div>
			</div>