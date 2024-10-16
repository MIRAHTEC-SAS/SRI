<aside class="main-sidebar">
	<!-- sidebar-->
	<section class="sidebar position-relative">
		<div class="d-flex align-items-center logo-box justify-content-start d-md-block d-none">
			<!-- Logo -->
			<a href="dashboard" class="logo">
				<!-- logo-->
				<div class="logo-mini">
					<span class="light-logo"><img src="img/symbole.png" alt="logo"></span>
				</div>
				<div class="logo-lg">
					<span class="light-logo fs-36 fw-700">DAGE - <span class="text-primary">SRI</span></span>
				</div>
			</a>
		</div>
		<div class="user-profile my-15 px-20 py-10 b-1 rounded10 mx-15">
			<div class="d-flex align-items-center justify-content-between">
				<div class="image d-flex align-items-center">
					<!-- <img src="images/avatar/avatar-13.png" class="rounded-0 me-10" alt="User Image"> -->
					<div>
						<h4 class="mb-0 fw-600"><?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']; ?></h4>
						<p class="mb-0"><?php echo $_SESSION['role']; ?></p>
					</div>
				</div>
				<div class="info">
					<a class="dropdown-toggle p-15 d-grid" data-bs-toggle="dropdown" href="#"></a>
					<div class="dropdown-menu dropdown-menu-end">
						<a class="dropdown-item" href="#"><i class="ti-user"></i> Profil</a>
						<!-- <a class="dropdown-item" href="mailbox.html"><i class="ti-email"></i> Inbox</a> -->
						<!-- <a class="dropdown-item" href="contact_app_chat.html"><i class="ti-link"></i> Conversation</a> -->
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="logout?logout=1"><i class="ti-lock"></i> Deconnexion</a>
					</div>
				</div>
			</div>
		</div>
		<div class="multinav">
			<div class="multinav-scroll" style="height: 97%;">
				<!-- sidebar menu-->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">Gestion des interventions</li>
					<li>
						<a href="dashboard">
							<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
							<span>Tableau de bord</span>
						</a>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="icon-Flag"><span class="path1"></span><span class="path2"></span></i>
							<span>Signalements</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="signalements"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>En attente</a></li>
							<li><a href="signalements_encours"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>En cours</a></li>
							<li><a href="signalements_approuves"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>approuvés</a></li>
							<li><a href="signalements_termines"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Terminés</a></li>
							<li><a href="signalements_rejetes"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Rejetés</a></li>

						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="icon-Tools"><span class="path1"></span><span class="path2"></span></i>
							<span>Interventions</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="interventions_planifiees"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Planifiées</a></li>
							<li><a href="interventions_approuvees"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Approuvées</a></li>
							<li><a href="interventions_terminees"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Terminées</a></li>
							<li><a href="interventions_retards"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>En retards</a></li>
							<li><a href="interventions_annulees"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Annulées</a></li>

						</ul>
					</li>

					<li class="header">Referentiels</li>
					<li>
						<a href="ministeres">
							<i class="icon-Bullet-list"><span class="path1"></span><span class="path2"></span></i>
							<span>Ministeres</span>
						</a>
					</li>
					<li>
						<a href="directions">
							<i class="icon-Box2"><span class="path1"></span><span class="path2"></span></i>
							<span>Services</span>
						</a>
					</li>

					<li class="treeview">
						<a href="#">
							<i class="icon-Building"><span class="path1"></span><span class="path2"></span></i>
							<span>Localisations</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="batiments">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									<span>Batiments</span>
								</a>
								<a href="etages">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									<span>Etages</span>
								</a>
								<a href="pieces">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									<span>Pieces</span>
								</a>
							</li>


						</ul>
					<li>
						<a href="gestionnaires">
							<i class="icon-Article"><span class="path1"></span><span class="path2"></span></i>
							<span>Gestionnaires</span>
						</a>
					</li>
					<li>
						<a href="responsables_dage">
							<i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
							<span>Responsables</span>
						</a>
					</li>

					<li class="treeview">
						<a href="#">
							<i class="icon-Settings1"><span class="path1"></span><span class="path2"></span></i>
							<span>Intervants</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="prestataires">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									<span>Prestataires</span>
								</a>
							</li>
							<li class="treeview">
								<a href="#">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									<span>Internes</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-right pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li>
										<a href="intervenants_dage">
											<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
											<span>Ressources Dage</span>
										</a>
										<a href="services_intervenant">
											<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
											<span>Services</span>
										</a>

									</li>


								</ul>

							</li>
						</ul>
					</li>
					<li>
						<a href="types_incident">
							<i class="icon-Filter"><span class="path1"></span><span class="path2"></span></i>
							<span>Domaines d'intervention</span>
						</a>
					</li>
					<li class="header">Parametrages</li>
					<li class="treeview">
						<a href="#">
							<i class="icon-Lock-overturning"><span class="path1"></span><span class="path2"></span></i>
							<span>Affectations</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="affecter_gestionnaires">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									<span>Gestionnaires services</span>
								</a>
								<a href="responsables_incidents">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									<span>Responsables incidents</span>
								</a>
								<a href="intervenants_interne">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									<span>Intervenants internes</span>
								</a>
								<a href="prestataires_incidents">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									<span>Prestataires incidents</span>
								</a>
								<a href="services_intervenants_incidents">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									<span>Services intervenant</span>
								</a>
							</li>
						</ul>
					</li>
					<!-- <li>
				  <a href="#">
					<i class="icon-Settings"><span class="path1"></span><span class="path2"></span></i>
					<span>Priorités</span>
				  </a>
			</li>	
            <li>
				  <a href="#">
					<i class="icon-Alarm-clock"><span class="path1"></span><span class="path2"></span></i>
					<span>Delais</span>
				  </a>
			</li>	 -->
					<li class="treeview">
						<a href="#">
							<i class="icon-Barcode-scan"><span class="path1"></span><span class="path2"></span></i>
							<span>QR CODE</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="generation_qrcode">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									<span>Generer</span>
								</a>
								<!-- <a href="#">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									<span>Telecharger</span>
								</a> -->
							</li>
						</ul>
					<li class="treeview">
						<a href="#">
							<i class="icon-Lock-overturning"><span class="path1"></span><span class="path2"></span></i>
							<span>Access</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="utilisateurs">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									<span>Utilisateurs</span>
								</a>
								<a href="roles">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									<span>Rôles</span>
								</a>
								<a href="reinit_password">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									<span>Reinitialisation</span>
								</a>
							</li>
						</ul>
					</li>
					<!-- <li class="header">Support</li>
					<li>
						<a href="#">
							<i class="icon-Airplay-video"><span class="path1"></span><span class="path2"></span></i>
							<span>Tutoriels</span>
						</a>
					</li> -->
					<!-- <li>
						<a href="#">
							<i class="icon-Ticket"><span class="path1"></span><span class="path2"></span></i>
							<span>tickets</span>
						</a>
					</li> -->
					<!-- <li>
						<a href="#">
							<i class="icon-Phone"><span class="path1"></span><span class="path2"></span></i>
							<span>Contacts</span>
						</a>
					</li> -->


			</div>
		</div>
	</section>
</aside>