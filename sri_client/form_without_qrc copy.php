


?>
<form method="POST" action="notifications/signalementController" enctype="multipart/form-data">
<div id="app">							
<input id="website" name="website" type="text" value="">
							<!-- Leave for security protection, read docs for details -->
							<div id="middle-wizard">
								<div class="step">
                                    <!-- 1/5 -->
                                    <!-- while ($row = mysqli_fetch_array($getDomaines)) {  -->

                                    <h3 class="main_question"><strong>1/5</strong>Localisation de l'incident</h3>
                                        
										<div class="form-group">
                                            <label>Service</label>
                                            <select name="code_service" class="form-control" v-model="newSignalement.code_service" required >
                                                <option v-for="service in services" :value="service.code_service">{{service.nom_service}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Batiment</label>
											<select name="code_batiment" class="form-control" v-model="newSignalement.code_batiment" required >
                                                <option v-for="batiment in batiments_service" :value="batiment.code_batiment">{{batiment.nom_batiment}}</option>
                                            </select>                                        
										</div>
										<!-- <div class="form-group">
                                            <label>Batiment</label>
											Adresse                                      
										</div> -->
                                        <div class="form-group">
                                            <label>Etage</label>
											 <select name="code_etage" class="form-control" v-model="newSignalement.code_etage" required >
                                                <option v-for="etage in etages_batiment" :value="etage.code_etage">{{etage.nom_etage}}</option>
                                            </select>
										</div>
										<div class="form-group">
                                            <label>Piece (<small style="font-style:italic">facultatif</small>)</label>
											 <input class="form-control" type="text" name="piece">
										</div>
                                   
                                </div>
                                <div class="step">
									<h3 class="main_question"><strong>2/5</strong>Dans quelle categorie classeriez-vous l'incident ?</h3>
									<div class="form-group">
										<label class="container_check version_2">Electricite
											<input type="checkbox" name="question_1[]" value="Electricite" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_check version_2">Plomberie
											<input type="checkbox" name="question_1[]" value="Plomberie" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_check version_2">Ascenseurs
											<input type="checkbox" name="question_1[]" value="Seo optimization" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_check version_2">Menuiserie
											<input type="checkbox" name="question_1[]" value="CMS integrations (Wordpress)" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_check version_2">Climatisation
											<input type="checkbox" name="question_1[]" value="Newsletter Campaign" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_check version_2">Autre
											<input type="checkbox" name="question_1[]" value="Logo Design" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>
								</div>
								<!-- /step-->
								<div class="step">
									<h3 class="main_question"><strong>3/5</strong>Decrivez l'incident</h3>
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
									<h3 class="main_question"><strong>4/5</strong>Identification</h3>
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
									<h3 class="main_question"><strong>5/5</strong>Revoir le resumé avant de soumettre le formulaire</h3>
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
                            </div>
						</form>