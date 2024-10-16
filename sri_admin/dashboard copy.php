<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../images/favicon.ico">

    <title>CRMi - Dashboard</title>
    
	<!-- Vendors Style-->
	<link rel="stylesheet" href="../src/css/vendors_css.css">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="../src/css/style.css">
	<link rel="stylesheet" href="../src/css/skin_color.css">
     
  </head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">
	<div id="loader"></div>
	
  <header class="main-header">
	<div class="d-flex align-items-center logo-box justify-content-start d-md-none d-block">	
		<!-- Logo -->
		<a href="index.html" class="logo">
		  <!-- logo-->
		  <div class="logo-mini w-30">
			  <span class="light-logo"><img src="../../../images/logo-letter.png" alt="logo"></span>
			  <span class="dark-logo"><img src="../../../images/logo-letter-white.png" alt="logo"></span>
		  </div>
		  <div class="logo-lg">
			  <span class="light-logo"><img src="../../../images/logo-dark-text.png" alt="logo"></span>
			  <span class="dark-logo"><img src="../../../images/logo-light-text.png" alt="logo"></span>
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
							  <input type="search" class="form-control" placeholder="Search">
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
			<li class="dropdown notifications-menu btn-group nav-item">
				<a href="#" class="waves-effect waves-light nav-link btn-primary-light svg-bt-icon" data-bs-toggle="dropdown" title="Notifications">
					<i class="icon-Notifications"><span class="path1"></span><span class="path2"></span></i>
					<div class="pulse-wave"></div>
			    </a>
				<ul class="dropdown-menu animated bounceIn">
				  <li class="header">
					<div class="p-20">
						<div class="flexbox">
							<div>
								<h4 class="mb-0 mt-0">Notifications</h4>
							</div>
							<div>
								<a href="#" class="text-danger">Clear All</a>
							</div>
						</div>
					</div>
				  </li>
				  <li>
					<!-- inner menu: contains the actual data -->
					<ul class="menu sm-scrol">
					  <li>
						<a href="#">
						  <i class="fa fa-users text-info"></i> Curabitur id eros quis nunc suscipit blandit.
						</a>
					  </li>
					  <li>
						<a href="#">
						  <i class="fa fa-warning text-warning"></i> Duis malesuada justo eu sapien elementum, in semper diam posuere.
						</a>
					  </li>
					  <li>
						<a href="#">
						  <i class="fa fa-users text-danger"></i> Donec at nisi sit amet tortor commodo porttitor pretium a erat.
						</a>
					  </li>
					  <li>
						<a href="#">
						  <i class="fa fa-shopping-cart text-success"></i> In gravida mauris et nisi
						</a>
					  </li>
					  <li>
						<a href="#">
						  <i class="fa fa-user text-danger"></i> Praesent eu lacus in libero dictum fermentum.
						</a>
					  </li>
					  <li>
						<a href="#">
						  <i class="fa fa-user text-primary"></i> Nunc fringilla lorem 
						</a>
					  </li>
					  <li>
						<a href="#">
						  <i class="fa fa-user text-success"></i> Nullam euismod dolor ut quam interdum, at scelerisque ipsum imperdiet.
						</a>
					  </li>
					</ul>
				  </li>
				  <li class="footer">
					  <a href="#">View all</a>
				  </li>
				</ul>
			</li>
			<li class="btn-group nav-item">
				<a href="#" class="waves-effect waves-light nav-link btn-primary-light svg-bt-icon" title="" data-bs-toggle="modal" data-bs-target="#quick_actions_toggle">
					<i class="icon-Layout-arrange"><span class="path1"></span><span class="path2"></span></i>
			    </a>
			</li>
			<li class="btn-group nav-item d-xl-inline-flex d-none">
				<a href="#" class="waves-effect waves-light nav-link btn-primary-light svg-bt-icon" title="" data-bs-toggle="modal" data-bs-target="#quick_panel_toggle">
					<i class="icon-Notification"><span class="path1"></span><span class="path2"></span></i>
			    </a>
			</li>
			<li class="btn-group nav-item d-xl-inline-flex d-none">
				<a href="#" class="waves-effect waves-light nav-link btn-primary-light svg-bt-icon" title="" data-bs-toggle="modal" data-bs-target="#quick_shop_toggle">
					<i class="icon-Cart1"><span class="path1"></span><span class="path2"></span></i>
			    </a>
			</li>
			<li class="btn-group nav-item d-xl-inline-flex d-none">
				<a href="#" class="waves-effect waves-light nav-link btn-primary-light svg-bt-icon" title="" id="live-chat">
					<i class="icon-Chat"><span class="path1"></span><span class="path2"></span></i>
			    </a>
			</li>
			
			<li class="btn-group">
			    <a href="#" class="waves-effect waves-light nav-link btn-primary-light svg-bt-icon dropdown-toggle" data-bs-toggle="dropdown">
					<img class="rounded" src="../../../images/svg-icon/usa.svg" alt="">
				</a>
			    <div class="dropdown-menu">
					<a class="dropdown-item my-5" href="#"><img class="w-20 rounded me-10" src="../../../images/svg-icon/usa.svg" alt=""> English</a>
					<a class="dropdown-item my-5" href="#"><img class="w-20 rounded me-10" src="../../../images/svg-icon/spain.svg" alt=""> Spanish</a>
					<a class="dropdown-item my-5" href="#"><img class="w-20 rounded me-10" src="../../../images/svg-icon/ger.svg" alt=""> German</a>
					<a class="dropdown-item my-5" href="#"><img class="w-20 rounded me-10" src="../../../images/svg-icon/jap.svg" alt=""> Japanese</a>
					<a class="dropdown-item my-5" href="#"><img class="w-20 rounded me-10" src="../../../images/svg-icon/fra.svg" alt=""> French</a>
			    </div>
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
							<p class="pt-5 fs-14 mb-0 fw-700 text-primary">Johen Doe</p>
							<small class="fs-10 mb-0 text-uppercase text-mute">Admin</small>
						</div>
						<img src="../../../images/avatar/avatar-1.png" class="avatar rounded-10 bg-primary-light h-40 w-40" alt="" />
					</div>
				</a>
			</li>
			
        </ul>
      </div>
    </nav>
  </header>
  
  <aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
		<div class="d-flex align-items-center logo-box justify-content-start d-md-block d-none">	
			<!-- Logo -->
			<a href="index.html" class="logo">
			  <!-- logo-->
			  <div class="logo-mini">
				  <span class="light-logo"><img src="../../../images/logo-letter.png" alt="logo"></span>
			  </div>
			  <div class="logo-lg">
				  <span class="light-logo fs-36 fw-700">CRM<span class="text-primary">i</span></span>
			  </div>
			</a>	
		</div> 
		<div class="user-profile my-15 px-20 py-10 b-1 rounded10 mx-15">
			<div class="d-flex align-items-center justify-content-between">			
				<div class="image d-flex align-items-center">
				    <img src="../../../images/avatar/avatar-13.png" class="rounded-0 me-10" alt="User Image">
					<div>
						<h4 class="mb-0 fw-600">Nil Yeager</h4>
						<p class="mb-0">Super Admin</p>
					</div>
				</div>
				<div class="info">
					<a class="dropdown-toggle p-15 d-grid" data-bs-toggle="dropdown" href="#"></a>
					<div class="dropdown-menu dropdown-menu-end">
					  <a class="dropdown-item" href="extra_profile.html"><i class="ti-user"></i> Profile</a>
					  <a class="dropdown-item" href="mailbox.html"><i class="ti-email"></i> Inbox</a>
					  <a class="dropdown-item" href="contact_app_chat.html"><i class="ti-link"></i> Conversation</a>
					  <div class="dropdown-divider"></div>
					  <a class="dropdown-item" href="auth_login.html"><i class="ti-lock"></i> Logout</a>
					</div>
				</div>
			</div>
	    </div>
	  	<div class="multinav">
		  <div class="multinav-scroll" style="height: 97%;">	
			  <!-- sidebar menu-->
			  <ul class="sidebar-menu" data-widget="tree">	
				<li class="header">Main Menu</li>
				<li>
				  <a href="index.html">
					<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
					<span>Dashboard</span>
				  </a>
				</li>
				<li>
				  <a href="analytics.html">
					<i class="icon-Chart-pie"><span class="path1"></span><span class="path2"></span></i>
					<span>Analytics</span>
				  </a>
				</li>
				<li>
				  <a href="reports.html">
					<i class="icon-Flag"><span class="path1"></span><span class="path2"></span></i>
					<span>Reports</span>
				  </a>
				</li>
				<li>
				  <a href="extra_calendar.html">
					<i class="icon-Alarm-clock"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
					<span>Calendar</span>
				  </a>
				</li>
				<li>
				  <a href="contact_app_chat.html">
					<i class="icon-Chat2"></i>
					<span>Chat</span>
				  </a>
				</li>
				<li>
				  <a href="contact_userlist_grid.html">
					<i class="icon-Add-user"><span class="path1"></span><span class="path2"></span></i>
					<span>Contacts</span>
				  </a>
				</li>				  
				<li class="header">Components</li>
				<li class="treeview">
				  <a href="#">
					<i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
					<span>Features</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">											
					<li class="treeview">
						<a href="#">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Card
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="box_cards.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>User Card</a></li>
							<li><a href="box_advanced.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Advanced Card</a></li>
							<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Basic Card</a></li>
							<li><a href="box_color.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Card Color</a></li>
							<li><a href="box_group.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Card Group</a></li>
						</ul>
					</li>												
					<li class="treeview">
						<a href="#">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>BS UI
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="ui_grid.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Grid System</a></li>
							<li><a href="ui_badges.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Badges</a></li>
							<li><a href="ui_border_utilities.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Border</a></li>
							<li><a href="ui_buttons.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Buttons</a></li>	
							<li><a href="ui_color_utilities.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Color</a></li>
							<li><a href="ui_dropdown.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dropdown</a></li>
							<li><a href="ui_dropdown_grid.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dropdown Grid</a></li>
							<li><a href="ui_progress_bars.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Progress Bars</a></li>
						</ul>
					</li>										
					<li class="treeview">
						<a href="#">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Icons
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="icons_fontawesome.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Font Awesome</a></li>
							<li><a href="icons_glyphicons.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Glyphicons</a></li>
							<li><a href="icons_material.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Material Icons</a></li>	
							<li><a href="icons_themify.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Themify Icons</a></li>
							<li><a href="icons_simpleline.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Simple Line Icons</a></li>
							<li><a href="icons_cryptocoins.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Cryptocoins Icons</a></li>
							<li><a href="icons_flag.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Flag Icons</a></li>
							<li><a href="icons_weather.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Weather Icons</a></li>
						</ul>
					</li>									
					<li class="treeview">
						<a href="#">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Custom UI
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="ui_ribbons.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Ribbons</a></li>
							<li><a href="ui_sliders.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sliders</a></li>
							<li><a href="ui_typography.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Typography</a></li>
							<li><a href="ui_tab.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Tabs</a></li>
							<li><a href="ui_timeline.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Timeline</a></li>
							<li><a href="ui_timeline_horizontal.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Horizontal Timeline</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Components
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="component_bootstrap_switch.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Bootstrap Switch</a></li>
							<li><a href="component_date_paginator.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Date Paginator</a></li>
							<li><a href="component_media_advanced.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Advanced Medias</a></li>
							<li><a href="component_rangeslider.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Range Slider</a></li>
							<li><a href="component_rating.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Ratings</a></li>
							<li><a href="component_animations.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Animations</a></li>
							<li><a href="extension_fullscreen.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Fullscreen</a></li>
							<li><a href="extension_pace.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pace</a></li>
							<li><a href="component_nestable.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Nestable</a></li>
							<li><a href="component_portlet_draggable.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Draggable Portlets</a></li>	
						</ul>
					</li>  
				  </ul>
				</li>			
				<li class="treeview">
				  <a href="#">
					<i class="icon-Box2"><span class="path1"></span><span class="path2"></span></i>
					<span>Forms, Tables & Charts</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>					
				  <ul class="treeview-menu">					
					<li class="treeview">
						<a href="#">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Forms
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="forms_advanced.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Form Elements</a></li>
							<li><a href="forms_general.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Form Layout</a></li>
							<li><a href="forms_wizard.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Form Wizard</a></li>	
							<li><a href="forms_validation.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Form Validation</a></li>
							<li><a href="forms_mask.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Formatter</a></li>
							<li><a href="forms_xeditable.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Xeditable Editor</a></li>
							<li><a href="forms_dropzone.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dropzone</a></li>
							<li><a href="forms_code_editor.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Code Editor</a></li>
							<li><a href="forms_editors.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Editor</a></li>
							<li><a href="forms_editor_markdown.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Markdown</a></li>
						</ul>
					</li> 		
					<li class="treeview">
						<a href="#">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Tables
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="tables_simple.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Simple tables</a></li>
							<li><a href="tables_data.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Data tables</a></li>
							<li><a href="tables_editable.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Editable Tables</a></li>
							<li><a href="tables_color.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Table Color</a></li>
						</ul>
					</li> 
					<li class="treeview">
						<a href="#">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Charts
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="charts_chartjs.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>ChartJS</a></li>
							<li><a href="charts_flot.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Flot</a></li>
							<li><a href="charts_inline.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Inline charts</a></li>
							<li><a href="charts_morris.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Morris</a></li>
							<li><a href="charts_peity.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Peity</a></li>
							<li><a href="charts_chartist.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Chartist</a></li>
							<li><a href="charts_c3_axis.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Axis Chart</a></li>
							<li><a href="charts_c3_bar.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Bar Chart</a></li>
							<li><a href="charts_c3_data.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Data Chart</a></li>
							<li><a href="charts_c3_line.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Line Chart</a></li>
							<li><a href="charts_echarts_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Basic Charts</a></li>
							<li><a href="charts_echarts_bar.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Bar Chart</a></li>
							<li><a href="charts_echarts_pie_doughnut.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pie & Doughnut Chart</a></li>
						</ul>
					</li>
				  </ul>
				</li>				 
				<li class="treeview">
				  <a href="#">
					<i class="icon-Globe"><span class="path1"></span><span class="path2"></span></i>
					<span>Apps & Widgets</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">					
					<li class="treeview">
						<a href="#">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Apps
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="contact_app.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Contact List</a></li>
							<li><a href="extra_taskboard.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Todo</a></li>
							<li><a href="mailbox.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Mailbox</a></li>
						</ul>
					</li>										
					<li class="treeview">
						<a href="#">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Widgets
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="treeview">
								<a href="#">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Custom
									<span class="pull-right-container">
										<i class="fa fa-angle-right pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li><a href="widgets_blog.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Blog</a></li>
									<li><a href="widgets_chart.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Chart</a></li>
									<li><a href="widgets_list.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List</a></li>
									<li><a href="widgets_social.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Social</a></li>
									<li><a href="widgets_statistic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Statistic</a></li>
									<li><a href="widgets_weather.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Weather</a></li>
									<li><a href="widgets.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Widgets</a></li>
									<li><a href="email_index.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Emails</a></li>	
								</ul>
							</li>											  	
							<li class="treeview">
								<a href="#">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Maps
									<span class="pull-right-container">
										<i class="fa fa-angle-right pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li><a href="map_google.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Google Map</a></li>
									<li><a href="map_vector.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Vector Map</a></li>
								</ul>
							</li>					  	
							<li class="treeview">
								<a href="#">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Modals
									<span class="pull-right-container">
										<i class="fa fa-angle-right pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li><a href="component_modals.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Modals</a></li>
									<li><a href="component_sweatalert.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sweet Alert</a></li>
									<li><a href="component_notification.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Toastr</a></li>
								</ul>
							</li>
						</ul>
					</li>					
					<li class="treeview">
						<a href="#">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Ecommerce
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="ecommerce_products.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Products</a></li>
							<li><a href="ecommerce_cart.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Products Cart</a></li>
							<li><a href="ecommerce_products_edit.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Products Edit</a></li>
							<li><a href="ecommerce_details.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Product Details</a></li>
							<li><a href="ecommerce_orders.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Product Orders</a></li>
							<li><a href="ecommerce_checkout.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Products Checkout</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sample Pages
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="invoice.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Invoice</a></li>
							<li><a href="invoicelist.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Invoice List</a></li>	
							<li><a href="extra_app_ticket.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Support Ticket</a></li>
							<li><a href="extra_profile.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>User Profile</a></li>
							<li><a href="contact_userlist.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Userlist</a></li>	
							<li><a href="sample_faq.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>FAQs</a></li>
							<li><a href="sample_blank.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Blank</a></li>
							<li><a href="sample_coming_soon.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Coming Soon</a></li>
							<li><a href="sample_custom_scroll.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Custom Scrolls</a></li>
							<li><a href="sample_gallery.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Gallery</a></li>
							<li><a href="sample_lightbox.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lightbox Popup</a></li>
							<li><a href="sample_pricing.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pricing</a></li>
						</ul>
					</li>
				  </ul>
				</li>	 
				<li class="treeview">
				  <a href="#">
					<i class="icon-Lock-overturning"><span class="path1"></span><span class="path2"></span></i>
					<span>Authentication</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li><a href="auth_login.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Login</a></li>
					<li><a href="auth_register.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Register</a></li>
					<li><a href="auth_lockscreen.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lockscreen</a></li>
					<li><a href="auth_user_pass.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Recover password</a></li>	
				  </ul>
				</li>
				<li class="treeview">
				  <a href="#">
					<i class="icon-Warning-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
					<span>Miscellaneous</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li><a href="error_404.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Error 404</a></li>
					<li><a href="error_500.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Error 500</a></li>
					<li><a href="error_maintenance.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Maintenance</a></li>	
				  </ul>
				</li>	 	     
			  </ul>
			  
			  <div class="sidebar-widgets">
				  <div class="mx-25 mb-30 pb-20 side-bx bg-primary-light rounded20">
					<div class="text-center">
						<img src="../../../images/svg-icon/color-svg/custom-17.svg" class="sideimg p-5" alt="">
						<h4 class="title-bx text-primary">View Full Report</h4>
						<a href="#" class="py-10 fs-14 mb-0 text-primary">
							Best CRM App here <i class="mdi mdi-arrow-right"></i>
						</a>
					</div>
				  </div>
				<div class="copyright text-center m-25">
					<p><strong class="d-block">CRMi Dashboard</strong> © <script>document.write(new Date().getFullYear())</script> All Rights Reserved</p>
				</div>
			  </div>
		  </div>
		</div>
    </section>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xxxl-8 col-xl-9 col-12">
					<div class="row">
						<div class="col-xl-4 col-lg-6 col-12">
							<div class="box">
								<div class="box-body">
									<div class="d-flex align-items-center justify-content-between">
										<div>
											<div class="bg-primary mb-20 w-50 h-50 rounded10 text-center l-h-50">
												<i class="fs-18 fa fa-file"></i>
											</div>
											<h4 class="mb-5">Projects</h4>
											<p class="text-mute mb-0">124 Total</p>
										</div>
										<div id="chart41"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-12">
							<div class="box">
								<div class="box-body">
									<div class="d-flex align-items-center justify-content-between">
										<div>
											<div class="bg-info mb-20 w-50 h-50 rounded10 text-center l-h-50">
												<i class="fs-18 fa fa-cogs"></i>
											</div>
											<h4 class="mb-5 text-nowrap">On Going</h4>
											<p class="text-mute mb-0">32 Total</p>
										</div>
										<div id="chart42"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-12">
							<div class="box">
								<div class="box-body">
									<div class="d-flex align-items-center justify-content-between">
										<div>
											<div class="bg-success mb-20 w-50 h-50 rounded10 text-center l-h-50">
												<i class="fs-18 fa fa-trophy"></i>
											</div>
											<h4 class="mb-5">Complate</h4>
											<p class="text-mute mb-0">102 Total</p>
										</div>
										<div id="chart43"></div>
									</div>
								</div>
							</div>
						</div>
					</div>					
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">
								Revenue Analytics
							</h3>
						</div>
						<div class="box-body pb-0">
							<div id="chart44"></div>
						</div>
						<div class="box-body pb-0">							
							<div class="row">
								<div class="col-lg-4 col-12">
									<div class="box no-shadow no-border bg-lightest">
										<div class="box-body">
											<h2 class="fw-600"><small>$</small>1.200</h2>
											<p class="text-mute mb-0">This Day</p>
											<p class="text-success mb-0"><i class="fa fa-arrow-up"></i> 1.8%</p>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-12">
									<div class="box no-shadow no-border bg-lightest">
										<div class="box-body">
											<h2 class="fw-600 text-primary"><small>$</small>12.745</h2>
											<p class="text-mute mb-0">This Week</p>
											<p class="text-success mb-0"><i class="fa fa-arrow-up"></i> 1.8%</p>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-12">
									<div class="box no-shadow no-border bg-lightest">
										<div class="box-body">
											<h2 class="fw-600 text-success"><small>$</small>7.745</h2>
											<p class="text-mute mb-0">Previous Week</p>
											<p class="text-success mb-0"><i class="fa fa-arrow-up"></i> 1.8%</p>
										</div>
									</div>
								</div>
							</div>	
						</div>
					</div>
				</div>
				<div class="col-xxxl-4 col-xl-3 col-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">
								Recent Activity
							</h3>
						</div>
						<div class="box-body">
							<div class="activity-div">
								<div class="timeline-label">
									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-16">08:42</div>
										<div class="timeline-badge">
											<i class="fa fa-genderless text-warning fs-14"></i>
										</div>
										<div class="timeline-content text-muted ps-3">Sed non libero at risus aliquet imperdiet.</div>
									</div>
									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-16">10:00</div>
										<div class="timeline-badge">
											<i class="fa fa-genderless text-success fs-14"></i>
										</div>
										<div class="timeline-content d-flex">
											<span class="fw-500 ps-3">Vivamus quis</span>
										</div>
									</div>
									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-16">14:37</div>
										<div class="timeline-badge">
											<i class="fa fa-genderless text-danger fs-14"></i>
										</div>
										<div class="timeline-content fw-500 ps-3">Cras lobortis 
										<a href="#" class="text-primary">USD 412</a>. to XYZ</div>
									</div>
									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-16">16:50</div>
										<div class="timeline-badge">
											<i class="fa fa-genderless text-primary fs-14"></i>
										</div>
										<div class="timeline-content text-muted ps-3">In eu massa sed lectus tempus blandit quis id orci.</div>
									</div>
									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-16">21:03</div>
										<div class="timeline-badge">
											<i class="fa fa-genderless text-danger fs-14"></i>
										</div>
										<div class="timeline-content fw-500 ps-3">Sed a lorem 
										<a href="#" class="text-primary">#41-4155</a>.</div>
									</div>
									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-16">16:50</div>
										<div class="timeline-badge">
											<i class="fa fa-genderless text-primary fs-14"></i>
										</div>
										<div class="timeline-content text-muted ps-3">Morbi blandit magna quis congue tristique.</div>
									</div>
									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-16">21:03</div>
										<div class="timeline-badge">
											<i class="fa fa-genderless text-danger fs-14"></i>
										</div>
										<div class="timeline-content fw-500 ps-3">New order placed 
										<a href="#" class="text-primary">#41-8457</a>.</div>
									</div>
									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-16">10:30</div>
										<div class="timeline-badge">
											<i class="fa fa-genderless text-success fs-14"></i>
										</div>
										<div class="timeline-content text-muted ps-3">Phasellus condimentum erat sed ligula </div>
									</div>
									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-16">14:37</div>
										<div class="timeline-badge">
											<i class="fa fa-genderless text-danger fs-14"></i>
										</div>
										<div class="timeline-content fw-500 ps-3">Cras lobortis 
										<a href="#" class="text-primary">USD 412</a>. to XYZ</div>
									</div>
									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-16">16:50</div>
										<div class="timeline-badge">
											<i class="fa fa-genderless text-primary fs-14"></i>
										</div>
										<div class="timeline-content text-muted ps-3">In eu massa sed lectus tempus blandit quis id orci.</div>
									</div>
									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-16">21:03</div>
										<div class="timeline-badge">
											<i class="fa fa-genderless text-danger fs-14"></i>
										</div>
										<div class="timeline-content fw-500 ps-3">Sed a lorem 
										<a href="#" class="text-primary">#41-4155</a>.</div>
									</div>
									<div class="timeline-item">
										<div class="timeline-label fw-500 fs-16">16:50</div>
										<div class="timeline-badge">
											<i class="fa fa-genderless text-primary fs-14"></i>
										</div>
										<div class="timeline-content text-muted ps-3">Morbi blandit magna quis congue tristique.</div>
									</div>
								</div>
							</div>							
						</div>
					</div>
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">
								Sales Analytics
							</h3>
						</div>
						<div class="box-body">
							<div style="min-height: 207.7px;">
								<div id="sales-chart"></div>
							</div>							
						</div>
					</div>	
				</div>
				<div class="col-xl-4 col-12">
					<div class="box">
						<div class="box-body">	
							<div class="flex-grow-1 pb-15">	
								<div class="d-flex align-items-center pe-2 mb-30">							
									<span class="text-fade fw-600 fs-16 flex-grow-1">
										7 Hours Ago
									</span>
									<div class="bg-info-light h-50 w-50 l-h-50 rounded text-center">
										  <img src="../../../images/svg-icon/color-svg/001-glass.svg" class="h-30 align-self-center" alt="">
									</div>							
								</div>

								<a href="#" class="text-dark fw-600 hover-primary fs-18">
									Ipsum is simply dummy<br>
									Printing
								</a>
								<p class="fs-16 mt-15">
									There are many variations of.<br>
									Ipsum available<br>
									but the majority.
								</p>
							</div>							
							<div class="d-flex flex-column mt-10">
								<div class="d-flex">
									<a href="#" class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center overflow-hidden">
										<img src="../../../images/avatar/avatar-1.png" class="h-50 align-self-end" alt="">
									</a>
									<a href="#" class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center overflow-hidden">
										<img src="../../../images/avatar/avatar-3.png" class="h-50 align-self-end" alt="">
									</a>
									<a href="#" class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center overflow-hidden">
										<img src="../../../images/avatar/avatar-4.png" class="h-50 align-self-end" alt="">
									</a>
								</div>
							</div>
						</div>					
					</div>
				</div>
				<div class="col-xl-4 col-12">
					<div class="box">
						<div class="box-body">	
							<div class="flex-grow-1 pb-10">	
								<div class="bg-warning w-70 h-70 rounded10 mb-30 text-center l-h-70">							
									<i class="fa fa-user fs-24"></i>							
								</div>

								<a href="#" class="text-dark fw-600 hover-primary fs-18">
									How to manage your Clients<br>in Proper way
								</a>
								<p class="fs-16 mt-15">
									Top priority project of August 2020
								</p>
								<div class="d-flex align-items-center">
									<span class="badge badge-lg badge-pill badge-warning-light me-15">Report</span>
									<div class="fs-16">
										<i class="fa fa-clock text-primary"></i>
										15 min
									</div>
								</div>
							</div>							
							<div class="d-flex flex-column mt-10">
								<div class="d-flex">
									<a href="#" class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center overflow-hidden">
										<img src="../../../images/avatar/avatar-1.png" class="h-50 align-self-end" alt="">
									</a>
									<a href="#" class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center overflow-hidden">
										<img src="../../../images/avatar/avatar-3.png" class="h-50 align-self-end" alt="">
									</a>
									<a href="#" class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center overflow-hidden">
										<img src="../../../images/avatar/avatar-4.png" class="h-50 align-self-end" alt="">
									</a>
								</div>
							</div>
						</div>					
					</div>
				</div>
				<div class="col-xl-4 col-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Daily Orders</h3>
						</div>
						<div class="box-body">
							<div id="charts_widget_1_chart"></div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title align-items-start flex-column">
								Agents Stats
								<small class="subtitle">More than 400+ new members</small>
							</h3>
						</div>
						<div class="box-body py-0">
							<div class="table-responsive">
								<table class="table no-border">
									<thead>
										<tr class="text-start">
											<th class="p-0" style="width: 50px"></th>
											<th class="p-0" style="min-width: 200px"></th>
											<th class="p-0" style="min-width: 150px"></th>
											<th class="p-0" style="min-width: 150px"></th>
											<th class="p-0" style="min-width: 150px"></th>
											<th class="text-end p-0" style="min-width: 150px"></th>
										</tr>
									</thead>
									<tbody>
										<tr>										
											<td>
												<div class="bg-lightest h-50 w-50 l-h-50 rounded text-center">
													  <img src="../../../images/svg-icon/color-svg/007-color-palette.svg" class="h-30" alt="">
												</div>
											</td>
											<td>
												<a href="#" class="text-dark fw-600 hover-primary fs-16">Vivamus consectetur</a>
												<span class="text-fade d-block">Pharetra, Nulla , Nec, Aliquet</span>
											</td>
											<td class="text-end">
												<span class="text-dark fw-600 d-block fs-18">
													45,800k
												</span>
												<span class="text-fade fw-600 d-block fs-16">
													Paid
												</span>
											</td>
											<td class="text-end">
												<span class="text-fade">
													Lacus lacinia mollis
												</span>
											</td>
											<td class="text-end">
												<span class="badge badge-primary-light">Approved</span>
											</td>
											<td class="text-end">
												<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Settings-1 fs-18"><span class="path1"></span><span class="path2"></span></span></a>
												<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle mx-5"><span class="icon-Write"><span class="path1"></span><span class="path2"></span></span></a>
												<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Trash1 fs-18"><span class="path1"></span><span class="path2"></span></span></a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="bg-lightest h-50 w-50 l-h-50 rounded text-center">
													  <img src="../../../images/svg-icon/color-svg/002-google.svg" class="h-30" alt="">
												</div>
											</td>
											<td>
												<a href="#" class="text-dark fw-600 hover-primary fs-16">Vivamus consectetur</a>
												<span class="text-fade d-block">Pharetra, Nulla , Nec, Aliquet</span>
											</td>
											<td class="text-end">
												<span class="text-dark fw-600 d-block fs-18">
													45,800k
												</span>
												<span class="text-fade fw-600 d-block fs-16">
													Paid
												</span>
											</td>
											<td class="text-end">
												<span class="text-fade">
													Lacus lacinia mollis
												</span>
											</td>
											<td class="text-end">
												<span class="badge badge-warning-light">In Progress</span>
											</td>
											<td class="text-end">
												<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Settings-1 fs-18"><span class="path1"></span><span class="path2"></span></span></a>
												<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle mx-5"><span class="icon-Write"><span class="path1"></span><span class="path2"></span></span></a>
												<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Trash1 fs-18"><span class="path1"></span><span class="path2"></span></span></a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="bg-lightest h-50 w-50 l-h-50 rounded text-center">
													  <img src="../../../images/svg-icon/color-svg/003-settings.svg" class="h-30" alt="">
												</div>
											</td>
											<td>
												<a href="#" class="text-dark fw-600 hover-primary fs-16">Vivamus consectetur</a>
												<span class="text-fade d-block">Pharetra, Nulla , Nec, Aliquet</span>
											</td>
											<td class="text-end">
												<span class="text-dark fw-600 d-block fs-18">
													45,800k
												</span>
												<span class="text-fade fw-600 d-block fs-16">
													Paid
												</span>
											</td>
											<td class="text-end">
												<span class="text-fade">
													Lacus lacinia mollis
												</span>
											</td>
											<td class="text-end">
												<span class="badge badge-success-light">Success</span>
											</td>
											<td class="text-end">
												<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Settings-1 fs-18"><span class="path1"></span><span class="path2"></span></span></a>
												<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle mx-5"><span class="icon-Write"><span class="path1"></span><span class="path2"></span></span></a>
												<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Trash1 fs-18"><span class="path1"></span><span class="path2"></span></span></a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="bg-lightest h-50 w-50 l-h-50 rounded text-center">
													  <img src="../../../images/svg-icon/color-svg/005-paint-palette.svg" class="h-30" alt="">
												</div>
											</td>
											<td>
												<a href="#" class="text-dark fw-600 hover-primary fs-16">Vivamus consectetur</a>
												<span class="text-fade d-block">Pharetra, Nulla , Nec, Aliquet</span>
											</td>
											<td class="text-end">
												<span class="text-dark fw-600 d-block fs-18">
													45,800k
												</span>
												<span class="text-fade fw-600 d-block fs-16">
													Paid
												</span>
											</td>
											<td class="text-end">
												<span class="text-fade">
													Lacus lacinia mollis
												</span>
											</td>
											<td class="text-end">
												<span class="badge badge-danger-light">Rejected</span>
											</td>
											<td class="text-end">
												<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Settings-1 fs-18"><span class="path1"></span><span class="path2"></span></span></a>

												<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle mx-5"><span class="icon-Write"><span class="path1"></span><span class="path2"></span></span></a>
												<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Trash1 fs-18"><span class="path1"></span><span class="path2"></span></span></a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="bg-lightest h-50 w-50 l-h-50 rounded text-center">
													  <img src="../../../images/svg-icon/color-svg/006-pottery.svg" class="h-30" alt="">
												</div>
											</td>
											<td>
												<a href="#" class="text-dark fw-600 hover-primary fs-16">Vivamus consectetur</a>
												<span class="text-fade d-block">Pharetra, Nulla , Nec, Aliquet</span>
											</td>
											<td class="text-end">
												<span class="text-dark fw-600 d-block fs-18">
													45,800k
												</span>
												<span class="text-fade fw-600 d-block fs-16">
													Paid
												</span>
											</td>
											<td class="text-end">
												<span class="text-fade">
													Lacus lacinia mollis
												</span>
											</td>
											<td class="text-end">
												<span class="badge badge-warning-light">In Progress</span>
											</td>
											<td class="text-end">
												<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Settings-1 fs-18"><span class="path1"></span><span class="path2"></span></span></a>

												<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle mx-5"><span class="icon-Write"><span class="path1"></span><span class="path2"></span></span></a>
												<a href="#" class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="icon-Trash1 fs-18"><span class="path1"></span><span class="path2"></span></span></a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>  
				</div>
			</div>				
		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
	
  <footer class="main-footer">
    <div class="pull-right d-none d-sm-inline-block">
        <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
		  <li class="nav-item">
			<a class="nav-link" href="https://themeforest.net/item/crmi-bootstrap-admin-dashboard-template/33405709" target="_blank">Purchase Now</a>
		  </li>
		</ul>
    </div>
	  &copy; <script>document.write(new Date().getFullYear())</script> <a href="https://www.multipurposethemes.com/">Multipurpose Themes</a>. All Rights Reserved.
  </footer>
  <!-- Side panel --> 
  <!-- quick_actions_toggle -->
  <div class="modal modal-right fade" id="quick_actions_toggle" tabindex="-1">
	  <div class="modal-dialog">
		<div class="modal-content slim-scroll">
		  <div class="modal-body bg-white p-30">
			<div class="d-flex align-items-center justify-content-between pb-30">
				<h4 class="m-0">Quick Actions<br>
				<small class="badge fs-12 badge-primary mt-10">23 tasks pending</small></h4>
				<a href="#" class="btn btn-icon btn-danger-light btn-sm no-shadow" data-bs-dismiss="modal">
					<span class="fa fa-close"></span>
				</a>
			</div>
            <div class="row">
                <div class="col-6">
                    <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="accounting.html">
                        <i class="icon-Euro fs-36"><span class="path1"></span><span class="path2"></span></i>
                        <span class="fs-16">Accounting</span>
                    </a>
                </div>
                <div class="col-6">
                    <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="contact_userlist_grid.html">
                        <i class="icon-Mail-attachment fs-36"><span class="path1"></span><span class="path2"></span></i>
                        <span class="fs-16">Members</span>
                    </a>
                </div>
                <div class="col-6">
                    <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="projects.html">
                        <i class="icon-Box2 fs-36"><span class="path1"></span><span class="path2"></span></i>
                        <span class="fs-16">Projects</span>
                    </a>
                </div>
                <div class="col-6">
                    <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="contact_userlist.html">
                        <i class="icon-Group fs-36"><span class="path1"></span><span class="path2"></span></i>
                        <span class="fs-16">Customers</span>
                    </a>
                </div>
                <div class="col-6">
                    <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="mailbox.html">
                        <i class="icon-Chart-bar fs-36"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                        <span class="fs-16">Email</span>
                    </a>
                </div>
                <div class="col-6">
                    <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="setting.html">
                        <i class="icon-Color-profile fs-36"><span class="path1"></span><span class="path2"></span></i>
                        <span class="fs-16">Settings</span>
                    </a>
                </div>
                <div class="col-6">
                    <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="ecommerce_orders.html">
                        <i class="icon-Euro fs-36"><span class="path1"></span><span class="path2"></span></i>
                        <span class="fs-18">Orders</span>
                    </a>
                </div>
			</div>
		  </div>
		</div>
	  </div>
  </div>
  <!-- /quick_actions_toggle -->    
    
  <!-- quick_panel_toggle -->
  <div class="modal modal-right fade" id="quick_panel_toggle" tabindex="-1">
	  <div class="modal-dialog">
		<div class="modal-content slim-scroll2">
		  <div class="modal-body bg-white py-20 px-0">
			<div class="d-flex align-items-center justify-content-between pb-30">
				<ul class="nav nav-tabs customtab3 px-30" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-bs-toggle="tab" href="#quick_panel_logs">Audit Logs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#quick_panel_notifications">Notifications</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#quick_panel_settings">Settings</a>
					</li>
				</ul>
                <div class="offcanvas-close">
                    <a href="#" class="btn btn-icon btn-danger-light btn-sm no-shadow" data-bs-dismiss="modal">
						<span class="fa fa-close"></span>
					</a>
                </div>
			</div>
              <div class="px-30">
                <div class="tab-content">
                    <div class="tab-pane active" id="quick_panel_logs" role="tabpanel">
                        <div class="mb-30">
                            <h5 class="fw-500 mb-15">System Messages</h5>
                            <div class="d-flex align-items-center mb-30">
                                <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                      <img src="../../../images/svg-icon/color-svg/001-glass.svg" class="h-30" alt="">
                                </div>
                                <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                    <a href="#" class="text-dark hover-primary mb-1 fs-16">Duis faucibus lorem</a>
                                    <span class="text-fade">Pharetra, Nulla</span>
                                </div>
                                <span class="badge badge-xl badge-light"><span class="fw-600">+125$</span></span>
                            </div>
                            <div class="d-flex align-items-center mb-30">
                                <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                      <img src="../../../images/svg-icon/color-svg/002-google.svg" class="h-30" alt="">
                                </div>
                                <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                    <a href="#" class="text-dark hover-danger mb-1 fs-16">Mauris varius augue</a>
                                    <span class="text-fade">Pharetra, Nulla</span>
                                </div>
                                <span class="badge badge-xl badge-light"><span class="fw-600">+125$</span></span>
                            </div>
                            <div class="d-flex align-items-center mb-30">
                                <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                      <img src="../../../images/svg-icon/color-svg/003-settings.svg" class="h-30" alt="">
                                </div>
                                <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                    <a href="#" class="text-dark hover-success mb-1 fs-16">Aliquam in magna</a>
                                    <span class="text-fade">Pharetra, Nulla</span>
                                </div>
                                <span class="badge badge-xl badge-light"><span class="fw-600">+125$</span></span>
                            </div>
                            <div class="d-flex align-items-center mb-30">
                                <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                      <img src="../../../images/svg-icon/color-svg/004-dad.svg" class="h-30" alt="">
                                </div>
                                <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                    <a href="#" class="text-dark hover-info mb-1 fs-16">Phasellus venenatis nisi</a>
                                    <span class="text-fade">Pharetra, Nulla</span>
                                </div>
                                <span class="badge badge-xl badge-light"><span class="fw-600">+125$</span></span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                      <img src="../../../images/svg-icon/color-svg/005-paint-palette.svg" class="h-30" alt="">
                                </div>
                                <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                    <a href="#" class="text-dark hover-warning mb-1 fs-16">Vivamus consectetur</a>
                                    <span class="text-fade">Pharetra, Nulla</span>
                                </div>
                                <span class="badge badge-xl badge-light"><span class="fw-600">+125$</span></span>
                            </div>
                        </div>
                        <div class="mb-30">
                            <h5 class="fw-500 mb-15">Tasks Overview</h5>
                            <div class="d-flex align-items-center mb-30">
                                <div class="me-15 bg-primary-light h-50 w-50 l-h-60 rounded text-center">
                                      <span class="icon-Library fs-24"><span class="path1"></span><span class="path2"></span></span>
                                </div>
                                <div class="d-flex flex-column fw-500">
                                    <a href="#" class="text-dark hover-primary mb-1 fs-16">Project Briefing</a>
                                    <span class="text-fade">Project Manager</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-30">
                                <div class="me-15 bg-danger-light h-50 w-50 l-h-60 rounded text-center">
                                    <span class="icon-Write fs-24"><span class="path1"></span><span class="path2"></span></span>
                                </div>
                                <div class="d-flex flex-column fw-500">
                                    <a href="#" class="text-dark hover-danger mb-1 fs-16">Concept Design</a>
                                    <span class="text-fade">Art Director</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-30">
                                <div class="me-15 bg-success-light h-50 w-50 l-h-60 rounded text-center">
                                    <span class="icon-Group-chat fs-24"><span class="path1"></span><span class="path2"></span></span>
                                </div>
                                <div class="d-flex flex-column fw-500">
                                    <a href="#" class="text-dark hover-success mb-1 fs-16">Functional Logics</a>
                                    <span class="text-fade">Lead Developer</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-30">
                                <div class="me-15 bg-info-light h-50 w-50 l-h-60 rounded text-center">
                                    <span class="icon-Attachment1 fs-24"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>
                                </div>
                                <div class="d-flex flex-column fw-500">
                                    <a href="#" class="text-dark hover-info mb-1 fs-16">Development</a>
                                    <span class="text-fade">DevOps</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="me-15 bg-warning-light h-50 w-50 l-h-60 rounded text-center">
                                    <span class="icon-Shield-user fs-24"></span>
                                </div>
                                <div class="d-flex flex-column fw-500">
                                    <a href="#" class="text-dark hover-warning mb-1 fs-16">Testing</a>
                                    <span class="text-fade">QA Managers</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="quick_panel_notifications" role="tabpanel">
                        <div>
                            <div class="media-list">
                                <a class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">10:10</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-primary">
                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                    <span class="text-fade">by Johne</span>
                                  </div>
                                </a>

                                <a class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">08:40</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-success">
                                    <p>Proin iaculis eros non odio ornare efficitur.</p>
                                    <span class="text-fade">by Amla</span>
                                  </div>
                                </a>

                                <a class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">07:10</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-info">
                                    <p>In mattis mi ut posuere consectetur.</p>
                                    <span class="text-fade">by Josef</span>
                                  </div>
                                </a>

                                <a class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">01:15</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-danger">
                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                    <span class="text-fade">by Rima</span>
                                  </div>
                                </a>

                                <a class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">23:12</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-warning">
                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                    <span class="text-fade">by Alaxa</span>
                                  </div>
                                </a>
                                <a class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">10:10</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-primary">
                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                    <span class="text-fade">by Johne</span>
                                  </div>
                                </a>

                                <a class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">08:40</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-success">
                                    <p>Proin iaculis eros non odio ornare efficitur.</p>
                                    <span class="text-fade">by Amla</span>
                                  </div>
                                </a>

                                <a class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">07:10</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-info">
                                    <p>In mattis mi ut posuere consectetur.</p>
                                    <span class="text-fade">by Josef</span>
                                  </div>
                                </a>

                                <a class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">01:15</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-danger">
                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                    <span class="text-fade">by Rima</span>
                                  </div>
                                </a>

                                <a class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">23:12</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-warning">
                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                    <span class="text-fade">by Alaxa</span>
                                  </div>
                                </a>
                              </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="quick_panel_settings" role="tabpanel">
                        <div>
                            <form class="form">
							<!--begin::Section-->
							<div>
								<h5 class="fw-500 mb-15">Customer Care</h5>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Enable Notifications:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-primary active" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Enable Case Tracking:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-primary" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Support Portal:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-primary active" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
							</div>
							<!--end::Section-->
							<div class="dropdown-divider"></div>
							<!--begin::Section-->
							<div class="pt-2">
								<h5 class="fw-500 mb-15">Reports</h5>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Generate Reports:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-danger active" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Enable Report Export:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-danger active" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Allow Data Collection:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-danger active" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
							</div>
							<!--end::Section-->
							<div class="dropdown-divider"></div>
							<!--begin::Section-->
							<div class="pt-2">
								<h5 class="fw-500 mb-15">Memebers</h5>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Enable Member singup:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-warning active" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Allow User Feedbacks:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-warning active" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Enable Customer Portal:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-warning active" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
							</div>
							<!--end::Section-->
						</form>
                        </div>
                    </div>
                </div>
              </div>
		  </div>
		</div>
	  </div>
  </div>
  <!-- /quick_panel_toggle -->
  
  <!-- quick_user_toggle -->
  <div class="modal modal-right fade" id="quick_user_toggle" tabindex="-1">
	  <div class="modal-dialog">
		<div class="modal-content slim-scroll3">
		  <div class="modal-body p-30 bg-white">
			<div class="d-flex align-items-center justify-content-between pb-30">
				<h4 class="m-0">User Profile
				<small class="text-fade fs-12 ms-5">12 messages</small></h4>
				<a href="#" class="btn btn-icon btn-danger-light btn-sm no-shadow" data-bs-dismiss="modal">
					<span class="fa fa-close"></span>
				</a>
			</div>
            <div>
                <div class="d-flex flex-row">
                    <div class=""><img src="../../../images/avatar/avatar-2.png" alt="user" class="rounded bg-danger-light w-150" width="100"></div>
                    <div class="ps-20">
                        <h5 class="mb-0">Johen Doe</h5>
                        <p class="my-5 text-fade">Web Designer</p>
                        <a href="mailto:dummy@gmail.com"><span class="icon-Mail-notification me-5 text-success"><span class="path1"></span><span class="path2"></span></span> dummy@gmail.com</a>
                        <button class="btn btn-success-light btn-sm mt-5"><i class="ti-plus"></i> Follow</button>
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
                        <a href="#" class="text-dark hover-primary mb-1 fs-16">My Profile</a>
                        <span class="text-fade">Account settings and more</span>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-30">
                    <div class="me-15 bg-danger-light h-50 w-50 l-h-60 rounded text-center">
                        <span class="icon-Write fs-24"><span class="path1"></span><span class="path2"></span></span>
                    </div>
                    <div class="d-flex flex-column fw-500">
                        <a href="#" class="text-dark hover-danger mb-1 fs-16">My Messages</a>
                        <span class="text-fade">Inbox and tasks</span>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-30">
                    <div class="me-15 bg-success-light h-50 w-50 l-h-60 rounded text-center">
                        <span class="icon-Group-chat fs-24"><span class="path1"></span><span class="path2"></span></span>
                    </div>
                    <div class="d-flex flex-column fw-500">
                        <a href="#" class="text-dark hover-success mb-1 fs-16">My Activities</a>
                        <span class="text-fade">Logs and notifications</span>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-30">
                    <div class="me-15 bg-info-light h-50 w-50 l-h-60 rounded text-center">
                        <span class="icon-Attachment1 fs-24"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>
                    </div>
                    <div class="d-flex flex-column fw-500">
                        <a href="#" class="text-dark hover-info mb-1 fs-16">My Tasks</a>
                        <span class="text-fade">latest tasks and projects</span>
                    </div>
                </div>
              </div>
              <div class="dropdown-divider my-30"></div>
              <div>
                <div class="media-list">
                    <a class="media media-single px-0" href="#">
                      <h4 class="w-50 text-gray fw-500">10:10</h4>
                      <div class="media-body ps-15 bs-5 rounded border-primary">
                        <p>Morbi quis ex eu arcu auctor sagittis.</p>
                        <span class="text-fade">by Johne</span>
                      </div>
                    </a>

                    <a class="media media-single px-0" href="#">
                      <h4 class="w-50 text-gray fw-500">08:40</h4>
                      <div class="media-body ps-15 bs-5 rounded border-success">
                        <p>Proin iaculis eros non odio ornare efficitur.</p>
                        <span class="text-fade">by Amla</span>
                      </div>
                    </a>

                    <a class="media media-single px-0" href="#">
                      <h4 class="w-50 text-gray fw-500">07:10</h4>
                      <div class="media-body ps-15 bs-5 rounded border-info">
                        <p>In mattis mi ut posuere consectetur.</p>
                        <span class="text-fade">by Josef</span>
                      </div>
                    </a>

                    <a class="media media-single px-0" href="#">
                      <h4 class="w-50 text-gray fw-500">01:15</h4>
                      <div class="media-body ps-15 bs-5 rounded border-danger">
                        <p>Morbi quis ex eu arcu auctor sagittis.</p>
                        <span class="text-fade">by Rima</span>
                      </div>
                    </a>

                    <a class="media media-single px-0" href="#">
                      <h4 class="w-50 text-gray fw-500">23:12</h4>
                      <div class="media-body ps-15 bs-5 rounded border-warning">
                        <p>Morbi quis ex eu arcu auctor sagittis.</p>
                        <span class="text-fade">by Alaxa</span>
                      </div>
                    </a>
                    <a class="media media-single px-0" href="#">
                      <h4 class="w-50 text-gray fw-500">10:10</h4>
                      <div class="media-body ps-15 bs-5 rounded border-primary">
                        <p>Morbi quis ex eu arcu auctor sagittis.</p>
                        <span class="text-fade">by Johne</span>
                      </div>
                    </a>

                    <a class="media media-single px-0" href="#">
                      <h4 class="w-50 text-gray fw-500">08:40</h4>
                      <div class="media-body ps-15 bs-5 rounded border-success">
                        <p>Proin iaculis eros non odio ornare efficitur.</p>
                        <span class="text-fade">by Amla</span>
                      </div>
                    </a>

                    <a class="media media-single px-0" href="#">
                      <h4 class="w-50 text-gray fw-500">07:10</h4>
                      <div class="media-body ps-15 bs-5 rounded border-info">
                        <p>In mattis mi ut posuere consectetur.</p>
                        <span class="text-fade">by Josef</span>
                      </div>
                    </a>

                    <a class="media media-single px-0" href="#">
                      <h4 class="w-50 text-gray fw-500">01:15</h4>
                      <div class="media-body ps-15 bs-5 rounded border-danger">
                        <p>Morbi quis ex eu arcu auctor sagittis.</p>
                        <span class="text-fade">by Rima</span>
                      </div>
                    </a>

                    <a class="media media-single px-0" href="#">
                      <h4 class="w-50 text-gray fw-500">23:12</h4>
                      <div class="media-body ps-15 bs-5 rounded border-warning">
                        <p>Morbi quis ex eu arcu auctor sagittis.</p>
                        <span class="text-fade">by Alaxa</span>
                      </div>
                    </a>
                  </div>
            </div>
		  </div>
		</div>
	  </div>
  </div>
  <!-- /quick_user_toggle -->
  
  <!-- quick_shop_toggle -->
  <div class="modal modal-right fade" id="quick_shop_toggle" tabindex="-1">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			  <div class="px-15 d-flex w-p100 align-items-center justify-content-between">
				<h4 class="m-0">Shopping Cart</h4>
				<a href="#" class="btn btn-icon btn-danger-light btn-sm no-shadow" data-bs-dismiss="modal">
					<span class="fa fa-close"></span>
				</a>
			  </div>
		  </div>
		  <div class="modal-body px-30 pb-30 bg-white slim-scroll4">
				<div class="d-flex align-items-center justify-content-between pb-15">
					<div class="d-flex flex-column me-2">
						<a href="#" class="fw-600 fs-18 text-hover-primary">Product Name</a>
						<span class="text-muted">When an unknown printer</span>
						<div class="d-flex align-items-center mt-2">
							<span class="fw-600 me-5 fs-18">$ 125</span>
							<span class="text-muted me-5">for</span>
							<span class="fw-600 me-2 fs-18">4</span>
							<a href="#" class="btn btn-sm btn-success-light btn-icon me-2">
								<i class="fa fa-minus"></i>
							</a>
							<a href="#" class="btn btn-sm btn-success-light btn-icon">
								<i class="fa fa-plus"></i>
							</a>
						</div>
					</div>
					<a href="#" class="flex-shrink-0">
						<img src="../../../images/product/product-1.png" class="avatar h-100 w-100" alt="" />
					</a>
				</div>
			  <div class="dropdown-divider"></div>
				<div class="d-flex align-items-center justify-content-between py-15">
					<div class="d-flex flex-column me-2">
						<a href="#" class="fw-600 fs-18 text-hover-primary">Product Name</a>
						<span class="text-muted">When an unknown printer</span>
						<div class="d-flex align-items-center mt-2">
							<span class="fw-600 me-5 fs-18">$ 125</span>
							<span class="text-muted me-5">for</span>
							<span class="fw-600 me-2 fs-18">4</span>
							<a href="#" class="btn btn-sm btn-success-light btn-icon me-2">
								<i class="fa fa-minus"></i>
							</a>
							<a href="#" class="btn btn-sm btn-success-light btn-icon">
								<i class="fa fa-plus"></i>
							</a>
						</div>
					</div>
					<a href="#" class="flex-shrink-0">
						<img src="../../../images/product/product-2.png" class="avatar h-100 w-100" alt="" />
					</a>
				</div>
			  <div class="dropdown-divider"></div>
				<div class="d-flex align-items-center justify-content-between py-15">
					<div class="d-flex flex-column me-2">
						<a href="#" class="fw-600 fs-18 text-hover-primary">Product Name</a>
						<span class="text-muted">When an unknown printer</span>
						<div class="d-flex align-items-center mt-2">
							<span class="fw-600 me-5 fs-18">$ 125</span>
							<span class="text-muted me-5">for</span>
							<span class="fw-600 me-2 fs-18">4</span>
							<a href="#" class="btn btn-sm btn-success-light btn-icon me-2">
								<i class="fa fa-minus"></i>
							</a>
							<a href="#" class="btn btn-sm btn-success-light btn-icon">
								<i class="fa fa-plus"></i>
							</a>
						</div>
					</div>
					<a href="#" class="flex-shrink-0">
						<img src="../../../images/product/product-3.png" class="avatar h-100 w-100" alt="" />
					</a>
				</div>
			  <div class="dropdown-divider"></div>
				<div class="d-flex align-items-center justify-content-between py-15">
					<div class="d-flex flex-column me-2">
						<a href="#" class="fw-600 fs-18 text-hover-primary">Product Name</a>
						<span class="text-muted">When an unknown printer</span>
						<div class="d-flex align-items-center mt-2">
							<span class="fw-600 me-5 fs-18">$ 125</span>
							<span class="text-muted me-5">for</span>
							<span class="fw-600 me-2 fs-18">4</span>
							<a href="#" class="btn btn-sm btn-success-light btn-icon me-2">
								<i class="fa fa-minus"></i>
							</a>
							<a href="#" class="btn btn-sm btn-success-light btn-icon">
								<i class="fa fa-plus"></i>
							</a>
						</div>
					</div>
					<a href="#" class="flex-shrink-0">
						<img src="../../../images/product/product-4.png" class="avatar h-100 w-100" alt="" />
					</a>
				</div>
			  <div class="dropdown-divider"></div> 
				<div class="d-flex align-items-center justify-content-between py-15">
					<div class="d-flex flex-column me-2">
						<a href="#" class="fw-600 fs-18 text-hover-primary">Product Name</a>
						<span class="text-muted">When an unknown printer</span>
						<div class="d-flex align-items-center mt-2">
							<span class="fw-600 me-5 fs-18">$ 125</span>
							<span class="text-muted me-5">for</span>
							<span class="fw-600 me-2 fs-18">4</span>
							<a href="#" class="btn btn-sm btn-success-light btn-icon me-2">
								<i class="fa fa-minus"></i>
							</a>
							<a href="#" class="btn btn-sm btn-success-light btn-icon">
								<i class="fa fa-plus"></i>
							</a>
						</div>
					</div>
					<a href="#" class="flex-shrink-0">
						<img src="../../../images/product/product-5.png" class="avatar h-100 w-100" alt="" />
					</a>
				</div>
			  <div class="dropdown-divider"></div> 
				<div class="d-flex align-items-center justify-content-between py-15">
					<div class="d-flex flex-column me-2">
						<a href="#" class="fw-600 fs-18 text-hover-primary">Product Name</a>
						<span class="text-muted">When an unknown printer</span>
						<div class="d-flex align-items-center mt-2">
							<span class="fw-600 me-5 fs-18">$ 125</span>
							<span class="text-muted me-5">for</span>
							<span class="fw-600 me-2 fs-18">4</span>
							<a href="#" class="btn btn-sm btn-success-light btn-icon me-2">
								<i class="fa fa-minus"></i>
							</a>
							<a href="#" class="btn btn-sm btn-success-light btn-icon">
								<i class="fa fa-plus"></i>
							</a>
						</div>
					</div>
					<a href="#" class="flex-shrink-0">
						<img src="../../../images/product/product-6.png" class="avatar h-100 w-100" alt="" />
					</a>
				</div>  
		  </div>
		  <div class="modal-footer modal-footer-uniform">
			  <div class="d-flex align-items-center justify-content-between mb-10">
				<span class="fw-600 text-muted fs-16 me-2">Total</span>
				<span class="fw-600 text-end">$1248.00</span>
			  </div>
			  <div class="d-flex align-items-center justify-content-between mb-15">
				<span class="fw-600 text-muted fs-16 me-2">Sub total</span>
				<span class="fw-600 text-primary text-end">$4125.00</span>
			  </div>
			  <div class="text-end">
				<button type="button" class="btn btn-primary">Place Order</button>
			  </div>
		  </div>
		</div>
	  </div>
  </div>
  <!-- /quick_shop_toggle -->
  
