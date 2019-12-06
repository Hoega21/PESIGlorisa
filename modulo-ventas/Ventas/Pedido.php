<!DOCTYPE html>
<html>
<head>
  <!-- Custom styles for this template -->
  <link href="../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e5e5">
  <?php error_reporting(0); ?>
  <?php include("../Clases/Moneda.php");    $monedas=Moneda::ListarMonedas(); ?>
  <?php include("../Clases/Producto.php");  $productos=Producto::ListarProductos(); ?>
  <?php include("../Clases/Comprobante.php"); Comprobante::ElimTodoDetalle();
?>
    <div class="container-fluid">
          <!-- Page Heading -->
          <br>
          <h1 class="h3 mb-2 text-gray-800 " align="center"  ><i>Nuevo Pedido</i></h1>
          <br>
          <div class="card shadow mb-4">
            <div class="card-body">
               <div class="p-5">
                  <form class="user">
                      <div class="form-group row">
                      <label for="NameUser" class="col-sm-2 col-form-label" >Tipo Cliente: </label>
                      <div class="col-sm-10">
                       <select id="Tip-Cliente" name="Tip-Cliente" class="form-control " onchange="TypeClient();">
                         <option value="PN" >Persona Natural</option>
                         <option value="PJ" >Persona Juridica</option>
                      </select>
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
                        <label for="CliNom" class="col-sm-2 col-form-label" name="LCliNom" id="LCliNom">Nombre Completo:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="CliNom" id="CliNom" class="form-control "  value="" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="CliDep" class="col-sm-2 col-form-label" >Departamento:  </label>
                      <div class="col-sm-3">
                          <input type="text" name="CliDep" id="CliDep" maxlenght="20" required="" class="form-control "  value="La Libertad" placeholder="Escribir ...">
                      </div>
                       <label for="CliProv" class="col-sm-1 col-form-label" >Provincia:  </label>
                      <div class="col-sm-3">
                          <input type="text" name="CliProv" id="CliProv" maxlenght="20" required="" class="form-control "  value="Trujillo" placeholder="Escribir ...">
                      </div>
                       <label for="CliDis" class="col-sm-1 col-form-label">Distrito:  </label>
                      <div class="col-sm-2">
                          <input type="text" name="CliDis" id="CliDis" maxlenght="20" required="" class="form-control "  value="Trujillo" placeholder="Escribir ...">
                      </div>
                    </div>
                      <div class="form-group row" >
                        <label for="CliDire" class="col-sm-2 col-form-label">Direccion:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="CliDire" id="CliDire" maxlenght="100" required="" class="form-control " >
                      </div>
                    </div>
                      <div class="form-group row" >
                        <label for="ComFec" class="col-sm-2 col-form-label" >Fecha:  </label>
                      <div class="col-sm-10">
                          <input type="date" min="<?php echo date("Y-m-d");?>" max="2020-12-31" name="ComFec" id="ComFec" required="" class="form-control " value="<?php echo date("Y-m-d");?>" >
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
                  <div id="tabla"></div>
                    <br>
                    <div class="form-group row">
                      <label for="ComTo" class="col-sm-1 col-form-label"  >Total Pagar:  </label>
                      <div class="col-sm-3">
                        <input type="text" name="ComTo" disabled id="ComTo" class="form-control "  value="0.00">
                      </div>
                    </div>
                    <br>
                  <div class="col-sm-12">
                      <span onclick="InsertarPedido();" class="btn btn-danger btn-block" >Guardar</span>
                  </div>
                </form>
                </div>
            </div>
          </div>
        </div>


  <script type="text/javascript">
      function  InsertarPedido(){
          var nom=document.getElementById('CliNom').value;
          if(nom.length==0 || nom=='No se encontro cliente'){
             alert('Digitar cliente');
          }else{
              var Dep=document.getElementById('CliDep').value;
              var Prov= document.getElementById('CliProv').value;
              var Dis=document.getElementById('CliDis').value;
              var dni= document.getElementById('CliDni').value;
              var Dir=document.getElementById('CliDire').value;
              var Fecha= document.getElementById('ComFec').value;
              var Totl=document.getElementById('ComTo').value;
            var parametros = { "Depati" : Dep,
                               "Provati" : Prov,
                               "Distrati" : Dis,
                               "Dniti" : dni,
                               "Directi" : Dir,
                               "Fechiti" : Fecha,
                               "Totiti" : Totl
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
          var tipo= document.getElementById('Tip-Cliente').value;
          if(tipo=='PN'){
            document.getElementById("LCliDni").innerHTML='Dni: ';                 
            document.getElementById("LCliNom").innerHTML='Nombre Completo: ';        
             document.getElementById("CliDni").setAttribute("maxlength","8");
          }else{
            document.getElementById("LCliDni").innerHTML='Ruc: ';                 
            document.getElementById("LCliNom").innerHTML='Razon Social: ';    
             document.getElementById("CliDni").setAttribute("maxlength","11");
          }
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

    <script type="text/javascript">
    function BuscarPersona(){
          var tip= $("#Tip-Cliente").val();
          var pr= $("#CliDni").val(); pr=pr.trim();
          if(isNaN(pr)){
            alert('Solo ingresar digitos');
          }else{
            if(tip=='PN' && pr.length!=8){
              alert('El DNI consta de 8 digitos');
            }else{
              if(tip=='PJ' && pr.length!=11){
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

   <!-- Bootstrap core JavaScript-->
  <script src="../lib/vendor/jquery/jquery.min.js"></script>
  <script src="../lib/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../lib/js/sb-admin-2.min.js"></script>


</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    $('#tabla').load('tabla.php');
  });
</script>