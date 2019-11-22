var myMDLApp = angular.module("myMDLApp", ['ui.router', 'ui.router.stateHelper', 'ngCookies', 'ui.bootstrap', 'ngTable']);

myMDLApp.config(['stateHelperProvider', '$urlRouterProvider', function(stateHelperProvider, $urlRouterProvider){
  // $qProvider.errorOnUnhandledRejections(false);
  stateHelperProvider
  .state({
    name: 'administrador',
    url: '/administrador',
    templateUrl: 'app/MDL/administrador/administrador.html',
    children: [
      {
        name: 'gestion-productos',
        url: '/productos',
        templateUrl: 'app/MDL/administrador/gestionProductos/listarProductos.html',
        controller: 'gestorProductosCtrl as GPCtrl'
      },
      {
        name: 'agregar-producto',
        url: '/productos/agregar',
        templateUrl: 'app/MDL/administrador/gestionProductos/agregarProducto.html',
        controller: 'gestorProductosCtrl as GPCtrl'
      },
      {
        name: 'editar-producto',
        url: '/productos/editar/:id',
        templateUrl: 'app/MDL/administrador/gestionProductos/editarProducto.html',
        controller: 'gestorProductosCtrl as GPCtrl',
      },
      {
        name: 'agregar-categoria',
        url: '/categoria',
        templateUrl: 'app/MDL/administrador/gestionProductos/crearCategoria.html',
        controller: 'gestorProductosCtrl as GPCtrl'
      },
      {
        name: 'gestionar-peticiones',
        url: '/peticiones',
        templateUrl: 'app/MDL/administrador/gestionPeticiones/listarPeticiones.html',
        controller: 'gestorPeticionesCtrl as GPeCtrl',
      },
      {
        name: 'agregar-peticion',
        url: '/peticiones/agregar',
        templateUrl: 'app/MDL/administrador/gestionPeticiones/agregarPeticion.html',
        controller: 'gestorPeticionesCtrl as GPeCtrl'
      },
      {
        name: 'editar-peticion',
        url: '/peticion/editar/:id',
        templateUrl: 'app/MDL/administrador/gestionPeticiones/editarPeticion.html',
        controller: 'gestorPeticionesCtrl as GPeCtrl',
      },
      {
        name: 'informe-peticion',
        url: '/peticion/informe/:id',
        templateUrl: 'app/MDL/administrador/gestionPeticiones/informePeticion.html',
        controller: 'gestorPeticionesCtrl as GPeCtrl'
      },
      {
        name: 'gestionar-ordenes',
        url: '/ordenes',
        templateUrl: 'app/MDL/administrador/gestionOrdenes/listarOrdenes.html',
        controller: 'gestorOrdenesCtrl as GOCtrl',
      },
      {
        name: 'agregar-orden',
        url: '/ordenes/agregar',
        templateUrl: 'app/MDL/administrador/gestionOrdenes/agregarOrden.html',
        controller: 'gestorOrdenesCtrl as GOCtrl',
      },
      {
        name: 'editar-orden',
        url: '/ordenes/editar/:id',
        templateUrl: 'app/MDL/administrador/gestionOrdenes/editarOrden.html',
        controller: 'gestorOrdenesCtrl as GOCtrl'
  //     },
  //     {
  //       name: 'gestionar-grado',
  //       url: '/gestionGrado',
  //       templateUrl: 'app/SGA/administrador/gestionGrados/gestorGrados.html',
  //       controller: 'gestorGradosCtrl as GGCtrl'
  //     },
  //     {
  //       name: 'gestionar-seccion',
  //       url: '/gestionSeccion',
  //       templateUrl: 'app/SGA/administrador/gestionSecciones/gestorSecciones.html',
  //       controller: 'gestorSeccionesCtrl as GSCtrl'
      }
    ]
  // },
  // {
  //   name: 'alumno',
  //   url: '/alumno',
  //   templateUrl: 'app/SGA/alumno/alumno.html',
  //   children: [
  //     {
  //       name: 'inicioAlumno',
  //       url: '/inicioAlumno',
  //       templateUrl: 'app/SGA/alumno/principalAlumno.html',
  //       controller: 'alumnoCtrl as AlumCtrl'
  //     }
  //   ]
  }, { keepOriginalNames: true })
  $urlRouterProvider.otherwise("/administrador");
}]);

myMDLApp.controller("MDLController", ['$scope', '$state', function($scope, $state){
  var ctrl = this;

  ctrl.irProductos = function () {
    $state.go('gestion-productos')
  }
  ctrl.irPeticiones = function () {
    $state.go('gestion-peticiones')
  }

  ctrl.init = function() {
    // $state.go('gestion-productos')
  }

  ctrl.init();
}]);
