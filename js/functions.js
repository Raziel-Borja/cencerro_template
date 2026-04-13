var urlApi = "/api/";

if (typeof $.fn.select2 !== 'undefined') {
   $(".js-example-basic-single").select2();
}


function initTooltip() {
   var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
   var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
   })
}


(function ($) {
   'use strict';

   $(function () {
      //   $(".dateField").datepicker({dateFormat: 'yy-mm-dd'});
      $(".dateField").datepicker({ dateFormat: 'yy-mm-dd' });
   });

   //$('[data-toggle="tooltip"]').tooltip();
})(jQuery);


function getIndicatorsDash() {
   //Peticion POST para mandar los datos
   fetch(urlApi + 'indicators-dashboard.php', {
      method: 'GET'
   })
      .then(function (response) {
         if (response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }

      })//Si es exitosa la llamada entonces...
      .then(function (texto) {
         var datos;
         try { datos = JSON.parse(texto); } catch(e) {
            console.error('Respuesta no válida del servidor:', texto);
            alert('Error de conexión con el servidor.');
            return;
         }
         console.log(datos);

         if (datos.ordenes.length > 0) {
            for (let i = 0; i < datos.ordenes.length; i++) {

               var tecnico = '';

               // switch (datos.ordenes[i].tecnico_id) {
               //    case '1':
               //       tecnico = 'SEBASTIAN RODRIGUEZ';
               //       break;
               //    case '2':
               //       ecnico = 'Selene Baca';
               //       break;
               //    case '3':
               //       tecnico = 'Lourdes Baca';
               //       break;
               //    case '4':
               //       tecnico = 'RAMIRO MAEDA';
               //       break;
               //    case '5':
               //       tecnico = 'Juan Manuel López';
               //       break;
               //    case '6':
               //       tecnico = 'LUIS LARA';
               //       break;
               //    case '7':
               //       tecnico = 'ISRAEL LARA';
               //       break;
               //    case '8':
               //       tecnico = 'Carmen Castillo';
               //       break;
               //    case '9':
               //       tecnico = 'Jorge Contreras';
               //       break;
               //    case '10':
               //       tecnico = 'Roberto León';
               //       break;
               //    case '11':
               //       tecnico = 'José Lara';
               //       break;
               //    case '12':
               //       tecnico = 'Victor Navarro';
               //       break;
               //    case '13':
               //       tecnico = 'Daniel Guillén';
               //       break;
               //    case '14':
               //       tecnico = 'JOEL MORA';
               //       break;
               //    case '15':
               //       tecnico = 'JUAN CONTRERAS';
               //       break;
               //    case '16':
               //       tecnico = 'ADRIAN CONTRERAS';
               //       break;
               //    case '17':
               //       tecnico = 'CARLOS JR VIDAL';
               //       break;
               //    case '18':
               //       tecnico = 'LUIS PIÑON';
               //       break;
               //    case '19':
               //       tecnico = 'CARLOS VIDAL';
               //       break;
               //    case '20':
               //       tecnico = 'DAMIAN LEON';
               //       break;
               //    case '21':
               //       tecnico = 'JESUS MANUEL GONZALEZ';
               //       break;
               //    case '22':
               //       tecnico = 'JUAN MANUEL LOPEZ';
               //       break;
               //    default:
               // }
               if (datos.ordenes[i].aseguradora == null) {
                  datos.ordenes[i].aseguradora = '';
               }

               document.getElementById('table-ordenes-dash').innerHTML += '<tr>' +
                  '<td>' + datos.ordenes[i].id + '</td>' +
                  '<td>' + datos.ordenes[i].fecha_ingreso + '</td>' +
                  '<td>' + datos.ordenes[i].fecha_promesa + '</td>' +
                  '<td>' + datos.ordenes[i].marca + ' ' + datos.ordenes[i].modelo + ', ' + datos.ordenes[i].anio + '<br>P: ' + datos.ordenes[i].placa + '<br>S: ' + datos.ordenes[i].serie + '<br>Color: ' + datos.ordenes[i].color + '</td>' +
                  '<td>' + datos.ordenes[i].aseguradora + '</td>' +
                  '<td>' + datos.ordenes[i].servicio + '</td>' +
                  '<td><a onclick="openPageBlank(\'sections/ordenes/tracking.php?id=' + datos.ordenes[i].id + '\');" type="button" class="btn btn-success btn-sm btn-icon-text mr-1">Detalle</a></td>' +
                  '</tr>';
            }
         }

         if (datos.clients.length > 0) {
            document.getElementById('add-nombre-cita').innerHTML += '<option value="">Selecciona una opción</option>';
            document.getElementById('edit-nombre-cita').innerHTML += '<option value="">Selecciona una opción</option>';
            for (let j = 0; j < datos.clients.length; j++) {
               document.getElementById('add-nombre-cita').innerHTML += '<option value="' + datos.clients[j].id + '">' + datos.clients[j].name + '</option>';
               document.getElementById('edit-nombre-cita').innerHTML += '<option value="' + datos.clients[j].id + '">' + datos.clients[j].name + '</option>';
            }
         }

         initCalendar(datos.citas);

         $("#edit-marca-vehicle-order").select2();
         $("#add-nombre-cita").select2({ dropdownParent: $("#modal-cita") });

         $('#edit-nombre-cita').select2();
         $("#edit-nombre-cita").select2({ dropdownParent: $("#modal-cita-edit") });

      })
      .catch(function (err) {
         console.log(err);
      });
}

