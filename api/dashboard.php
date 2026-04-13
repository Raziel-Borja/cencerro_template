<!DOCTYPE html>
<html lang="en">
   <?php include dirname(__DIR__) . '/includes/head.php'; ?>
   <body>
      <div class="container-scroller">
         <?php include dirname(__DIR__) . '/includes/navbar.php'; ?>
         <!-- partial -->
         <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
               <div class="content-wrapper wrapper-platform">
                  
                  <div class="row justify-content-md-center">
                     <div class="col-sm-11 flex-column d-flex stretch-card">


                        

                        <div style="margin-top: 50px;" class="row justify-content-md-center">
                           <div class="col-md-6">
                              <div id="calendar"></div>
                           </div>
                        </div>

                     </div>

                  </div>


               </div>
               <!-- content-wrapper ends -->
               <?php include dirname(__DIR__) . '/includes/footer.php'; ?>
            </div>
            <!-- main-panel ends -->
         </div>
         <!-- page-body-wrapper ends -->
      </div>
	  <?php include dirname(__DIR__) . '/includes/scripts.php'; ?>
   </body>



</html>
<script>        
   window.onload = checkSession;
   getSession();
   initMenu();
   //getPolizasCalendar();
   // //Funcion para poner la fecha actual
   // currentDateNavBar();

   // $(document).ready(function(){
   //    $(".progress-bar").ProgressBar();
   // });
   
</script>