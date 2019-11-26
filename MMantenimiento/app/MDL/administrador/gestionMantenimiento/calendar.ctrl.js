myMDLApp.controller("calendarCtrl", ['$scope', '$state', 'NgTableParams', '$location', '$http', '$cookies', '$stateParams',
function($scope, $state, NgTableParams, $location, $http, $cookies, $stateParams){
  var ctrl = this;

  $(document).ready(function () {
    // for now, there is something adding a click handler to 'a'
    var events = [];
    var parametros = { "var" : 'var' };
    var peticiones = [];
    $.ajax({
      data: parametros,
      url:   './app/MDL/administrador/gestionMantenimiento/cargarPeticiones.php',
      type:  'post', //método de envio
      success:  function (response) {
        // console.log(response);
        response.forEach(function(element) {
          if (element.progreso == 'FINALIZADO') {
            peticiones.push({
              id: element.id,
              title: element.descripcion,
              start: element.fecha,
              end: element.fechaCierre,
              allDay: true,
              url: '#!/raiz/administrador/mantenimientos',
              className: ['verde']
            });
          } else if (element.idOrdenTrabajo != null) {
            peticiones.push({
              id: element.id,
              title: element.descripcion,
              start: element.fecha,
              end: element.fechaPrevista,
              allDay: true,
              url: '#!/raiz/administrador/mantenimientos',
              className: ['naranja']
            });
          } else {
            peticiones.push({
              id: element.id,
              title: element.descripcion,
              start: element.fecha,
              allDay: true,
              url: '#!/raiz/administrador/mantenimientos',
              className: ['rojo']
            });
          }
        });
      }
    });

    setTimeout(function(){
      // setup a few events
      $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,listWeek'
        },
        events: events.concat(peticiones)
      });
    }, 1500);

  });

  ctrl.llamada = function () {}
}]);
