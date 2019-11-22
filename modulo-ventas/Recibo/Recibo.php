<!DOCTYPE html>
<html>
<head>
  <!-- Custom styles for this template -->
  <link href="../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e5e5">
  <?php include("../Clases/Comprobante.php");  $recibos=Comprobante::ListarComprobantes(); ?>
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
                      <label for="NameUser" class="col-sm-2 col-form-label" >Nro Comprobante: </label>
                      <div class="col-sm-7">
                       <select id="Tip-Cliente" name="Tip-Cliente" class="form-control ">
                        <?php foreach($recibos as $recibo){ 
                              $Com='B'; $Tip='Boleta';
                              if($recibo->Tipo=='01'){ $Com='F'; $Tip='Factura'; }
                              $NroComprobante=$Com.$recibo->Serie.'-'.$recibo->Corr;
                              $NroComprobante2=$Com.'-'.$recibo->Serie.'-'.$recibo->Corr;
                          ?>
                           <option value="<?php echo $NroComprobante2; ?>" ><?php echo $NroComprobante; ?></option>
                        <?php } ?>
                      </select>
                      </div>
                      <div class="col-sm-3 ">
                        <button class="btn btn-info btn-block">Buscar</button>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="CliNom" class="col-sm-2 col-form-label" name="LCliNom" id="LCliNom">Cliente:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="CliNom" id="CliNom" class="form-control "  value="" disabled>
                      </div>
                    </div>
                    <div class="form-group row" >
                        <label for="CliNom" class="col-sm-2 col-form-label" name="LComFecha" id="LComFecha">Fecha:  </label>
                      <div class="col-sm-10">
                          <input type="date" name="ComFecha" id="ComFecha" required="" class="form-control " >
                      </div>
                    </div>
                     <div class="form-group row" >
                        <label for="CliNom" class="col-sm-2 col-form-label" name="LCliNom" id="LCliNom">Cantidad que adeuda:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="CliNom" id="CliNom" maxlenght="40" required="" disabled class="form-control "  value="" >
                      </div>
                    </div>
                     <div class="form-group row" >
                        <label for="CliNom" class="col-sm-2 col-form-label" name="LComFecha" id="LComFecha">Cantidad a pagar:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="ComFecha" id="ComFecha" required="" class="form-control " >
                      </div>
                    </div>
                    <div class="form-group row" >
                        <label for="CliNom" class="col-sm-2 col-form-label" name="LComFecha" id="LComFecha">Saldo Pendiente:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="ComFecha" id="ComFecha" required="" class="form-control " disabled>
                      </div>
                    </div>               
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


</body>
</html>