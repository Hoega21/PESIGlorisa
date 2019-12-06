<!DOCTYPE html>
<html>
<head>
  <!-- Custom styles for this template -->
  <link href="../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e5e5">
  <?php include("../Clases/Comprobante.php");  $recibos=Comprobante::ListarComprobantes(); 
        include("../Clases/Recibo.php");
   ?>
    <div class="container-fluid">
          <!-- Page Heading -->
          <br><br>
          <h1 class="h3 mb-2 text-gray-800 " align="center"  ><i>Recibo de Pago</i></h1>
          <br>
          <div class="card shadow mb-4">
            <div class="card-body">
               <div class="p-5">
                  <form class="user">
                      <div class="form-group row">
                      <label for="Compb" class="col-sm-2 col-form-label"  >Nro Comprobante: </label>
                      <div class="col-sm-10">
                       <select id="Compb" name="Compb" class="form-control "  onchange="NroComprobantito()";>
                        <?php $i=0; foreach($recibos as $recibo){ 
                          $NroComprobante=$recibo->TipoComprobante.'-'.$recibo->idSerie.'-'.$recibo->Correlativo; 
                          if($i==0){ $Deuditas=Recibo::ObtenerDatos($NroComprobante,'../'); $i=1;}  ?>
                           <option value="<?php echo $NroComprobante; ?>" ><?php echo $NroComprobante; ?></option>
                        <?php } ?>
                      </select>
                      </div>
                    </div>
                    <?php $i=0; foreach($Deuditas as $deuda){ ?>
                    <div class="form-group row">
                        <label for="CliNom" class="col-sm-2 col-form-label">Cliente:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="CliNom" id="CliNom" class="form-control "  value="<?php echo $deuda->Client; ?>" disabled>
                      </div>
                    </div>
                     <div class="form-group row" >
                        <label for="ComFec" class="col-sm-2 col-form-label" >Fecha:  </label>
                      <div class="col-sm-10">
                          <input type="date" name="ComFec" id="ComFec" disabled class="form-control " value="<?php echo date("Y-m-d");?>" >
                      </div>
                    </div>
                     <div class="form-group row" >
                        <label for="ReDeu" class="col-sm-2 col-form-label">Cantidad que adeuda:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="ReDeu" id="ReDeu" maxlenght="40"  disabled class="form-control" value="<?php echo $deuda->Saldo; ?>" >
                      </div>
                    </div>
                    <?php } ?>
                     <div class="form-group row" >
                        <label for="RePag" class="col-sm-2 col-form-label">Cantidad a pagar:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="RePag" id="RePag" class="form-control " >
                      </div>
                    </div>
                    <span  name="Save" id="Save" onclick="GuardarRecibo();" class="btn btn-danger btn-block"> Guardar</span>
                  </form>
                </div>
            </div>
          </div>
        </div>


   <!-- Bootstrap core JavaScript-->
  <script src="../lib/vendor/jquery/jquery.min.js"></script>
  <script src="../lib/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../lib/js/sb-admin-2.min.js"></script>


<script type="text/javascript">
  function GuardarRecibo(){
        var pr2= $("#RePag").val(); pr2=pr2.trim();
        if(pr2.length==0){
          alert('Ingrese una cantidad');
        }else{
          if(isNaN(pr2)){
              alert('Ingresar solo digitos');
          }else{
            var pr3= $("#ReDeu").val();
            pr3=parseFloat(pr3); 
            pr2=parseFloat(pr2); 
            if(pr2>pr3){
              alert('Solo se paga lo que se adeuda');
            }else{
              var pr= $("#Compb").val();
              var pr1= $("#ComFec").val();
              var parametros = { 
                "Compb" : pr, 
                "Fechoto" : pr1, 
                "Pagado" : pr2,
                "Totalo" : pr3
              };
              $.ajax({
                data:  parametros,
                url:   '../AjaxAiua.php', 
                type:  'post', //método de envio
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                  alert(response);
              }
            });
        
        } } }
}
</script>


<script type="text/javascript">
  function NroComprobantito(){
        var pr= $("#Compb").val();
        var parametros = { "NroComprobantito" : pr };
        $.ajax({
                data:  parametros,
                url:   '../AjaxAiua.php', 
                type:  'post', //método de envio
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                  var newEscalafon = JSON.parse(response);
                  
                  $("#CliNom").val(newEscalafon[0].Client);
                  $("#ReDeu").val(newEscalafon[0].Saldo);
                }
        });
}
</script>

</body>
</html>