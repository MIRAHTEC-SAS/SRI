 <!-- Success Message -->
 <?php
    if (isset($_SESSION['message']) && $_SESSION['successMsg']) { ?>

     <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
         <!-- <i class="ri-checkbox-circle-line label-icon" style="font-size:30px"></i> -->
         <?php
            echo '<strong>' . $_SESSION['message'] . '</strong>';
            unset($_SESSION['message']);
            ?>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

     </div>
 <?php } ?>

 <!-- Error Message -->
 <?php if (isset($_SESSION['message']) && $_SESSION['errorMsg']) { ?>

     <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show mb-xl-0" role="alert">
         <!-- <i class="ri-error-warning-line label-icon" style="font-size:30px"></i> -->
         <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>

     </br>

 <?php } ?>