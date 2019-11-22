myMDLApp.controller("gestorOrdenesCtrl", ['$scope', '$state', 'NgTableParams', '$location', '$http', '$cookies', '$stateParams',
function($scope, $state, NgTableParams, $location, $http, $cookies, $stateParams){

  var ctrl = this;
  ctrl.informe = [];
  ctrl.orden = {
      id: '',
      serie: '',
      codigo: '',
      asunto: '',
      descripcion: '',
      fecha: new Date(),
      generadaX: 'ADMINISTRADOR',
      presupuesto: "",
      costo: null,
      finalizado: 0,
      estado: 1
    }

  ctrl.irCrearOrden = function () {
    $state.go('agregar-orden');
  }

  ctrl.irEditarOrden = function (orden) {
    $state.go('editar-orden', {id: orden.id});
  }

  ctrl.irInformeOrden = function (orden) {
    $state.go('informe-orden', {id: orden.id});
  }

  ctrl.regresarOrdenes = function () {
    $state.go('gestionar-ordenes');
  }

  ctrl.verificarPresupuesto = function () {
    if (isNaN(ctrl.orden.presupuesto)){
      var tamañoPresupuesto = ctrl.orden.presupuesto.length;
      ctrl.orden.presupuesto = ctrl.orden.presupuesto.substr(0,tamañoPresupuesto-1);
      swal("¡Opss!", "Llene correctamente el campo de presupuesto." , "error");
    }
  }

  ctrl.verificarCosto = function () {
    if (isNaN(ctrl.orden.costo)){
      var tamañoCosto = ctrl.orden.costo.length;
      ctrl.orden.costo = ctrl.orden.costo.substr(0,tamañoCosto-1);
      swal("¡Opss!", "Llene correctamente el campo de costo." , "error");
    }
  }

  ctrl.cargarOrdenes = function () {
    try {
      $http.get('./app/MDL/administrador/gestionOrdenes/cargarOrdenes.php',{params: {}}
      ).then(function (response) {
        // console.log(response.data)
        if (response.data.status != 'Error') {
          ctrl.ordenesLista = response.data;
          ctrl.ordenesTabla = new NgTableParams({ dataset: ctrl.ordenesLista });
        }
      })
    } catch (e) {
      swal("¡Opss!", "Ocurrió un error." + e , "error");
    }
  }

  ctrl.buscarUltimaOrden = function () {
    try {
      $http.get('./app/MDL/administrador/gestionOrdenes/buscarUltimaOrden.php',{params: {}}
      ).then(function (response) {
        if (response.data.status != 'Error') {
          var serie = parseInt(response.data.serie) + 1;
          var tamSerie = serie.toString().length;
          ctrl.orden.serie = '';
          for (var i = 0; i < 5-tamSerie; i++) {
            ctrl.orden.serie += '0';
          }
          ctrl.orden.serie += serie.toString();
          ctrl.orden.codigo = '[OT-' + ctrl.orden.serie + ']'
        } else {
          ctrl.orden.serie = '00001'
          ctrl.orden.codigo = '[OT-00001]'
        }
      })
    } catch (e) {
      swal("¡Opss!", "Ocurrió un error." + e , "error");
    }
  }

  ctrl.agregarOrden = function () {
    $http.get("./app/MDL/administrador/gestionOrdenes/insertarOrden.php",{params: {serie: ctrl.orden.serie, codigo: ctrl.orden.codigo, asunto: ctrl.orden.asunto, generadaX: ctrl.orden.generadaX, presupuesto: ctrl.orden.presupuesto}})
    .then(function (response) {
      // console.log(response);
      if (response.data == 'HECHO SIN ERRORES') {
        $state.go('gestionar-ordenes');
        swal("¡Bien hecho!", "La orden fue registrada exitosamente" , "success");
      } else {
        swal("¡Opss!", "No se pudo registrar la orden." , "error");
      }
    });
  }

  ctrl.eliminarOrden = function (orden) {
    $http.get("./app/MDL/administrador/gestionOrdenes/eliminarOrden.php",{params: {id: orden.id}})
    .then(function (response) {
      // console.log(response);
      if (response.data != "Error") {
        ctrl.ordenesLista.splice(ctrl.ordenesLista.indexOf(orden),1);
        swal("¡Bien hecho!", "La orden de mantenimiento fue eliminado exitosamente" , "success");
      } else {
        // console.log(response.data);
        swal("¡Opss!", "No se pudo eliminar la orden." , "error");
      }
    });
  }

  ctrl.editarOrden = function () {
    if (ctrl.orden.costo.length == 0)
      ctrl.orden.costo = 0.00
    $http.get("./app/MDL/administrador/gestionOrdenes/editarOrden.php",{params: {id: ctrl.orden.id, asunto: ctrl.orden.asunto, presupuesto: ctrl.orden.presupuesto, costo: ctrl.orden.costo}})
    .then(function (response) {
      if (response.data == 'HECHO SIN ERRORES') {
        $state.go('gestionar-ordenes');
        swal("¡Bien hecho!", "La orden fue editada exitosamente" , "success");
      } else {
        swal("¡Opss!", "No se pudo editar la orden." , "error");
      }
    });
  }

  ctrl.cargarPeticiones = function () {
    try {
      $http.get('./app/MDL/administrador/gestionOrdenes/cargarPeticiones.php',{params: {idOrden: ctrl.informe.orden.id}}
      ).then(function (response) {
        if (response.data.status != 'Error') {
          ctrl.peticionesLista = response.data;
          ctrl.peticionesLista.forEach(function(element) {
            try {
              // console.log(element.id);
              $http.get('./app/MDL/administrador/gestionOrdenes/buscarEquipo.php',{params: {idEquipo: element.idEquipo}}
              ).then(function (response) {
                if (response.data.status != 'Error') {
                  ctrl.peticionesLista[ctrl.peticionesLista.indexOf(element)].equipo = response.data.descripcion;
                  // console.log(ctrl.peticionesLista[ctrl.peticionesLista.indexOf(element)]);
                }
              })
            } catch (e) {
              swal("¡Opss!", "Ocurrió un error." + e , "error");
            }
          })
        }
      })
    } catch (e) {
      swal("¡Opss!", "Ocurrió un error." + e , "error");
    }
  }

  ctrl.cargarInfo = function () {
    ctrl.orden.id = $stateParams.id;
    $http.get('./app/MDL/administrador/gestionOrdenes/buscarOrden.php',{params: {id: ctrl.orden.id}}
    ).then(function (response) {
      ctrl.informe.orden = response.data;
      ctrl.cargarPeticiones();
      ctrl.orden.asunto = response.data.asunto
      ctrl.orden.codigo = response.data.codigo
      ctrl.orden.costo = response.data.costo
      ctrl.orden.descripcion = response.data.descripcion
      ctrl.orden.estado = response.data.estado
      ctrl.orden.finalizado = response.data.finalizado
      ctrl.orden.generadaX = response.data.generadaX
      ctrl.orden.presupuesto = response.data.presupuesto
      ctrl.orden.serie = response.data.serie
      fechaStr = response.data.fecha;
      yearM = fechaStr.substr(0,4);
      monthM = fechaStr.substr(5,2);
      dayM = fechaStr.substr(8,2);
      ctrl.orden.fecha = new Date(yearM, monthM-1, dayM);
    });
  }


  ctrl.init = function () {
    ctrl.cargarOrdenes();
    ctrl.buscarUltimaOrden();
    if ($stateParams.id)
      ctrl.cargarInfo();
  }

  ctrl.init();

}]);
