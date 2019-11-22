myMDLApp.controller("gestorProductosCtrl", ['$scope', '$state', 'NgTableParams', '$location', '$http', '$cookies', '$stateParams',
function($scope, $state, NgTableParams, $location, $http, $cookies, $stateParams){
  var ctrl = this;
  ctrl.producto = {
    id: "",
    descripcion: "",
    categoria: null,
    serie: "",
    referencia: "",
    costo: ""
  };

  ctrl.regresarProductos = function () {
    window.location.href = "#!/administrador/productos";
  }

  ctrl.regresarProductosAgregar = function () {
    ctrl.estado = "CREAR";
    window.location.href = "#!/administrador/productos/agregar";
  }

  ctrl.irCrearCategoria = function () {
    window.location.href = "#!/administrador/categoria";
  }

  ctrl.irEditarProducto = function (producto) {
    $state.go('editar-producto', {id: producto.id})
  }

  ctrl.cargarProductos = function () {
    $http.get('./app/MDL/administrador/gestionProductos/cargarProductos.php',{params: {}}
    ).then(function (response) {
      // console.log(response.data)
      if (response.data.status != 'Error') {
        try {
          ctrl.productosLista = response.data;
          ctrl.productosTabla = new NgTableParams({ dataset: ctrl.productosLista });
        } catch (e) {
          swal("¡Opss!", "Ocurrió un error." + e , "error");
        }
      } else {
        swal("¡Opss!", "No se encuentró ningún curso.", "error");
      }
    })
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

  ctrl.obtenerSerie = function () {
    $http.get('./app/MDL/administrador/gestionProductos/obtenerSerie.php',{params: {idCategoria: ctrl.producto.categoria.id}}
    ).then(function (response) {
      if (response.data.status != 'Error') {
        try {
          var serie = parseInt(response.data.serie) + 1;
          var tamSerie = serie.toString().length;
          ctrl.producto.serie = '';
          for (var i = 0; i < 5-tamSerie; i++) {
            ctrl.producto.serie += '0';
          }
          ctrl.producto.serie += serie.toString();
        } catch (e) {
          swal("¡Opss!", "Ocurrió un error: " + e, "error");
        }
      } else {
        ctrl.producto.serie = '00001';
        // swal("¡Opss!", "No se encuentra ningún apoderado con ese DNI.", "error");
      }
    })
  }

  ctrl.agregarProducto = function () {
    $http.get("./app/MDL/administrador/gestionProductos/insertarProducto.php",{params: {descripcion: ctrl.producto.descripcion, idCategoria: ctrl.producto.categoria.id, serie: ctrl.producto.serie, referencia: ctrl.producto.referencia, costo: ctrl.producto.costo}})
    .then(function (response) {
      // console.log(response);
      if (response.data == 'HECHO SIN ERRORES') {
        // console.log(ctrl.alumnoNuevo.correo);
        // ctrl.cancelar();
        $state.go('gestion-productos');
        swal("¡Bien hecho!", "El producto fue registrado exitosamente" , "success");
      } else {
        swal("¡Opss!", "No se pudo registrar el alumno." , "error");
      }
    });
  }

  ctrl.editarProducto = function () {
    $http.get("./app/MDL/administrador/gestionProductos/editarProducto.php",{params: {descripcion: ctrl.producto.descripcion, id: ctrl.producto.id, referencia: ctrl.producto.referencia, costo: ctrl.producto.costo}})
    .then(function (response) {
      // console.log(response);
      if (response.data == 'HECHO SIN ERRORES') {
        ctrl.cancelar();
        $state.go('gestion-productos');
        swal("¡Bien hecho!", "El producto fue editado exitosamente" , "success");
      } else {
        swal("¡Opss!", "No se pudo editar el alumno." , "error");
      }
    });
  }

  ctrl.agregarCategoria = function () {
    $http.get("./app/MDL/administrador/gestionProductos/insertarCategoria.php",{params: {descripcion: ctrl.categoria.descripcion, iniciales: ctrl.categoria.iniciales}})
    .then(function (response) {
      if (response.data == 'HECHO SIN ERRORES') {
        // console.log(ctrl.alumnoNuevo.correo);
        ctrl.categoria.descripcion = '';
        ctrl.categoria.iniciales = "";
        window.location.href = "#!/administrador/productos/agregar";
        swal("¡Bien hecho!", "La categoría fue registrado exitosamente" , "success");
      } else {
        swal("¡Opss!", "No se pudo registrar la categoría." , "error");
      }
    });
  }

  ctrl.eliminarProducto = function (producto) {
    $http.get("./app/MDL/administrador/gestionProductos/eliminarProducto.php",{params: {id: producto.id}})
    .then(function (response) {
      // console.log(response);
      if (response.data != "Error") {
        ctrl.productosLista.splice(ctrl.productosLista.indexOf(producto),1);
        swal("¡Bien hecho!", "El producto fue eliminado exitosamente" , "success");
      } else {
        // console.log(response.data);
        swal("¡Opss!", "No se pudo eliminar el alumno." , "error");
      }
    });
  }

  ctrl.cancelar = function () {
    ctrl.producto.id = '';
    ctrl.producto.descripcion = '';
    ctrl.producto.categoria = null;
    ctrl.producto.serie = '';
    ctrl.producto.referencia = '';
    ctrl.producto.costo = '';
  }

  ctrl.cargarInfo = function () {
    ctrl.producto.id = $stateParams.id;
    $http.get('./app/MDL/administrador/gestionProductos/buscarProducto.php',{params: {id: ctrl.producto.id}}
    ).then(function (response) {
      ctrl.producto = response.data;
      $http.get('./app/MDL/administrador/gestionProductos/buscarCategoria.php',{params: {id: ctrl.producto.idCategoria}}
      ).then(function (response) {
        ctrl.producto.categoria = response.data;
        ctrl.categoriasLista.find(function(element) {
        if (element.id == response.data.id) {
          ctrl.producto.categoria = ctrl.categoriasLista[ctrl.categoriasLista.indexOf(element)]
        }
        });
        // console.log(ctrl.producto.categoria)
      })
    })
  }

  ctrl.init = function () {
    ctrl.cargarProductos();
    ctrl.obtenerCategorias();
    if ($stateParams.id)
      ctrl.cargarInfo();

  }

  ctrl.init();
}]);
