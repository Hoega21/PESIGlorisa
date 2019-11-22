<!DOCTYPE html>
<html>
<head>
  <!-- Custom styles for this template -->
  <link href="../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e5e5">
<?php include("../Clases/Clientes.php");  $clientes=Clientes::ListarClientes(); ?>
<?php error_reporting(0); ?>
   <div class="container-fluid">
          <!-- Page Heading -->
          <br><br>
          <h1 class="h3 mb-2 text-gray-800 " align="center"  ><i>Listar Clientes</i></h1>
          <br>
           <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tipo Cliente</th>
                      <th>Nro Documento</th>
                      <th>Cliente</th>
                      <th>Direccion</th>
                      <th>Correo</th>
                      <th>Perfil</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                     <th>Tipo Cliente</th>
                      <th>Nro Cliente</th>
                      <th>Cliente</th>
                      <th>Direccion</th>
                      <th>Correo</th>
                      <th>Perfil</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach($clientes as $cliente){ ?>
                    <tr>
                      <td><?php echo $cliente->TipoPersona; ?></td>
                      <td><?php echo $cliente->NroDocumento; ?></td>
                      <td><?php echo $cliente->NombreCliente; ?></td>
                      <td><?php echo $cliente->Direccion; ?></td>
                      <td><?php echo $cliente->Correo; ?></td>
                      <td>
                        <span  class="btn btn-warning" onclick="modalsito('<?php echo $cliente->TipoPersona; ?>','<?php echo $cliente->NroDocumento; ?>','<?php echo $cliente->NombreCliente; ?>','<?php echo $cliente->Direccion; ?>',
                        '<?php echo $cliente->Correo; ?>')"
                         >Editar</span>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        
    <script type="text/javascript">
      function modalsito(tipo,nro,nombre,direc,correo) {
        $("div").find("h5").text('Editar Cliente');
        $(".modal-body #text-tipo").val(tipo);
        $(".modal-body #nro").val(nro);
        $(".modal-body #text-nombre").val(nombre);
        $(".modal-body #text-direc").val(direc);
        $(".modal-body #text-correo").val(correo);
        $('#exampleModal2').modal('show');
      }
    </script>
    <?php include('modalInfo.php'); ?>

   <!-- Bootstrap core JavaScript-->
  <script src="../lib/vendor/jquery/jquery.min.js"></script>
  <script src="../lib/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../lib/js/sb-admin-2.min.js"></script>
   <!-- Page level plugins -->
  <script src="../lib/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../lib/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
  <script src="../lib/js/demo/datatables-demo.js"></script>


</body>
</html>