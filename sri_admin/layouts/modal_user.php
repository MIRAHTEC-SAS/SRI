<!-- quick_user_toggle -->
<div class="modal modal-right fade" id="quick_user_toggle" tabindex="-1">
	  <div class="modal-dialog">
		<div class="modal-content slim-scroll3">
		  <div class="modal-body p-30 bg-white">
			<div class="d-flex align-items-center justify-content-between pb-30">
				<h4 class="m-0">Profil utilisateur
				<small class="text-fade fs-12 ms-5">12 demandes</small></h4>
				<a href="#" class="btn btn-icon btn-danger-light btn-sm no-shadow" data-bs-dismiss="modal">
					<span class="fa fa-close"></span>
				</a>
			</div>
            <div>
                <div class="d-flex flex-row">
                    <!-- <div class=""><img src="images/avatar/avatar-2.png" alt="user" class="rounded bg-danger-light w-150" width="100"></div> -->
                    <div class="ps-20">
                        <h5 class="mb-0"><?php echo $_SESSION['prenom'].' '.$_SESSION['nom']; ?></h5>
                        <p class="my-5 text-fade"><?php echo $_SESSION['role']; ?></p>

                        
                        <a href="mailto:dummy@gmail.com"><span class="icon-Mail-notification me-5 text-success"><span class="path1"></span><span class="path2"></span></span><?php echo $_SESSION['email']; ?></a>
                    </div>
                </div>
			</div>
              <div class="dropdown-divider my-30"></div>
              <div>
                <div class="d-flex align-items-center mb-30">
                    <div class="me-15 bg-primary-light h-50 w-50 l-h-60 rounded text-center">
                          <span class="icon-Library fs-24"><span class="path1"></span><span class="path2"></span></span>
                    </div>
                    <div class="d-flex flex-column fw-500">
                        <a href="#" class="text-dark hover-primary mb-1 fs-16">Mon profil</a>
                        <span class="text-fade">Informations et mot de passe</span>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-30">
                    <div class="me-15 bg-danger-light h-50 w-50 l-h-60 rounded text-center">
                        <span class="icon-Write fs-24"><span class="path1"></span><span class="path2"></span></span>
                    </div>
                    <div class="d-flex flex-column fw-500">
                        <a href="#" class="text-dark hover-danger mb-1 fs-16">Mes Messages</a>
                        <span class="text-fade">Messages et alertes</span>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-30">
                    <div class="me-15 bg-success-light h-50 w-50 l-h-60 rounded text-center">
                        <span class="icon-Group-chat fs-24"><span class="path1"></span><span class="path2"></span></span>
                    </div>
                    <div class="d-flex flex-column fw-500">
                        <a href="#" class="text-dark hover-success mb-1 fs-16">Mes Activités</a>
                        <span class="text-fade">Interactions et interventions</span>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-30">
                    <div class="me-15 bg-info-light h-50 w-50 l-h-60 rounded text-center">
                        <span class="icon-Attachment1 fs-24"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>
                    </div>
                    <div class="d-flex flex-column fw-500">
                        <a href="#" class="text-dark hover-info mb-1 fs-16">Mes demandes</a>
                        <span class="text-fade">Liste des demandes</span>
                    </div>
                </div>
              </div>
              <div class="dropdown-divider my-30"></div>
              <div>
                <div class="media-list">
                    <a class="media media-single px-0" href="#">
                      <h4 class="w-50 text-gray fw-500">10:10</h4>
                      <div class="media-body ps-15 bs-5 rounded border-primary">
                        <p>Resume intervention...</p>
                        <span class="text-fade">service</span>
                      </div>
                    </a>

                    <a class="media media-single px-0" href="#">
                      <h4 class="w-50 text-gray fw-500">08:40</h4>
                      <div class="media-body ps-15 bs-5 rounded border-success">
                      <p>Resume intervention...</p>
                        <span class="text-fade">service</span>
                      </div>
                    </a>

                    <a class="media media-single px-0" href="#">
                      <h4 class="w-50 text-gray fw-500">07:10</h4>
                      <div class="media-body ps-15 bs-5 rounded border-info">
                      <p>Resume intervention...</p>
                        <span class="text-fade">service</span>
                      </div>
                    </a>

                    <a class="media media-single px-0" href="#">
                      <h4 class="w-50 text-gray fw-500">01:15</h4>
                      <div class="media-body ps-15 bs-5 rounded border-danger">
                      <p>Resume intervention...</p>
                        <span class="text-fade">service</span>
                      </div>
                    </a>

                  

                   
                  </div>
            </div>
		  </div>
		</div>
	  </div>
  </div>
  
</div>
<!-- ./wrapper -->
	
	<!-- ./side demo panel -->

	<!-- Sidebar -->
	</div>