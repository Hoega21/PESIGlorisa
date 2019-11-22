  <link href="../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

                <div class="row">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Precio Unitario</th>
                      <th>Total</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php include("../Clases/Comprobante.php");  $detallitos=Comprobante::TodosDetalles(); $i=0;
                    foreach($detallitos as $detallito){ $i++;?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $detallito->Descrip; ?></td>
                      <td><?php echo $detallito->Cantidad; ?></td>
                      <td><?php echo $detallito->ValorUnitario; ?></td>
                      <td><?php echo $detallito->PrecioVenta; ?></td>
                      <td><a href="#" onclick="EliminarDetalle(<?php echo $detallito->idDetallitos; ?>)" class="btn btn-warning">Eliminar</a></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>

                </div>

              <script type="text/javascript">
                function EliminarDetalle(idDetallitos){
                      var parametros = { 
                        "idDetallitos" : idDetallitos
                       };
                      $.ajax({
                          data:  parametros,
                          url:   '../AjaxAiua.php', 
                          type:  'post', //método de envio
                          success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                            $('#tabla').load('tabla.php');
                          }
                      });
                  }
              </script>
   <!-- Bootstrap core JavaScript-->
  <script src="../lib/vendor/jquery/jquery.min.js"></script>
  <script src="../lib/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../lib/js/sb-admin-2.min.js"></script>
