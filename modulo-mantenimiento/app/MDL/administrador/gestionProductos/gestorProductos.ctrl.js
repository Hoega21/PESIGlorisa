myMDLApp.controller("gestorProductosCtrl", ['$scope', '$state', function($scope, $state){
  var ctrl = this;

  ctrl.productosLista = [
    {
      id: '85f60f6a-0a66-11ea-9dd4-e4e74986',
      descripcion: 'AUTO',
      tipo: 'CONSUMIBLE',
      referencia: null,
      codigoSAP: '1000',
      grupo: '[1000] GP0001',
      codigo: null,
      categoria: 'TODAS',
      costo: 100.00,
      estado: 1
    }
  ]
}]);
