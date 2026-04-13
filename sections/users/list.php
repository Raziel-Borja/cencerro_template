<!DOCTYPE html>
<html lang="en">

<?php include '../../includes/head.php'; ?>

<body>
  <div class="container-scroller">
  <?php include '../../includes/navbar.php'; ?>
        <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Usuarios</h4>
                  <button onclick="openPage('create.php');" type="button" class="btn btn-primary btn-add-admin">Nuevo</button>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                            <th>Nombre(s)</th>
                            <th>Apellidos</th>
                            <th>Correo electrónico</th>
                            <th>Privilegios</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                        <tr>
                            <th><input id="user_name_filt" onkeypress='filterUsers(event);' class='input-filter' value='<?php echo $_GET['user_name_filt'] ?>'></th>
                            <th><input id="user_lastname_filt" onkeypress='filterUsers(event);' class='input-filter' value='<?php echo $_GET['user_lastname_filt'] ?>'></th>
                            <th><input id="user_email_filt" onkeypress='filterUsers(event);' class='input-filter' value='<?php echo $_GET['user_email_filt'] ?>'></th>
                            <th><input id="user_privileges_filt" onkeypress='filterUsers(event);' class='input-filter' value='<?php echo $_GET['user_privileges_filt'] ?>'></th>
                            <th><input id="user_disabled_filt" onkeypress='filterUsers(event);' class='input-filter' value='<?php echo $_GET['user_disabled_filt'] ?>'></th>
                            <th></th>
                        </tr>
                      </thead>
                      <tbody id="table-list-users"></tbody>
                    </table>
                  </div>
                  
                    <nav class="pagination-admin" aria-label="Page navigation example">
                        <ul id="paginate-list-users" class="pagination"></ul>
                    </nav>

                </div>
              </div>
            </div>


            
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include '../../includes/footer.php'; ?>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
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
   getListUsers();
</script>
