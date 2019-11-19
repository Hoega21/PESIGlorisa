myMDLApp.controller("gestorOrdenesCtrl", ['$scope', '$state', function($scope, $state){
  var ctrl = this;

  ctrl.ordenesLista = [
    {
      id: 'd80a4015-0a7d-11ea-9dd4-e4e749869830',
      descripcion: 'ARREGLAR AUTO',
      fecha: '2019-11-18',
      responsable: 'ADMINISTRADOR',
      presupuesto: 1000.00,
      costo: null,
      finalizado: 0,
      estado: 1
    }
  ]

}]);