//Función para loguearse
function login() {
   var formElement = document.getElementById("form-login-alseg");
   formData = new FormData(formElement);

   fetch(urlApi + 'login.php', {
      method: 'POST',
      body: formData
   })
      .then(function (response) {
         if (response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }

      })
      .then(function (texto) {
         var datos;
         try { datos = JSON.parse(texto); } catch(e) {
            console.error('Respuesta no válida del servidor:', texto);
            alert('Error de conexión con el servidor.');
            return;
         }
         console.log(datos);
         if (datos.error == false) {
            localStorage.setItem("sessionAirCDMX", JSON.stringify(datos.data[0]));

            window.location = 'sections/users/list.php';

         } else {
            alert(datos.message);
         }
      })
      .catch(function (err) {
         console.log(err);
      });
}

//Función para cerrar sesión
function closeSession() {
   if (confirm("¿Estás seguro de cerrar sesión?") == true) {
      localStorage.removeItem('sessionAirCDMX');
      window.location = "/index.php";
   }
}

//Función para validar sesión
function checkSession() {
   var session = JSON.parse(localStorage.getItem('sessionAirCDMX'));
   console.log(session);

   if (session === null) {
      window.location = '/index.php';
   }
}

function checkSession2() {
   var session = JSON.parse(localStorage.getItem('sessionAirCDMX'));
   if (session !== null) {
      window.location = '/dashboard.php';
   }
}

//Función para obtener sesión
function getSession() {
   var session = JSON.parse(localStorage.getItem('sessionAirCDMX'));
   console.log(session);
   console.log(2);

   //Asignamos el nombre en la etiqueta del dashboard
   document.getElementById("lbl-name-session").innerHTML = session.name + ' (' + session.privilege_name + ')';
}

function openPage(url) {
   window.location.href = url;
}

function openPageBlank(url) {
   window.open(url, '_blank');
}

//Funcion para recuperar contraseña
function recovery_password() {
   //Traemos los datos de los campos de las contraseñas
   var formElement = document.getElementById("form-recovery");
   formData = new FormData(formElement);

   //Si todo sale bien hacemos la peticion del POST
   fetch(urlApi + 'recovery-password.php', {
      method: 'POST',
      body: formData
   })
      .then(function (response) {
         if (response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }

      })//Si es exitosa la llamada entonces...
      .then(function (texto) {
         var datos;
         try { datos = JSON.parse(texto); } catch(e) {
            console.error('Respuesta no válida del servidor:', texto);
            alert('Error de conexión con el servidor.');
            return;
         }
         console.log(datos);
         if (datos.error == false) {
            alert(datos.message);
            window.location = 'index.php';

         } else {
            alert(datos.message);
         }
      })
      .catch(function (err) {
         console.log(err);
      });
   //Fin de peticion POST para mandar los datos
}

