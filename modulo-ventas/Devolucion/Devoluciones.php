<!DOCTYPE html>
<html>
<head>
  <link href="../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e5e5">
    <div class="container-fluid">
        <?php 
              //error_reporting(0);
              include("../Clases/Comprobante.php");  $recibos=Comprobante::ListarComprobanteT(); 
              include("../Clases/Recibo.php");   
        ?>
          <br><br>
          <h1 class="h3 mb-2 text-gray-800 " align="center"  ><i>Devoluciones</i></h1>
          <br>
          <div class="card shadow mb-4">
            <div class="card-body">
               <div class="p-5">
                  <form class="user" method="post">
                      <div class="form-group row">
                      <label for="NameUser" class="col-sm-2 col-form-label" >Nro Comprobante: </label>
                      <div class="col-sm-7">
                       <select id="Compb" name="Compb" class="form-control " >
                        <?php $i=0; 
                        foreach($recibos as $recibo){ 
                          $NroComprobante=$recibo->TipoComprobante.'-'.$recibo->idSerie.'-'.$recibo->Correlativo; 
                          ?>
                           <option value="<?php echo $NroComprobante; ?>" ><?php echo $NroComprobante; ?></option>
                        <?php } ?>
                      </select>
                      </div class="col-sm-3">
                      <div> 
                        <button type="subtmit" id="clasita" name="clasita" class="btn btn-info btn-block" onclick="NroComprobantito()">Buscar</button>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
          </div>
        </div>

      <?php 
          if(isset($_POST['clasita']) ){
            $op=$_POST['Compb'];
            header('Location: DevolucionesCuerpo.php?cli='.$op);
            die();
          }
      ?>
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
                    $("#CliDni").val(newEscalafon[0].nro);
                    $("#ReDeu").val(newEscalafon[0].cli);
                    document.getElementById('Compb').disabled=true;
                  }
          });
  }
  </script>
  <script src="../lib/vendor/jquery/jquery.min.js"></script>
  <script src="../lib/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../lib/js/sb-admin-2.min.js"></script>
</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    $('#tablaProd').load('tablaProd.php');
    $('#tablaDevolver').load('../Ventas/tabla.php');
  });
</script>

 