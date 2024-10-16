
<div id="app">							
<main id="general_page">
<div class="row text-center">
			<a href="#" id="logo"><img src="img/logo.png" alt="" width="250" height="70"></a>
			</div>	
			<div class="row"></br></br></div>	<!-- end map-->
		<div class="container margin_60_35">
			
			<div class="row">
				<div class="col-lg-8">
					<h3>Gestion des incidents</h3>
					<p>
						Fiche de declaration d'incidents.
					</p>
					<div>
						<div id="message-contact"></div>
						<form method="post" action="notifications/signalementController" enctype="multipart/form-data">
							<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
                                            <label>Type d'incident</label>
											 <select name="code_incident" class="form-control" v-model="newSignalement.code_incident" required >
                                                <option v-for="type in typesIncident" :value="type.code_incident">{{type.type_incident}}</option>
                                            </select>
										</div>
								</div>

								<div class="col-md-6 col-sm-6">
									<div class="form-group">
                                            <label>Service</label>
                                            <select name="code_service" class="form-control" v-model="newSignalement.code_service" required >
                                                <option v-for="service in services" :value="service.code_service">{{service.nom_service}}</option>
                                            </select>
                                    </div>
								</div>
								
							</div>
							<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
                                            <label>Batiment</label>
											<select name="code_batiment" class="form-control" v-model="newSignalement.code_batiment" required >
                                                <option v-for="batiment in batiments_service" :value="batiment.code_batiment">{{batiment.nom_batiment}}</option>
                                            </select>                                        
										</div>
								</div>
								<div class="col-md-6 col-sm-6">
								<div class="form-group">
                                            <label>Etage</label>
											 <select name="code_etage" class="form-control" v-model="newSignalement.code_etage" required >
                                                <option v-for="etage in etages_batiment" :value="etage.code_etage">{{etage.nom_etage}}</option>
                                            </select>
										</div>
								</div>
								
							</div>
							<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
                                            <label>Piece</label>
											 <select name="code_piece" class="form-control" v-model="newSignalement.code_localisation" required >
                                                <option v-for="espace in typesLocalisation" :value="espace.code_localisation">{{espace.type}}</option>
                                            </select>
										</div>
								</div>
								<div class="col-md-6 col-sm-6">
								<div class="form-group">
                                            <label>Piece jointe <small>(Fichiers acceptés: jpg, jpeg, .png, .pdf )</small></label>
											<input name="fileupload" type="file" class="form-control" v-model="newSignalement.pj">
										</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Description </label>
										<textarea rows="5" id="message_contact" name="description" class="form-control" style="height:100px;" placeholder="Veuillez d'ecrire en quelques phrases l'incident..." v-model="newSignalement.description"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 col-sm-4">
								<div class="form-group">
                                            <label>Auteur</label>
											 <input name="auteur" class="form-control" v-model="newSignalement.auteur" required >
										</div>
								</div>
								<div class="col-md-4 col-sm-4">
								<div class="form-group">
                                            <label>Telephone</label>
											<input name="telephone" type="number" class="form-control" v-model="newSignalement.telephone" required >
										</div>
								</div>
								<div class="col-md-4 col-sm-4">
								<div class="form-group">
                                            <label>Email</label>
											<input name="email" type="email" class="form-control" v-model="newSignalement.email" required >
										</div>
								</div>
							</div>
							<div class="row text-center">
								<div class="col-md-12">
									<!-- <div class="form-group">
										<label>Are you human? 3 + 1 =</label>
										<input type="text" id="verify_contact" class=" form-control" placeholder=" 3 + 1 =">
									</div> -->
</br>
									<p><input type="submit" value="Envoyer la declaration" name="declarerIncident" class="btn_1 add_bottom_15" ></p>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- End col lg 9 -->
				<aside class="col-lg-4" v-bind="resume">
					<div class="box_style_2">
						<h4 style="text-align:center">Resumé</h4></br>
						<h6>Type d'incident</h6>
						<p v-for="ti in selected_type_incident">
							{{ti.type_incident}}
						</p>
						<h6>Service</h6>
						<p v-for="s in selected_service">
							{{s.nom_service}}
						</p>
						<h6>Localisation</h6>
						<ul class="contacts_info">
							<li v-for=" b in selected_batiment">
								Batiment : <b>{{b.nom_batiment}}</b>
							</li>
							<li v-for=" b in selected_batiment">
								Adresse  : <b>{{b.adresse}}</b>
							</li>
							<li v-for="e in selected_etage">
								Etage : <b>{{e.nom_etage}}</b>
							</li>
							<li v-for="l in selected_type_localisation">
								Piece : <b>{{l.type}}</b>
							</li>
						</ul>
							</br>

						<h6>Description</h6>
						<div class="row">
							<p>
							{{newSignalement.description}}
							</p>
						</div>
						<h6>Piece jointe</h6>
						<p >
							{{newSignalement.pj}}
						</p>
						
						<h6>Auteur</h6>
						<ul class="contacts_info">
							<li :v-bind="newSignalement">
							{{newSignalement.auteur}}</br>
							{{newSignalement.telephone}}</br>
							{{newSignalement.email}}
							</li>
						</ul>
						<div class="row text-center">
								<div class="col-md-12">		
									</br>
									<form method="post" action="notifications/signalementController" enctype="multipart/form-data">
										<!-- recuperation des variables -->
										<input type="hidden" name="code_incident" :value="newSignalement.code_incident">
										<input type="hidden" name="code_service" :value="newSignalement.code_service">
										<input type="hidden" name="code_batiment" :value="newSignalement.code_batiment">
										<input type="hidden" name="code_etage" :value="newSignalement.code_etage">
										<input type="hidden" name="code_piece" :value="newSignalement.code_localisation">
										<input type="hidden" name="description" :value="newSignalement.code_description">
										<input type="hidden" name="" :value="newSignalement.code_incident">
										<input type="hidden" name="code_incident" :value="newSignalement.code_incident">
										<input type="hidden" name="code_incident" :value="newSignalement.code_incident">

										<p><input type="submit" value="Envoyer la declaration" name="declarerIncident" class="btn_1 add_bottom_15" ></p>
									</form>
								</div>
					</div>
					</div>
					
				</aside>
				<!--End aside -->
			</div>
			<!-- end row-->
		</div>
		<!-- end container-->
	</main>
</div>