//----FUNCIONES PARA LA SECCION DE USUARIOS----//

const createUser = () => {
   var formElement = document.getElementById("form-create-user");
   formData = new FormData(formElement);

   switch (true) {
      case formData.get('name-user') == '':
         alert('Por favor, agrega el/los nombres');
         break;
      case formData.get('email-user') == '':
         alert('Por favor, agrega el correo electrónico');
         break;
      case formData.get('pass-user') == '':
         alert('Por favor, agrega la contraseña');
         break;
      case formData.get('confirm-pass-user') == '':
         alert('Por favor, confirma la contraseña');
         break;
      case formData.get('pass-user') !== formData.get('confirm-pass-user'):
         alert('Por favor, verifica que las contraseñas sean iguales');
         break;
      case formData.get('perfil') == '':
         alert('Por favor, elige el perfil');
         break;
      default:

         //Peticion POST para mandar los datos
         fetch(urlApi + 'add-user.php', {
            method: 'POST',
            body: formData
         })
            .then(function (response) {
               if (response.ok) {
                  return response.text()
               } else {
                  throw "Error en la llamada Ajax";
               }

            })//Si es exitosa la llamada entonces...
            .then(function (texto) {
               var datos;
               try { datos = JSON.parse(texto); } catch(e) {
                  console.error('Respuesta no válida del servidor:', texto);
                  alert('Error de conexión con el servidor.');
                  return;
               }
               console.log(datos);
               if (datos.error == false) {
                  alert('Usuario creado con exito.');
                  window.location = 'list.php';

               } else {
                  alert('Lo sentimos algo salio mal, intenta de nuevo.');
               }
            })
            .catch(function (err) {
               console.log(err);
            });
      //Fin de peticion POST para mandar los datos

   }//Fin de Switch
}