</div>
<!-- ./wrapper -->
	
	<!-- ./side demo panel -->
	<div class="sticky-toolbar">	    
	    <a href="https://themeforest.net/item/crmi-bootstrap-admin-dashboard-template/33405709" data-bs-toggle="tooltip" data-bs-placement="left" title="Buy Now" class="waves-effect waves-light btn btn-success btn-flat mb-5 btn-sm" target="_blank">
			<span class="icon-Money"><span class="path1"></span><span class="path2"></span></span>
		</a>
	    <a href="https://themeforest.net/user/multipurposethemes/portfolio" data-bs-toggle="tooltip" data-bs-placement="left" title="Portfolio" class="waves-effect waves-light btn btn-danger btn-flat mb-5 btn-sm" target="_blank">
			<span class="icon-Image"></span>
		</a>
	    <a id="chat-popup" href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Live Chat" class="waves-effect waves-light btn btn-warning btn-flat btn-sm">
			<span class="icon-Group-chat"><span class="path1"></span><span class="path2"></span></span>
		</a>
	</div>
	<!-- Sidebar -->
		
	<div id="chat-box-body">
		<div id="chat-circle" class="waves-effect waves-circle btn btn-circle btn-sm btn-warning l-h-50">
            <div id="chat-overlay"></div>
            <span class="icon-Group-chat fs-18"><span class="path1"></span><span class="path2"></span></span>
		</div>

		<div class="chat-box">
            <div class="chat-box-header p-15 d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button class="waves-effect waves-circle btn btn-circle btn-primary-light h-40 w-40 rounded-circle l-h-45" type="button" data-bs-toggle="dropdown">
                      <span class="icon-Add-user fs-22"><span class="path1"></span><span class="path2"></span></span>
                  </button>
                  <div class="dropdown-menu min-w-200">
                    <a class="dropdown-item fs-16" href="#">
                        <span class="icon-Color me-15"></span>
                        New Group</a>
                    <a class="dropdown-item fs-16" href="#">
                        <span class="icon-Clipboard me-15"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>
                        Contacts</a>
                    <a class="dropdown-item fs-16" href="#">
                        <span class="icon-Group me-15"><span class="path1"></span><span class="path2"></span></span>
                        Groups</a>
                    <a class="dropdown-item fs-16" href="#">
                        <span class="icon-Active-call me-15"><span class="path1"></span><span class="path2"></span></span>
                        Calls</a>
                    <a class="dropdown-item fs-16" href="#">
                        <span class="icon-Settings1 me-15"><span class="path1"></span><span class="path2"></span></span>
                        Settings</a>
                    <div class="dropdown-divider"></div>
					<a class="dropdown-item fs-16" href="#">
                        <span class="icon-Question-circle me-15"><span class="path1"></span><span class="path2"></span></span>
                        Help</a>
					<a class="dropdown-item fs-16" href="#">
                        <span class="icon-Notifications me-15"><span class="path1"></span><span class="path2"></span></span> 
                        Privacy</a>
                  </div>
                </div>
                <div class="text-center flex-grow-1">
                    <div class="text-dark fs-18">Mayra Sibley</div>
                    <div>
                        <span class="badge badge-sm badge-dot badge-primary"></span>
                        <span class="text-muted fs-12">Active</span>
                    </div>
                </div>
                <div class="chat-box-toggle">
                    <button id="chat-box-toggle" class="waves-effect waves-circle btn btn-circle btn-danger-light h-40 w-40 rounded-circle l-h-45" type="button">
                      <span class="icon-Close fs-22"><span class="path1"></span><span class="path2"></span></span>
                    </button>                    
                </div>
            </div>
            <div class="chat-box-body">
                <div class="chat-box-overlay">   
                </div>
                <div class="chat-logs">
                    <div class="chat-msg user">
                        <div class="d-flex align-items-center">
                            <span class="msg-avatar">
                                <img src="../../../images/avatar/2.jpg" class="avatar avatar-lg" alt="">
                            </span>
                            <div class="mx-10">
                                <a href="#" class="text-dark hover-primary fw-bold">Mayra Sibley</a>
                                <p class="text-muted fs-12 mb-0">2 Hours</p>
                            </div>
                        </div>
                        <div class="cm-msg-text">
                            Hi there, I'm Jesse and you?
                        </div>
                    </div>
                    <div class="chat-msg self">
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="mx-10">
                                <a href="#" class="text-dark hover-primary fw-bold">You</a>
                                <p class="text-muted fs-12 mb-0">3 minutes</p>
                            </div>
                            <span class="msg-avatar">
                                <img src="../../../images/avatar/3.jpg" class="avatar avatar-lg" alt="">
                            </span>
                        </div>
                        <div class="cm-msg-text">
                           My name is Anne Clarc.         
                        </div>        
                    </div>
                    <div class="chat-msg user">
                        <div class="d-flex align-items-center">
                            <span class="msg-avatar">
                                <img src="../../../images/avatar/2.jpg" class="avatar avatar-lg" alt="">
                            </span>
                            <div class="mx-10">
                                <a href="#" class="text-dark hover-primary fw-bold">Mayra Sibley</a>
                                <p class="text-muted fs-12 mb-0">40 seconds</p>
                            </div>
                        </div>
                        <div class="cm-msg-text">
                            Nice to meet you Anne.<br>How can i help you?
                        </div>
                    </div>
                </div><!--chat-log -->
            </div>
            <div class="chat-input">      
                <form>
                    <input type="text" id="chat-input" placeholder="Send a message..."/>
                    <button type="submit" class="chat-submit" id="chat-submit">
                        <span class="icon-Send fs-22"></span>
                    </button>
                </form>      
            </div>
		</div>
	</div>
	
	<!-- Page Content overlay -->
	
	
	<!-- Vendor JS -->
	<script src="../src/js/vendors.min.js"></script>
	<script src="../src/js/pages/chat-popup.js"></script>
    <script src="../../../assets/icons/feather-icons/feather.min.js"></script>
	
	<script src="../../../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
	
	<!-- CRMi App -->
	<script src="../src/js/template.js"></script>
	<script src="../src/js/pages/dashboard.js"></script>
	
</body>
</html>
