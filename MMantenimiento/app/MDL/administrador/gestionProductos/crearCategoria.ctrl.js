angular.module('myMDLApp').controller('modalCategoriaCtrl', modalCategoriaCtrl);

modalCategoriaCtrl.$inject = ['$scope', '$uibModalInstance', 'NgTableParams','parametros'];

function modalCategoriaCtrl ($scope, $uibModalInstance, NgTableParams, parametros){

  var ctrl = this;

  ctrl.agregarCategoria = function () {
    $http.get("./app/MDL/administrador/gestionProductos/insertarCategoria.php",{params: {descripcion: ctrl.producto.descripcion, idCategoria: ctrl.producto.categoria.id, serie: ctrl.producto.serie, referencia: ctrl.producto.referencia, costo: ctrl.producto.costo}})
    .then(function (response) {
      // console.log(response);
      if (response.data == 'HECHO SIN ERRORES') {
        // console.log(ctrl.alumnoNuevo.correo);
        ctrl.cancelar();
        swal("¡Bien hecho!", "El producto fue registrado exitosamente" , "success");
      } else {
        swal("¡Opss!", "No se pudo registrar el alumno." , "error");
      }
    });
  }

  ctrl.seleccionarResponsable = function () {
    swal({
      title: "¿Estás seguro de que deseas seleccionar el responsable?",
      icon: "warning",
      buttons: {
        Cancelar: {
          text: "Cancelar",
          className: "btn btn-lg btn-danger"
        },
        Confirm: {
          text: "Sí, agregar",
          className: "btn btn-lg color-fondo-azul-pucp color-blanco"
        }
      },
      closeModal: false
    }).then(function (responsableConfirmado) {
      if (responsableConfirmado == "Confirm") {
        $uibModalInstance.close(ctrl.responsableSeleccionado);
      }
    });
  };

  ctrl.init = function(){
    ctrl.listarResponsables();
  }
  ctrl.cerrar = function () {
    $uibModalInstance.close(0);
  };

  ctrl.init();

};
