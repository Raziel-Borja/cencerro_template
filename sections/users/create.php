<!DOCTYPE html>
<html lang="en">

<?php include '../../includes/head.php'; ?>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_horizontal-navbar.html -->
        
    <?php include '../../includes/navbar.php'; ?>
        
        <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Crear usuario</h4>
                  <p class="card-description">Por favor completa los campos obligatorios (*)</p>
                  <form id="form-create-user" class="forms-sample">
                   
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="name-user">* Nombre(s)</label>
                        <input type="text" class="form-control" id="name-user" name="name-user" placeholder="Escribe el nombre">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="lastname-user">Apellidos</label>
                        <input type="text" class="form-control" id="lastname-user" name="lastname-user" placeholder="Escribe los apellidos">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="email-user">* Correo electrónico</label>
                        <input type="email" class="form-control" id="email-user" name="email-user" placeholder="Escribe el correo electrónico">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="pass-user">* Contraseña</label>
                        <input type="password" class="form-control" id="pass-user" name="pass-user" placeholder="Escribe la contraseña">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="confirm-pass-user">* Confirmar contraseña</label>
                        <input type="password" class="form-control" id="confirm-pass-user" name="confirm-pass-user" placeholder="Confirma la contraseña">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="pass-user">* Perfil</label>
                        <select name="perfil" id="perfil" class="form-control form-control-lg">
                          <option>Perfil</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label>Imagen de perfil</label>
                        <input type="file" name="img[]" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Imagen">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Elegir</button>
                          </span>
                        </div>
                      </div>
                    </div>
                    
                    <button onclick="createUser();" type="button" class="btn btn-primary me-2">Crear</button>
                    <button onclick="history.back()" class="btn btn-light">Regresar</button>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- content-wrapper ends -->
        <?php include '../../includes/footer.php'; ?>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <?php include '../../includes/scripts.php'; ?>
</body>

</html>
<script>        
   window.onload = checkSession;
   getSession();
   initMenu();
   // //Funcion para poner la fecha actual
   // currentDateNavBar();
   // getIndicatorsDash();
   //Funcion para obtener el listado de los privilegios
   getPrivileges();
</script>