<!DOCTYPE html>
<html>
<head>
  <link href="../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e5e5">
    <div class="container-fluid">
        <?php 
              error_reporting(0);
              include("../Clases/Comprobante.php");  $recibos=Comprobante::ListarComprobanteT(); 
              include("../Clases/Recibo.php");   
              Recibo::ElimTodoDetalle();
              if(isset($_GET['cli'])){
                $NroComp=$_GET['cli'];
                $cabecera=Recibo::ObtenerCliente($NroComp,'../');
                $detalle=Comprobante::ListarDetalle($NroComp);
              }
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
                      <div class="col-sm-10">
                          <input value="<?php echo $NroComp; ?>" class="form-control " disabled >
                      </div>
                    </div>
                    <?php foreach($cabecera as $cab){  ?>
                    <div class="form-group row">
                        <label for="CliDni" class="col-sm-2 col-form-label">NroCliente:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="CliDni" id="CliDni" class="form-control "  value="<?php echo $cab->nro; ?>" disabled>
                      </div>
                    </div>
                     <div class="form-group row" >
                        <label for="ReDeu" class="col-sm-2 col-form-label">Cliente:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="ReDeu" id="ReDeu" maxlenght="40"  disabled class="form-control" value="<?php echo $cab->cli; ?>" >
                      </div>
                    </div>
                    <?php } ?>
                    <div class="form-group row" >
                        <label for="ComFec" class="col-sm-2 col-form-label" >Fecha:  </label>
                      <div class="col-sm-10">
                          <input type="date" name="ComFec" id="ComFec" disabled class="form-control " value="<?php echo date("Y-m-d");?>" >
                      </div>
                    </div>
                    <hr>
                    <br>
                     <p>Productos Comprados:  </p>
                     <div id="tablaProd">
                        <div class="row">
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Observacion</th>
                                <th>Agregar</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; foreach($detalle as $det){ ?>
                                <tr>
                                  <td><?php echo ' '.$i; ?></td>
                                  <td><?php echo ' '.$det->productito; ?></td>
                                  <td><?php echo ' '.$det->cantidad; ?></td>
                                  <td><?php echo ' '.$det->PrVenta; ?></td>
                                  <td><input type="text" class="form-control " id="Obs<?php echo $det->idDetalle; ?>" name="Obs<?php echo $det->idDetalle; ?>"></td>
                                  <td><span class="btn btn-info btn-block" onclick="modalsito(<?php echo $det->idProd; ?>,'<?php echo $NroComp; ?>','<?php echo $det->productito; ?>',<?php echo $det->idDetalle; ?>);">Agregar</span></td>
                                </tr>
                                <?php $i++; } ?>          
                            </tbody>
                            </table>
                          </div>
                       </div>
                <br>
                   <p>Productos a devolver:  </p>
                      <div id="tablaDevolver"></div>
                   <br>
                   <p style="font-size: 16px; font-style: italic;" align="center"><b>Las devoluciones respectivas seran inspeccionadas por el area de finanzas, en caso de aprobarse, realizaran una nota de credito </b>   </p>
                   <br>
                    <input type="submit" name="Save" id="Save" class="btn btn-outline-danger btn-block" value="Agregar">
                  </form>
                </div>
            </div>
          </div>
        </div>

  <script src="../lib/vendor/jquery/jquery.min.js"></script>
  <script src="../lib/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../lib/js/sb-admin-2.min.js"></script>
  
  <?php 
    if(isset($_POST['Save'])){
        $Hol=Recibo::InsertarDevolucion($NroComp);
        echo "<script>alert('".$Hol."');</script>";
    }
  ?>

</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    $('#tablaDevolver').load('tablaProd.php');
  });
</script>

<script type="text/javascript">
  function modalsito(idDescrip, idComp ,Prod,idotro){
        var puchi="#Obs"+idotro;
        var observacion= $(puchi).val();
        var parametros = { "idDescrip" : idDescrip,
          "Obser" : observacion,
          "idComp" : idComp,
          "VProd" : Prod
         };
        $.ajax({
            data:  parametros,
            url:   'Ajax.php', 
            type:  'post', //método de envio
            success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
              $('#tablaDevolver').load('tablaProd.php');
            }
        });
  }
</script>