function getListUsers() {
   //Obtenemos el parametro de la pagina
   //Obtenemos el id de la URL del parametro GET
   const queryString = window.location.search;
   const urlParams = new URLSearchParams(queryString);
   const pageno = urlParams.get('pageno');

   const user_name_filt = urlParams.get('user_name_filt');
   const user_lastname_filt = urlParams.get('user_lastname_filt');
   const user_email_filt = urlParams.get('user_email_filt');
   const user_privileges_filt = urlParams.get('user_privileges_filt');
   const user_disabled_filt = urlParams.get('user_disabled_filt');
   var filtersUrl = '';

   console.log(1);
   console.log(user_name_filt);

   const data = new FormData();
   data.append('pageno', pageno);

   //Validamos que campos filtraremos

   if (user_name_filt !== '' && user_name_filt !== null) {
      data.append('user_name_filt', user_name_filt);
      filtersUrl += '&user_name_filt=' + user_name_filt + '';
   }

   if (user_lastname_filt !== '' && user_lastname_filt !== null) {
      data.append('user_lastname_filt', user_lastname_filt);
      filtersUrl += '&user_lastname_filt=' + user_lastname_filt + '';
   }

   if (user_email_filt !== '' && user_email_filt !== null) {
      data.append('user_email_filt', user_email_filt);
      filtersUrl += '&user_email_filt=' + user_email_filt + '';
   }

   if (user_privileges_filt !== '' && user_privileges_filt !== null) {
      data.append('user_privileges_filt', user_privileges_filt);
      filtersUrl += '&user_privileges_filt=' + user_privileges_filt + '';
   }

   if (user_disabled_filt !== '' && user_disabled_filt !== null) {
      data.append('user_disabled_filt', user_disabled_filt);
      filtersUrl += '&user_disabled_filt=' + user_disabled_filt + '';
   }

   fetch(urlApi + 'list-users.php', {
      method: 'POST',
      body: data
   })
      .then(function (response) {
         if (response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }

      })
      .then(function (texto) {
         var datos;
         try { datos = JSON.parse(texto); } catch(e) {
            console.error('Respuesta no válida del servidor:', texto);
            alert('Error de conexión con el servidor.');
            return;
         }
         console.log(datos);

         //Variables para paginacion antes y despues
         var pagebefore = parseInt(datos.page_number) - 1;
         var pagenext = parseInt(datos.page_number) + 1;

         //Limpiamos el contenedor
         document.getElementById("table-list-users").innerHTML = '';

         //Ciclamos los registros
         for (let i = 0; i < datos.data.length; i++) {

            if (datos.data[i].status == '0') {
               elStatus = 'Activo';
            } else {
               elStatus = 'Inactivo';
            }

            document.getElementById("table-list-users").innerHTML +=
               '<tr>' +
               '<td>' + datos.data[i].name + '</td>' +
               '<td>' + datos.data[i].lastname + '</td>' +
               '<td>' + datos.data[i].email + '</td>' +
               '<td>' + datos.data[i].privilege + '</td>' +
               '<td>' + elStatus + '</td>' +
               '<td>' +
               '<div class="d-flex align-items-center space-btns-admin">' +
               '<button onclick="openPage(\'edit.php?id=' + datos.data[i].id + '\');" type="button" class="btn btn-success btn-sm btn-icon-text mr-1">Editar<i class="typcn typcn-edit btn-icon-append"></i></button>' +
               '<button onclick="deleteUser(' + datos.data[i].id + ')" type="button" class="btn btn-danger btn-sm btn-icon-text">Borrar<i class="typcn typcn-delete-outline btn-icon-append"></i></button>' +
               '</div>' +
               '</td>' +
               '</tr>';
         }

         ///PAGINACION///
         var activePage = '';
         document.getElementById("paginate-list-users").innerHTML = '';

         //Trabajamos en la paginacion

         //Pestana de uno antes
         if (parseInt(datos.page_number) > 1) {
            document.getElementById("paginate-list-users").innerHTML +=
               '<li class="page-item">' +
               '<a class="page-link" href="?pageno=' + pagebefore + '' + filtersUrl + '" aria-label="Previous">' +
               '<span aria-hidden="true">&laquo;</span>' +
               '</a>' +
               '</li>';
         }

         var page = parseInt(datos.page_number);

         if (datos.flag_first == true) {
            document.getElementById("paginate-list-users").innerHTML += '<li class="page-item ' + activePage + '"><a class="page-link" href="?pageno=1' + filtersUrl + '">1</a></li>';
            document.getElementById("paginate-list-users").innerHTML += '<li class="page-item ' + activePage + '"><a class="page-link">...</a></li>';
         }

         for (let j = datos.first_page; j < datos.last_page + 1; j++) {

            if (j >= 1 && j <= datos.total_pagination) {
               var z = j;
               var page = parseInt(datos.page_number);

               if (page === z) {
                  activePage = 'active';
               } else {
                  activePage = '';
               }

               document.getElementById("paginate-list-users").innerHTML += '<li class="page-item ' + activePage + '"><a class="page-link" href="?pageno=' + z + '' + filtersUrl + '">' + z + '</a></li>';
            }
         }

         if (datos.flag_last == true) {
            document.getElementById("paginate-list-users").innerHTML += '<li class="page-item ' + activePage + '"><a class="page-link">...</a></li>';
            document.getElementById("paginate-list-users").innerHTML += '<li class="page-item ' + activePage + '"><a class="page-link" href="?pageno=' + datos.total_pagination + '' + filtersUrl + '">' + datos.total_pagination + '</a></li>';
         }

         //Pestana de uno despues
         if (parseInt(datos.page_number) < datos.total_pagination) {
            document.getElementById("paginate-list-users").innerHTML +=
               '<li class="page-item">' +
               '<a class="page-link" href="?pageno=' + pagenext + '' + filtersUrl + '" aria-label="Next">' +
               '<span aria-hidden="true">&raquo;</span>' +
               '</a>' +
               '</li>';

         }

         ///PAGINACION///

      })
      .catch(function (err) {
         console.log(err);
      });
}


