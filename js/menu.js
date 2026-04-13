var url = "/";

function initMenu() {

    //Obtenemos la sesion
    var session = JSON.parse(localStorage.getItem('sessionAirCDMX'));
    console.log(session.privileges);

    //Menu para superadmin
    if (session.privileges == '1') {
        document.getElementById("menu-content").innerHTML = '<li class="nav-item">' +
            '<a href="/sections/users/list.php" class="nav-link">' +
            '<i class="mdi mdi-account-key menu-icon"></i>' +
            '<span class="menu-title">Usuarios</span>' +
            '<i class="menu-arrow"></i>' +
            '</a>' +
            '</li>' +
            '<li class="nav-item">' +
            '<a href="/sections/users/list.php" class="nav-link">' +
            '<i class="mdi mdi-account-key menu-icon"></i>' +
            '<span class="menu-title">Edificios</span>' +
            '<i class="menu-arrow"></i>' +
            '</a>' +
            '</li>' +
            '<li class="nav-item">' +
            '<a href="/sections/users/list.php" class="nav-link">' +
            '<i class="mdi mdi-account-key menu-icon"></i>' +
            '<span class="menu-title">Departamentos</span>' +
            '<i class="menu-arrow"></i>' +
            '</a>' +
            '</li>' +
            '<li class="nav-item">' +
            '<a href="#" class="nav-link">' +
            '<i class="mdi mdi-codepen menu-icon"></i>' +
            '<span class="menu-title">Catálogos</span>' +
            '<i class="menu-arrow"></i>' +
            '</a>' +
            '<div class="submenu">' +
            '<ul class="submenu-item">' +
            '<li class="nav-item"><a class="nav-link" href="/sections/users/list.php">Usuarios</a></li>' +
            '</ul>' +
            '</div>' +
            '</li>';
    }


    if (session.privileges == '2') {
        //     document.getElementById("sidebar").innerHTML = '<ul class="nav">'+
        //     '<li class="nav-item">'+
        //         '<a class="nav-link" href="https://www.asesoresinc.com/plataforma/sections/mis_comisiones_por_pagar/list.php">'+
        //             '<i class="fas fa-dollar-sign"></i>'+
        //             '<span class="menu-title">Comisiones por<br> pagar</span>'+
        //         '</a>'+
        //     '</li>'+
        //     '<li class="nav-item">'+
        //         '<a class="nav-link" href="https://www.asesoresinc.com/plataforma/sections/mis_estados_cuenta_semanales/list.php">'+
        //             '<i class="fas fa-dollar-sign"></i>'+
        //             '<span class="menu-title">Estados de cuenta</span>'+
        //         '</a>'+
        //     '</li>'+
        // '</ul>';
    }



}