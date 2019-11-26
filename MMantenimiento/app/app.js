var myMDLApp = angular.module("myMDLApp", ['ui.router', 'ui.router.stateHelper', 'ngCookies', 'ui.bootstrap', 'ngTable', 'ui.calendar']);

myMDLApp.config(['stateHelperProvider', '$urlRouterProvider', function(stateHelperProvider, $urlRouterProvider){
  // $qProvider.errorOnUnhandledRejections(false);
  stateHelperProvider
  .state({
    name: 'raiz',
    url: '/raiz',
    templateUrl: 'app/MDL/raiz.html',
    controller: 'MDLRaiz',
    children: [
      {
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
          },
          {
            name: 'informe-orden',
            url: '/ordenes/informe/:id',
            templateUrl: 'app/MDL/administrador/gestionOrdenes/informeOrden.html',
            controller: 'gestorOrdenesCtrl as GOCtrl'
          },
          {
            name: 'calendario',
            url: '/mantenimientos',
            templateUrl: 'app/MDL/administrador/gestionMantenimiento/calendar.html',
            controller: 'calendarCtrl as CalCtrl'
          }
        ]
      },
      {
        name: 'empleado',
        url: '/empleado',
        templateUrl: 'app/MDL/empleado/empleado.html',
        children: [
          {
            name: 'gestion-productos-e',
            url: '/productosE',
            templateUrl: 'app/MDL/empleado/gestionProductos/listarProductos.html',
            controller: 'gestorProductosEmpCtrl as GPEmpCtrl'
          },
          {
            name: 'agregar-producto-e',
            url: '/productosE/agregar',
            templateUrl: 'app/MDL/empleado/gestionProductos/agregarProducto.html',
            controller: 'gestorProductosEmpCtrl as GPEmpCtrl'
          },
          {
            name: 'editar-producto-e',
            url: '/productosE/editar/:id',
            templateUrl: 'app/MDL/empleado/gestionProductos/editarProducto.html',
            controller: 'gestorProductosEmpCtrl as GPEmpCtrl',
          },
          {
            name: 'agregar-categoria-e',
            url: '/categoriaE',
            templateUrl: 'app/MDL/empleado/gestionProductos/crearCategoria.html',
            controller: 'gestorProductosEmpCtrl as GPEmpCtrl'
          },
          {
            name: 'gestionar-peticiones-e',
            url: '/peticionesE',
            templateUrl: 'app/MDL/empleado/gestionPeticiones/listarPeticiones.html',
            controller: 'gestorPeticionesEmpCtrl as GPeEmpCtrl',
          },
          {
            name: 'agregar-peticion-e',
            url: '/peticionesE/agregar',
            templateUrl: 'app/MDL/empleado/gestionPeticiones/agregarPeticion.html',
            controller: 'gestorPeticionesEmpCtrl as GPeEmpCtrl'
          },
          {
            name: 'editar-peticion-e',
            url: '/peticionE/editar/:id',
            templateUrl: 'app/MDL/empleado/gestionPeticiones/editarPeticion.html',
            controller: 'gestorPeticionesEmpCtrl as GPeEmpCtrl',
          },
          {
            name: 'informe-peticion-e',
            url: '/peticionE/informe/:id',
            templateUrl: 'app/MDL/empleado/gestionPeticiones/informePeticion.html',
            controller: 'gestorPeticionesEmpCtrl as GPeEmpCtrl'
          },
          {
            name: 'gestionar-ordenes-e',
            url: '/ordenesE',
            templateUrl: 'app/MDL/empleado/gestionOrdenes/listarOrdenes.html',
            controller: 'gestorOrdenesEmpCtrl as GOEmpCtrl',
          },
          {
            name: 'informe-orden-e',
            url: '/ordenesE/informe/:id',
            templateUrl: 'app/MDL/empleado/gestionOrdenes/informeOrden.html',
            controller: 'gestorOrdenesEmpCtrl as GOEmpCtrl'
          }
        ]
      }
    ]
  }, { keepOriginalNames: true })
  $urlRouterProvider.otherwise("/raiz");
}]);

myMDLApp.controller("MDLController", ['$scope', '$state', '$cookies', function($scope, $state, $cookies){
  var ctrl = this;
  ctrl.rol = $cookies.get('rol');
  if (window.location.href.includes('administrador')) {
    $cookies.put('rol', 'administrador');
    ctrl.letrita = '';
    console.log($cookies.get('rol'));
  } else {
    $cookies.put('rol', 'empleado');
    ctrl.letrita = 'E';
    console.log($cookies.get('rol'));
  }
  ctrl.rol = $cookies.get('rol');

  ctrl.init = function() {
    // $state.go('gestion-productos')
  }

  ctrl.init();
}]);