function filterUsers(e) {
   const queryString = window.location.search;
   const urlParams = new URLSearchParams(queryString);
   const pageno = urlParams.get('pageno');
   var filtersUrl = '';

   //Si presionamos enter
   if (e.which == 13) {

      const data = new FormData();

      if (document.getElementById("user_name_filt").value !== '') {
         data.append('user_name_filt', document.getElementById("user_name_filt").value);
         filtersUrl += '&user_name_filt=' + document.getElementById("user_name_filt").value + '';
      }

      if (document.getElementById("user_lastname_filt").value !== '') {
         data.append('user_lastname_filt', document.getElementById("user_lastname_filt").value);
         filtersUrl += '&user_lastname_filt=' + document.getElementById("user_lastname_filt").value + '';
      }

      if (document.getElementById("user_email_filt").value !== '') {
         data.append('user_email_filt', document.getElementById("user_email_filt").value);
         filtersUrl += '&user_email_filt=' + document.getElementById("user_email_filt").value + '';
      }

      if (document.getElementById("user_privileges_filt").value !== '') {
         data.append('user_privileges_filt', document.getElementById("user_privileges_filt").value);
         filtersUrl += '&user_privileges_filt=' + document.getElementById("user_privileges_filt").value + '';
      }

      if (document.getElementById("user_disabled_filt").value !== '') {
         data.append('user_disabled_filt', document.getElementById("user_disabled_filt").value);
         filtersUrl += '&user_disabled_filt=' + document.getElementById("user_disabled_filt").value + '';
      }

      //Si todo sale bien hacemos la peticion del POST
      fetch(urlApi + 'list-users.php', {
         method: 'POST',
         body: data
      })
         .then(function (response) {
            if (response.ok) {
               return response.text()
            } else {
               throw "Error en la llamada Ajax";
            }

         })//Si es exitosa la llamada entonces...
         .then(function (texto) {
            var datos;
            try { datos = JSON.parse(texto); } catch(e) {
               console.error('Respuesta no válida del servidor:', texto);
               alert('Error de conexión con el servidor.');
               return;
            }
            console.log(datos);
            //Variables para paginacion antes y despues
            var pagebefore = parseInt(datos.page_number) - 1;
            var pagenext = parseInt(datos.page_number) + 1;

            document.getElementById("table-list-users").innerHTML = '';

            if (datos.error == false) {
               document.getElementById('table-list-users').innerHTML = "";

               for (let i = 0; i < datos.data.length; i++) {

                  if (datos.data[i].status == '0') {
                     elStatus = 'Activo';
                  } else {
                     elStatus = 'Inactivo';
                  }

                  document.getElementById("table-list-users").innerHTML +=
                     '<tr>' +
                     '<td>' + datos.data[i].name + '</td>' +
                     '<td>' + datos.data[i].lastname + '</td>' +
                     '<td>' + datos.data[i].email + '</td>' +
                     '<td>' + datos.data[i].privilege + '</td>' +
                     '<td>' + elStatus + '</td>' +
                     '<td>' +
                     '<div class="d-flex align-items-center space-btns-admin">' +
                     '<button onclick="openPage(\'edit.php?id=' + datos.data[i].id + '\');" type="button" class="btn btn-success btn-sm btn-icon-text mr-1">Editar<i class="typcn typcn-edit btn-icon-append"></i>' +
                     '</button>' +
                     '<button onclick="deleteUser(' + datos.data[i].id + ')" type="button" class="btn btn-danger btn-sm btn-icon-text">Borrar<i class="typcn typcn-delete-outline btn-icon-append"></i>' +
                     '</button>' +
                     '</div>' +
                     '</td>' +
                     '</tr>';
               }

               ///PAGINACION///
               var activePage = '';
               document.getElementById("paginate-list-users").innerHTML = '';

               //Trabajamos en la paginacion
               //Pestana de uno antes
               if (parseInt(datos.page_number) > 1) {
                  document.getElementById("paginate-list-users").innerHTML +=
                     '<li class="page-item">' +
                     '<a class="page-link" href="?pageno=' + pagebefore + '' + filtersUrl + '" aria-label="Previous">' +
                     '<span aria-hidden="true">&laquo;</span>' +
                     '</a>' +
                     '</li>';
               }

               var page = parseInt(datos.page_number);

               if (datos.flag_first == true) {
                  document.getElementById("paginate-list-users").innerHTML += '<li class="page-item ' + activePage + '"><a class="page-link" href="?pageno=1' + filtersUrl + '">1</a></li>';
                  document.getElementById("paginate-list-users").innerHTML += '<li class="page-item ' + activePage + '"><a class="page-link">...</a></li>';
               }

               for (let j = datos.first_page; j < datos.last_page + 1; j++) {

                  if (j >= 1 && j <= datos.total_pagination) {
                     var z = j;
                     var page = parseInt(datos.page_number);

                     if (page === z) {
                        activePage = 'active';
                     } else {
                        activePage = '';
                     }

                     document.getElementById("paginate-list-users").innerHTML += '<li class="page-item ' + activePage + '"><a class="page-link" href="?pageno=' + z + '' + filtersUrl + '">' + z + '</a></li>';
                  }
               }

               if (datos.flag_last == true) {
                  document.getElementById("paginate-list-users").innerHTML += '<li class="page-item ' + activePage + '"><a class="page-link">...</a></li>';
                  document.getElementById("paginate-list-users").innerHTML += '<li class="page-item ' + activePage + '"><a class="page-link" href="?pageno=' + datos.total_pagination + '' + filtersUrl + '">' + datos.total_pagination + '</a></li>';
               }

               //Pestana de uno despues
               if (parseInt(datos.page_number) < datos.total_pagination) {
                  document.getElementById("paginate-list-users").innerHTML +=
                     '<li class="page-item">' +
                     '<a class="page-link" href="?pageno=' + pagenext + '' + filtersUrl + '" aria-label="Next">' +
                     '<span aria-hidden="true">&raquo;</span>' +
                     '</a>' +
                     '</li>';

               }

               ///PAGINACION///

            }
         })
         .catch(function (err) {
            console.log(err);
         });
      //Fin de peticion POST para mandar los datos
   }
}

