myMDLApp.controller("MDLRaiz", ['$scope', '$state', '$cookies', function($scope, $state, $cookies){
  var ctrl = this;

  ctrl.irProductos = function () {
    // $state.go('gestion-productos')
  }
  ctrl.irPeticiones = function () {
    // $state.go('gestion-peticiones')
  }

  ctrl.init = function() {
    // if ($cookies.get('rol') == 'administrador')
    //   $state.go('gestion-productos')
    // else if ($cookies.get('rol') == 'empleado')
    //   $state.go('gestion-productos-e')
  }

  ctrl.init();
}]);
