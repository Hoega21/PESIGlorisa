<!DOCTYPE html>
<html>
<head>
  <!-- Custom styles for this template -->
  <link href="../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../lib/css/alertify.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e5e5">
<?php error_reporting(0); ?>
<?php include("../Clases/Moneda.php");    $monedas=Moneda::ListarMonedas(); ?>
<?php include("../Clases/Producto.php");  $productos=Producto::ListarProductos(); ?>
<?php include("../Clases/Clientes.php");  ?>
<?php include("../Clases/Comprobante.php"); $series=Comprobante::ListarSerie(); 
  $Corr=Comprobante::ObtenerCorrelativo('/..','03');
  Comprobante::ElimTodoDetalle();
?>

    <div class="container-fluid"> 
          <!-- Page Heading --> 
          <br>
          <h1 class="h3 mb-2 text-gray-800 " align="center"  ><i>Nuevo Comprobante</i></h1>
          <br>
          
          <div class="card shadow mb-4">
            <div class="card-body">
               <div class="p-5">
                  <form class="user">
                    <div class="form-group row">
                      <label for="TipoCom" class="col-sm-2 col-form-label" >Tipo Comprobante: </label>
                      <div class="col-sm-2">
                       <select id="TipoCom" name="TipoCom" class="form-control " onchange="TypeClient();">
                         <option value="03" >Boleta</option>
                         <option value="01" >Factura</option>
                      </select>
                      </div>
                      <label for="LSerie" class="col-sm-1 col-form-label" >Serie:  </label>
                      <div class="col-sm-3">
                      <select id="LSerie" name="LSerie" class="form-control">
                      <?php foreach($series as $serie){ ?>
                         <option value="<?php echo $serie->idSerie; ?>" ><?php echo $serie->idSerie.'-'. $serie->Direccion; ?></option>
                      <?php } ?>
                      </select>
                      </div>
                       <label for="LCorr" class="col-sm-1 col-form-label" >Correlativo:  </label>
                       <div class="col-sm-3">
                          <input type="text" name="LCorr" id="LCorr" class="form-control "  value="<?php echo $Corr; ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="CliDni" class="col-sm-2 col-form-label" name="LCliDni" id="LCliDni" >DNI:  </label>
                      <div class="col-sm-7">
                          <input type="text" name="CliDni" id="CliDni" maxlength="8" required="" class="form-control "  value="" placeholder="Escribir ...">
                      </div>
                      <div class="col-sm-3">
                           <span name="buscar" id="buscar" class="btn btn-info btn-block" onclick="BuscarPersona()" >Buscar</span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <p id="NameResguardo" name="NameResguardo" hidden=""></p>
                        <label for="CliNom" class="col-sm-2 col-form-label" name="LCliNom" id="LCliNom">Nombre Completo:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="CliNom" id="CliNom" maxlenght="40" required="" class="form-control "  value="" disabled>
                      </div>
                    </div>
                     <div class="form-group row" >
                        <label for="ComFec" class="col-sm-2 col-form-label" >Fecha:  </label>
                      <div class="col-sm-10">
                          <input type="date" min="2019-10-01" max="2020-12-31" name="ComFec" id="ComFec" required="" class="form-control " value="<?php echo date("Y-m-d");?>" >
                      </div>
                    </div>
                    <hr>
                     <h4 class="h3 mb-2 text-gray-800 " align="center"  ><i>Productos</i></h4>
                     <div class="form-group row">
                      <label for="LProducto" class="col-sm-2 col-form-label" >Producto: </label>
                      <div class="col-sm-10">
                       <select id="LProducto" name="LProducto" class="form-control " onchange="ObtenerPrecio()">
                        <?php $i=0; foreach($productos as $producto){  if($i==0){$prec=$producto->precio; $i=1;}?>
                         <option value="<?php echo $producto->idProd; ?>" ><?php echo $producto->nomProd.'-'.$producto->marProd; ?></option>
                         <?php } ?>
                      </select>
                      </div>
                    </div>

                    <div class="form-group row">
                        <label for="ProCant"  class="col-sm-2 col-form-label">Cantidad:  </label>
                      <div class="col-sm-3">
                          <input type="number" name="ProCant" id="ProCant" min="0" max="999" class="form-control "  value="" placeholder="Escribir ...">
                      </div>
                       <label for="ProPre" class="col-sm-1 col-form-label">Precio:  </label>
                      <div class="col-sm-3">
                          <input type="text" name="ProPre" id="ProPre" class="form-control "  value="<?php echo $prec; ?>" disabled>

                      </div>
                      <div class="col-sm-3">
                      <span class="btn btn-info btn-block" onclick="AgregarDetallitos()">Agregar</span>
                      </div>
                    </div>
                    <br>
                   <br>
                  <input type="text" name="ComVe" id="ComVe" class="form-control "  value="0.00" hidden="">
                   <div id="tabla"></div>
                   <br>
                    <div class="form-group row">
                      <label for="ComTo" class="col-sm-1 col-form-label"  >Total Pagar:  </label>
                      <div class="col-sm-3">
                        <input type="text" name="ComTo" disabled id="ComTo" class="form-control "  value="0.00">
                      </div>
                      <label for="ComPa" class="col-sm-1 col-form-label"  >Tipo Pago:  </label>
                      <div class="col-sm-3">
                        <select id="ComPa" name="ComPa" class="form-control " onchange="CambioTotal();">
                          <option value="Contado" >Contado</option>
                          <option value="Credito" >Credito</option>
                        </select>
                      </div>
                      <label for="ComMon" class="col-sm-1 col-form-label" >Moneda: </label>
                      <div class="col-sm-3">
                        <select id="ComMon" name="ComMon" class="form-control " onchange="CambioTotal();">
                          <?php foreach($monedas as $moneda){ ?>
                            <option value="<?php echo $moneda->idMoneda; ?>" ><?php echo $moneda->Monedita; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <br>
                  <div class="col-sm-12">
                      <span onclick="InsertarComprobante();" class="btn btn-danger btn-block" >Guardar</span>
                  </div>
                </form>
                </div>
            </div>
          </div>
        </div>


  <script type="text/javascript">
      function  InsertarComprobante(){
          var tipo= document.getElementById('TipoCom').value;
          var nom=document.getElementById('CliNom').value;

          if(tipo=='01' && (nom.length==0 || nom=='No se encontro cliente')){
             alert('Las facturas siempre deben tener cliente');
          }else{
              var serie=document.getElementById('LSerie').value;
              var corr= document.getElementById('LCorr').value;
              var dni=document.getElementById('CliDni').value;
              var fecha= document.getElementById('ComFec').value;
              var mon=document.getElementById('ComMon').value;
              var total= document.getElementById('ComTo').value;
              var pa=document.getElementById('ComPa').value;
            var parametros = { "Tipito" : tipo,
                               "Serita" : serie,
                               "Corrito" : corr,
                               "Dnito" : dni,
                               "Fechita" : fecha,
                               "Monedita" : mon,
                               "Totalsito" : total,
                               "Paguito" : pa
             };
            $.ajax({
                    data:  parametros,
                    url:   '../AjaxAiua.php', 
                    type:  'post', //método de envio
                    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                           alert(response);
                    }
            });
          }
      } 
  </script>



    <script type="text/javascript">
      function  TypeClient(){
          var tipo= document.getElementById('TipoCom').value;
          if(tipo=='03'){
            document.getElementById("LCliDni").innerHTML='Dni: ';                 
            document.getElementById("LCliNom").innerHTML='Nombre Completo: ';        
             document.getElementById("CliDni").setAttribute("maxlength","8");
          }else{
            document.getElementById("LCliDni").innerHTML='Ruc: ';                 
            document.getElementById("LCliNom").innerHTML='Razon Social: ';    
             document.getElementById("CliDni").setAttribute("maxlength","11");
          }
          var parametros = { "TipoCom" : tipo };
          $.ajax({
                  data:  parametros,
                  url:   '../AjaxAiua.php', 
                  type:  'post', //método de envio
                  success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                          $("#LCorr").val(response.trim());
                  }
          });
      } 
  </script>


