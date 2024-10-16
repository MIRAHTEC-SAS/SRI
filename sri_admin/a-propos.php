<!DOCTYPE html>
<html lang="zxx">  
  <?php include('layouts/head.php');?>
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

		<!-- Main content Start -->
        <div class="main-content">
            <!--Full width header Start-->
            <div class="full-width-header home8-style4 home9">
                <?php include ('layouts/header.php');?>
                <?php include ('layouts/navigation.php');?>
            </div>
            <!--Full width header End-->
            <!-- Page Content -->
            <?php include ('contents/c-a-propos.php');?>
        </div> 
        <!-- Main content End -->

        <!-- Footer Start -->
       <?php include ('layouts/footer.php'); ?>
        <!-- Footer End -->

        <!-- start scrollUp  -->
        <div id="scrollUp" class="yellow-color">
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
        <!-- Menu js -->
        <script src="assets/js/rsmenu-main.js"></script> 
        <!-- op nav js -->
        <script src="assets/js/jquery.nav.js"></script>
        <!-- owl.carousel js -->
        <script src="assets/js/owl.carousel.min.js"></script>
        <!-- Slick js -->
        <script src="assets/js/slick.min.js"></script>
        <!-- isotope.pkgd.min js -->
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <!-- imagesloaded.pkgd.min js -->
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <!-- wow js -->
        <script src="assets/js/wow.min.js"></script>
        <!-- Skill bar js -->
        <script src="assets/js/skill.bars.jquery.js"></script>
        <script src="assets/js/jquery.counterup.min.js"></script>        
         <!-- counter top js -->
        <script src="assets/js/waypoints.min.js"></script>
        <!-- video js -->
        <script src="assets/js/jquery.mb.YTPlayer.min.js"></script>
        <!-- magnific popup js -->
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <!-- tilt js -->
        <script src="assets/js/tilt.jquery.min.js"></script>           
        <!-- plugins js -->
        <script src="assets/js/plugins.js"></script>
        <!-- contact form js -->
        <script src="assets/js/contact.form.js"></script>
        <!-- main js -->
        <script src="assets/js/main.js"></script>
    </body>
</html>