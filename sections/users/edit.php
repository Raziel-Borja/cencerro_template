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
                  <h4 class="card-title">Actualizar usuario</h4>
                  <p class="card-description">Por favor completa los campos obligatorios (*)</p>
                  <form id="form-edit-user" class="forms-sample">
                   
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="edit-name-user">* Nombre(s)</label>
                        <input type="text" class="form-control" id="edit-name-user" name="edit-name-user" placeholder="Escribe el nombre">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="edit-lastname-user">Apellidos</label>
                        <input type="text" class="form-control" id="edit-lastname-user" name="edit-lastname-user" placeholder="Escribe los apellidos">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="edit-email-user">* Correo electrónico</label>
                        <input type="email" class="form-control" id="edit-email-user" name="edit-email-user" placeholder="Escribe el correo electrónico">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="edit-pass-user">* Contraseña</label>
                        <input type="password" class="form-control" id="edit-pass-user" name="edit-pass-user" placeholder="Escribe la contraseña">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="edit-confirm-pass-user">* Confirmar contraseña</label>
                        <input type="password" class="form-control" id="edit-confirm-pass-user" name="edit-confirm-pass-user" placeholder="Confirma la contraseña">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="edit-pass-user">* Perfil</label>
                        <select name="edit-perfil" id="edit-perfil" class="form-control form-control-lg">
                          <option>Perfil</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="edit-status-user">* Estatus</label>
                        <select name="edit-status-user" id="edit-status-user" class="form-control form-control-lg">
                          <option value="">Selecciona una opción</option>
                          <option value="0">Activo</option>
                          <option value="1">Inactivo</option>
                        </select>
                      </div>
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
                    <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['id']; ?>">
                    <button onclick="saveUser();" type="button" class="btn btn-primary me-2">Actualizar</button>
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
   //Funcion para obtener la informacion del usuario
   getInfoUser();
</script>