<script type="text/javascript">
  function ObtenerPrecio(){
        var pr= $("#LProducto").val();
        var parametros = { "idProducto" : pr };
        $.ajax({
                data:  parametros,
                url:   '../AjaxAiua.php', 
                type:  'post', //método de envio
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#ProPre").val(response.trim());
                }
        });
}
</script>


<script type="text/javascript">
  function BuscarPersona(){
        var tip= $("#TipoCom").val();
        var pr= $("#CliDni").val(); pr=pr.trim();
        if(isNaN(pr)){
          alert('Solo ingresar digitos');
        }else{
          if(tip=='03' && pr.length!=8){
            alert('El DNI consta de 8 digitos');
          }else{
            if(tip=='01' && pr.length!=11){
              alert('El RUC consta de 11 digitos');
            }else{
              $("#NameResguardo").html(pr);
              var parametros = { "CliDni" : pr };
              $.ajax({
                    data:  parametros,
                    url:   '../AjaxAiua.php', 
                    type:  'post', //método de envio
                    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    $("#CliNom").val(response.trim());
                  }
              });
            }
          }
        }
    }
</script>
 
<script type="text/javascript">
  function AgregarDetallitos(){
        var pr1= $("#ProPre").val();
        var pr2= $("#ProCant").val(); 
        var pr3=0;
        if(pr2.length==0){
          alert("La cantidad no puede ser 0");
        }else{
          if(pr2==0 ){
            alert("La cantidad no puede ser 0");
          }else{
            var pr4= $("#LProducto").val(); 
            var pr6= $("#ComTo").val();
            var combo=document.getElementById("LProducto");
            pr1=parseFloat(pr1); pr2=parseFloat(pr2);
            pr6=parseFloat(pr6); 
            var pr5= combo.options[combo.selectedIndex].text; 
            var parametros = { 
              "ProPre" : pr1,
              "ProCant" : pr2,
              "ProTo" : pr3,
              "LProducto" : pr4,
              "ProdDescr" : pr5
            };
            $.ajax({
                data:  parametros,
                url:   '../AjaxAiua.php', 
                type:  'post', //método de envio
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                  $('#tabla').load('tabla.php');
                  $("#ComTo").val(pr6+pr2*pr1);
                }
            });
          }
        }
  }
</script>

   <!-- Bootstrap core JavaScript-->
  <script src="../lib/vendor/jquery/jquery.min.js"></script>
  <script src="../lib/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../lib/js/sb-admin-2.min.js"></script>
  <script src="../lib/js/alertify.js"></script>
</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    $('#tabla').load('tabla.php');
  });
</script>
