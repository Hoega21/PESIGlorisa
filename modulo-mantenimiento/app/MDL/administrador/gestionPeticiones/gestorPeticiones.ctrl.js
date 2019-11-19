myMDLApp.controller("gestorPeticionesCtrl", ['$scope', '$state', function($scope, $state){
  var ctrl = this;

  ctrl.peticionesLista = [
    {
      id: '50623011-0a74-11ea-9dd4-e4e74986',
      descripcion: 'SE ROMPIÓ AUTO 1000',
      sector: '[10000] MA00001',
      codigoSAP: '100000',
      idOrdenTrabajo: null,
      solicitadoX: 'Administrador',
      fecha: '2019-11-18',
      fechaCierre: null,
      tipoMantenimiento: 'CORRECTIVO',
      equipo: 'MANTENIMIENTO INTERNO',
      responsable: null,
      fechaPrevista: null,
      prioridad: 0,
      peticionInicial: null,
      nota: null,
      progreso: 'INICIO',
      estado: 1
    }
  ]

  ctrl.regresarPeticiones = function () {
    window.location.href = "#!/administrador/peticiones";
  }

}]);
