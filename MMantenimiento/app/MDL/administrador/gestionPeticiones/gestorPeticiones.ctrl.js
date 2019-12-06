myMDLApp.controller("gestorPeticionesCtrl", ['$scope', '$state', 'NgTableParams', '$location', '$http', '$cookies', '$stateParams',
function($scope, $state, NgTableParams, $location, $http, $cookies, $stateParams){
  var ctrl = this;

  ctrl.informe = [];
  month = parseInt(new Date().getMonth()) + 1
  if (month <= 9) {
    month = '0' + month;
  }
  var fechaHoy = new Date().getFullYear() + '-' + month + '-' + new Date().getDate();
  ctrl.peticion = {
    id: '',
    descripcion: 'SE ROMPIÓ LA PANTALLA DE CELULAR SAMSUNG',
    tipoMantenimiento: null,
    categoria: null,
    equipo: null,
    idOrdenTrabajo: null,
    solicitadoX: 'ADMINISTRADOR',
    fecha: new Date(),
    fechaPrevista: new Date(),
    prioridad: 0,
    nota: "AÚN FUNCIONA PERO SE VE FEO",
    progreso: 'INICIO',
    estado: 1
  }

  ctrl.irEditarPeticion = function (peticion) {
    $state.go('editar-peticion', {id: peticion.id});
  }

  ctrl.irInformePeticion = function (peticion) {
    $state.go('informe-peticion', {id: peticion.id})
  }

  ctrl.obtenerCategorias = function () {
    $http.get('./app/MDL/administrador/gestionProductos/obtenerCategorias.php',{params: {}}
    ).then(function (response) {
      // console.log(response.data)
      if (response.data.status != 'Error') {
        try {
          ctrl.categoriasLista = response.data;
        } catch (e) {
          swal("¡Opss!", "Ocurrió un error." + e , "error");
        }
      } else {
        swal("¡Opss!", "No se encuentró ninguna asignación para mostrar.", "error");
      }
    })
  }

  ctrl.obtenerProductos = function () {
    try {
      $http.get('./app/MDL/administrador/gestionPeticiones/obtenerProductos.php',{params: {idCategoria: ctrl.peticion.categoria.id}}
      ).then(function (response) {
        // console.log(response.data)
        if (response.data.status != 'Error') {
            ctrl.productosLista = response.data;
        }
      })
    } catch (e) {
      // swal("¡Opss!", "Ocurrió un error." + e , "error");
    }
  }

  ctrl.obtenerOrdenes = function () {
    try {
      $http.get('./app/MDL/administrador/gestionPeticiones/obtenerOrdenes.php',{params: {}}
      ).then(function (response) {
        if (response.data.status != 'Error') {
            ctrl.ordenesLista = response.data;
        } else {
          swal("¡Opss!", "No se encuentró ninguna asignación para mostrar.", "error");
        }
      })
    } catch (e) {
      swal("¡Opss!", "Ocurrió un error." + e , "error");
    }
  }



  ctrl.obtenerOrdenesSF = function () {
    try {
      $http.get('./app/MDL/administrador/gestionPeticiones/obtenerOrdenesSF.php',{params: {}}
      ).then(function (response) {
        // console.log(response.data)
        if (response.data.status != 'Error') {
          ctrl.ordenesSFLista = response.data;
          // ctrl.ordenesSFTabla = new NgTableParams({ dataset: ctrl.ordenesSFLista });
        }
      })
    } catch (e) {
      swal("¡Opss!", "Ocurrió un error." + e , "error");
    }
  }

  ctrl.cargarPeticiones = function () {
    try {
      $http.get('./app/MDL/administrador/gestionPeticiones/cargarPeticionesInicio.php',{params: {}}
      ).then(function (response) {
        // console.log(response.data)
        if (response.data.status != 'Error') {
          ctrl.peticionesLista = response.data;
          ctrl.peticionesTabla = new NgTableParams({ dataset: ctrl.peticionesLista });
        }
      })
    } catch (e) {
      swal("¡Opss!", "Ocurrió un error." + e , "error");
    }
  }

  ctrl.cargarPeticionesEnProgreso = function () {
    try {
      $http.get('./app/MDL/administrador/gestionPeticiones/cargarPeticionesProgreso.php',{params: {}}
      ).then(function (response) {
        // console.log(response.data)
        if (response.data.status != 'Error') {
          ctrl.peticionesEnProgresoLista = response.data;
          ctrl.peticionesEnProgresoTabla = new NgTableParams({ dataset: ctrl.peticionesEnProgresoLista });
        }
      })
    } catch (e) {
      swal("¡Opss!", "Ocurrió un error." + e , "error");
    }
  }

  ctrl.cargarPeticionesFinalizadas = function () {
    try {
      $http.get('./app/MDL/administrador/gestionPeticiones/cargarPeticionesFinalizadas.php',{params: {}}
      ).then(function (response) {
        // console.log(response.data)
        if (response.data.status != 'Error') {
          ctrl.peticionesFinalizadasLista = response.data;
          ctrl.peticionesFinalizadasTabla = new NgTableParams({ dataset: ctrl.peticionesFinalizadasLista });
        }
      })
    } catch (e) {
      swal("¡Opss!", "Ocurrió un error." + e , "error");
    }
  }

  ctrl.agregarPeticion = function () {
    month = ctrl.peticion.fechaPrevista.getMonth();
    month = parseInt(month) + 1
    if (month <= 9) {
      month = '0' + month;
    }
    var fechaPrevista = ctrl.peticion.fechaPrevista.getFullYear() + '-' + month + '-' + ctrl.peticion.fechaPrevista.getDate();
    var estrella = document.getElementsByName('estrellas');
    for(i=0; i<estrella.length; i++){
      if(estrella[i].checked)
        ctrl.peticion.prioridad = estrella[i].value;
    }
    $http.get("./app/MDL/administrador/gestionPeticiones/insertarPeticion.php",{params: {descripcion: ctrl.peticion.descripcion, tipoMantenimiento: ctrl.peticion.tipoMantenimiento, idProducto: ctrl.peticion.producto.id, solicitadoX: ctrl.peticion.solicitadoX, fechaPrevista: fechaPrevista, prioridad: ctrl.peticion.prioridad, nota: ctrl.peticion.nota}})
    .then(function (response) {
      // console.log(response);
      if (response.data == 'HECHO SIN ERRORES') {
        // console.log(ctrl.alumnoNuevo.correo);
        // ctrl.cancelar();
        swal("¡Bien hecho!", "El producto fue registrado exitosamente" , "success");
      } else {
        swal("¡Opss!", "No se pudo registrar el alumno." , "error");
      }
    });
  }

  ctrl.editarPeticion = function () {
    month = ctrl.peticion.fechaPrevista.getMonth();
    month = parseInt(month) + 1
    if (month <= 9) {
      month = '0' + month;
    }
    var fechaPrevista = ctrl.peticion.fechaPrevista.getFullYear() + '-' + month + '-' + ctrl.peticion.fechaPrevista.getDate();
    var estrella = document.getElementsByName('estrellas');
    for(i=0; i<estrella.length; i++){
      if(estrella[i].checked)
        ctrl.peticion.prioridad = estrella[i].value;
    }
    if (ctrl.peticion.nota.length == 0)
      ctrl.peticion.nota = '-'
    if (ctrl.peticion.orden == null) {
      $http.get("./app/MDL/administrador/gestionPeticiones/editarPeticion.php",{params: {id: ctrl.peticion.id, descripcion: ctrl.peticion.descripcion, fechaPrevista: fechaPrevista, prioridad: ctrl.peticion.prioridad, nota: ctrl.peticion.nota}})
      .then(function (response) {
        // console.log(response);
        if (response.data == 'HECHO SIN ERRORES') {
        $state.go('gestionar-peticiones');
          swal("¡Bien hecho!", "La petición fue editada exitosamente" , "success");
        } else {
          swal("¡Opss!", "No se pudo editar la petición." , "error");
        }
      });
    } else {
      $http.get("./app/MDL/administrador/gestionPeticiones/editarPeticion2.php",{params: {id: ctrl.peticion.id, descripcion: ctrl.peticion.descripcion, idOrden: ctrl.peticion.orden.id, fechaPrevista: fechaPrevista, prioridad: ctrl.peticion.prioridad, nota: ctrl.peticion.nota}})
      .then(function (response) {
        if (response.data == 'HECHO SIN ERRORES') {
        $state.go('gestionar-peticiones');
          swal("¡Bien hecho!", "La petición fue editada exitosamente" , "success");
        } else {
          swal("¡Opss!", "No se pudo editar la petición." , "error");
        }
      });
    }

  }

  ctrl.finalizarPeticion = function () {
    $http.get("./app/MDL/administrador/gestionPeticiones/editarPeticion3.php",{params: {id: ctrl.peticion.id}})
    .then(function (response) {
        // console.log(response);
        if (response.data == 'HECHO SIN ERRORES') {
          $state.go('gestionar-peticiones');
          swal("¡Bien hecho!", "La petición fue finalizada exitosamente" , "success");
        } else {
          swal("¡Opss!", "No se pudo finalizar la petición." , "error");
        }
    });
  }


  ctrl.regresarPeticiones = function () {
    $state.go('gestionar-peticiones');
  }

  ctrl.cargarInfo = function () {
    ctrl.peticion.id = $stateParams.id;
    $http.get('./app/MDL/administrador/gestionPeticiones/buscarPeticion.php',{params: {id: ctrl.peticion.id}}
    ).then(function (response) {
      ctrl.informe.peticion = response.data;
      ctrl.peticion.idEquipo = response.data.idEquipo;
      ctrl.peticion.descripcion = response.data.descripcion;
      fechaStr = response.data.fecha;
      yearM = fechaStr.substr(0,4);
      monthM = fechaStr.substr(5,2);
      dayM = fechaStr.substr(8,2);
      ctrl.peticion.fecha = new Date(yearM, monthM-1, dayM);
      fechaPStr = response.data.fechaPrevista;
      yearPM = fechaPStr.substr(0,4);
      monthPM = fechaPStr.substr(5,2);
      dayPM = fechaPStr.substr(8,2);
      ctrl.peticion.fechaPrevista = new Date(yearPM, monthPM-1, dayPM);
      ctrl.peticion.id = response.data.id
      ctrl.peticion.idEquipo = response.data.idEquipo
      ctrl.peticion.idOrdenTrabajo = response.data.idOrdenTrabajo;
      setTimeout(function(){
        // console.log(response.data.idOrdenTrabajo);
        ctrl.ordenesSFLista.find(function(element) {
          if (element.id == response.data.idOrdenTrabajo) {
            ctrl.peticion.orden = ctrl.ordenesSFLista[ctrl.ordenesSFLista.indexOf(element)]
          }
        });
      }, 500);
      setTimeout(function(){
        ctrl.ordenesLista.find(function(element) {
          if (element.id == response.data.idOrdenTrabajo) {
            ctrl.informe.orden = element;
            // ctrl.peticion.orden = ctrl.ordenesLista[ctrl.ordenesLista.indexOf(element)]
          }
        });
      }, 500);
      ctrl.peticion.nota = response.data.nota
      ctrl.peticion.prioridad = response.data.prioridad
      ctrl.peticion.progreso = response.data.progreso
      ctrl.peticion.solicitadoX = response.data.solicitadoX
      ctrl.peticion.tipoMantenimiento = response.data.tipoMantenimiento
      $http.get('./app/MDL/administrador/gestionProductos/buscarProducto.php',{params: {id: ctrl.peticion.idEquipo}}
      ).then(function (response) {
        ctrl.informe.equipo = response.data;
        ctrl.peticion.producto = response.data;
        $http.get('./app/MDL/administrador/gestionProductos/buscarCategoria.php',{params: {id: ctrl.peticion.producto.idCategoria}}
        ).then(function (response) {
          ctrl.informe.categoria = response.data;
          ctrl.peticion.categoria = response.data;
          ctrl.categoriasLista.find(function(element) {
            if (element.id == response.data.id) {
              ctrl.peticion.categoria = ctrl.categoriasLista[ctrl.categoriasLista.indexOf(element)]
              ctrl.obtenerProductos();
            }
          });
        })
      })
    });
  }

  ctrl.init = function () {
    ctrl.cargarPeticiones();
    ctrl.cargarPeticionesEnProgreso();
    ctrl.cargarPeticionesFinalizadas();
    ctrl.obtenerOrdenes();
    ctrl.obtenerOrdenesSF();
    ctrl.obtenerCategorias();
    if ($stateParams.id)
      ctrl.cargarInfo();
  }

  ctrl.init()

}]);
