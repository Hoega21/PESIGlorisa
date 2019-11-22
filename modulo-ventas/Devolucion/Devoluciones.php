<!DOCTYPE html>
<html>
<head>
  <!-- Custom styles for this template -->
  <link href="../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e5e5">
    <div class="container-fluid">
        <?php include("../Clases/Comprobante.php");  $recibos=Comprobante::ListarComprobanteT(); ?>
          <!-- Page Heading -->
          <br><br>
          <h1 class="h3 mb-2 text-gray-800 " align="center"  ><i>Devoluciones</i></h1>
          <br>
          <div class="card shadow mb-4">
            <div class="card-body">
               <div class="p-5">
                  <form class="user">
                      <div class="form-group row">
                      <label for="NameUser" class="col-sm-2 col-form-label" >Nro Comprobante: </label>
                      <div class="col-sm-7">
                       <select id="TipDev" name="TipDev" class="form-control ">
                        <?php foreach($recibos as $recibo){ 
                              $NroComprobante=$recibo->TipoComprobante.'-'.$recibo->idSerie.'-'.$recibo->Correlativo;
                          ?>
                           <option value="<?php echo $NroComprobante; ?>" ><?php echo $NroComprobante; ?></option>
                        <?php } ?>
                      </select>
                      </div>
                      <div class="col-sm-3 ">
                        <span type="submit" name="buscar" id="buscar" class="btn btn-info btn-block" onclick="BuscarComprobante()" >Buscar</span>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="CliDni" class="col-sm-2 col-form-label">Nro Cliente:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="CliDni" id="CliDni" class="form-control "  value="" disabled>
                      </div>
                    </div>
                         <div class="form-group row" >
                        <label for="CliNom" class="col-sm-2 col-form-label">Nombre Cliente:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="CliNom" id="CliNom" maxlenght="40" required="" class="form-control "  disabled value="" >
                      </div>
                    </div>
                    <div class="form-group row" >
                        <label for="ComFecha" class="col-sm-2 col-form-label">Fecha:  </label>
                      <div class="col-sm-10">
                          <input type="date" name="ComFecha" id="ComFecha" required="" class="form-control " >
                      </div>
                    </div>
                
                    <hr>
                    <br>
                     <p>Productos Comprados:  </p>
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Elegir</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>fasdas</td>
                      <td>fasdas</td>
                      <td>dasdas</td>
                      <td><a href="EditarCliente.php">Editar</a></td>
                    </tr>
                  </tbody>
                </table>
                <br>
                   <p>Productos a devolver:  </p>
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Numero</th>
                      <th>Fecha</th>
                      <th>Nro Comprobante</th>
                      <th>Cliente</th>
                      <th>Direccion</th>
                      <th>Ver Pedido</th>
                      <th>Ver Factura</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>fasdas</td>
                      <td>fasdas</td>
                      <td>dasdas</td>
                       <td>dasdas</td>
                        <td>dasdas</td>
                         <td>dasdas</td>
                      <td><a href="EditarCliente.php">Editar</a></td>
                    </tr>
                  </tbody>
                </table>
                   <br>
                   <p style="font-size: 16px; font-style: italic;" align="center"><b>Las devoluciones respectivas seran inspeccionadas por el area de finanzas, en caso de aprobarse, realizaran una nota de credito </b>   </p>
                   <br>
                    <input type="submit" name="Save" id="Save" class="btn btn-outline-danger btn-block" value="Agregar">
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
  function BuscarComprobante(){
        var tip= $("#TipoCom").val();
        var pr= $("#CliDni").val(); pr=pr.trim();
        if(isNaN(pr)){
          alertify.alert('Solo ingresar digitos');
        }else{
          if(tip=='03' && pr.length!=8){
            alertify.alert('El DNI consta de 8 digitos');
          }else{
            if(tip=='01' && pr.length!=11){
              alertify.alert('El RUC consta de 11 digitos');
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

</body>
</html>