const getInfoUser = () => {
   document.getElementById("edit-perfil").innerHTML += '';

   //Obtenemos el id de la URL del parametro GET
   const queryString = window.location.search;
   const urlParams = new URLSearchParams(queryString);
   const id = urlParams.get('id');

   const data = new FormData();
   data.append('id', id);

   fetch(urlApi + 'get-info-user.php', {
      method: 'POST',
      body: data
   })
      .then(function (response) {
         if (response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }

      })//Si es exitosa la llamada entonces...
      .then(function (texto) {
         var datos;
         try { datos = JSON.parse(texto); } catch(e) {
            console.error('Respuesta no válida del servidor:', texto);
            alert('Error de conexión con el servidor.');
            return;
         }
         console.log(datos);
         if (datos.error == false) {

            document.getElementById("edit-name-user").value = datos.data[0].name;
            document.getElementById("edit-lastname-user").value = datos.data[0].lastname;
            document.getElementById("edit-email-user").value = datos.data[0].email;
            document.getElementById("edit-status-user").value = datos.data[0].status;

            for (let i = 0; i < datos.privileges.length; i++) {
               if (datos.data[0].privileges == datos.privileges[i].id) {

                  document.getElementById("edit-perfil").innerHTML +=
                     "<option selected value=" + datos.privileges[i].id + ">" + datos.privileges[i].name + "</option>";

               } else {

                  document.getElementById("edit-perfil").innerHTML +=
                     "<option value=" + datos.privileges[i].id + ">" + datos.privileges[i].name + "</option>";

               }

            }

         } else {
            alert('Lo sentimos algo salio mal, intenta de nuevo.');
         }
      })
      .catch(function (err) {
         console.log(err);
      });
}

