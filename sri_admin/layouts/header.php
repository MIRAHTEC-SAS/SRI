<header class="main-header">
	<div class="d-flex align-items-center logo-box justify-content-start d-md-none d-block">
		<!-- Logo -->
		<a href="dashboard" class="logo">
			<!-- logo-->
			<div class="logo-mini w-30">
				<span class="light-logo"><img src="img/symbole.png" alt="logo"></span>
				<span class="dark-logo"><img src="img/symbole.png" alt="logo"></span>
			</div>
			<div class="logo-lg">
				<span class="light-logo"><img src="img/symbole.png" alt="logo"></span>
				<span class="dark-logo"><img src="img/symbole.png" alt="logo"></span>
			</div>
		</a>
	</div>
	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<div class="app-menu">
			<ul class="header-megamenu nav">
				<li class="btn-group nav-item">
					<a href="#" class="waves-effect waves-light nav-link push-btn btn-primary-light" data-toggle="push-menu" role="button">
						<i class="icon-Menu"><span class="path1"></span><span class="path2"></span></i>
					</a>
				</li>
				<li class="btn-group d-lg-inline-flex d-none">
					<div class="app-menu">
						<div class="search-bx mx-5">
							<form>
								<div class="input-group">
									<input type="search" class="form-control" placeholder="Recherche...">
									<div class="input-group-append">
										<button class="btn" type="submit" id="button-addon3"><i class="icon-Search"><span class="path1"></span><span class="path2"></span></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</li>
			</ul>
		</div>

		<div class="navbar-custom-menu r-side">
			<ul class="nav navbar-nav">
				<!-- <li class="btn-group nav-item">
				<a href="#" class="waves-effect waves-light nav-link btn-primary-light svg-bt-icon" title="" data-bs-toggle="modal" data-bs-target="#quick_actions_toggle">
					<i class="icon-Layout-arrange"><span class="path1"></span><span class="path2"></span></i>
			    </a>
			</li> -->
				<li class="btn-group nav-item d-xl-inline-flex d-none">
					<a href="#" class="waves-effect waves-light nav-link btn-primary-light svg-bt-icon" title="" data-bs-toggle="modal" data-bs-target="#quick_panel_toggle1">
						<i class="icon-Notification"><span class="path1"></span><span class="path2"></span></i>
					</a>
				</li>

				<li class="btn-group nav-item d-xl-inline-flex d-none">
					<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link btn-primary-light svg-bt-icon" title="Full Screen">
						<i class="icon-Expand-arrows"><span class="path1"></span><span class="path2"></span></i>
					</a>
				</li>

				<!-- User Account-->
				<li class="dropdown user user-menu">
					<a href="#" class="waves-effect waves-light dropdown-toggle w-auto l-h-12 bg-transparent p-0 no-shadow" title="User" data-bs-toggle="modal" data-bs-target="#quick_user_toggle">
						<div class="d-flex pt-1">
							<div class="text-end me-10">
								<p class="pt-5 fs-14 mb-0 fw-700 text-primary"><?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']; ?></p>
								<small class="fs-10 mb-0 text-uppercase text-mute"><?php echo $_SESSION['role']; ?></small>

							</div>
							<img src="images/avatar/avatar-11.svg" class="avatar rounded-10 bg-primary-light h-40 w-40" alt="" />
						</div>
					</a>
				</li>

			</ul>
		</div>
	</nav>
</header>