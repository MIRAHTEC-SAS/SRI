

<form method="POST" action="notifications/signalementController" enctype="multipart/form-data">
							<input id="website" name="website" type="text" value="">
							<!-- Leave for security protection, read docs for details -->
							<div id="middle-wizard">
								<div class="step">
									<h3 class="main_question"><strong>1/4</strong>Dans quelle categorie classeriez-vous l'incident ?</h3>
									<?php while ($row = mysqli_fetch_array($getDomaines)) { ?>
										<div class="form-group">
											<label class="container_check version_2"><?php echo $row['type_incident']; ?>
												<input type="checkbox" name="question_1[]" value="<?php echo $row['type_incident']; ?>" class="required" onchange="getVals(this, 'question_1');">
												<span class="checkmark"></span>
											</label>
										</div>
									<?php } ?>
								</div>
								<!-- /step-->
								<div class="step">
									<h3 class="main_question"><strong>2/4</strong>Decrivez l'incident</h3>
									<div class="form-group add_top_30">
										<!-- <label>Additional information</label> -->
										<textarea name="additional_message" class="form-control required" style="height:150px;" placeholder="Decrire ici brievement l'incident..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
									<div class="form-group add_top_30">
										<label>Joindre une photo<br><small>(Fichiers acceptés: gif, jpg, jpeg, .png, .pdf - Taille Maximum: 50ko.)</small></label>
										<div class="fileupload">
											<input type="file" name="fileupload" accept="image/*,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" onchange="getVals(this, 'fileupload');">
										</div>
									</div>
								</div>
								<!-- /step-->
								<div class="step">
									<h3 class="main_question"><strong>3/4</strong>Identification</h3>
									<div class="form-group">
										<input type="text" name="firstname" class="form-control required" placeholder="Prenom" onkeyup="getVals(this, 'firstname');">
									</div>
									<div class="form-group">
										<input type="text" name="lastname" class="form-control required" placeholder="Nom">
									</div>
									<!-- <div class="form-group">
										<input type="email" name="email" class="form-control required" placeholder="Your Email">
									</div> -->
									<div class="form-group">
										<input type="text" name="contact" class="form-control" placeholder="Email, Matricule ou Telephone">
										<input type='hidden' name="code_service" value="<?php echo $code_service;?>">
										<input type='hidden' name="code_batiment" value="<?php echo $code_batiment;?>">
										<input type='hidden' name="code_etage" value="<?php echo $code_etage;?>">

									</div>
									<div class="form-group terms">
										<label class="container_check">Merci de lire les <a href="#" data-bs-toggle="modal" data-bs-target="#terms-txt">Termes et conditions</a>
											<input type="checkbox" name="terms" value="Yes" class="required">
											<span class="checkmark"></span>
										</label>
									</div>
								</div>
								<!-- /step-->
								<div class="submit step">
									<h3 class="main_question"><strong>4/4</strong>Revoir le resumé avant de soumettre le formulaire</h3>
									<div class="summary">
										<ul>
											<li><strong>1</strong>
												<h5>Categorie de l'incident</h5>
												<p id="question_1"></p>
											</li>
											<li><strong>2</strong>
												<h5>Description</h5>
												<p id="additional_message"></p>
												<p><label>Fichier chargé</label>: <span id="fileupload"></span></p>
											</li>
											<!-- <li><strong>3</strong>
												<h5>Declarant</h5>
												<p id="firstname"></p>
											</li> -->
										</ul>
									</div>
								</div>
								<!-- /step-->
							</div>
							<!-- /middle-wizard -->
							<div id="bottom-wizard">
								
								<button type="button" name="backward" class="backward">Precedent</button>
								<button type="button" name="forward" class="forward">Suivant</button>
								<button type="submit" name="process" class="submit">Envoyer</button>
							</div>
							<!-- /bottom-wizard -->
						</form>
