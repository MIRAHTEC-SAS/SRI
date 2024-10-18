<?php 
include('config/app.php');
// ...
if (isset($_GET['code']))
{
    $code_formation=$_GET['code'];

    $getFormations = mysqli_query($con,"SELECT 
    formations.nom_formation,
    formations.niveau,
    formations.link_img,
    formations.code_formation,
    formations_details.objectifs,
    formations_details.poursuite_etudes,
    formations_details.debouches,
    formations_details.modules,
    formations_details.conditions
    FROM `formations` INNER JOIN formations_details ON formations_details.code_formation=formations.code_formation WHERE formations.code_formation='$code_formation'");

    while ($row = mysqli_fetch_array($getFormations)) 
    {
        $code_formation=$row['code_formation'];
        $niveau=$row['niveau'];
        $formation=$row['nom_formation'];
        $link_img=$row['link_img'];
        $objectifs=$row['objectifs'];
        $debouches=$row['debouches'];
        $poursuite_etudes=$row['poursuite_etudes'];
        $modules=$row['modules'];
        $conditions=$row['conditions'];
    }

    // brochure
    $getBrochure = mysqli_query($con,"SELECT * FROM plaquettes WHERE code_formation='$code_formation'");

    while ($row = mysqli_fetch_array($getBrochure)) 
    {
        $lien_brochure=$row['link_doc'];
    }


}
?>


<!DOCTYPE html>
<html lang="zxx">
    <head> 
        <!-- meta tag -->
        <meta charset="utf-8">
        <title>EMIA - Université des Sciences et Technologie</title>

        <meta name="description" content="">
        <!-- responsive tag -->
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon -->
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
        <!-- Bootstrap v5.0.2 css -->
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <!-- font-awesome css -->
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
        <!-- animate css -->
        <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
        <!-- off canvas css -->
        <link rel="stylesheet" type="text/css" href="assets/css/off-canvas.css">
        <!-- linea-font css -->
        <link rel="stylesheet" type="text/css" href="assets/fonts/linea-fonts.css">
        <!-- flaticon css  -->
        <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon.css">
        <!-- magnific popup css -->
        <link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.css">
        <!-- Main Menu css -->
        <link rel="stylesheet" href="assets/css/rsmenu-main.css">
        <!-- spacing css -->
        <link rel="stylesheet" type="text/css" href="assets/css/rs-spacing.css">
        <!-- style css -->
        <link rel="stylesheet" type="text/css" href="style.css"> <!-- This stylesheet dynamically changed from style.less -->
        <!-- responsive css -->
        <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="defult-home">
        
        <!--Preloader area start here-->
        <div id="loader" class="loader orange-color">
            <div class="loader-container">
                <div class='loader-icon'>
                    <img src="assets/images/pre-logo1.png" alt="">
                </div>
            </div>
        </div>
        <!--Preloader area End here-->

        <!--Full width header Start-->
        <div class="full-width-header header-style1 home8-style4">
            <!--Header Start-->
            <header id="rs-header" class="rs-header">
                <!-- Topbar Area Start -->
                <div class="topbar-area home8-topbar">
                        <div class="container">
                            <div class="row y-middle">
                                <div class="col-md-7">
                                    <ul class="topbar-contact">
                                        <li>
                                            <i class="flaticon-email"></i>
                                            <a href="mailto:support@rstheme.com">contact@emia.sn</a>
                                        </li>
                                        <li>
                                            <i class="flaticon-location"></i>
                                            Sicap foire Numéro 10753 Dakar, Dakar, Senegal
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-5 text-end">
                                    <ul class="topbar-right">
                                        <li class="login-register">
                                            <i class="fa fa-sign-in"></i>
                                            <a href="#">Etudiants</a>
                                        </li>
                                        <li class="btn-part">
                                            <a class="apply-btn" href="filieres">Brochures</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Topbar Area End -->

                <!-- Menu Start -->
                <div class="menu-area menu-sticky">
                    <div class="container">
                        <div class="row y-middle">
                            <div class="col-lg-2">
                                <div class="logo-cat-wrap">
                                    <div class="logo-part">
                                        <a href="../emia">
                                            <img class="normal-logo" src="assets/images/logo2.png" alt="">
                                            <!-- <img class="sticky-logo" src="assets/images/logo2.png" alt=""> -->
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10 text-end">
                                <div class="rs-menu-area">
                                    <div class="main-menu">
                                        <div class="mobile-menu">
                                            <a class="rs-menu-toggle">
                                                <i class="fa fa-bars"></i>
                                            </a>
                                        </div>
                                        <nav class="rs-menu">
                                            <ul class="nav-menu">
                                                <!-- EMIA -->
                                                <li class="menu-item">
                                                    <a href="/emia">EMIA</a>
                                                    <!-- <ul class="sub-menu">
                                                        <li><a href="#">Mot de l’Administrateur</a> </li>
                                                        <li><a href="#">Mission, vision et valeurs </a> </li>
                                                        <li><a href="#">Le conseil scientifique </a> </li>
                                                        <li><a href="#">L'équipe</a> </li>
                                                    </ul> -->
                                                </li>
                                                <li class="menu-item"><a href="a-propos">A propos</a></li> 
                                                <li class="menu-item"><a href="filieres">Nos filières</a></li> 
                                                <!-- Programmes -->
                                                <!-- Licences -->
                                                <!-- <li class="menu-item-has-children">
                                                    <a href="#">Licences</a>
                                                    <ul class="sub-menu">
                                                        <li class="menu-item-has-children right">
                                                            <a href="#">Pôle Polytechnique</a>
                                                            <ul class="sub-menu right">
                                                                <li><a href="#">Génie Civil</a> </li>
                                                                <li><a href="#">Génie Pétrochimique </a> </li>
                                                                <li><a href="#">Statistiques et Informatique décisionnelle</a> </li>
                                                            </ul>
                                                        </li>
                                                        <li class="menu-item-has-children right">
                                                            <a href="#">Agronomie et environnement</a>
                                                            <ul class="sub-menu right">
                                                                <li><a href="#">Sciences Agronomiques</a> </li>
                                                            </ul>
                                                        </li>
                                                        <li class="menu-item-has-children right">
                                                            <a href="#">Gouvernance publique et Management</a>
                                                            <ul class="sub-menu right">
                                                                <li><a href="#">Management Appliqué</a> </li>
                                                                <li><a href="#">Gouvernance Publique et Développement </a> </li>
                                                                <li><a href="#">Diplomacy, Languages and Communication </a> </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li> -->
                                                <!-- Master -->
                                                <!-- <li class="menu-item-has-children">
                                                    <a href="#">Nos masters</a>
                                                    <ul class="sub-menu">
                                                        <li class="menu-item-has-children right">
                                                            <a href="#">Santé publique</a>
                                                            <ul class="sub-menu right">
                                                                <li><a href="#">Specialisation nutrition</a></li>
                                                                <li><a href="#">Spécialisation épidémiologie</a></li>
                                                            </ul>
                                                        </li>
                                                        <li>
                                                            <a href="#">Droit Mining, Oil & Gas</a>
                                                        </li>
                                                    
                                                    </ul>
                                                </li> -->
                                                <!-- <li class="menu-item"><a href="equipe">Èquipe</a></li> 
                                                <li class="menu-item"><a href="executive">Executive education</a></li>  -->
                                                <!-- <li class="menu-item"><a href="#">Bourses EMIA Conneqt</a></li> -->
                                                <li class="menu-item"><a href="contact">Contact</a></li>
                                            </ul> <!-- //.nav-menu -->
                                        </nav>                                        
                                    </div> <!-- //.main-menu -->
                            </div>
                        </div>
                        <!-- <div class="col-lg-2 text-end">
                            <div class="expand-btn-inner">
                                <ul>
                                    
                                    <li>
                                        <a class="hidden-xs rs-search" data-bs-toggle="modal" data-bs-target="#searchModal" href="#">
                                            <i class="flaticon-search"></i>
                                        </a>
                                    </li>
                                    <li class="user-icon cart-inner no-border mini-cart-active">
                                        <a href="#"><i class="fa fa-shopping-bag"></i></a>
                                        <div class="woocommerce-mini-cart text-start">
                                            <div class="cart-bottom-part">
                                                <ul class="cart-icon-product-list">
                                                    <li class="display-flex">
                                                        <div class="icon-cart">
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                        </div>
                                                        <div class="product-info">
                                                            <a href="cart.html">Law Book</a><br>
                                                            <span class="quantity">1 × $30.00</span>
                                                        </div>
                                                        <div class="product-image">
                                                            <a href="cart.html"><img src="assets/images/shop/1.jpg" alt="Product Image"></a>
                                                        </div>
                                                    </li>
                                                    <li class="display-flex">
                                                        <div class="icon-cart">
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                        </div>
                                                        <div class="product-info">
                                                            <a href="cart.html">Spirit Level</a><br>
                                                            <span class="quantity">1 × $30.00</span>
                                                        </div>
                                                        <div class="product-image">
                                                            <a href="cart.html"><img src="assets/images/shop/2.jpg" alt="Product Image"></a>
                                                        </div>
                                                    </li>
                                                </ul>

                                                <div class="total-price text-center">
                                                    <span class="subtotal">Subtotal:</span>
                                                    <span class="current-price">$85.00</span>
                                                </div>

                                                <div class="cart-btn text-center">
                                                    <a class="crt-btn btn1" href="cart.html">View Cart</a>
                                                    <a class="crt-btn btn2" href="checkout.html">Check Out</a>
                                                </div>
                                            </div>
                                        </div> 
                                    </li>
                                    
                                    </ul>
                                    <a id="nav-expander" class="nav-expander style6">
                                        <span class="dot1"></span>
                                        <span class="dot2"></span>
                                        <span class="dot3"></span>
                                    </a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- Menu End -->

                <!-- Canvas Menu start -->
                <nav class="right_menu_togle hidden-md">
                    <div class="close-btn">
                        <div id="nav-close">
                            <div class="line">
                                <span class="line1"></span><span class="line2"></span>
                            </div>
                        </div>
                    </div>
                    <div class="canvas-logo">
                        <a href="index.html"><img src="assets/images/dark-logo.png" alt="logo"></a>
                    </div>
                    <div class="offcanvas-text">
                        <p>We denounce with righteous indige nationality and dislike men who are so beguiled and demo  by the charms of pleasure of the moment data com so blinded by desire.</p>
                    </div>
                    <div class="offcanvas-gallery">
                        <div class="gallery-img">
                            <a class="image-popup" href="assets/images/gallery/1.jpg"><img src="assets/images/gallery/1.jpg" alt=""></a>
                        </div>
                        <div class="gallery-img">
                            <a class="image-popup" href="assets/images/gallery/2.jpg"><img src="assets/images/gallery/2.jpg" alt=""></a>
                        </div>
                        <div class="gallery-img">
                            <a class="image-popup" href="assets/images/gallery/3.jpg"><img src="assets/images/gallery/3.jpg" alt=""></a>
                        </div>
                        <div class="gallery-img">
                            <a class="image-popup" href="assets/images/gallery/4.jpg"><img src="assets/images/gallery/4.jpg" alt=""></a>
                        </div>
                        <div class="gallery-img">
                            <a class="image-popup" href="assets/images/gallery/5.jpg"><img src="assets/images/gallery/5.jpg" alt=""></a>
                        </div>
                        <div class="gallery-img">
                            <a class="image-popup" href="assets/images/gallery/6.jpg"><img src="assets/images/gallery/6.jpg" alt=""></a>
                        </div>
                    </div>
                    <div class="map-img">
                        <img src="assets/images/map.jpg" alt="">
                    </div>
                    <div class="canvas-contact">
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </nav>
                <!-- Canvas Menu end -->
            </header>
            <!--Header End-->
        </div>
        <!--Full width header End-->

		<!-- Main content Start -->
        <div class="main-content">
            <!-- Breadcrumbs Start -->
            <div class="rs-breadcrumbs breadcrumbs-overlay">
                <div class="breadcrumbs-img">
                    <img src="assets/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
                </div>
                <div class="breadcrumbs-text white-color">
                    <h1 class="page-title"><?php echo $formation; ?></h1>
                    <ul>
                        <li>
                            <a class="active" href="../emia/">Accueil</a>
                        </li>
                        <li>Formation</li>
                    </ul>
                </div>
            </div>
            <!-- Breadcrumbs End -->            

            <!-- Intro Courses -->
            <section class="intro-section gray-bg pt-94 pb-100 md-pt-64 md-pb-70">
                <div class="container">
                    <div class="row clearfix">
                        <!-- Content Column -->
                        <div class="col-lg-8 md-mb-50">
                            <!-- Intro Info Tabs-->
                            <div class="intro-info-tabs">
                                <ul class="nav nav-tabs intro-tabs tabs-box" id="myTab" role="tablist">
                                    <li class="nav-item tab-btns" role="presentation">
                                        <a class="nav-link tab-btn active" id="prod-overview-tab" data-bs-toggle="tab" href="#" data-bs-target="#prod-overview" role="tab" aria-controls="prod-overview" aria-selected="true">Objectifs</a>
                                    </li>
                                    <li class="nav-item tab-btns" role="presentation">
                                        <a class="nav-link tab-btn" id="prod-curriculum-tab" data-bs-toggle="tab" href="#" data-bs-target="#prod-curriculum" role="tab" aria-controls="prod-curriculum" aria-selected="false">Poursuites</a>
                                    </li>
                                    <li class="nav-item tab-btns" role="presentation">
                                        <a class="nav-link tab-btn" id="prod-instructor-tab" data-bs-toggle="tab" href="#" data-bs-target="#prod-instructor" role="tab" aria-controls="prod-instructor" aria-selected="false">Débouchés</a>
                                    </li>
                                    <li class="nav-item tab-btns" role="presentation">
                                        <a class="nav-link tab-btn" id="prod-faq-tab" data-bs-toggle="tab" href="#" data-bs-target="#prod-faq" role="tab" aria-controls="prod-faq" aria-selected="false">Modules</a>
                                    </li>
                                    <li class="nav-item tab-btns" role="presentation">
                                        <a class="nav-link tab-btn" id="prod-reviews-tab" data-bs-toggle="tab" href="#" data-bs-target="#prod-reviews" role="tab" aria-controls="prod-reviews" aria-selected="false">Conditions</a>
                                    </li>
                                </ul>
                                <div class="tab-content tabs-content" id="myTabContent">
                                    <!-- Objectifs... -->
                                    <div class="tab-pane tab fade show active" id="prod-overview" role="tabpanel" aria-labelledby="prod-overview-tab">
                                        <div class="content white-bg pt-30">
                                            <!-- Cource Overview -->
                                            <div class="course-overview">
                                                <div class="inner-box">
                                                    <h4>Les objectifs</h4>
                                                    <p><?php echo $objectifs; ?></p>
                                                    <h3>A l’issue de la formation, l’étudiant sera capable de :</h3>
                                                    <?php if ($code_formation==231) { ?>
                                                    <ul class="review-list">
                                                        <li>Acquérir des compétences solides dans les différents domaines de la gestion (comptabilité, marketing, finance, gestion des ressources humaines, marketing, stratégie, …)</li>
                                                        <li>Développer des compétences transversales (outils quantitatifs, outils d’aide à la décision, langues…)</li>
                                                        <li>Approfondir son projet professionnel et de renforcer des aptitudes personnelles et relationnelles (gestion de projet, travail collaboratif…)</li>
                                                        <li>Savoir résoudre avec une vision systémique des problèmes de gestion</li>
                                                        <li>Savoir organiser, utiliser de façon efficiente les ressources</li>
                                                        <li>Mettre en place et appliquer des protocoles de procédures</li>
                                                        <li>Analyser la situation financière de l’entreprise</li>
                                                    </ul>    
                                                    <?php } ?> 
                                                    <?php if ($code_formation==232) { ?>
                                                    <ul class="review-list">
                                                        <li>Concevoir des Systèmes d'Information Statistiques Utiliser des modèles stochastiques et Statistiques</li>
                                                        <li>Participer à la mise en place et à l’exploitation de système d’informations décisionnelles</li>
                                                        <li>Elaborer des bases de données informatiques Concevoir des outils de collectes et de traitements de données.</li>
                                                        <li>Contribuer au choix des méthodes statistique et de data mining et les mettre en œuvre</li>
                                                        <li>Réaliser des tableaux de bord et reporting</li>
                                                    </ul>    
                                                    <?php } ?>  
                                                    <?php if ($code_formation==233) { ?>
                                                    <ul class="review-list">
                                                        <li>Maîtriser les comportements élémentaires des éléments d’une construction (sols, matériaux, structures, enveloppes, fluides...)</li>
                                                        <li>Être capable d’analyser une construction, un système constructif et d’organiser sa représentation plane ou spatiale</li>
                                                        <li>Savoir modéliser un objet à construire par outils informatiques (Conception Assistée par Ordinateur type Autocad, Modélisation et analyse de comportements par Robot)</li>
                                                        <li>Maîtriser les volets généraux de la gestion d’un chantier : les aspects techniques (méthodes, planification, matériaux, aléas), les aspects économiques (déroulement, gestion de base, sous-traitance) et les aspects humains (besoins, ressources humaines) ; les aspects réglementaires liés à la construction</li>
                                                        <li>Être imprégné des questions de sécurité, de prévention et de maîtrise des risques</li>
                                                        <li>Savoir s’intégrer et se comporter dans une entreprise</li>
                                                        <li>Avoir le sens des responsabilités, de la communication pour interagir avec les différents acteurs et les ressources humaines très diversifiées que le monde de la construction met en rapport</li>
                                                        <li>Développer des aptitudes réelles au leadership.</li>
                                                        <li>Conduire des travaux</li>
                                                        <li>Planifier et assurer la gestion de chantier</li>
                                                        <li>Gérer la technologie de la construction</li>
                                                        <li>Conduire des opérations</li>
                                                        <li>Développer parallèlement l’aspect pratique et les outils numériques permettant au diplômé de concevoir des solutions rapides et moins coûteuses et ceci par augmenter le nombre des ateliers.</li>
                                                        <li>Améliorer les habiletés en communication pour défendre une idée et argumenter et ceci se fait par les soutenances de mini-projet, stage, PFE…</li>
                                                    </ul>    
                                                    <?php } ?>   
                                                    <?php if ($code_formation==234) { ?>
                                                    <ul class="review-list">  
                                                        <li>Être en mesure de maîtriser les aspects d’anatomie, de structure, de physiologie, de reproduction et des interactions existant entre les différents membres d’une communauté végétale et animale</li>
                                                        <li>Comprendre et analyser le fonctionnement des agro systèmes<li>
                                                        <li>Mobiliser un savoir-faire technique au service des filières agricoles (végétales/animales)<li>
                                                        <li>Maitriser les outils de diagnostic d’évaluation et de conception d’agro système innovants<li>
                                                        <li>Connaitre les enjeux des filières de productions (acteurs, cadres règlementaires, enjeux politiques et socio-économiques)<li>
                                                    </ul>    
                                                    <?php } ?>                                                                                                   
                                                </div>
                                            </div>                                                
                                        </div>
                                    </div>
                                    <!-- poursuite -->
                                    <div class="tab-pane fade" id="prod-curriculum" role="tabpanel" aria-labelledby="prod-curriculum-tab">
                                        <div class="content">

                                            <div id="accordion" class="accordion-box">
                                                
                                                <div class="card accordion block">
                                                    <div class="container">
                                                    </br>
                                                    <h3 class="instructor-title">Poursuites d'etudes</h3>

                                                        <?php echo $poursuite_etudes;?>
                                                    </br>
                                                    </div>
                                                </div>
                                                <!-- <div class="card accordion block">
                                                    <div class="card-header" id="headingTwo">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link acc-btn collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Color Theory</button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                                                        <div class="card-body acc-content">
                                                            <div class="content">
                                                                <div class="clearfix">
                                                                    <div class="pull-left">
                                                                        <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="popup-videos play-icon"><span class="fa fa-play"></span>What is UI/ UX Design?</a>
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <div class="minutes">35 Minutes</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <div class="clearfix">
                                                                    <div class="pull-left">
                                                                        <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="popup-videos play-icon"><span class="fa fa-play"><i class="ripple"></i></span>What is UI/ UX Design?</a>
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <div class="minutes">35 Minutes</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <div class="clearfix">
                                                                    <div class="pull-left">
                                                                        <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="popup-videos play-icon"><span class="fa fa-play"></span>What is UI/ UX Design?</a>
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <div class="minutes">35 Minutes</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card accordion block">
                                                    <div class="card-header" id="headingThree">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link acc-btn collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Basic Typography</button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordion">
                                                        <div class="card-body acc-content">
                                                            <div class="content">
                                                                <div class="clearfix">
                                                                    <div class="pull-left">
                                                                        <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="popup-videos play-icon"><span class="fa fa-play"></span>What is UI/ UX Design?</a>
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <div class="minutes">35 Minutes</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <div class="clearfix">
                                                                    <div class="pull-left">
                                                                        <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="popup-videos play-icon"><span class="fa fa-play"><i class="ripple"></i></span>What is UI/ UX Design?</a>
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <div class="minutes">35 Minutes</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <div class="clearfix">
                                                                    <div class="pull-left">
                                                                        <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="popup-videos play-icon"><span class="fa fa-play"></span>What is UI/ UX Design?</a>
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <div class="minutes">35 Minutes</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>                                             
                                        </div>
                                    </div>
                                    <!-- debouches -->
                                    <div class="tab-pane fade" id="prod-instructor" role="tabpanel" aria-labelledby="prod-instructor-tab">
                                        <div class="content pt-30 pb-30 pl-30 pr-30 white-bg">
                                            <h3 class="instructor-title">Débouchés</h3>
                                            <div class="row rs-team style1 orange-color transparent-bg clearfix">
                                               <div class="container">
                                                    <p style="align:justify"><?php echo $debouches; ?></p>
                                               </div>                                                        
                                            </div>  
                                        </div>
                                    </div>
                                    <!-- modules -->
                                    <div class="tab-pane fade" id="prod-faq" role="tabpanel" aria-labelledby="prod-faq-tab">
                                        <div class="content">
                                            <!-- <div id="accordion3" class="accordion-box">
                                                <div class="card accordion block">
                                                    <div class="card-header" id="headingSeven">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link acc-btn" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">UI/ UX Introduction</button>
                                                        </h5>
                                                    </div>

                                                    <div id="collapseSeven" class="collapse show" aria-labelledby="headingSeven" data-bs-parent="#accordion3">
                                                        <div class="card-body acc-content current">
                                                            <div class="content">
                                                                <div class="clearfix">
                                                                    <div class="pull-left">
                                                                        <a class="popup-videos play-icon" href="https://www.youtube.com/watch?v=atMUy_bPoQI"><i class="fa fa-play"></i>What is UI/ UX Design?</a>
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <div class="minutes">35 Minutes</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <div class="clearfix">
                                                                    <div class="pull-left">
                                                                        <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="popup-videos play-icon"><span class="fa fa-play"><i class="ripple"></i></span>What is UI/ UX Design?</a>
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <div class="minutes">35 Minutes</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <div class="clearfix">
                                                                    <div class="pull-left">
                                                                        <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="popup-videos play-icon"><span class="fa fa-play"></span>What is UI/ UX Design?</a>
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <div class="minutes">35 Minutes</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card accordion block">
                                                    <div class="card-header" id="headingEight">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link acc-btn collapsed" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">Color Theory</button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-bs-parent="#accordion3">
                                                        <div class="card-body acc-content">
                                                            <div class="content">
                                                                <div class="clearfix">
                                                                    <div class="pull-left">
                                                                        <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="popup-videos play-icon"><span class="fa fa-play"></span>What is UI/ UX Design?</a>
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <div class="minutes">35 Minutes</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <div class="clearfix">
                                                                    <div class="pull-left">
                                                                        <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="popup-videos play-icon"><span class="fa fa-play"><i class="ripple"></i></span>What is UI/ UX Design?</a>
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <div class="minutes">35 Minutes</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <div class="clearfix">
                                                                    <div class="pull-left">
                                                                        <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="popup-videos play-icon"><span class="fa fa-play"></span>What is UI/ UX Design?</a>
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <div class="minutes">35 Minutes</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card accordion block">
                                                    <div class="card-header" id="headingNine">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link acc-btn collapsed" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">Basic Typography</button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-bs-parent="#accordion3">
                                                        <div class="card-body acc-content">
                                                            <div class="content">
                                                                <div class="clearfix">
                                                                    <div class="pull-left">
                                                                        <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="popup-videos play-icon"><span class="fa fa-play"></span>What is UI/ UX Design?</a>
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <div class="minutes">35 Minutes</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <div class="clearfix">
                                                                    <div class="pull-left">
                                                                        <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="popup-videos play-icon"><span class="fa fa-play"><i class="ripple"></i></span>What is UI/ UX Design?</a>
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <div class="minutes">35 Minutes</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <div class="clearfix">
                                                                    <div class="pull-left">
                                                                        <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="popup-videos play-icon"><span class="fa fa-play"></span>What is UI/ UX Design?</a>
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <div class="minutes">35 Minutes</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>   
                                                                                -->
                                            <div class="card block">
                                                <div class="content pt-30 pb-30 pl-30 pr-30 white-bg">
                                                <h3 class="instructor-title">Les modules</h3>
                                                    <div class="container">
                                                        <p style="text-align:justify"><?php echo $modules;?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- conditions -->
                                    <div class="tab-pane fade" id="prod-reviews" role="tabpanel" aria-labelledby="prod-reviews-tab">
                                        <div class="content pt-30 pb-30 white-bg">
                                                <div class="container">
                                                    <h3 class="instructor-title">Les conditions</h3>
                                                    <p style="text-align:justify"><?php echo $conditions;?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
      
                        
                        <!-- Video Column -->
                        <div class="video-column col-lg-4">
                            <div class="inner-column">
                                <!-- <div class="btn-part">
                                    <a href="#" class="btn readon2 orange">Postuler maintenant</a>
                                    <a href="#" class="btn readon2 orange-transparent">Buy Now</a>
                                </div>
                                </br> -->
                                <div class="btn-part">
                                    <div class="row">
                                        <img class="img" src="assets/images/pdf.png">
                                    </div>
                                    </br>
                                    <a href="telecharger_brochure?code=<?php echo $code_formation; ?>" class="btn readon2 orange">Telecharger la brochure</a>
                                    <!-- <a href="#" class="btn readon2 orange-transparent">Buy Now</a> -->
                                </div>
                                </br>
                            <!-- Video Box -->
                                <div class="intro-video media-icon orange-color2">
                                    <img class="video-img" src="assets/images/ma.png" alt="Video Image">
                                    <a class="popup-videos" href="https://www.youtube.com/watch?v=JxBPz66F5yE&t=9s">
                                        <i class="fa fa-play"></i>
                                    </a>
                                    <h4>Voir la presentation</h4>
                                </div>
                                <!-- End Video Box -->
                                <!-- <div class="course-features-info">
                                    <ul>
                                        <li class="lectures-feature">
                                            <i class="fa fa-files-o"></i>
                                            <span class="label">Lectures</span>
                                            <span class="value">3</span>
                                        </li>
                                    </ul>
                                </div> -->
                                
                                
                            </div>
                        </div>                        
                    </div>                
                </div>
            </section>
            <!-- End intro Courses -->

            <!-- Newsletter section start -->
            <div class="rs-newsletter style1 gray-bg orange-color mb--90 sm-mb-0 sm-pb-70">
                <div class="container">
                    <div class="newsletter-wrap">
                        <div class="row y-middle">
                            <div class="col-lg-6 col-md-12 md-mb-30">
                               <div class="content-part">
                                   <div class="sec-title">
                                       <div class="title-icon md-mb-15">
                                           <img src="assets/images/newsletter.png" alt="images">
                                       </div>
                                       <h2 class="title mb-0 white-color">Subscribe to Newsletter</h2>
                                   </div>
                               </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <form class="newsletter-form">
                                    <input type="email" name="email" placeholder="Enter Your Email" required="">
                                    <button type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Newsletter section end -->
        </div> 
        <!-- Main content End --> 

        
        <!-- Footer Start -->
        <?php include ('layouts/footer.php'); ?>

        <!-- Footer End -->

        <!-- start scrollUp  -->
        <div id="scrollUp" class="orange-color">
            <i class="fa fa-angle-up"></i>
        </div>
        <!-- End scrollUp  -->

        <!-- Search Modal Start -->
        <div class="modal fade search-modal" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
            <button type="button" class="close" data-bs-dismiss="modal">
              <span class="flaticon-cross"></span>
            </button>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="search-block clearfix">
                        <form>
                            <div class="form-group">
                                <input class="form-control" placeholder="Search Here..." type="text">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search Modal End -->

        <!-- modernizr js -->
        <script src="assets/js/modernizr-2.8.3.min.js"></script>
        <!-- jquery latest version -->
        <script src="assets/js/jquery.min.js"></script>
        <!-- Bootstrap v5.0.2 js -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- magnific popup js -->
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <!-- Menu js -->
        <script src="assets/js/rsmenu-main.js"></script> 
        <!-- wow js -->
        <script src="assets/js/wow.min.js"></script>     
        <!-- plugins js -->
        <script src="assets/js/plugins.js"></script>
        <!-- contact form js -->
        <script src="assets/js/contact.form.js"></script>
        <!-- main js -->
        <script src="assets/js/main.js"></script>
    </body>
</html>