function saveUser() {
   var formElement = document.getElementById("form-edit-user");
   formData = new FormData(formElement);

   switch (true) {
      case formData.get('edit-name-user') == '':
         alert('Por favor, agrega el/los nombres');
         break;
      case formData.get('edit-email-user') == '':
         alert('Por favor, agrega el correo electrónico');
         break;
      case formData.get('edit-perfil') == '':
         alert('Por favor, elige el perfil');
         break;
      default:

         //Si todo sale bien hacemos la peticion del POST
         fetch(urlApi + 'update-user.php', {
            method: 'POST',
            body: formData
         })
            .then(function (response) {
               if (response.ok) {
                  return response.text()
               } else {
                  throw "Error en la llamada Ajax";
               }

            })//Si es exitosa la llamada entonces...
            .then(function (texto) {
               var datos;
               try { datos = JSON.parse(texto); } catch(e) {
                  console.error('Respuesta no válida del servidor:', texto);
                  alert('Error de conexión con el servidor.');
                  return;
               }
               console.log(datos);
               if (datos.error == false) {
                  //Actualizamos la sesion
                  //localStorage.removeItem('session');
                  //localStorage.setItem("session", JSON.stringify(datos.data[0]));

                  alert('Usuario actualizado con exito.');
                  window.location = 'list.php';

               } else {
                  alert('Lo sentimos algo salio mal, intenta de nuevo.');
               }
            })
            .catch(function (err) {
               console.log(err);
            });
      //Fin de peticion POST para mandar los datos

   }//Fin del swicth de validaciones de nombre, correo y perfil
}

//Funcion para eliminar usuario
function deleteUser(id) {

   const data = new FormData();
   data.append('id', id);

   //Preguntamos si desea eliminar el registro, si confirma, hacemos peticion POST para eliminarlo
   if (confirm("¿Estás seguro de eliminar este usuario?") == true) {
      //Peticion POST para mandar los datos
      fetch(urlApi + 'delete-user.php', {
         method: 'POST',
         body: data
      })
         .then(function (response) {
            if (response.ok) {
               return response.text()
            } else {
               throw "Error en la llamada Ajax";
            }

         })//Si es exitosa la llamada entonces...
         .then(function (texto) {
            var datos;
            try { datos = JSON.parse(texto); } catch(e) {
               console.error('Respuesta no válida del servidor:', texto);
               alert('Error de conexión con el servidor.');
               return;
            }
            console.log(datos);
            if (datos.error == false) {
               alert('Usuario eliminado con exito.');
               window.location = 'list.php';

            } else {
               alert('Lo sentimos algo salio mal, intenta de nuevo.');
            }
         })
         .catch(function (err) {
            console.log(err);
         });
   }
}

const getPrivileges = () => {

   document.getElementById("perfil").innerHTML += '';

   fetch(urlApi + 'list-privileges.php', {
      method: 'GET'
   })
      .then(function (response) {
         if (response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }

      })
      .then(function (texto) {
         var datos;
         try { datos = JSON.parse(texto); } catch(e) {
            console.error('Respuesta no válida del servidor:', texto);
            alert('Error de conexión con el servidor.');
            return;
         }
         console.log(datos);

         for (let i = 0; i < datos.data.length; i++) {
            document.getElementById("perfil").innerHTML +=
               "<option value=" + datos.data[i].id + ">" + datos.data[i].name + "</option>";
         }
      })
      .catch(function (err) {
         console.log(err);
      });
}

//----FUNCIONES PARA LA SECCION DE USUARIOS----//





