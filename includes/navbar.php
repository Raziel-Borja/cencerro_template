<!-- partial:partials/_horizontal-navbar.html -->
<div class="horizontal-menu">
   <nav class="navbar top-navbar col-lg-12 col-12 p-0">
      <div class="container-fluid">
         <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
               <a class="navbar-brand brand-logo" href="/dashboard.php">
                  <!-- <img style="height: 104px;" src="https://cencerro.net/airCDMX/images/logo.png" alt="logo"/> -->
               </a>
               <a class="navbar-brand brand-logo-mini" href="/dashboard.php">
                  <!-- <img src="lisimages/logo.png" alt="logo"/> -->
               </a>
            </div>
            <ul class="navbar-nav navbar-nav-right">
               <li class="nav-item dropdown  d-lg-flex d-none">
                  <a href="/sections/users/list.php" class="btn btn-inverse-primary btn-sm">Usuarios </a>
               </li>
               <li class="nav-item dropdown  d-lg-flex d-none">
                  <a href="/sections/reports/reports.php" class="btn btn-inverse-primary btn-sm">Reportes</a>
               </li>
               <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                  <span id="lbl-name-session" class="nav-profile-name"></span>
                  <span class="online-status"></span>
                  <img src="/images/faces/face28.png" alt="profile"/>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                     <!-- <a href="javascript:void(0);" class="dropdown-item">
                     <i class="mdi mdi-settings text-primary"></i>Mi cuenta
                     </a> -->
                     <a href="javascript:void(0);" onclick="closeSession();" class="dropdown-item">
                     <i class="mdi mdi-logout text-primary"></i>Cerrar sesión
                     </a>
                  </div>
               </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
            <span class="mdi mdi-menu"></span>
            </button>
         </div>
      </div>
   </nav>
   <nav class="bottom-navbar">
      <div class="container">
         <ul id="menu-content" class="nav page-navigation">
         </ul>
      </div>
   </nav>
</div>