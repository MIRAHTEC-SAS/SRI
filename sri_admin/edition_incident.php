<div class="row">
				<div class="col-12">
					<div class="box">
						<div class="box-header with-border">
						  <h4 class="box-title">Edition de l'incident <strong style="color:red"><?php echo $numero_incident; ?></strong></h4>
						</div>
						<div class="box-body" style="background-color:#F7F7F7">
									<form action="services/incidents.php" method="POST">
											<label>Categorie Incident</label>
											<select name="categorie"  class="form-control">
												<option value="<?php echo $code_incident;?>"><?php echo $categorie;?></option>
												<?php 
													$getListeTypes = mysqli_query($con, "SELECT * FROM `type_incidents` WHERE type_incident<>'$categorie'");
													while ($row = mysqli_fetch_array($getListeTypes)) { 
												?>
												<option value="<?php echo $row['code_incident'];?>"><?php echo $row['type_incident'];?></option>
												<?php } ?>

											</select>
</br>
											<label>Description</label>
											<textarea class="form-control" name="description" style="text-align:left"><?php echo htmlspecialchars($descriptionEdit); ?></textarea>
</br>
											<label>Priorite</label>
											<select name="code_priorite"  class="form-control">
												<option value="<?php echo $code_priorite;?>"><?php echo $priorite;?></option>
												<?php 
													$getPriorites = mysqli_query($con, "SELECT * FROM `code_priorite` WHERE code <> '$code_priorite'");
													while ($row = mysqli_fetch_array($getPriorites)) { 
												?>
												<option value="<?php echo $row['code'];?>"><?php echo $row['priorite'];?></option>
												<?php } ?>

											</select>
											</br>

											<input type="hidden" name="numero_incident" value="<?php echo $numero_incident;?>">
											<button type="submit" name="editerIncident" class="btn btn-warning form-control"><i class="mdi mdi-pencil"></i> Editer les details de l'incident</button>
									</form>
						</div>
					</div>
				</div>
			</div>