<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php'; ?>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <!-- <img src="/lone_star/images/logo.png" alt="logo"> -->
              </div>
              <h4>¡Recupera tu contraseña!</h4>
              <h6 class="font-weight-light">Ingresa tu correo electrónico para recuperar tu contraseña</h6>
              <form id="form-recovery" class="pt-3">
                <div class="form-group">
                  <label for="exampleInputEmail">Correo electrónico</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0" id="email" name="email" placeholder="email">
                  </div>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <a href="index.php" class="auth-link text-black">¿Te acordaste de tu contraseña?</a>
                </div>
                <div class="my-3">
                  <a onclick="recovery_password();" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="javascript:void(0);">RECUPERAR</a>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2023  Todos los derechos reservados.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/template.js"></script>
  <script src="js/functions.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
<script>
      window.onload = checkSession2;
  </script>
